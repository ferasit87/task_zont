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
        $this->load->library('jsonlib');
    }
    public function index()                 //simple interfes for test multiusing ip with Ajax and Json
    {

        $data['title'] = 'Task for Zont';
        $this->load->view('templates/header', $data);
        $this->load->view('user/index');
        $this->load->view('templates/footer');
    }
    public function get_difference_ips(){           // function work with json for get multiusing ip
        $result = $this->post_model->get_multiuser_ip();
        if (count($result) > 0 )
            $this->jsonlib->return_normal($result);        // check if added post
        else
            $this->jsonlib->return_error('there is no multiuseres IP');
    }
}
?>