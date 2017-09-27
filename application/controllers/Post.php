<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Post extends CI_Controller
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
    public function add()
    {
        $userid = $this->user_mode->get_user();                                 // check if user exist
        if ($userid == null)                                                    // if not user creating new
            $userid = $this->user_mode->set_user();
        if ($userid == null) $this->jsonlib->return_error();                    // check added new user or not
        else {
            $post_id = $this->post_model->set_post();                           // add new post
            if ($post_id == null) $this->jsonlib->return_error();               // check if added post
            else $this->jsonlib->return_normal();
        }
    }
    public function get_top_n($n) {
        if ($n > 0 ){                                                           //check empty values
            $this->post_model->get_top_n($n);
        }else {
            $this->jsonlib->return_error();
        }
    }
}
?>