<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {


	public function index(){
            
          $this->load->view('contact/form');
        }
        
        public function send(){
            $this->load->library('form_validation');            
            $this->form_validation->set_rules('name', 'Full name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('msg', 'Comment', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="error"> &nbsp;&nbsp;', '</div>');
            if($this->form_validation->run() == FALSE)
		{
			$this->load->view('contact/form');
		}
	    else
		{		            
                    $this->load->library('email');
                    $this->email->from($this->input->post('email'),$this->input->post('name'));
                    $this->email->to(eCONTACT_EMAIL);           
                    $this->email->subject('TERN Portal Contact form');
                    $this->email->reply_to( $this->input->post('email'),$this->input->post('name'));
                    $data['name'] = $this->input->post('name');
                    $data['email'] = $this->input->post('email');
                    $data['msg'] = $this->input->post('msg');
                    $data['ip'] = $this->input->post('ip');
                    $content = $this->load->view('contact/template', $data, TRUE);
                    $this->email->message($content);            
                    $this->email->send();
                    $this->load->view('contact/result', $data);
                }
        }
}
?>
