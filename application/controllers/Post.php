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
        $this->load->library('Jsonlib');
        $this->load->model('post_model');
        $this->load->model('vote_model');
        $this->load->model('user_model');
    }

    public function index()                                 //simple interfes for test add post with Ajax and Json
    {

        $data['title'] = 'Task for Zont';
        $this->load->view('templates/header', $data);
        $this->load->view('post/index');
        $this->load->view('templates/footer');
    }
    public function get_top()                   //simple interfes for test top n post with Ajax and Json
    {

        $data['title'] = 'Task for Zont';
        $this->load->view('templates/header', $data);
        $this->load->view('post/top');
        $this->load->view('templates/footer');
    }
    public function add()
    {
        $data = $_REQUEST;
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
                        else
                            $this->jsonlib->return_normal($post);
                    }
                }
            }
        }
    }
    public function gettop() {
        $n = $_REQUEST['count'];
        if ($n > 0 ){                                                           //check empty values
            $data = $this->post_model->get_top_n($n);
            if ($data['error'])
                $this->jsonlib->return_error($data['error']);                        // check if added vote
            else
                $this->jsonlib->return_normal($data);
        }else {
            $this->jsonlib->return_error('Nomber have to be greater than 0');
        }
    }
    public function generatedbposts()                                           //Function for generate 200000 post whit 100 user and 50 ip
    {
        $ipsArray = array();
        for ($i = 0; $i < 50; $i++) {
            $ipsArray[] = mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
        }
        $usersArray = array();
        $names = array(
            'feras',
            'test',
            'Christopher',
            'Ryan',
            'Ethan',
            'John',
            'Zoey',
            'Sarah',
            'Michelle',
            'Samantha',
        );
        $surnames = array(
            'Walker',
            'Thompson',
            'Anderson',
            'Johnson',
            'Tremblay',
            'Peltier',
            'Cunningham',
            'Simpson',
            'Mercado',
            'Sellers'
        );
        foreach ($names as $name){
            foreach ($surnames as $surname){
                $usersArray[] = $name.$surname ;
            }
        }
        $title = 'this title is for all post' ;
        $content = 'this title is for all post' ;
        $arrayposts = array();
        for ($i = 0; $i < 200000; $i++) {
            $arrayposts[] = array(
                'post_user_ip' => $ipsArray[mt_rand(0,50)] ,
                'user_id' => mt_rand(1,100),
                'title'=>$title,
                'content' => $content ,
            );
        }
        $this->user_model->set_users($usersArray);
        $this->post_model->set_posts($arrayposts);
        $this->jsonlib->return_normal(array("result"=>'DB GENERATED 200K post 50 ip 100 user'));
    }
}
?>