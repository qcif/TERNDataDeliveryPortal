
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class R extends CI_Controller {
    
    public function getList($l_id)
    {
         $this->load->model('Regions');
         $regions = $this->Regions->getRegionList($l_id);
         header('Content-type: application/json');
         print json_encode($regions);
    }
        
    public function intersectPt($long,$lat,$l_id){
         $this->load->model('Regions');
         header('Content-type: application/json');
         header('Access-Control-Allow-Origin: *');
         echo json_encode($this->Regions->intersect($long,$lat,$l_id));
         
    }
    
    public function intersectPoly($geom,$l_id){
         $this->load->model('Regions');
         header('Content-type: application/json');
         echo json_encode($this->Regions->intersectPoly($geom,$l_id));
         
    }	
        

}
?>