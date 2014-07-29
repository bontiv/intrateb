<?php
function z($b)
{
  $c = sizeof($b);
  $a = ((($c % 3) * 5) % 3);
  $d = $a + $c;
  if ($c == $d)
    return $b;
  array_push($b, 0);
  if ($a == 2)
    array_push($b, 0);
  return $b;
}

function y($b)
{
  $a = sizeof($b);
  for ($c = 0; $c < 2; ++$c)
    if ($b[$a - $c] == 0)
      array_pop($b);
    else
      return $b;
  return $b;
}

function x($b)
{
  $a = unpack("C*",$b);
  $c = sizeof($a);
  $d = $c / 2;
  $e = array();
  for ($h = 0; $h < $c; ++$h)
    array_push($e, ~($a[($h + $d) % $c + 1]));
  $f = array_reverse($e);
  $g = array();
  for ($h = 0; $h < $c; ++$h)
    $g[$h] = ($f[$h] + 96);
  return z($g);
}
 
function v($b)
{
  $c = y($b);
  $a = sizeof($c);
  $d = ($a + 1) / 2;
  $e = array();
  for ($h = 0; $h < $a; ++$h)
    array_push($e, $c[$h + 1] - 96);
  $f = array_reverse($e);
  $g = array();
  for ($h = 0; $h < $a; ++$h)
    array_push($g, ~($f[($d + $h) % $a]));
  return $g;
}

/**
* Chiffre la donnée entrée en paramètre
* @param $a string Donnée à chiffrer
* @return string La nouvelle donnée chiffrée
*/
function encrypt($a) {
  $b = call_user_func_array('pack', array_merge(array('C*'), x($a)));
  return preg_replace("`[+]`", "_", preg_replace("`/`", "-", base64_encode($b)));
}


/**
* Déchiffre la donnée entrée en paramètre
* @param $a string Donnée à déchiffrer
* @return string La nouvelle donnée déchiffrée
*/
function decrypt($a) {
  $b = unpack("c*", base64_decode(preg_replace("`-`", "/", preg_replace("`_`", "+", $a))));
  $a = call_user_func_array('pack', array_merge(array('C*'), v($b)));
  return $a;
}
?>