<?php

$genRoot = dirname(__FILE__) . '/';
define('FPDF_FONTPATH', $genRoot . 'fonts/');
require_once $genRoot . 'codegen.php';
require_once $genRoot . 'fpdf.php';
require_once $genRoot . 'makefont/makefont.php';

class TicketGen
{
	private $conf = array();
	private $img;
	private $pdf;
	
	public function __construct($config = array())
	{
	}

	private function reload_conf($type)
	{
		require $GLOBALS['genRoot'] . 'config.php';
		$this->conf = $config['default'];
		if (isset($config[$type]))
			$this->conf  = $config[$type];
		//$this->conf = array_merge_recursive($config['default'], $config[$type]);
	}
	
	private function getimg($filename)
	{
		$ext = strtolower(strrchr($filename, '.'));

		if ($ext == '.jpg')
			return imagecreatefromjpeg($filename);
		if ($ext == '.png')
			return imagecreatefrompng($filename);
		if ($ext == '.gif')
			return imagecreatefromgif($filename);

		trigger_error('No handler for this file type : ' . $filename);
	}

	private function colordecode($color, &$result)
	{
		$result = array(
			hexdec(substr($color, 1, 2)),
			hexdec(substr($color, 3, 2)),
			hexdec(substr($color, 5, 2)),
		);
	}

	private function addtext($tconf, $txt)
	{
		extract(array_merge(array(
			'color' => '#000000',
			'font' => 'Rom_Ftl_Srif_bold_Std_2011.TTF',
			'posx' => 30,
			'posy' => 30,
			'size' => 20,
			'angle' => 0,
		), $tconf));
		
		$this->colordecode($color, $colorc);
		$color = imagecolorallocate($this->img, $colorc[0], $colorc[1], $colorc[2]);
		if ($color === false)
			trigger_error('Cant make color');
		
		$font = $GLOBALS['genRoot'] . 'fonts/' . $font;
		
		imagettftext($this->img, $size, $angle, $posx, $posy, $color, $font, $txt);
	}

	private function addblank($tconf)
	{
		extract(array_merge(array(
			'color' => '#000000',
			'font' => 'Rom_Ftl_Srif_bold_Std_2011.TTF',
			'posx' => 30,
			'posy' => 30,
			'size' => 20,
			'angle' => 0,
		), $tconf));
		
		$color = imagecolorallocate($this->img, 255, 255, 255);
		if ($color === false)
			trigger_error('Cant make color');
		
		$size = floatval($size) * floatval($this->conf['blank_factor']);
		imagefilledrectangle($this->img, $posx, $posy - $size, $posx + $this->conf['blank_width'], $posy, $color);
	}

	public function mkticket($data)
	{
		$this->reload_conf($data['type']);
		$this->img = $this->getimg($GLOBALS['genRoot'] . 'frames/' . $this->conf['img']);

		if (isset($this->conf['gamma']))
			imagegammacorrect($this->img, 1.0, $this->conf['gamma']);

		if (isset($data['firstname']) && $data['firstname'])
			$this->addtext($this->conf['firstname'], $data['firstname']);
		else
			$this->addblank($this->conf['firstname']);

		if (isset($data['lastname']) && $data['lastname'])
			$this->addtext($this->conf['lastname'], $data['lastname']);
		else
			$this->addblank($this->conf['lastname']);

		if (isset($data['ticketid']))
			$this->addtext($this->conf['ticketid'], $data['ticketid']);

		$this->addtext($this->conf['cb_label'], $data['barcode']);

		checksum($data['barcode']);
		writecode($this->img, $this->conf['codebar'], $data['barcode']);
	}
	
	public function display()
	{
		header('Content-Type: image/jpeg');
		imagejpeg($this->img);
	}
	
	public function writeto($filename)
	{
		imagejpeg($this->img, $filename);
	}
	
	private function addptext($styleconf, $text, $posx = null, $posy = null)
	{
		static $cfonts = array();
		
		$font = $this->conf[$styleconf . '_font'];
		$size = isset($this->conf[$styleconf . '_size']) ? $this->conf[$styleconf . '_size'] : 10;
		$style = isset($this->conf[$styleconf . '_style']) ? $this->conf[$styleconf . '_style'] : '';
		$color = isset($this->conf[$styleconf . '_color']) ? $this->conf[$styleconf . '_color'] : '#000000';
		$height = isset($this->conf[$styleconf . '_height']) ? $this->conf[$styleconf . '_height'] : 0;
		$text = utf8_decode($text);
		
		if (!is_file(FPDF_FONTPATH . $font . '.php'))
		{
			ob_start();
			MakeFont(FPDF_FONTPATH . $font . '.ttf');
			file_put_contents(FPDF_FONTPATH . $font . '.log', ob_get_contents());
			ob_end_clean();
		}
		
		if (!isset($cfonts[$font]))
			$cfonts[$font] = $this->pdf->AddFont($font, $style, $font . '.php');
		$this->pdf->SetFont($font, $style, $size);
		$this->colordecode($color, $comp);
		
		$this->pdf->SetTextColor($comp[0], $comp[1], $comp[2]);

		if ($posx !== null && $posy !== null)
		{
			$this->pdf->SetXY($posx, $posy);
			$this->pdf->Cell(0, $height, $text);
		}
		else
			$this->pdf->Write($height, $text);
	}
	
	public function mkpdf($out = 'I', $pdffile = 'prevente.pdf')
	{
		$this->pdf = new FPDF();
		$this->pdf->SetCreator('BDE Rising', true);
		$this->pdf->SetAuthor('BDE Rising - bontiv', true);
		$this->pdf->SetTitle('BDE Rising - Prevente Before Starfloor : Terror Hostel', true);
		$this->pdf->AddPage();
		$this->pdf->Image($GLOBALS['genRoot'] . 'frames/' . $this->conf['logo'], 160, 20, 27, 25);

		//Cie Informations
		$this->addptext('cie_name', 'BDE EPITECH Rising', 20, 30);
		$this->addptext('cie_address', '24 rue Pasteur', 20, 40);
		$this->addptext('cie_address', '94270 LE KREMLIN-BICETRE', 20, 45);
		$this->addptext('cie_head', 'Courriel', 20, 55);
		$this->addptext('cie_details', 'contact@bde-epitech.fr', 40, 55);
		$this->addptext('cie_head', 'Téléphone', 20, 60);
		$this->addptext('cie_details', '01.44.08.01.70', 40, 60);
		
		//Main text
		$this->addptext('id_object', $this->conf['txt_object'], 30, 75);
		$this->pdf->SetXY(20, 90);
		$this->addptext('id_main', $this->conf['txt_main']);
		
		//Add pre-selling
		$file = $GLOBALS['genRoot'] . 'tmp/' . uniqid() . '.jpg';
		$this->writeto($file);
		$this->pdf->Rect(28, 218, 154, 54);
		$this->pdf->Image($file, 30, 220, 150, 50);
		unlink($file);
		
		//OUT
		$this->pdf->Output($pdffile, $out);
	}
}

