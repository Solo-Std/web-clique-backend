<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19/06/2018
 * Time: 14.10
 */

class HttpOptionsController
{
    public function http_options(){
        echo json_encode("200");
    }
}