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
        $this->load->library('jsonlib');
    }
    public function index()
    {

        $data['title'] = 'Task for Zont';
        $this->load->view('templates/header', $data);
        $this->load->view('vote/index');
        $this->load->view('templates/footer');
    }
    public function add()
    {
        $data = $_REQUEST;
        if (! isset($data['id_post']) || $data['id_post'] == '')
            $this->jsonlib->return_error('empty id post');                                  //check empty values
        else {
            if (! isset($data['value']) || $data['value'] == '0')
                $this->jsonlib->return_error('empty vote value');                           //check empty values
            else {
                $vote_id = $this->vote_model->set_vote($data);                              // add new vote
                if ($vote_id['error'])
                    $this->jsonlib->return_error($vote_id['error']);                        // check if added vote
                else {
                    $new_avg_vote = $this->post_model->update_post_with_vote($data);        // update post with vote and get new vote sum
                    if ($new_avg_vote == null)
                        $this->jsonlib->return_error('error while updating post votes');
                    else $this->jsonlib->return_normal(array('average rating'=> $new_avg_vote ));
                }
            }
        }

    }
}
?>