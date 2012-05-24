<?php
$count = count($recordsArr);
$half = round($count / 2);

function printRecord($r){
     $ro_key = $r->{'key'};
            $name =  $r->{'displayTitle'};
            $descriptions = array();if(isset($r->{'description_value'})) $descriptions = $r->{'description_value'};
            $description_type=array();if(isset($r->{'description_type'})) $description_type = $r->{'description_type'};
	    $brief = '';$found_brief = false;
            $full = '';$found_full = false;
            foreach($description_type as $key=>$t){
                    if($t=='brief' && !$found_brief) {
                            $brief = $descriptions[$key];
                            $found_brief = true;
                    }elseif($t=='full' && !$found_full){
                            $full = $descriptions[$key];
                            $found_full = true;
                    }
            }
            echo '<div class="list_item">'; 
            echo '<h2><a href="view/dataview?key='.$ro_key.'" class="record-list">'.$name.'</a></h2>';
            //DESCRIPTIONS';
            if($found_brief || $found_full){
                echo '<p>';
                if($found_brief){
                        echo showBrief($brief,30);
                        if(strlen($brief) > strlen(showBrief($brief,30))){
                            echo "...";
                        }
                }elseif($found_full){
                        echo showBrief($full,30);
                        if(strlen($full) > strlen(showBrief($full,30))){
                            echo "...";
                        }
                }
                
                    echo '</p> ';
            }
            echo '</div>';
}
?>
<div id="hp-left">
    <?php 
        for($i=0;$i<$half; $i++){
           printRecord($recordsArr[$i]);
        }
    ?>
</div>
<div id="hp-right">
     <?php 
        for($i=$half;$i<$count; $i++){
           printRecord($recordsArr[$i]);
        }
    ?>
</div>