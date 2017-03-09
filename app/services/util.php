<?php

namespace Services;

class Util {
    public static function getGlobalVariables(){
        return [
            'viewsDirectory' => getenv('VIEW_DIRECTORY'),
            'imagesDirectory' => '/public/images/'
        ];
    }
}