<?php
/**
Copyright 2011 Terrestrial Ecosystem Research Network
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
**/
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RefreshFORStat extends CI_Controller {

	public function index(){


		$this->load->model('Solr');
		$json = $this->Solr->getFORCodes();
                 $this->load->model('Registryobjects','ro');
                 
                //print_r($json->{'facet_counts'}->{'facet_fields'});
                $two_code = $json->{'facet_counts'}->{'facet_fields'}->{'for_code_two'};
		$four_code = $json->{'facet_counts'}->{'facet_fields'}->{'for_code_four'};
                 //print the selected
                for($i=0;$i< sizeof($two_code)-1 ;$i=$i+2){
                       
                        if($two_code[$i+1]>0 && strlen($two_code[$i])>1){
                               // $subject[$two[$i]]['value']=$two[$i+1];
                                  $termQ = $this->ro->getTermsForVocab('ANZSRC-FOR',$two_code[$i]);
                                    $row = $termQ->row();
                                    if($row->name!='') {
                                        $two_name = $row->name;
                                     

                                    for($j=0;$j< sizeof($four_code)-1 ;$j=$j+2){
                                        if(substr($four_code[$j],0,2) == substr($two_code[$i],0,2)){  // if the four code belongs to this two code 
                                                $termQ = $this->ro->getTermsForVocab('ANZSRC-FOR',$four_code[$j]);
                                                $row = $termQ->row();
                                                if($row->name!='') {
                                                    $four_name = $row->name;
                                                    $subject[$two_name][$four_name] = $four_code[$j+1];
                                                }
                                        }
                                    }
                                }
                        }
                }
               print_r($subject);
                
                $json = $this->Solr->getNotFORCodes();
                
                $uncategorized = $json->{'response'}->{'numFound'};
            
                if($uncategorized>0){
                    $subject['UNCATEGORIZED'] = $uncategorized;
                }
               
                $handle = fopen(APPPATH . 'views/tab/forstat.php',w);
                fwrite($handle,'<?php  ');
                fwrite($handle,'$subject = ');
                fwrite($handle, var_export($subject,true));            
                fwrite($handle,'?>');
                fclose($handle);
                echo error_get_last();
	}


}
?>
