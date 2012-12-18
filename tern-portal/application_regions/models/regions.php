<?php


class Regions extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        
    }
    
    /* Find which layer objects intersect with this latitude and longitude*/
    
    function intersect($long,$lat,$layer=null){
        if(!$layer){            
            $sql = 'SELECT r_id,r_name,l_id FROM regions WHERE ST_Within(ST_SETSRID(ST_Point(?,?),4326), the_geom)';
            $q  = $this->db->query($sql, array($long,$lat)); 
        }else{
            $sql = 'SELECT r_id,r_name,l_id FROM regions WHERE ST_Within(ST_SETSRID(ST_Point(?,?),4326), the_geom) AND l_id=?';
            $q =  $this->db->query($sql, array($long,$lat,$layer)); 
        }
       if($q->num_rows() > 0) return $q->result();
        else return new stdClass;
        
    }
    
     /* intersect regions table with coordinates*/
    function intersectLine($coords,$layer=null){
        
        $coords = "LINESTRING(". $coords . ")";        
          if(!$layer){             
            $sql = 'SELECT r_id,r_name,l_id FROM regions WHERE ST_INTERSECTS(ST_GeomFromText(?,4326), the_geom)';
            $q  = $this->db->query($sql, array($coords)); 
        }else{
            $sql = 'SELECT r_id,r_name,l_id FROM regions WHERE ST_INTERSECTS(ST_GeomFromText(?,4326), the_geom) AND l_id=?';
            $q =  $this->db->query($sql, array($coords,$layer)); 
        }
       if($q->num_rows() > 0) return $q->result();
        else return new stdClass;
        
    }
     
    
    /* intersect regions table with coordinates*/
    function intersectPoly($coords,$layer=null){
        
        $coords = "POLYGON((". $coords . "))";        
          if(!$layer){            
            $sql = 'SELECT r_id,r_name,l_id FROM regions WHERE ST_INTERSECTS(ST_GeomFromText(?,4326), the_geom)';
            $q  = $this->db->query($sql, array($coords)); 
        }else{
            $sql = 'SELECT r_id,r_name,l_id FROM regions WHERE ST_INTERSECTS(ST_GeomFromText(?,4326), the_geom) AND l_id=?';
            $q =  $this->db->query($sql, array($coords,$layer)); 
        }
       if($q->num_rows() > 0) return $q->result();
       else return new stdClass;
        
    }
     
    /* get full region list based on layer id*/ 
    function getRegionList($l_id){
        $sql = 'SELECT r_id, r_name from regions WHERE l_id=? ORDER BY r_name ASC';
        $q = $this->db->query($sql, array($l_id));
        if($q->num_rows() > 0) return $q->result();
        else return new stdClass;
        
    }
    
    function searchPoly($bounds,$geometry){
        $db2 = $this->load->database('orca', TRUE);
        $sql = 'SET search_path=dba;';
        $q = $db2->query($sql);
        $sql = 'SELECT  dba.tern_search_geom_intersect(CAST(? as DOUBLE PRECISION), CAST(? as DOUBLE PRECISION), CAST(? as DOUBLE PRECISION), CAST(?  as DOUBLE PRECISION) , CAST(? as TEXT)) as key';
        $q = $db2->query($sql, array($bounds['n'],$bounds['w'],$bounds['s'],$bounds['e'],$geometry));
        if($q->num_rows() > 0) return $q->result();
        else return new stdClass;
        
        
    }
}


?>
