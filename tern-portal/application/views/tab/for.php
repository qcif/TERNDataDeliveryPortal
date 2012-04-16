<div class="hp-left">
    <?php
    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */
    $prefix = '';

    if (!$subject || count($subject) < 1)
    {
    ?>

        <div class="boxfor">
            No records found with field of research.
        </div>
    <?php
    }
    else
    {
        foreach($subject as $name=>$childs)
        {


            $separator = "";
    ?>
            <div class="boxfor">    <h4> <?php echo $name; ?></h4>
        <?php
            if (count($childs)>=1 && $name !='UNCATEGORIZED')
            {
                foreach ($childs as $childName => $value)
                {
                   
        ?>
        <?php echo $separator; ?>  <a href="#" title="<?php echo $childName; ?>"><?php echo $childName; ?> (<?php echo $value; ?>)</a>
        <?php
                    $separator = " | ";
                }
            } else if ($name=='UNCATEGORIZED'){ ?>
                <a href="#" title=""><?php echo $name; ?> (<?php echo $childs; ?>)</a>
            <? } ?> 
                </div>
        <?php
        } ?>

    <?
    }
    ?>
</div>
<div class="hp-right">
    <div id="formap"></div>
</div>