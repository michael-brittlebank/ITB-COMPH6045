<?php

//homepage
$app->get('/', \Controllers\Pages::class.':getHomepage')->setName('homepage');

$app->get('/contact', \Controllers\Pages::class.':getContactPage')->setName('contact');

$app->get('/about', \Controllers\Pages::class.':getAboutPage')->setName('about');
