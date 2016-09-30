<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {

 	function __construct() {
        parent::__construct();  
        
    }
	public function index()
	{		
	 echo $this->session->userdata('user_type');	
		echo "<pre>";
		print_r($this->session->all_userdata());
		echo "On Super admin";
	}

}
