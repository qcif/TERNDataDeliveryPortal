<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$model = ModelFactory::getDefaultModel();

// Load and parse document
$model->load(GCMDBASE);

findChildGCMD($id,$model);

?>
