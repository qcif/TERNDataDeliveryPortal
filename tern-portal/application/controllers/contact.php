<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {


	public function index(){ 
           session_start();
          $this->load->view('contact/form');
        }
        
        public function security_check($str)
	{
		 session_start();
                 $captcha = $_SESSION['captcha'];  
                
                if ($str == $captcha)
		{
                        $this->form_validation->set_message('security_check', 'error');
                                return TRUE;
                    
		}
		else
		{
			
			$this->form_validation->set_message('security_check', 'The security code you have entered was incorrect');
			return FALSE;
		}
	}
        
         
        public function phone_num_check($str)
        {
            $pattern = "/^[\d|\+|\(][\)|\d|\s|-]+[\d]$/" ;
            if (preg_match($pattern,$str)){
                $this->form_validation->set_message('phone_num_check', 'error');
                                 return TRUE;
            }else{
                $this->form_validation->set_message('phone_num_check', 'The phone number you have entered was invalid ');
			return FALSE;
            }
            
        }
        public function create_security(){
            session_start();
               require_once(APPPATH . 'libraries/CaptchaSecurityImages.php');       
                $width = '120';
                $height = '40';
                $characters = 6;
 
               $data["captcha"] = new CaptchaSecurityImages($width,$height,$characters);
                
            
        }
        public function send(){
            session_start();
            
            $this->load->library('form_validation');            
            $this->form_validation->set_rules('security_code', 'Security code', 'callback_security_check|xss_clean');
            $this->form_validation->set_rules('name', 'Full name', 'trim|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|callback_phone_num_check|xss_clean');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('msg', 'Message', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="error"> &nbsp;&nbsp;', '</div>');
            if($this->form_validation->run() == FALSE)
		{
			$this->load->view('contact/form');
		}
	    else
		{		           
                    $this->load->library('email');
                   
                    
                    $this->email->from(eCONTACT_EMAIL, eINSTANCE_TITLE. ' website');
                    $this->email->to(eCONTACT_EMAIL);             
                    $this->email->subject('TERN Portal Contact form');
                    $this->email->reply_to( $this->input->post('email'),$this->input->post('name'));
                    $data['name'] = $this->input->post('name');
                    $data['email'] = $this->input->post('email');
                    $data['msg'] = $this->input->post('msg');
                    $data['phone'] = $this->input->post('phone');
                    $data['subject'] = $this->input->post('subject');
                    $content = $this->load->view('contact/template', $data, TRUE);
                    $this->email->message($content);            
                    $this->email->send();
                    $this->load->view('contact/result', $data);
                }
        }
}
?>
