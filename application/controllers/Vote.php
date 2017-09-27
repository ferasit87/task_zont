<?php
/**
 * Created by PhpStorm.
 * User: feras
 * Date: 9/27/17
 * Time: 9:06 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Vote extends CI_Controller
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
        $post_id = '' ;
        if ($post_id == null) $this->jsonlib->return_error();               //check empty values
        else {
            $vote_id = $this->vote_model->set_vote();                       // add new vote
            if ($vote_id == null) $this->jsonlib->return_error();            // check if added vote
            else {
                $new_vote = $this->post_model->update_post_with_vote();     // update post with vote and get new vote sum
                if ($new_vote == null) $this->jsonlib->return_error();
                else $this->jsonlib->return_normal();
            }
        }

    }
}
?>