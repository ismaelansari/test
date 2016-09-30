<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

 	function __construct() {
        parent::__construct();          
        if($this->session->userdata('user_type')!="user"){
			redirect("/home/",'refresh');
		}      
    }
	public function index()
	{		
	 	echo "User";
	 	die;
	}

}
