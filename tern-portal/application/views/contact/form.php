<?php $this->load->view('tpl/header'); ?>    
<div id="staticContent">
    <h1 class="margin10">Contact Form</h1>
    <div style="margin:0 auto; overflow: auto; width: 670px">
<div id="contact_form">
    <?php
    $this->load->helper('form');
    $attr = array('name'=>'contact','id'=>'contact');    
    echo form_open('contact/send',$attr);
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
    echo "<label for=\"security_code\">Security Code: </label><br/>
        <img src=\"/contact/create_security/" . $captcha ."\" width=\"120\" height=\"40\" ><br/>" ; 
    echo "<input id=\"security_code\" name=\"security_code\" type=\"text\" /><br />";
    echo  form_error('security_code'); 
     if(!form_error('msg')){
        echo "<br/>";
        
  
    }
    echo "<input id=\"submitBtn\" class=\"orangeGradient roundedCorners\" onClick=\"document.contact.submit()\" value=\"Send\"/>";
    echo form_close();

    ?>
</div>
    <div id="contact_text">
        <p>
        Terrestrial Ecosystem Research Network (TERN)<br/>
Goddard Building (Bld #8)<br/>
The University of Queensland<br/>
St Lucia QLD 4072, Australia</p>
<p>
TEL: +61 7 3346 7021<br/>
FAX: +61 7 3365 1423<br/>
EMAIL: <a href="mailto:tern.portal@tern.org.au">tern.portal@tern.org.au</a><br/>
</p> 
<p>
    <a href="http://www.tern.org.au/Facility-Data-Contacts-pg19931.html" style="font-size:16px;" target="_blank">Get access to Facility Data Managers</a>  
</p> 
    </div>
    </div>
</div>
<?php $this->load->view('tpl/footer'); ?>     
