<?php
header("Content-type: image/png");
session_start();

$a=$_GET['a'];
$b=$_GET['b'];
$string = (string)$a."+".(string)$b;

$font  = 2;
$width  = imagefontwidth($font) * strlen($string);
$height = imagefontheight($font);

$image = imagecreatetruecolor ($width,$height);
$white = imagecolorallocate ($image,255,255,255);
$black = imagecolorallocate ($image,0,0,0);
imagefill($image,0,0,$white);

imagestring ($image,$font,0,0,$string,$black);

imagepng ($image);
//imagedestroy($image);
?>