<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function findBounds($g)
{
    global $gCNN_DBS_ORCA;

    $e='select dba.st_xmax((select dba.st_extent((select dba.ST_AsText(dba.ST_envelope(dba.ST_GeomFromText(\''.$g.'\')'.')::dba.geometry)))::dba.geometry))';
    $n='select dba.st_ymax((select dba.st_extent((select dba.ST_AsText(dba.ST_envelope(dba.ST_GeomFromText(\''.$g.'\')'.')::dba.geometry)))::dba.geometry))';
    $w='select dba.st_xmin((select dba.st_extent((select dba.ST_AsText(dba.ST_envelope(dba.ST_GeomFromText(\''.$g.'\')'.')::dba.geometry)))::dba.geometry))';
    $s='select dba.st_ymin((select dba.st_extent((select dba.ST_AsText(dba.ST_envelope(dba.ST_GeomFromText(\''.$g.'\')'.')::dba.geometry)))::dba.geometry))';

    $resultEast=executeQuery($gCNN_DBS_ORCA, $e);
    $resultNorth=executeQuery($gCNN_DBS_ORCA, $n);
    $resultWest=executeQuery($gCNN_DBS_ORCA, $w);
    $resultSouth=executeQuery($gCNN_DBS_ORCA, $s);
    
    $b=array(   
        "e"  => $resultEast[0]["st_xmax"],
        "n"  => $resultNorth[0]["st_ymax"],
        "w"  => $resultWest[0]["st_xmin"],
        "s"  => $resultSouth[0]["st_ymin"],
    );

    return $b;
}

function doSpatial($g,$bounds)
{
    global $gCNN_DBS_ORCA;

        $s='SET search_path=dba;';
        $q=  executeQuery($gCNN_DBS_ORCA, $s);

        $sql = 'SELECT  dba.tern_api_search_geom_intersect(CAST($1 as DOUBLE PRECISION), CAST($2 as DOUBLE PRECISION), CAST($3 as DOUBLE PRECISION), CAST($4  as DOUBLE PRECISION) , CAST($5 as TEXT)) as key';
        $params=array($bounds['n'],$bounds['w'],$bounds['s'],$bounds['e'],$g);
        
        $q=  executeQuery($gCNN_DBS_ORCA, $sql, $params);
        print_r($params);
        $kstr="";
        foreach ($q as $key)
        {
            if ($kstr=="")
            {
                $kstr='"'.$key['key'].'"';
            }
            else
            {
                $kstr=$kstr.' OR "'.$key['key'].'"';
            }

        }

        $kstr='+key:('.$kstr.')';

            if(count($q)>0) return $kstr;
            else return new stdClass;
}


function doSpatialBox($b)
{
    global $gCNN_DBS_ORCA;

    $b_array=  explode(",", $b);
    $n=$b_array[0];
    $e=$b_array[1];
    $s=$b_array[2];
    $w=$b_array[3];

    $sql = 'select distinct rs.registry_object_key from dba.tbl_registry_objects rs, dba.tbl_spatial_extents se 
            where rs.registry_object_key = se.registry_object_key and se.bound_box && box ((point($1,$2)),(point($3,$4)))';
    
    $params=array($n,$w,$s,$e);
        
    $q=  executeQuery($gCNN_DBS_ORCA, $sql, $params);
    
        $kstr="";
        foreach ($q as $key)
        {
            if ($kstr=="")
            {
                $kstr='"'.$key['registry_object_key'].'"';
            }
            else
            {
                $kstr=$kstr.' OR "'.$key['registry_object_key'].'"';
            }

        }

        $kstr='+key:('.$kstr.')';

        if(count($q)>0) return $kstr;
        else return new stdClass;
}
?>