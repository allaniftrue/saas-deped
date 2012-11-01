<?php $this->load->view('student/student_header'); ?>
<header class="jumbotron subhead" id="overview">
<div class="subnav">
    <ul class="nav nav-pills">
        <li  class="active"><a href="?mc=stdaccount&s=<?=rand(1,999999)?>&sess=<?=random_string('alnum',8)?>">Personal Information</a></li>
        <li><a href="?mc=stdaccount&m=guardian&s=<?=rand(1,999999)?>&sess=<?=random_string('alnum',8)?>">Guardian's Information</a></li>
        <li><a href="?mc=stdaccount&m=pwd&s=<?=rand(1,999999)?>&sess=<?=random_string('alnum',8)?>">Login Information</a></li>
    </ul>
</div>
</header>
<br />
<div class="page-header">
    <h1 class="padleft">Student Information</h1>
</div>
<!-- start of form -->
<div class="span11">
    <div id="profile-pic-wrapper" class="thumbnail">
        <img src="<?=($student_info[0]->std_photo) ? base_url().'uploads/'.$student_info[0]->std_photo : base_url().'img/user.png'; ?>" id="profile_img" rel="tooltip" title="Click to change photo" />
        <div id="editHolder" class="hide">

        </div>

        <noscript>			
                <p>Please enable JavaScript to use file uploader.</p>
        </noscript>   
    </div><img src="<?=base_url()?>img/ajax-loader.gif" id="preloader" class="hide" />
    <br /><br />
</div>
<form id="infoForm" method="post" action="">
<div class="span4">
<p>
    <label>School ID Number</label>
    <span class="input input-large uneditable-input"><?=$student_info[0]->std_sch_id?></span>
</p>
<p>
    <label>Surname</label>
    <input type="text" class="required input input-large" value="<?=$student_info[0]->std_lastname?>" id="lastname" name="lastname" />
</p>
<p>
    <label>First Name</label>
    <input type="text" class="required input input-large" value="<?=$student_info[0]->std_firstname?>" id="firstname" name="firstname" />
</p>
<p>
    <label>Middle Name</label>
    <input type="text" class="required input" value="<?=$student_info[0]->std_middlename?>" id="middlename" name="middlename" />
</p>
<p>
    <label>Name Extension</label>
    <input type="text" class="input input-large" value="<?=$student_info[0]->std_extname?>" placeholder="Example: Jr., I, II, III" id="namext" name="namext" />
</p>
<p>
    <label>Gender</label>
    <div class="padleft">
        <?php 
            if($student_info[0]->std_sex === 'male') {
        ?>
            <label class="radio">
                <input type="radio" name="sex" value="male" id="sex" checked  /> Male
            </label>
            <label class="radio">
                <input type="radio" name="sex" value="female" id="sex" /> Female
            </label>
        <?php } else { ?>
            <label class="radio">
                <input type="radio" name="sex" value="male" id="sex" /> Male
            </label>
            <label class="radio">
                <input type="radio" name="sex" value="female" id="sex" checked /> Female
            </label>
        <?php } ?>
    </div>
</p>
</div>

<div class="span4">
    <p>
        <label>Address</label>
        <textarea rows="2" class="required input input-xlarge" id="address" name="address"><?=$student_info[0]->std_address?></textarea>
    </p>
    <p>
        <label>Birth Date</label>
        <input type="text"  class="required input input-large" id="birthdate" name="birthdate" value="<?=($student_info[0]->std_dob != '0000-00-00') ? $student_info[0]->std_dob : ''?>" placeholder="yyyy-mm-dd" />
    </p>
    <p>
        <label>Contact Number</label>
        <input type="text" value="<?=($student_info[0]->std_contact) ? $student_info[0]->std_contact : ''?>" class="required input input-large" id="contactnumber" name="contactnumber" placeholder="example: 09167625413" />
    </p>
    <p>
        <label>Email Address</label>
        <input type="text" value="<?=$student_info[0]->std_email?>" id="emailaddress" class="required input input-large" placeholder="example: email@yahoo.com" name="email" />
    </p>
    <p>
        <label>Religion</label>
        <input type="text" value="<?=($student_info[0]->std_religion) ? $student_info[0]->std_religion : ''?>" id="religion" class="required input input-large" name="religion" placeholder="example: catholic" />
    </p>
</div><div class="clearfix"></div>
    <div class="page-header">&nbsp;
    </div>
<div class="span11">
    <br /><br />
    <p>
        <button class="btn btn-primary" id="saveinformation" data-loading-text="Saving Information...">Save Information</button>
    </p>
</div>
</form>
<div class="modal hide fade" id="myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Result</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn btn-primary" data-dismiss="modal">OK</a>
  </div>
</div>
<script src="<?=base_url()?>js/modernizr-transitions.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/bootstrap-tooltip.js"></script>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script src="<?=base_url()?>js/bootstrap-button.js"></script>
<script src="<?=base_url()?>js/ajaxupload.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function(){
        
        $('#profile_img').tooltip({
            placement: 'right'
        });
        
        $( "#birthdate" ).datepicker({maxDate:"-2y",dateFormat:"yy-mm-dd",changeMonth: true,changeYear: true});
        $('#profile-pic-wrapper,#editHolder').live({
		mouseover: function() {
			$('#editHolder').show();
		},
		mouseout: function(){
			$('#editHolder').hide();
		}
	});   
        
        function createUploader(){  
            
		var uploader = new qq.FileUploader({
                        element: document.getElementById('editHolder'),
                        action: '?mc=stdaccount&m=upload',
                        allowedExtensions: [<?=$this->config->item('acceptable_files');?>],
                        debug: false,
                        multiple:false,
                        onSubmit: function(id, fileName){
                                var spinner = $('#preloadeer');
                                spinner.show();
                                spinner.css({'z-index':'100','display':'block'});
                        },
                        onProgress: function(id, fileName, loaded, total){
                            
                        },
                        onComplete: function(id, fileName, responseJSON){
                                $('#profile-pic-wrapper img').attr('src', responseJSON.filename);
                                $('#editHolder').hide();
                        },
                        onCancel: function(id, fileName){},
                        onError: function(id, fileName, xhr){ $.alert('Error','Failed to upload your photo: '+fileName);},
                        showMessage: function(message){ $.alert(message); }
                });        
	} window.onload = createUploader; 
        
        $('#infoForm').validate({
            rules: {
                lastname:"required",
                firstname:"required",
                middlename:"required",
                address:"required",
                birthdate: {
                    required:true,
                    date:true
                },
                contactnumber:"required",
                emailaddress:{email:true},
                religion:"required"
            },
            submitHandler: function() {
                $('#saveinformation').button('loading');
		$.ajax({
                    type:'post',
                    url:'?mc=stdaccount&m=saveinfo',
                    data:{
                        lastname:$('#lastname').val(),
                        firstname:$('#firstname').val(),
                        middlename:$('#middlename').val(),
                        namext:$('#namext').val(),
                        sex:$('#sex:checked').val(),
                        address:$('#address').val(),
                        birthdate:$('#birthdate').val(),
                        contactnumber:$('#contactnumber').val(),
                        emailaddress:$('#emailaddress').val(),
                        religion:$('#religion').val()
                    },
                    dataType:"json",
                    success:function(r) {
                        
                        if(r.status == 1) {
                            $('.modal-body').empty().append('Information successfully saved.');
                        } else {
                            $('.modal-body').empty().append('Failed to save information.  Please check if you have filled the required fields.');
                        }
                        
                        
                        $('#myModal').modal('show');
                    }
                });
                $('#saveinformation').button('reset');
            }
        });
});
</script>
<?php $this->load->view('student/student_footer'); ?>