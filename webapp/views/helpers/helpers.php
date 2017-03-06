<?php

function getVariable($data, $key){
    if(isset($data[$key])){
        return $data[$key];
    } else {
        return '';
    }
}