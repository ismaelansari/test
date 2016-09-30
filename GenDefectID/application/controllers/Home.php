<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

 	function __construct() {
        parent::__construct();
                   
    }
	public function index()
	{				
		if($this->session->userdata('user_type'))
        {
        	$user_type = $this->session->userdata('user_type');
        	checkuser_type($user_type);
        }  
        else{
        	$url=base_url()."home/login/";
			redirect($url, 'refresh');
        }  		
	}	

	# Load login Page.	
	public function login($i = 0){  	

		$perm='';		
		if($this->session->userdata('user_type'))
        {
        	$user_type = $this->session->userdata('user_type');
        	checkuser_type($user_type);
        }    
		//Set Rules
		$rules = array(
			array("field"=>"username", "label"=>"Username", "rules"=>"required" ),
			array("field"=>"password", "label"=>"Password", "rules"=>"required" )
		);
		
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters("<p class='failure_r'>","</p>");
		//check validation
		if($this->form_validation->run() == true){
			$user_company =  $this->input->post('companyName');
			if($i == 0 && empty($user_company))
			{					
				$this->session->set_flashdata('notification', 'Comapny name should be field');
				$url=base_url()."/home/login";
				redirect($url, 'refresh');
			}

			$subDomain = "dev";
			$where = array("username"=>addcslashes($this->input->post("username"),"'"), "password"=>md5($this->input->post("password")), "is_deleted"=>0);
			if(!empty($user_company) && isset($user_company)){
				$where['company']=$user_company; 
			}			

			$table= 'user';
			$field= array('user_id','username','fullname','user_type','busi_state','cmp_id as cmpid');			
			$result=$this->adminmodel->getDetails($table,$where,$field); 	
			
		//check login response
			if($result!=false){ 
				$ukey = md5(uniqid(base64_encode($subDomain.$result[0]["user_id"].time()),true));
				
				$user_details = array('ukey'=>$ukey,'uid'=>$result[0]["user_id"],'cmpid'=>$result[0]["cmpid"],'uname'=>$result[0]["username"],'fullname'=>$result[0]["fullname"],'ustate'=>$result[0]["busi_state"],'user_type'=>$result[0]["user_type"],'subDomain'=>$subDomain);
				$this->session->set_userdata($user_details);
								
				# Start:- Remember Password section
				$rememberPass =  $this->input->post('remember'); 
				if($rememberPass == 1){
					$year = time() + 31536000;
					$cookieData = serialize(array("username"=>$this->input->post("username"), "password"=>$this->input->post("password")));
					setcookie('remProbSWId', $cookieData, $year);
				}else{
					if(isset($_COOKIE['remProbSWId'])) {
						$past = time() - 100;
						setcookie('remProbSWId', 'gone', $past);
					}
				}
				# End:- Remember Password section
												
				if(isset($_SESSION['emailURL']) && !empty($_SESSION['emailURL'])){
					$emailURL = $_SESSION['emailURL'];					
					$this->session->set_userdata('emailURL',"");
					redirect("".$emailURL,'refresh');
				}				
				$check_user_type = checkuser_type($result[0]["user_type"]);		
				if($check_user_type == "0"){
					$this->logout();
				}
				//if($userType=="manager" && $result[0]["{$preFix}username"]=="manager"){
				// if($userType=="manager"){
				// 	redirect($userType.$page, 'refresh');
				// }else{
				// 	if($isSubConUSer == 1){
				// 		redirect("/workplaceHSEScore/", 'refresh');
						
				// 	}elseif($userType=="user"){
				// 		redirect($page, 'refresh');
						
				// 	}else{
				// 		redirect($userType.$page, 'refresh');
				// 	}
				// }
			}else{
				$data['error'] = "Check your credential, please try again!";
			}
		}
		if(!empty($_COOKIE['remProbSWId'])){
			$remember = unserialize($_COOKIE['remProbSWId']);			
			$data['username'] = $remember['username'];
			$data['password'] = $remember['password'];
		}
		$data['is_super_admin'] = $i;
		//$data['userType'] = $userType;
		$data['publicUrl']=$this->config->item('public_url');
		$data['template']='home';
    	$this->load->view('templates/general_template',$data);
	}


	# Forgot Password Page.	
	public function forgotPassword(){  			
		$email = $this->input->post('email');
		$where['email'] = $email;
		$where['is_deleted'] = "0";
		$table = "user";
		$field= array('user_id','user_type','fullname','email');
		$result=$this->adminmodel->getDetails($table,$where,$field);		
		if(!empty($result) && isset($result)){
			# strat send email 
			$subject = "Reset Your Password";
			$curtime = time(); //base64_encode(date('Y-m-d h:i:s'));
			$randomKey=substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,10);
			$link = base_url()."home/resetPassword/".$curtime."/".$randomKey."_RswAfxJ".$result[0]["user_id"]."_".$result[0]['user_type'];
			$message = '<html><head> <title>Reset Your Password</title></head><body>
					<h4>Hi '.$result[0]["fullname"].',</h4>
					Changing your password is simple. Please use the link below within 2 hours.<br>
					<a href="'.$link.'" target="_parent">Reset Password</a> <br><br><br>
					<hr />
					<em>Regards From<br>
					<a href="'.base_url().'" target="_parent">'.siteName.'</a> Team.</em>
					</body>	</html>	';
			$is_mail_send = sendEmail($subject, $message, $result);			
			echo $success="<span style='color: green;'>We sent you reset password link on your email address i.e. ".$result[0]['email']."</span>";
			# End send email 
		}else{
			echo $error = "<span style='color: red;'>Email id does not exists</span>";
		}		
	}

	# Change Reset Password.
	public function resetPassword($curtime = "", $token = ""){
		//_RswAfxJ
		$data['curtime'] = $curtime;
		$data['token'] = $token;
		
		if(isset($curtime) && isset($token) && !empty($curtime) && !empty($token)){
			$today = new DateTime(date('Y-m-d h:i:s'));
			@$pastDate = $today->diff(new DateTime(date('Y-m-d h:i:s', $curtime)));
			$h = $pastDate->h; //return the difference in Hour(s).
			$data['key'] = $key = explode("_", $token);

			if($h>=2){
				$data['error'] = 'Your link has been expired. please re-generate new link!';
				
			}else if(is_array($key) && count($key)==3 && $pastDate->invert>0){
				
			}else{
				$data['error'] = 'Something wrong in your link. please try again!';
			}
		}else{
			$data['error'] = 'Something wrong in your link. please try again!';			
		}
		// Set Validation Rules
		$rules = array(
			array("field"=>"password", "label"=>"New Password", "rules"=>"required|min_length[6]" ),
			array("field"=>"cpassword", "label"=>"Confirm Password ", "rules"=>"required|min_length[6]|matches[newPass]" ),
		);		
		
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters("","<br>");
		//check validation

		if($this->form_validation->run() == true){
			echo "<pre>";
			print_r($this->input->post());
			die;
			$newPass = $this->input->post('newPass');
			$userId = $this->input->post('id');
			$type = $this->input->post('type');

			if($type>0){
				$updateData=array('user_password'=>md5($newPass), 'user_plainpassword'=>$newPass, 'user_modified'=>"NOW()", 'user_modified_by'=>$userId);
				$this->adminmodel->updateDetails('user', $updateData, array("user_id"=>$userId));
				//echo $this->db->last_query();
				$data['success'] = 'Update Successful! <a href='.base_url().' style="color:#0469AD;">Continue to login</a>';
			}else{
				$data['error'] = 'Something wrong in your link. please try again!';	
			}
		}
		// echo "<pre>";
		// print_r($data[]);
		// die;
		$data['template']='reset_password';
    	$this->load->view('templates/general_template',$data);		
	}	

	# Logout
	public function logout(){		
		$this->session->sess_destroy();
		session_destroy();
		redirect('/home');
	}

}
