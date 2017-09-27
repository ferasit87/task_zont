<?php
/**
 * Created by PhpStorm.
 * User: feras
 * Date: 9/27/17
 * Time: 9:21 AM
 */

class Post_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
}