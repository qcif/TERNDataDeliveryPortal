<?php $this->load->view('tpl/header'); ?>     
<div id="contact_form">
    <?php
    $this->load->helper('form');
    $hidden = array('ip' => $_SERVER['REMOTE_ADDR']);
    echo form_open('contact/send','',$hidden);
    echo form_label('Full name: ','name');
    $ndata = array('name' => 'name', 'id' => 'name', 'size' => '25', 'value' => set_value("name"));
        echo form_error('name'); 
    if(!form_error('name')){
        echo "<br/>";
    }
    echo form_input($ndata);
    echo "<br/>";
    echo form_label('Email address: ','email');
    $edata = array('name' => 'email', 'id' => 'email', 'size' => '25' , 'value' => set_value("email"));
    echo form_error('email'); 
    if(!form_error('email')){
        echo "<br/>";
    }
    echo form_input($edata);
    echo "<br/>";
    echo form_label('Comment: ','msg');
    $cdata = array('name' => 'msg', 'id' => 'msg', 'cols' => '40', 'rows' => '5' , 'value' => set_value("msg"));
    echo  form_error('msg'); 
    if(!form_error('msg')){
        echo "<br/>";
    }
    echo form_textarea($cdata);
    echo "<br/>";
    echo form_submit('submit','Send');
    echo form_close();

    ?>
</div>

<?php $this->load->view('tpl/footer'); ?>     
