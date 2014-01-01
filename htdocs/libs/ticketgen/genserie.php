<?php

require_once dirname(__FILE__) . '/' . 'gen.php';


class GenSerie extends FPDF
{
	private $date;
	private $serie;
	private $proprio;
	private $conf;
	private $posy;
	private $tickets = array();
	private $header = '';
	private $border = 0;

	public function init($serie, $proprio)
	{
		$this->date = strftime('%e %B %G, %H:%M:%S');
		$this->serie = $serie;
		$this->proprio = $proprio;
		$this->reload_conf(0);
	}

	public function Header()
	{
		$this->border = 0;
		$this->addptext('vdr_head', 'Serie : ', 10, 15);
		$this->addptext('vdr_details', $this->serie, 50, 15);
		$this->addptext('vdr_head', 'Utilisateur : ', 10, 20);
		$this->addptext('vdr_details', $this->proprio, 50, 20);
		$this->addptext('vdr_head', 'Date : ', 110, 15);
		$this->addptext('vdr_details', $this->date, 150, 15);
		$this->addptext('vdr_head', 'Event : ', 110, 20);
		$this->addptext('vdr_details', 'AdopteUneSoiree', 150, 20);
		$this->Line(10, 25, 200, 25);

		switch ($this->header)
		{
			case 'table':
				$this->border = 1;
				$this->addptext('vdr_head', 'Numero', 10, 30, 20, 7);
				$this->addptext('vdr_head', 'Code Barre', 30, 30, 30, 7);
				$this->addptext('vdr_head', 'Nom', 60, 30, 50, 7);
				$this->addptext('vdr_head', 'Prenom', 110, 30, 50, 7);
				$this->addptext('vdr_head', 'Telephone', 160, 30, 40, 7);
				$this->posy = 37;
				break;
			default:
			$this->posy = 30;
		}
	}

	private function reload_conf($type)
	{
		require dirname(__FILE__) . '/' . 'config.php';
		$this->conf = $config['default'];
		if (isset($config[$type]))
		$this->conf = array_merge_recursive($config['default'], $config[$type]);
	}

	private function colordecode($color, &$result)
	{
		$result = array(
			intval(substr($color, 1, 2)),
			intval(substr($color, 3, 2)),
			intval(substr($color, 5, 2)),
		);
	}

	private function addptext($styleconf, $text, $posx = null, $posy = null, $width = 0, $height = 0)
	{
		static $cfonts = array();

		$font = $this->conf[$styleconf . '_font'];
		$size = isset($this->conf[$styleconf . '_size']) ? $this->conf[$styleconf . '_size'] : 10;
		$style = isset($this->conf[$styleconf . '_style']) ? $this->conf[$styleconf . '_style'] : '';
		$color = isset($this->conf[$styleconf . '_color']) ? $this->conf[$styleconf . '_color'] : '#000000';
		$height = isset($this->conf[$styleconf . '_height']) ? $this->conf[$styleconf . '_height'] : $height;
		$text = utf8_decode($text);

		if (!is_file(FPDF_FONTPATH . $font . '.php'))
		{
			ob_start();
			MakeFont(FPDF_FONTPATH . $font . '.ttf');
			file_put_contents(FPDF_FONTPATH . $font . '.log', ob_get_contents());
			ob_end_clean();
		}

		if (!isset($cfonts[$font]))
			$cfonts[$font] = $this->AddFont($font, $style, $font . '.php');
		$this->SetFont($font, $style, $size);
		$this->colordecode($color, $comp);

		$this->SetTextColor($comp[0], $comp[1], $comp[2]);

		if ($posx !== null && $posy !== null)
		{
			$this->SetXY($posx, $posy);
			$this->Cell($width, $height, $text, $this->border);
		}
		else
			$this->Write($height, $text);
	}

	public function __construct($serie, $proprio)
	{
		parent::__construct();
		$this->init($serie, $proprio);
		$this->SetCreator('BDE Tech\'Paf', true);
		$this->SetAuthor('BDE Tech\'Paf - bontiv', true);
		$this->SetTitle('BDE Tech\'Paf - Prevente BDE', true);
		$this->AddPage();
	}

	public function out($out = 'I')
	{
		$this->Output('Serie.pdf', $out);
	}

	public function mkticket($data)
	{
		if ($this->posy + 55 > 297)
			$this->AddPage();

		$ticket = new TicketGen();
		$ticket->mkticket($data);

		$file = $GLOBALS['root'] . 'tmp/' . uniqid() . '.jpg';
		$ticket->writeto($file);
		$this->Rect(28, $this->posy, 154, 54);
		$this->Image($file, 30, $this->posy + 2, 150, 50);
		unlink($file);

		$this->posy += 55;
		$this->tickets[] = $data;
	}

	public function mktable()
	{
		$this->header = 'table';
		$this->border = 1;
		$this->AddPage();
		foreach ($this->tickets as $ticket)
		{
			if ($this->posy + 7 > 297)
				$this->AddPage();

			$this->addptext('vdr_details', $ticket['ticketid'], 10, $this->posy, 20, 7);
			$this->addptext('vdr_details', $ticket['barcode'], 30, $this->posy, 30, 7);
			$this->addptext('vdr_details', $ticket['lastname'], 60, $this->posy, 50, 7);
			$this->addptext('vdr_details', $ticket['firstname'], 110, $this->posy, 50, 7);
			$this->addptext('vdr_details', $ticket['phone'], 160, $this->posy, 40, 7);

			$this->posy += 7;
		}
	}
}
