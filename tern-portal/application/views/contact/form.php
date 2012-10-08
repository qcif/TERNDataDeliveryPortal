<?php $this->load->view('tpl/header'); ?>    
<div id="staticContent">
    <h1 class="margin10">Contact Form</h1>
<div id="contact_form">
    <?php
    $this->load->helper('form');
    $hidden = array('ip' => $_SERVER['REMOTE_ADDR']);
    echo form_open('contact/send','',$hidden);
    echo form_label('Name: ','name');
    $ndata = array('name' => 'name', 'id' => 'name', 'size' => '25', 'value' => set_value("name"));
        echo form_error('name'); 
    if(!form_error('name')){
        echo "<br/>";
    }
    echo form_input($ndata);
    echo "<br/>";
    echo form_label('Email: ','email');
    $edata = array('name' => 'email', 'id' => 'email', 'size' => '25' , 'value' => set_value("email"));
    echo form_error('email'); 
    if(!form_error('email')){
        echo "<br/>";
    }
    echo form_input($edata);
    echo "<br/>";
    echo form_label('Phone: ','email');
    $pdata = array('name' => 'phone', 'id' => 'phone', 'size' => '25' , 'value' => set_value("phone"));
    echo form_error('phone'); 
    if(!form_error('phone')){
        echo "<br/>";
    }
    echo form_input($pdata);
    echo "<br/>";
    echo form_label('Subject: ','email');
    $sdata = array('name' => 'subject', 'id' => 'subject', 'size' => '50' , 'value' => set_value("subject"));
    echo form_error('subject'); 
    if(!form_error('subject')){
        echo "<br/>";
    }
    echo form_input($sdata);
    
    echo "<br/>";
    echo form_label('Message: ','msg');
    $cdata = array('name' => 'msg', 'id' => 'msg', 'cols' => '47', 'rows' => '5' , 'value' => set_value("msg"));
    echo  form_error('msg'); 
    if(!form_error('msg')){
        echo "<br/>";
    }
    echo form_textarea($cdata);
    echo "<br/>";
    echo "<input id=\"submitBtn\" class=\"orangeGradient roundedCorners\" value=\"Send\"/>";
    echo form_close();

    ?>
</div>
</div>
<?php $this->load->view('tpl/footer'); ?>     
