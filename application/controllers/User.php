<?php
/**
 * Created by PhpStorm.
 * User: feras
 * Date: 9/27/17
 * Time: 9:06 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{
    public function __construct()
    {
        /*-------------including all needed models*/
        parent::__construct();
        $this->load->model('post_model');
        $this->load->model('vote_model');
        $this->load->model('user_model');
        $this->load->helper('url_helper');
        $this->load->library('jsonlib');
    }
    public function get_difference_ips(){

    }
}
?>