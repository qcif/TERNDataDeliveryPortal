<?php


class Scheduler extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        
    }
    
    
    function getOrder($cat_id,$batch_id = null){
        if($batch_id){
            $sql = 'SELECT * FROM index_scheduler WHERE run_schedule <= NOW() and under_process=0 and end_run = 0 and cat = ? and batch_id = ? ORDER BY run_schedule ASC LIMIT 1';
            $q  = $this->db->query($sql, array($cat_id,$batch_id));  
            log_message('DEBUG', $this->db->last_query());
            }else{
            $sql = 'SELECT * FROM index_scheduler WHERE run_schedule <= NOW() and under_process=0 and end_run = 0 and cat = ? ORDER BY run_schedule ASC LIMIT 1';
            $q  = $this->db->query($sql, $cat_id);
            log_message('DEBUG', $this->db->last_query());
        } 
        if(pg_last_error()){ 
            log_message('DEBUG', pg_last_error());
        }
         log_message('DEBUG', 'Found schedule: '. $q->num_rows());
        if($q->num_rows() > 0) return $q->result();
        else return false;
        
    }
    
    function setUnderProcess($id){
        $sql = 'UPDATE index_scheduler SET under_process=1,run_timestamp=NOW() WHERE batch_id = ?';
        $q  = $this->db->query($sql, $id);
        if(pg_last_error()){
            log_message('error', pg_last_error());
        }
        return $this->db->affected_rows();        
        
    }
    
    function setNotUnderProcess($id){
        $sql = 'UPDATE index_scheduler SET under_process=0 WHERE batch_id = ?';
        $q  = $this->db->query($sql, $id);
        if(pg_last_error()){
            log_message('error', pg_last_error());
        }
        return $this->db->affected_rows();        
    }
    
    function updateProcess($id,$start_timestamp, $rec_start){
        $sql = 'UPDATE index_scheduler SET under_process=1,start_timestamp=?,rec_start=? WHERE batch_id = ?';
        $q  = $this->db->query($sql, array((string) $start_timestamp,$rec_start, $id));
        if(pg_last_error()){
            log_message('error', pg_last_error());
        }
        return $this->db->affected_rows();        
        
    }
    
    function setCancelProcess($id){
        $sql = 'UPDATE index_scheduler SET under_process=0 WHERE batch_id = ?';
        $q  = $this->db->query($sql, $id);
        if(pg_last_error()){
            log_message('error', pg_last_error());
        }
        return $this->db->affected_rows();        
        
    }
    
     function setFinishProcess($id,$start_timestamp, $last_run, $rec_start){
        if ($start_timestamp != '' ){ 
        $sql = 'UPDATE index_scheduler SET under_process=0,end_run=?,start_timestamp=?,rec_start=? WHERE batch_id = ?';
        $q  = $this->db->query($sql, array($last_run, (string) $start_timestamp, $rec_start, $id));
        }else{
            $sql = 'UPDATE index_scheduler SET under_process=0,end_run=?,rec_start=? WHERE batch_id = ?';
        $q  = $this->db->query($sql, array($last_run, $rec_start, $id));
            
        }

        if(pg_last_error()){
            log_message('error', pg_last_error());
      
        }
        return $this->db->affected_rows();        
        
    }
    
    function insertSchedule($start_timestamp = null, $end_timestamp = null, $run_schedule = null, $l_id=null, $rec_start=0, $cat=0 ){
       if($start_timestamp) $convert_start = ' AT TIME ZONE \'UTC\'';
       if($end_timestamp) $convert_end = ' AT TIME ZONE \'UTC\'';    
       if($run_schedule) $convert_run = ' AT TIME ZONE \'UTC\'';    
       if(!$run_schedule) { 

           $sql = 'INSERT INTO index_scheduler(start_timestamp,end_timestamp,l_id,rec_start,cat) VALUES(?'.$convert_start.',?'. $convert_end .',?,?,?);'  ;
            $q  = $this->db->query($sql, array($start_timestamp, $end_timestamp,  $l_id, $rec_start, $cat));
       }
       else {
           $sql = 'INSERT INTO index_scheduler(start_timestamp,end_timestamp,run_schedule,l_id,rec_start,cat) VALUES(?'.$convert_start.',?' . $convert_end . ',?' . $convert_run .',?,?,?);';
           $q  = $this->db->query($sql, array($start_timestamp, $end_timestamp,  $run_schedule, $l_id, $rec_start, $cat));
       }
       
        if(pg_last_error()){ 
            log_message('error', pg_last_error());
            return false;
        }
        return $this->db->insert_id();        
    }
    
    function deleteSchedule($batch_id=null,$cat=null){
         
         if(!is_null($batch_id) && $batch_id !=''){
            if(!is_null($cat)  && $cat !='')  {
                $sql = 'DELETE FROM index_scheduler WHERE batch_id=? AND cat=? AND under_process=0';
                $q  = $this->db->query($sql, array($batch_id,$cat));
            }else{
                $sql = 'DELETE FROM index_scheduler WHERE batch_id=? AND under_process=0';
                $q  = $this->db->query($sql, array($batch_id));
            } 
        }elseif(!is_null($cat)  && $cat !=''){
            $sql = 'DELETE FROM index_scheduler WHERE cat=? AND under_process=0';
            $q  = $this->db->query($sql, array($cat));
            }   
           
        return $this->db->affected_rows();    
    }
}


?>
