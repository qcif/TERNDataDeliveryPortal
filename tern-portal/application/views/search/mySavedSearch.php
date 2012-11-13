<?php
/** 
Copyright 2011 The Australian National University
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

********************************************************************************
$Date: 2011-09-06 11:35:57 +1000 (Tue, 06 Sep 2011) $
$Revision: 1 $
***************************************************************************
*
**/ 
?>
<div class="saved_cookie">
<?php
    $row = 1;
    
    $r=explode("|",$saved);

    if(count($r)<1||$saved=='')
    {
        echo 'No saved searches';
    }else
    {
        echo '<ul>';
        

            for($s=0;$s<count($r);$s++)
            {
                $sep=explode(";",$r[$s]);
                echo '<li><span  class="removeCookie" id="'.$sep[0].';'.$sep[1].'"><a target="_blank" href="'.$sep[0].'">'.(string)$sep[1].'</a><a class="remove"></a></span></li>';
            }
 
         
        echo '</ul>';
        
    }        


?>
</div>
