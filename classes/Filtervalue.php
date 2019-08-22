<?php
/**
 * Created by PhpStorm.
 * User: arcangelo
 * Date: 3/3/19
 * Time: 6:29 PM
 */

namespace Classes;


class Filtervalue
{
    public function filter($type,$value,$empty=1){
        if($empty){
            if($value == ''){
                array_push($_SESSION['message'],'dato passato vuoto');
            }
        }
        filter_var($value, $type);
    }
    public function filter_validate($type,$value){
        return filter_var($value, $type);

    }

}