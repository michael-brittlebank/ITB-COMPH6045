<?php

namespace Services;

class Util {
    public static function getGlobalVariables(){
        return [
            'viewsDirectory' => getenv('VIEW_DIRECTORY'),
            'imagesDirectory' => '/public/images/'
        ];
    }

    public static function getMetaTitle($pageName){
        return getenv('META_TITLE_PREFIX').' '.ucwords(str_replace('-',' ',$pageName));
    }

    public static function getPageTitle($pageName){
        return ucwords(str_replace('-',' ',$pageName));
    }
}