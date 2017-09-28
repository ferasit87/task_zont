<?php
/**
 * Created by PhpStorm.
 * User: feras
 * Date: 9/27/17
 * Time: 9:06 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Post extends CI_Controller
{
    public function __construct()
    {
        /*-------------including all needed models*/
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->library('Jsonlib');
        $this->load->model('post_model');
        $this->load->model('vote_model');
        $this->load->model('user_model');
    }

    public function index()
    {

        $data['title'] = 'Task for Zont';
        $this->load->view('templates/header', $data);
        $this->load->view('post/index');
        $this->load->view('templates/footer');
    }
    public function add()
    {
        $data = $_POST;
        if (! isset($data['user']) || $data['user'] == '')
            $this->jsonlib->return_error('empty user name');                            // check empty value user
        else{
            if (! isset($data['content']) || $data['content'] == '')                    // check empty value content
                $this->jsonlib->return_error('empty content post');
            else {
                if (! isset($data['title']) || $data['title'] == '')                    // check empty value title
                    $this->jsonlib->return_error('empty title post');
                else {
                    $user = $this->user_model->get_by_name($data['user']);              // check if user exist
                    if ($user == null)                                                  // if not user creating new
                        $user = $this->user_model->set_user($data['user']);
                    if ($user == null)
                        $this->jsonlib->return_error('cannot add new user');            // check added new user or not
                    else {
                        $data['user'] = $user;
                        $post = $this->post_model->set_post($data);                     // add new post
                        if ($post['id'] == null)
                            $this->jsonlib->return_error('cannot add new post');        // check if added post
                        else $this->jsonlib->return_normal($post);
                    }
                }
            }
        }
    }
    public function gettop($n = 5 ) {
        if ($n > 0 ){                                                           //check empty values
            $this->post_model->get_top_n($n);
        }else {
            $this->jsonlib->return_error();
        }
    }
}
?>