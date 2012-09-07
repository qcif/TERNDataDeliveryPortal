<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Controller {

    
    function __construct()
    {         
         if (isset($_SERVER['REMOTE_ADDR']) && (($_SERVER['REMOTE_ADDR'] != '127.0.0.1') && ($_SERVER['REMOTE_ADDR' != 'localhost']) && $_SERVER['RREMOTE_ADDR'] != $_SERVER['SERVER_ADDR'])) die( 'Permission denied');
    
        parent::__construct();
        $this->load->model('Scheduler');   
        
    }
    
    public function put(){
        $default = array('run_schedule','start_timestamp','end_timestamp','l_id','cat','rec_start');
        $params = $this->uri->uri_to_assoc(3, $default);
        
        extract($params);
        if($run_schedule!=''){
           if(strcasecmp($run_schedule,'NOW') ==0){
                $run_schedule = NULL;              
            }else{
                $run_schedule = urldecode($run_schedule);
            }
        }else{
            $run_schedule = null;
        }
        if($start_timestamp !=''){
             if(strcasecmp($start_timestamp,'NOW') ==0){
                $start_timestamp = NULL;                   
            }else{
                $start_timestamp = urldecode($start_timestamp);
            }
        }else{
            $start_timestamp = null;
        }
        if($end_timestamp !=''){
             if(strcasecmp($end_timestamp,'NOW') ==0){
                 $end_timestamp = NULL;                                   
            }else{
                $end_timestamp = urldecode($end_timestamp);
            }
        }else{
            $end_timestamp = null;
        }
        if(!$l_id || $l_id == '' ){
            $l_id = null;
        }
        if(!$rec_start || $rec_start == ''){
            $rec_start = 0;
        }
        if(!$cat || $cat == ''){
            $cat = 0;
        }
        
        $id = $this->Scheduler->insertSchedule($start_timestamp,$end_timestamp,$run_schedule,$l_id,$rec_start,$cat);
        print($id);
        
    }
    
    public function del(){
        $default = array('cat','batch_id');
        $params = $this->uri->uri_to_assoc(3, $default);
       
        extract($params);

        print $this->Scheduler->deleteSchedule($batch_id,$cat);
    }
    
   
}
?>
