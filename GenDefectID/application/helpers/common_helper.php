<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function checkuser_type($chk_user = ''){
	// $CI = & get_instance();
 //    $CI->load->library('session');
	if($chk_user == "super_admin")
		{
			$url=base_url()."dashboard/";
			redirect($url, 'refresh');
		}				
		elseif($chk_user== "manager"){
			$url=base_url()."manager/";
			redirect($url, 'refresh');
		}
		elseif($chk_user == "user"){
			$url=base_url()."user/";
			redirect($url, 'refresh');
		}
		elseif($chk_user == "company"){
			$url=base_url()."company/";
			redirect($url, 'refresh');
		}
		else{
			return "0";
		}
}

function sendEmail($subject = "", $message = "", $toDataList = array(), $fromDataList = array(), $attachmentList = array(), $ccDataList = array(), $bccDataList = array()) {
        #start config to php mailer
        if (!empty($subject) && isset($toDataList[0]['email']) && !empty($toDataList[0]['email'])) {
            // sending email
            require_once('application/helpers/class.phpmailer.php');
//			$this->load->helper('class_phpmailer_helper');
            $mail = new PHPMailer(true);
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
            $mail->SMTPAuth = true;                    // enable SMTP authentication
            $mail->Port = 465;
            $mail->Username = emailUsername; //"wiseworkingsales@gmail.com"; //wiseworkingptyltd@gmail.com"; // SMTP account username
            $mail->Password = emailPassword; //"Wiseworking123"; //WWptyltd2011";        // SMTP account password
            $mail->IsHTML(true);
            #end config
            try {
                if (isset($fromDataList[0]['email']) && !empty($fromDataList[0]['email'])) {
                    $mail->SetFrom($fromDataList[0]['email'], "".$fromDataList[0]['fullname']."");
                    $mail->AddReplyTo($fromDataList[0]['email'], "".$fromDataList[0]['fullname']."");
                } else {
                    $from = "no-reply@safeworkid.com";
                    $mail->SetFrom($from, "SafeworkID");
                }

                $mail->Subject = trim($subject);
                $mess = "<html><body>";
                $mess .= nl2br(trim($message));
                $mess .= "</body></html>";
                $mail->MsgHTML($mess);

                //Add To here
                for ($i = 0; $i < sizeof($toDataList); $i++) {
                    if (!empty($toDataList[$i]['email'])) {
                        $mail->AddAddress(trim($toDataList[$i]['email']), ''); //send to mail heree
                    }
                }

                //Add CC here
                for ($i = 0; $i < sizeof($ccDataList); $i++) {
                    if (!empty($ccDataList[$i]['email'])) {
                        $mail->AddCC(trim($ccDataList[$i]['email']), ''); //send to mail heree
                    }
                }

                //Add BCC here
                for ($i = 0; $i < sizeof($bccDataList); $i++) {
                    if (!empty($bccDataList[$i]['email'])) {
                        $mail->AddBCC(trim($bccDataList[$i]['email']), ''); //send to mail heree
                    }
                }

                //Add AddAttachment here
                for ($i = 0; $i < sizeof($attachmentList); $i++) {
                    if (!empty($attachmentList[$i])) {
                        $mail->AddAttachment(trim($attachmentList[$i]), ''); //send to mail heree
                    }
                }

                $result = $mail->Send();
                $mail->ClearAllRecipients();
                $mail->ClearAddresses();
                $mail->ClearAttachments();
                //unlink(trim($this->input->post('attachPath')));

                if ($result == FALSE) {
                    return "<h3 style='color:red;'>Failure, can not send mail.</h3>";
                } else {
                    return "<h3 style='color:green;'>Email sent successfully.</h3>";
                }
            } catch (Exception $e) {
                return $e->errorMessage();
                return "<h3 style='color:red;'>Failure, can not send mail.</h3>";
            }
        }
    }