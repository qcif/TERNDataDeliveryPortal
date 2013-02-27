<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class R extends CI_Controller {
    
     
    /* Get List of regions based on l_id. Outputs in json format 
     */ 
    
    public function getList($l_id)
    {
         $this->load->model('Regions');
         $regions = $this->Regions->getRegionList($l_id);
         header('Content-type: application/json');
         print json_encode($regions);
    }
    
    /* Intersecting Point with a single layer
     * http://host/regions/r/intersectPt/long/lat/l_id
     */ 
    public function intersectPt($long,$lat,$l_id){
         $this->load->model('Regions');
         header('Content-type: application/json');
         header('Access-Control-Allow-Origin: *');
         echo json_encode($this->Regions->intersect($long,$lat,$l_id));
         
    }
    
    /* Intersecting Geometry with a single layer
     * http://host/regions/r/intersectPoly/-71.1776585052917 42.3902909739571,-71.1776820268866 42.3903701743239,
-71.1776063012595 42.3903825660754,-71.1775826583081 42.3903033653531,-71.1776585052917 42.3902909739571/l_id
     * Coordinate pairs are separated by commas!!
     */ 
    
    public function intersectPoly($geom,$l_id){
         $this->load->model('Regions');
         header('Content-type: application/json');
         echo json_encode($this->Regions->intersectPoly($geom,$l_id));
         
    }	
        
   
    public function search(){
       $this->load->model('Regions');
       $geometry = $_POST['geometry'];
       $bounds = $_POST['bounds'];
       $r_list_single = array();
       $r_list = $this->Regions->searchPoly($bounds, $geometry);
       foreach($r_list as $key=>$res){
           array_push($r_list_single, $res->key);
       };
        $data['registryObjects'] = $r_list_single;

        $this->load->view('listIDs', $data);

    }    
}
?>