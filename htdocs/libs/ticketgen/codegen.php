<?php

function checksum(&$code)
{
	$long = strlen( $code ) ;
	$factor = 3;
	$checksum = 0;
	
	if (preg_match("/^[0-9]{8}$/", $code))
	{
   
		for ($index = ($long - 1); $index > 0; $index--)
		{
			$checksum += intval($code{$index-1}) * $factor ;
			$factor = 4 - $factor ;
		}
		$cc = ( (1000 - $checksum) % 10 ) ;

		if ( substr( $code, -1, 1) != $cc )
		{
			trigger_error('Bad codebar checksum');
			return false;
		}
	}
	elseif (preg_match("/^[0-9]{7}$/", $code))
	{
   
		for ($index = $long; $index > 0; $index--) {
			$checksum += intval($code{$index-1}) * $factor ;
			$factor = 4 - $factor ;
		}
		$cc = ( ( 1000 - $checksum ) % 10 ) ;

		$code = $code.$cc ;   
	}
	else
	{
		trigger_error('Bad codebar form');
		return false;
	}
	return true;
}


function writecode($img, $conf, $code)
{
	
	$EANbars = array('A' => array(
		0 => "0001101",         1 => "0011001",
		2 => "0010011",         3 => "0111101",
		4 => "0100011",         5 => "0110001",
		6 => "0101111",         7 => "0111011",
		8 => "0110111",         9 => "0001011"
		),
		'B' => array(
		0 => "0100111",         1 => "0110011",
		2 => "0011011",         3 => "0100001",
		4 => "0011101",         5 => "0111001",
		6 => "0000101",         7 => "0010001",
		8 => "0001001",         9 => "0010111"
		),
		'C' => array(
		0 => "1110010",         1 => "1100110",
		2 => "1101100",         3 => "1000010",
		4 => "1011100",         5 => "1001110",
		6 => "1010000",         7 => "1000100",
		8 => "1001000",         9 => "1110100"
		)
	);
	
	$EANparity = array(
		0 => array('A','A','A','A','A','A'),
		1 => array('A','A','B','A','B','B'),
		2 => array('A','A','B','B','A','B'),
		3 => array('A','A','B','B','B','A'),
		4 => array('A','B','A','A','B','B'),
		5 => array('A','B','B','A','A','B'),
		6 => array('A','B','B','B','A','A'),
		7 => array('A','B','A','B','A','B'),
		8 => array('A','B','A','B','B','A'),
		9 => array('A','B','B','A','B','A')
	);
	
	$config = array_merge(array(
		'width' => 100,
		'height' => 200,
		'borderx' => 10,
		'bordery' => 10,
		'posx' => 30,
		'posy' => 30,
		'orientation' => 'v',
		'background' => '#FFFFFF',
		'forground' => '#000000',
	), $conf);

	$config['background'] = hexdec($config['background']);
	$config['forground'] = hexdec($config['forground']);

	settype($code, 'string');
	$lencode = strlen($code);
	
	$encodedString = '';
	
	// Copie de la chaine dans un tableau
	$a_tmp = array();
	for($i = 0; $i < $lencode ; $i++) $a_tmp[$i] = $code{$i};

			if ($lencode == 8)
			{
				$encodedString = '101'; //Premier séparateur (101)
				for ($i = 0; $i < 4; $i++) $encodedString .= $EANbars['A'][$a_tmp[$i]]; //Codage partie gauche (tous de classe A)
				$encodedString .= '01010'; //Séparateur central (01010) //Codage partie droite (tous de classe C)
				for ($i = 4; $i < 8; $i++) $encodedString .= $EANbars['C'][$a_tmp[$i]];
				$encodedString .= '101'; //Dernier séparateur (101)
			}
			else
			{
				$parity = $EANparity[$a_tmp[0]]; //On récupère la classe de codage de la partie qauche
				$encodedString = '101'; //Premier séparateur (101)
				for ($i = 1; $i < 7; $i++) $encodedString .= $EANbars[$parity[$i-1]][$a_tmp[$i]]; //Codage partie gauche
				$encodedString .= '01010'; //Séparateur central (01010) //Codage partie droite (tous de classe C)
				for ($i = 7; $i < 13; $i++) $encodedString .= $EANbars['C'][$a_tmp[$i]];
				$encodedString .= '101'; //Dernier séparateur (101)
			}

	$nb_elem = strlen($encodedString);

	/**
	* Création de l'image du code
	*/
	
	//Initialisation de l'image
	$config['width'] = max( $config['width'], $nb_elem + ($config['borderx']*2) );
	$posY = $config['bordery'] + $config['posy']; // position Y
	if ($config['orientation'] == 'h')
		$intL = ($config['width'] - 2 * $config['borderx']) / $nb_elem;
	else
		$intL = ($config['height'] - 2 * $config['bordery']) / $nb_elem;
	$posX = $config['borderx'] + $config['posx']; // position X
	
	// colors
	$color[0] = ImageColorAllocate($img, 0xFF & ($config['background'] >> 0x10), 0xFF & ($config['background'] >> 0x8), 0xFF & $config['background']);
	$color[1] = ImageColorAllocate($img, 0xFF & ($config['forground'] >> 0x10), 0xFF & ($config['forground'] >> 0x8), 0xFF & $config['forground']);
	
	imagefilledrectangle($img, $config['posx'], $config['posy'], $config['width'] + $config['posx'], $config['height'] + $config['posy'], $color[0]);
	
	// Gravure du code
	for ($i = 0; $i < $nb_elem; $i++)
	{		
		// Gravure des barres
		$fill_color = $encodedString{$i};
		if($fill_color == "1" && $config['orientation'] == 'h')
		{
			$intH = $config['height'] - 2 * $config['bordery'];
			imagefilledrectangle($img, $posX, $posY, $posX + $intL - 1, ($posY+$intH), $color[1]);
		}
		
		if($fill_color == "1" && $config['orientation'] == 'v')
		{
			$intH = $config['width'] - 2 * $config['borderx'];
			imagefilledrectangle($img, $posX, $posY, $posX + $intH, $posY + $intL - 1, $color[1]);
		}
		
		//Deplacement du pointeur
		if ($config['orientation'] == 'h')
			$posX += $intL;
		else
			$posY += $intL;
	}
}
