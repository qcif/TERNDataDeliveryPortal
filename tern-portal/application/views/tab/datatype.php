<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="hp-left">
    <?php
    if (!$dataTypeLvl1)
    {
    ?>

        <div class="boxdatatype">
            No records found.
        </div>
<?php
    }
    else
    {
        foreach ($dataTypeLvl1 as $dataTypeLvl1Details)
        {
?>
            <div class="boxdatatype">    <h4> <?php echo $dataTypeLvl1Details['name']; ?></h4>
    <?php
            if (is_array($dataTypeLvl2[$dataTypeLvl1Details['name']]))
            {
                foreach ($dataTypeLvl2[$dataTypeLvl1Details['name']] as $dataTypeLvl2Code => $dataTypeLvl2Details)
                {
    ?>
        <?php echo $separator; ?>  <a href="#" title="<?php echo $dataTypeLvl2Code; ?>"><?php echo $dataTypeLvl2Details['name']; ?> (<?php echo $dataTypeLvl2Details['stat']; ?>)</a>
        <?php
                    $separator = " | ";
                }
            }
            $separator = " ";
        ?>
        </div>    
        <?php } ?>

    <?
    }
    ?>
</div>
<div class="hp-right">
    <div id="datatypemap"></div>
</div>