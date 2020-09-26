<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('Db_labkom');
	}

	public function index(){
		$this->load->helper('url');
		$this->load->view('login');
	}

	function aksi_login(){
		$username 		= $this->input->post('uname');
		$password		= $this->input->post('pass');
		$getUser 		= $this->Db_labkom->get_auth($username,$password);
		$matched_id		= $value['u_id'];
			$matched_uname	= $value['username'];
			$matched_pass 	= $value['password'];
			$matched_level 	= $value['level'];

		foreach ($getUser as $value) {
			$matched_id		= $value['u_id'];
			$matched_uname	= $value['username'];
			$matched_pass 	= $value['password'];
			$matched_level 	= $value['level'];
			

        	if ($username == $matched_uname && $password == $matched_pass) {

        		if ($username == "admin" && $password == "admin") {
        			$data_session = array(
        				'nama' 		=> $username,
        				'status'	=> "login",
        				'level'		=> $matched_level);
        			$this->session->set_userdata($data_session);
        		}else{
        			$data_session = array(
        				'nama' 		=> $username,
        				'status'	=> "login",
        				'level'		=> $matched_level);
        			$this->session->set_userdata($data_session);
        		}

		        		if ($matched_level == "admin") {
		        			redirect(base_url('adminberanda'));
		        		}elseif ($matched_level == "Asisten Laboratorium") {
		        			redirect(base_url('kelolaperangkat'));
		        		}elseif($matched_level == "Koordinator Laboratorium"){
		        			redirect(base_url('adminberanda'));
		        		}else{
		        			if ($matched_level == "Asisten Laboratorium" || $matched_level == "Koordinator Laboratorium") {
				        	redirect(base_url('Android_controller/login?warn=loginFailed'));
				        }else{
				        	redirect(base_url('login?warn=loginFailed'));
				        }
				    }
        	}else{
		        if ($matched_level == "Asisten Laboratorium" || $matched_level == "Koordinator Laboratorium") {
		        	redirect(base_url('Android_controller/login?warn=loginFailed'));
		        }else{
		        	redirect(base_url('login?warn=loginFailed'));
		        }
        	}
        }
        if ($matched_level == "Asisten Laboratorium" || $matched_level == "Koordinator Laboratorium") {
        	redirect(base_url('Android_controller/login?warn=loginFailed'));
        }else{
        	redirect(base_url('login?warn=loginFailed'));
        }
    }

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

	public function logout_aslab(){
		$this->session->sess_destroy();
		redirect(base_url('Android_controller/login'));
	}
}

?>