<?php

//user login page
$app->get('/login', \Controllers\User::class.':getLoginPage')->setName('user-login');
$app->put('/login', \Controllers\User::class.':submitLogin');

//new user page
$app->get('/register',\Controllers\User::class.':getRegisterPage')->setName('user-register');
$app->post('/register', \Controllers\User::class.':submitUserRegistration');

//user profile page
$app->get('/profile', \Controllers\User::class.':getProfilePage')->setName('user-profile')->add($isUserLoggedIn);
$app->put('/profile', \Controllers\User::class.':submitUpdatePassword')->add($isUserLoggedIn);

//edit profile
$app->get('/profile-edit', \Controllers\User::class.':getEditProfilePage')->setName('user-profile-edit')->add($isUserLoggedIn);
$app->put('/profile-edit', \Controllers\User::class.':submitEditProfile')->add($isUserLoggedIn);

//user logout route
$app->get('/logout', \Controllers\User::class.':submitLogout')->setName('user-logout');