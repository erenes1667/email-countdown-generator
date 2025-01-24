<?php
header('Content-Type: image/png');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Set target date (EST)
$target = strtotime('2025-01-28 11:00:00 America/New_York');
$now = time();
$remaining = $target - $now;

// Calculate time units
$days = floor($remaining / 86400);
$hours = floor(($remaining % 86400) / 3600);
$minutes = floor(($remaining % 3600) / 60);
$seconds = $remaining % 60;

// Create image
$width = 400;
$height = 100;
$im = imagecreatetruecolor($width, $height);

// Colors
$bg = imagecolorallocate($im, 155, 38, 66); // #9B2642
$white = imagecolorallocate($im, 255, 255, 255);

// Fill background
imagefilledrectangle($im, 0, 0, $width, $height, $bg);

// Add text
$text = sprintf("%dd %02dh %02dm %02ds", $days, $hours, $minutes, $seconds);
$font = 5; // Built-in font
$font_width = imagefontwidth($font);
$font_height = imagefontheight($font);
$text_width = $font_width * strlen($text);
$x = ($width - $text_width) / 2;
$y = ($height - $font_height) / 2;

imagestring($im, $font, $x, $y, $text, $white);

// Output image
imagepng($im);
imagedestroy($im);
?>