<?php

namespace Services;

class Util {
    public static function getGlobalVariables(){
        return [
            'viewsDirectory' => VIEW_DIRECTORY,
            'imagesDirectory' => '/public/images/'
        ];
    }
}