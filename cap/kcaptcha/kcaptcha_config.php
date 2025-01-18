<?php

# KCAPTCHA configuration file

$alphabet = "0123456789abcdefghijklmnopqrstuvwxyz";

# symbols used to draw CAPTCHA
$allowed_symbols = "23456789abcdegikpqsvxyz";

# folder with fonts
$fontsdir = 'fonts';

# CAPTCHA string length
$length = mt_rand(5,7);
//$length = 4;

# CAPTCHA image size
$width = 200;
$height = 100;

# symbol's vertical fluctuation amplitude
$fluctuation_amplitude = 8;

#noise
//$white_noise_density=0;
$white_noise_density=1/6;
//$black_noise_density=0;
$black_noise_density=1/30;

# increase safety by prevention of spaces between symbols
$no_spaces = true;

# show credits
$show_credits = true;
$credits = 'Captcha';

# CAPTCHA image colors (RGB, 0-255)
$foreground_color = array(mt_rand(0,80), mt_rand(0,80), mt_rand(0,80));
$background_color = array(mt_rand(220,255), mt_rand(220,255), mt_rand(220,255));

# JPEG quality of Captcha
$jpeg_quality = 150;
?>