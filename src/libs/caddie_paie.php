<?php

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class Paiement {

    static private $singleton = null;
    private $itemList;
    private $apiContext;
    private $totalAmount;
    private $currencyCode = 'EUR';

    private function __construct() {
        global $root;

        #Include deps
        $paypalRoot = $root . 'libs' . DS . 'paypal' . DS;
        include $paypalRoot . 'autoload.php';

        $this->payer = new Payer();
        $this->payer->setPaymentMethod("paypal");
        $this->itemList = new ItemList();
        $this->totalAmount = 0.;

        $clientId = 'AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS';
        $clientSecret = 'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL';
        $this->apiContext = $this->getApiContext($clientId, $clientSecret);
    }

    public function addProduct($description, $price, $quantity = 1) {
        $item = new Item();
        $item->setName($description)
                ->setCurrency($this->currencyCode)
                ->setQuantity($quantity)
                ->setSku("123123") // Similar to `item_number` in Classic API
                ->setPrice($price);
        $this->itemList->addItem($item);

        $this->totalAmount += $price;
    }

    public function sendRequest() {
        $details = new Details();
        $details->setShipping(0)
                ->setTax(0)
                ->setSubtotal($this->totalAmount);

        $amount = new Amount();
        $amount->setCurrency($this->currencyCode)
                ->setTotal($this->totalAmount)
                ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($this->itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());

        $baseUrl = 'http://localhost/';
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
                ->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");

        $payment = new Payment();
        $payment->setIntent("sale")
                ->setPayer($this->payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));

        try {
            $payment->create($this->apiContext);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            var_dump($ex);
            exit(1);
        }

        $approvalUrl = $payment->getApprovalLink();
        echo $approvalUrl;
    }

    private function getApiContext($clientId, $clientSecret) {
        global $tmpdir, $config;

        $payconf = $config['PayPal'];
        if ($payconf['enable'] === 'no') {
            echo "FATAL ERROR: PayPal not configured.";
            exit(2);
        }

        $apiContext = new ApiContext(
                new OAuthTokenCredential(
                $clientId, $clientSecret
                )
        );

        $apiContext->setConfig(
                array(
                    'mode' => $payconf['enable'] == 'prod' ? 'live' : 'sandbox',
                    'log.LogEnabled' => false,
                    'log.FileName' => $tmpdir . '/PayPal.log',
                    'log.LogLevel' => 'INFO',
                    'cache.enabled' => true,
                    'cache.FileName' => $tmpdir . 'paypal.cache',
                )
        );

        return $apiContext;
    }

    public static function getInstance() {
        if (self::$singleton === null) {
            self::$singleton = new Paiement();
        }
        return self::$singleton;
    }

}
