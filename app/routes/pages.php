<?php

//homepage
$app->get('/', \Controllers\Pages::class.':getHomepage');

//default page handler
$app->get('/{page}', \Controllers\Pages::class.':getDefaultPageHandler');

//subdirectory pages
$app->get('/{directory}/{page}', \Controllers\Pages::class.':getDefaultSubdirectoryPageHandler');