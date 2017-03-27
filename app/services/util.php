<?php

namespace Services;

class Util {

    public static function getMetaTitle($pageName){
        return getenv('META_TITLE_PREFIX').' | '.self::getPageTitle($pageName);
    }

    public static function getAdminMetaTitle($pageName){
        return 'Admin | '.self::getPageTitle($pageName);
    }

    public static function getErrorMetaTitle($pageName){
        return 'Error | '.self::getPageTitle($pageName);
    }

    public static function getPageTitle($pageName){
        return ucwords(str_replace('-',' ',$pageName));
    }

    public static function createResponse($status, $message = ''){
        if (empty($message)){
            switch($status){
                case 200: 
                    $message = 'Accepted';
                    break;
                case 201:
                    $message = 'Created';
                    break;
                case 204:
                    $message = 'No Content';
                    break;
                case 400:
                    $message = 'Bad Request';
                    break;
                case 401:
                    $message = 'Unauthorized';
                    break;
                case 404:
                    $message = 'Not Found';
                    break;
                case 500:
                    $message = 'Internal Error';
                    break;
            }
        }
        return array(
            'status'=>$status,
            'message'=>$message
        );
    }

    public static function prepareObjectArrayForView($objectArray){
        $preparedArray = array();
        foreach ($objectArray as $object){
            array_push($preparedArray,$object->toString());
        }
        return $preparedArray;
    }
    
    public static function bodyParserIsValid($parsedBody, $requiredParameters){
        $isValid = true;
        foreach($requiredParameters as $parameter){
            if (!isset($parsedBody[$parameter])){
                $isValid = false;
            }
        }
        return $isValid;
    }
}