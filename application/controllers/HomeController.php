<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Jerome
 * Date: 28/09/15
 * Time: 12:52
 */
class HomeController extends CI_Controller
{

    public function index()
    {
        $this->load->model('user');
        $data['logged'] = $this->user->isLoggedIn();
        $data['username'] = $this->session->userdata('username');
        $this->load->view('partials/header');
        $this->load->view('partials/navbar', $data);
        $this->load->view('modals/connexion_modal');
        $this->load->view('modals/inscription_modal');
        $this->load->view('home', $data);
        $this->load->view('partials/footer');
    }

    public function register(){
        $this->load->library('form_validation');

    }

    public function login()
    {
        $this->load->model('user');
        $username = $this->input->post('Jname');
        $password = $this->input->post('Jpassword');
        $return = $this->user->login($username, $password);

        if($return){
            $data = array(
                'return' => true,
                'username' => $return->username,
                'logged_in' => true
            );
            $this->session->set_userdata($data);
            echo (json_encode($data));
            return true;
        }else {
            echo "Il y a eu un problème";
        }

    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
        exit;
    }



}