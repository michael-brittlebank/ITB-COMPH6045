<?php

//user login page
$app->get('/login', \Controllers\User::class.':getLoginPage')->setName('login');
$app->put('/login', \Controllers\User::class.':submitLogin');

//new user page
$app->get('/register',\Controllers\User::class.':getRegisterPage')->setName('register');

//user profile page
$app->get('/profile', \Controllers\User::class.':getProfilePage')->setName('profile')->add($isUserLoggedIn);
$app->put('/profile', \Controllers\User::class.':submitEditProfile')->add($isUserLoggedIn);

//user logout route
$app->get('/logout', \Controllers\User::class.':submitLogout')->setName('logout');