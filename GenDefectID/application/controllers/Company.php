<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

 	function __construct() {
        parent::__construct();          
        if($this->session->userdata('user_type')!="company"){
			redirect("/home/",'refresh');
		}      
    }
	public function index()
	{		
	 	echo "Comapny";
	 	die;
	}

}
