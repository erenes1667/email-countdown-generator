<?php
// Prevent caching
header('Content-Type: image/png');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Memory optimization
ini_set('memory_limit', '64M');

// Target date (Jan 28, 2025 11:00 AM EST)
$target = strtotime('2025-01-28 11:00:00 America/New_York');
$now = time();
$remaining = max(0, $target - $now);

// Calculate time units
$days = floor($remaining / 86400);
$hours = floor(($remaining % 86400) / 3600);
$minutes = floor(($remaining % 3600) / 60);
$seconds = $remaining % 60;

// Create optimized image
$width = 400;
$height = 100;
$im = imagecreatetruecolor($width, $height);

// Colors with error handling
$bg = imagecolorallocate($im, 155, 38, 66); // #9B2642
$white = imagecolorallocate($im, 255, 255, 255);

// Fill background
imagefilledrectangle($im, 0, 0, $width, $height, $bg);

// Add text with error handling
$text = sprintf("%dd %02dh %02dm %02ds", $days, $hours, $minutes, $seconds);
$font = 5; // Built-in font for better compatibility
$font_width = imagefontwidth($font);
$font_height = imagefontheight($font);
$text_width = $font_width * strlen($text);
$x = ($width - $text_width) / 2;
$y = ($height - $font_height) / 2;

imagestring($im, $font, $x, $y, $text, $white);

// Output optimized PNG
imagepng($im, null, 6, PNG_NO_FILTER);
imagedestroy($im);