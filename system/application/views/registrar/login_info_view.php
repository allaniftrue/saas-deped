<?php $this->load->view('registrar/main_header_view'); ?>
<header class="jumbotron subhead" id="overview">
<div class="subnav">
    <ul class="nav nav-pills">
        <li><a href="<?=base_url()?>?mc=account<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Personal Info</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=family_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Family Background</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=educational_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Educational Background</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=civil_srv_elegibility<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Civil Service Eligibility</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=work_experience<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Work Experience</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=voluntary_work<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Voluntary Work</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=training_programs<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Training Programs</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=other_info<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Other Information</a></li>
        <li class="active"> <a href="<?=base_url()?>?mc=account&m=login<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Account</a></li>
    </ul>
</div>
</header>
<section id="expwrap">
<div class="span11" >
      <div class="page-header">
            <h1>Personal Data Sheet <small> &nbsp;{ Login Information }</small></h1>
      </div>
      <form id="form-login"> 
          <div class="span5">
            <p>
                <label for="passold">Current Password  </label>
                <input type="password" name="passold" id="passold" class="input-xlarge" />
            </p>
            <p>
                <label for="passnew00">New Password  </label>
                <input type="password" name="passnew00" id="passnew00" class="input-xlarge" />
                <div class="password-meter">
                    <div class="password-meter-bg">
                            <div class="password-meter-bar"></div><span class="password-meter-message"> </span>
                    </div>
                </div>
            </p>
            <br />
            <p>
                <label for="passnew01">Confirm New Password  </label>
                <input type="password" name="passnew01" id="passnew01" class="input-xlarge" />
            </p>
            <p>
                <input type="submit" name="submit" value="Submit" id="submit" class="btn btn-primary" />
                <img src="<?=base_url()?>img/ajax-loader.gif" style="display:none;" id="preloader" />
            </p>
          </div>
          <div class="span5 well">
              <div class="alert alert-info"><h3>Password Tips</h3></div>

                    <b>How safe is your password?</b>

                    <p align="justify">The first step in protecting your online privacy is creating a safe password - i.e. one that a computer program or persistent individual won't easily be able to guess in a short period of time. To help you choose a secure password, we've created a feature that lets you know visually how safe your password is as soon as you create it.</p>

                    <p><b>Tips for creating a secure password:</b></p>
                    <ul>
                        <li>Include punctuation marks and/or numbers.</li>
                        <li>Mix capital and lowercase letters.</li>
                        <li>Include similar looking substitutions, such as the number zero for the letter 'O' or '$' for the letter 'S'.</li>
                        <li>Create a unique acronym.</li>
                        <li>Include phonetic replacements, such as 'Luv 2 Laf' for 'Love to Laugh'.</li>
                    </ul>
                    
                    <p><b>Things to avoid:</b></p>
                    <ul>
                        <li>Don't reuse passwords for multiple important accounts, such as Gmail and online banking.</li>
                        <li>Don't use a password that is listed as an example of how to pick a good password.</li>
                        <li>Don't use a password that contains personal information (name, birth date, etc.)</li>
                        <li>Don't use words or acronyms that can be found in a dictionary.</li>
                        <li>Don't use keyboard patterns (asdf) or sequential numbers (1234).</li>
                        <li>Don't make your password all numbers, uppercase letters or lowercase letters.</li>
                        <li>Don't use repeating characters (aa11).</li>
                    </ul>
                    
                    
                    <p><b>Tips for keeping your password secure:</b></p>
                    
                    <ul>
                        <li>Never tell your password to anyone (this includes significant others, roommates, parrots, etc.).</li>
                        <li>Never write your password down.</li>
                        <li>Never send your password by email.</li>
                        <li>Periodically test your current password and change it to a new one.</li>
                    </ul>
          </div>
    </form>
</div>
</span>
<div id="delwarning" title="Confirmation" style="display: none;">
                <p>Are you sure you want to completely remove this information?</p>
</div>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.validate.password.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
       $("#form-login").validate({
           rules:{
               passold:{
                   required:true,
                   password:false
               },
               passnew00:{
                   required:true,
                   minlength: 8,
                   password: true
               },
               passnew01: {
                   required:"true",
                   password: false,
                   equalTo:"#passnew00"
               }
           },
           messages: {
                passold: {
                    required: "Please provide a password"
		},
                passnew00: {
                    required: "Please provide your new password",
                    minlength: "Your password must be at least 8 characters long"
                }
                
           },
           errorPlacement: function(error, element) {
                error.insertAfter(element.parent().find('label:first'));
           },
           submitHandler:function() {
               $('#preloader').show();
               $.ajax({
                   type:'post',
                   url:'?mc=account&m=login_data',
                   data:{
                       oldpass:$('#passold').val(),
                       newpass:$('#passnew00').val()
                   },
                   cache:'false',
                   success: function(msg){
                       var json = $.parseJSON(msg);
                       $.alert(json.message,json.title);
                       $('form').clearForm();
                       $('#preloader').hide();
                       $('.password-meter-bar').removeClass('password-meter-strong');
                       $('.password-meter-message').empty();
                       
                   },
                   error:function (xhr, ajaxOptions, thrownError){
                       $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                       $('#preloader').hide();
                   } 
               });
           }
       });
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>
