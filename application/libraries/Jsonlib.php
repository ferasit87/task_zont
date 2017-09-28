<?php
/**
 * Created by PhpStorm.
 * User: feras
 * Date: 9/27/17
 * Time: 9:06 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
// library for sending json results
class Jsonlib {

    public function return_normal($data)                  //send result 200
    {
        $myJSON = json_encode($data);
        echo $myJSON;
    }
    public function return_error($err = 'Unknown error') //send result 422
    {
        $json = json_encode(array("jsonError" =>  $err));
        echo $json;
        http_response_code(442);            // Set HTTP response status code to: 422 - Unprocessable entity Error
    }
}
?>