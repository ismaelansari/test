<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

 	function __construct() {
        parent::__construct();          
        if($this->session->userdata('user_type')!="manager"){
			redirect("/home/",'refresh');
		}      
    }
	public function index()
	{		
	 	echo "Manager";
	 	die;
	}

}
