<?php


/***
 * Name:       Pryper
 * Package:     page_helper.php
 * About:       page helper
 * Copyright:  (C) 2016,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/

 function show_login($value)
{

   header('Location: '.base_url().'index.php/user/login/'.$value);
}

function show_page($value)
{
  header('Location: '.base_url().'index.php/'.$value);
}

