<?php

function imagebarcode($file, $code, $width, $height, $pas) {

    settype($code, 'string');
    $long = strlen($code);
    $factor = 3;
    $checksum = 0;

    $EANbars = array('A' => array(
            0 => "0001101", 1 => "0011001",
            2 => "0010011", 3 => "0111101",
            4 => "0100011", 5 => "0110001",
            6 => "0101111", 7 => "0111011",
            8 => "0110111", 9 => "0001011"
        ),
        'B' => array(
            0 => "0100111", 1 => "0110011",
            2 => "0011011", 3 => "0100001",
            4 => "0011101", 5 => "0111001",
            6 => "0000101", 7 => "0010001",
            8 => "0001001", 9 => "0010111"
        ),
        'C' => array(
            0 => "1110010", 1 => "1100110",
            2 => "1101100", 3 => "1000010",
            4 => "1011100", 5 => "1001110",
            6 => "1010000", 7 => "1000100",
            8 => "1001000", 9 => "1110100"
        )
    );
    $EANparity = array(
        0 => array('A', 'A', 'A', 'A', 'A', 'A'),
        1 => array('A', 'A', 'B', 'A', 'B', 'B'),
        2 => array('A', 'A', 'B', 'B', 'A', 'B'),
        3 => array('A', 'A', 'B', 'B', 'B', 'A'),
        4 => array('A', 'B', 'A', 'A', 'B', 'B'),
        5 => array('A', 'B', 'B', 'A', 'A', 'B'),
        6 => array('A', 'B', 'B', 'B', 'A', 'A'),
        7 => array('A', 'B', 'A', 'B', 'A', 'B'),
        8 => array('A', 'B', 'A', 'B', 'B', 'A'),
        9 => array('A', 'B', 'B', 'A', 'B', 'A')
    );


    for ($index = $long; $index > 0; $index--) {
        $checksum += intval($code{$index - 1}) * $factor;
        $factor = 4 - $factor;
    }
    $cc = ( ( 1000 - $checksum ) % 10 );

    $code .= $cc;
    $long ++;

    $a_tmp = array();
    for ($i = 0; $i < $long; $i++) {
        $a_tmp[$i] = $code{$i};
    }

    $parity = $EANparity[$a_tmp[0]];
    $encodedString = '101';
    for ($i = 1; $i < 7; $i++) {
        $encodedString .= $EANbars[$parity[$i - 1]][$a_tmp[$i]];
    }
    $encodedString .= '01010';
    for ($i = 7; $i < 13; $i++) {
        $encodedString .= $EANbars['C'][$a_tmp[$i]];
    }
    $encodedString .= '101';

    $img = imagecreate($width, $height);
    $black = imagecolorallocate($img, 0, 0, 0);
    $white = imagecolorallocate($img, 255, 255, 255);
    imagefill($img, 0, 0, $white);

    $len = strlen($encodedString);
    $posX = ($width - $len * $pas) / 2;

    for ($i = 0; $i < $len; $i++) {
        imagefilledrectangle($img, $posX, 0, $posX + $pas, $height, $encodedString{$i} == '1' ? $black : $white);
        $posX += $pas;
    }

    imagepng($img, $file);
}
