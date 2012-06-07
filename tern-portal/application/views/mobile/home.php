<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>


<?php $this->load->view('mobile/tpl/header'); ?>


<div class="content-primary">
    <?php
    $object_group = $json->{'facet_counts'}->{'facet_fields'}->{'group'};
    $groups = array(); // array to stores the class
    for ($i = 0; $i < sizeof($object_group) - 1; $i = $i + 2)
    {
        $groups[$object_group[$i]] = $object_group[$i + 1];
    }
    ?>
    <nav>
        <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b">
            <li data-role="list-divider">TERN data Collection</li>
            <?php foreach ($groups as $index => $c)
            {
                ?>
                <li><a href="/m/search?group=<?php echo $index; ?>&page=1&class=collection"><?php echo $index; ?><span class="ui-li-count"><?php echo number_format($c); ?></span></a></li>
<?php } ?>
        </ul>
    </nav>
</div>
<?php $this->load->view('mobile/tpl/footer'); ?>