<?php


/***
 * Name:       Pryper
 * Package:     question_helper.php
 * About:       question helper
 * Copyright:  (C) 2019,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/


function convert_question_text_to_image($givenText)
{

// 200 is width / 30 is height
$TheImage = Imagecreate("500", "300");

// Color image background blue.
$ColorImage = imagecolorallocate($TheImage, 255,255,255);

// Color the text white
$ColorText = imagecolorallocate($TheImage,  0, 150, 136);
//$ColorText = imagecolorallocate($TheImage,  0, 3, 7);

//get user input text
$text = "Pryper Daily Trivia Game\nwww.pryper.com \n\n".$givenText;
//maximum question characters 265
$text = wordwrap($text,36,"\n",TRUE);

//select font file
$font = 'C:\xampp\htdocs\w\pryper\arial.ttf'; 

//add grey shadow
$grey = imagecolorallocate($TheImage, 128, 128, 128); //grey shadow
imagettftext($TheImage, 15, 0, 81, 41, $grey, $font, $text);
//add text to image 
imagettftext($TheImage, 15, 0,80, 40, $ColorText, $font, $text);

// Let the browser know that it is an PNG image..
header("Content-Type: image/png");
imagepng($TheImage);
 // output to browser.

}