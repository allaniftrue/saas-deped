<?php $this->load->view('registrar/main_header_view'); ?>
<header class="jumbotron subhead" id="overview">
<div class="subnav">
    <ul class="nav nav-pills">
        <li class="active"><a href="javascript:void(0);">Personal Info</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=family_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Family Background</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=educational_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Educational Background</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=civil_srv_elegibility<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Civil Service Eligibility</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=work_experience<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Work Experience</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=voluntary_work<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Voluntary Work</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=training_programs<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Training Programs</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=other_info<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Other Information</a></li>
        <li> <a href="<?=base_url()?>?mc=account&m=login<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Account</a></li>
    </ul>
</div>
</header>
<section id="pdsform"><div class="span11">
        <div class="page-header">
            <h1>Personal Data Sheet <small> &nbsp;{ Personal Information }</small></h1>
        </div></div>
        <div id="form-wrapper">
            <div class="span11">
                <div id="profile-pic-wrapper" class="thumbnail">
                    <img src="<?=($profile[0]->inf_photo) ? base_url().'uploads/'.$profile[0]->inf_photo : base_url().'img/user.png'; ?>" id="profile_img" rel="tooltip" title="Click to change photo" />
                    <div id="editHolder" class="hide">
                            
                    </div>
                    
                    <noscript>			
                            <p>Please enable JavaScript to use file uploader.</p>
                    </noscript>   
                </div><img src="<?=base_url()?>img/ajax-loader.gif" id="preloader" class="hide" />
                <br /><br />
            </div>
            
            <form id="personal-form">
            
            <div id="form-left" class="span5">
                <p>
                    <label class="required" for="lastname">Last Name: </label>
                    <input type="text" id="lastname" value="<?=($profile[0]->inf_surname) ? $profile[0]->inf_surname : ''; ?>" name="lastname" class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="firstname">First Name: </label>
                    <input type="text" id="firstname" value="<?=($profile[0]->inf_firstname) ? $profile[0]->inf_firstname : ''; ?>" name="firstname" class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="middlename">Middle Name: </label>
                    <input type="text" id="middlename" value="<?=($profile[0]->inf_middlename) ? $profile[0]->inf_middlename : '';?>" name="middlename" class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="extension">Name Extension: </label>
                    <input type="text" id="extension" value="<?=($profile[0]->inf_name_ext) ? $profile[0]->inf_name_ext : '';?>" name="extension" class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="birthdate">Date of Birth: </label>
                    <input type="text" id="birthdate" value="<?=($profile[0]->inf_dob) ? $profile[0]->inf_dob : '';?>" name="birthdate"  class="input-xlarge" />
                </p>
                <p>
                    <label class="required" for="pob">Place of Birth: </label>
                    <input type="text" id="pob" value="<?=($profile[0]->inf_pob) ? $profile[0]->inf_pob : '';?>" name="pob"  class="input-xlarge" />
                </p>
                <p>
                    <label class="required" for="sex">Sex: </label>
                    <select name="sex" class="input-xlarge" id="sex">
                        <option value="F" <?=($profile[0]->inf_sex === 'F') ? 'selected' : '';?>>Female</option>
                        <option value="M" <?=($profile[0]->inf_sex === 'M') ? 'selected' : '';?>>Male</option>
                    </select>
                </p>

                <p>
                    <label class="required" for="civilstatus">Civil Status: </label>
                    <select name="civilstatus" id="civilstatus" class="input-xlarge">
                        <option value="" <?=($profile[0]->inf_civil_status == '') ? 'selected' : '';?>>Select Your Civil Status</option>
                        <option value="single" <?=($profile[0]->inf_civil_status == 'single') ? 'selected' : '';?>>Single</option>
                        <option value="married" <?=($profile[0]->inf_civil_status == 'married') ? 'selected' : '';?>>Married</option>
                        <option value="annulled" <?=($profile[0]->inf_civil_status == 'annulled') ? 'selected' : '';?>>Annulled</option>
                        <option value="widowed" <?=($profile[0]->inf_civil_status == 'widowed') ? 'selected' : '';?>>Widowed</option>
                        <option value="separated" <?=($profile[0]->inf_civil_status == 'separated') ? 'selected' : '';?>>Separated</option>
                        <option value="other" value="other" <?php if(! empty($profile[0]->inf_civil_status) && $profile[0]->inf_civil_status != 'single' && $profile[0]->inf_civil_status != 'married' && $profile[0]->inf_civil_status != 'annulled' && $profile[0]->inf_civil_status != 'widowed' && $profile[0]->inf_civil_status != 'separated') { echo 'selected'; } else {echo ''; } ?>>Other</option>
                    </select>
                </p>
            
                <p id="otherstatus">
                     <label class="required" for="specificstatus">Others, specify </label> 
                     <input type="text" id="specificstatus" value="<?php if(! empty($profile[0]->inf_civil_status) && $profile[0]->inf_civil_status != 'single' && $profile[0]->inf_civil_status != 'married' && $profile[0]->inf_civil_status != 'annulled' && $profile[0]->inf_civil_status != 'widowed' && $profile[0]->inf_civil_status != 'separated') { echo $profile[0]->inf_civil_status; } else {echo ''; } ?>" name="specificstatus"  class="input-xlarge" />
                </p>
                
                <p>
                    <label class="required" for="citizenship">Citizenship: </label>
                    <input type="text" id="citizenship" value="<?=($profile[0]->inf_citizenship) ? $profile[0]->inf_citizenship : ''; ?>" name="citizenship"  class="input-xlarge" />
                </p>
                <p>
                    <label class="required" for="height">Height(m): </label>
                    <input type="text" id="height" value="<?=($profile[0]->inf_height) ? $profile[0]->inf_height : ''; ?>" name="height"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="weight">Weight(kg): </label>
                    <input type="text" id="weight" value="<?=($profile[0]->inf_weight) ? $profile[0]->inf_weight : '';?>" name="weight"  class="input-xlarge" />
                </p>


                <p>
                    <label class="required" for="bloodtype">Blood Type: </label>
                    <input type="text" id="bloodtype" value="<?=($profile[0]->inf_blood_type) ? $profile[0]->inf_blood_type : ''; ?>" name="bloodtype"  class="input-xlarge" />
                </p>

            </div>


            <div id="form-right" class="span4">
                <p>
                    <label class="required" for="gsis">GSIS ID Number: </label>
                    <input type="text" id="gsis" value="<?=($profile[0]->inf_gsis_id) ? $profile[0]->inf_gsis_id : '';?>" name="gsis"  class="input-xlarge" />
                </p>
                <p>
                    <label class="required" for="pagibig">Pag-ibig ID Number: </label>
                    <input type="text" id="pagibig" value="<?=($profile[0]->inf_pagibig) ? $profile[0]->inf_pagibig : '';?>" name="pagibig"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="philhealth">Philhealth Number: </label>
                    <input type="text" id="philhealth" value="<?=($profile[0]->inf_philhealth) ? $profile[0]->inf_philhealth : ''; ?>" name="philhealth"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="sss">SSS Number: </label>
                    <input type="text" id="sss" value="<?=($profile[0]->inf_sss) ? $profile[0]->inf_sss : '';?>" name="sss"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="residential">Residential Address: </label>
                    <input type="text" id="residential" value="<?=($profile[0]->inf_res_address) ? $profile[0]->inf_res_address : '';?>" name="residential"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="zipresidential">Zip Code: </label>
                    <input type="text" id="zipresidential" value="<?=($profile[0]->inf_res_zip_code) ? $profile[0]->inf_res_zip_code : '';?>" name="zipresidential"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="telephoneres">Telephone Number: </label>
                    <input type="text" id="telephoneres" value="<?=($profile[0]->inf_telno) ? $profile[0]->inf_telno : ''; ?>" name="telephoneres"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="permanent">Permanent Address: </label>
                    <input type="text" id="permanent" value="<?=($profile[0]->inf_perm_address) ? $profile[0]->inf_perm_address : ''; ?>" name="permanent"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="zippermanent">Zip Code: </label>
                    <input type="text" id="zippermanent" value="<?=($profile[0]->inf_perm_zip_code) ? $profile[0]->inf_perm_zip_code : ''; ?>" name="zippermanent"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="telephonepermanent">Telephone Number: </label>
                    <input type="text" id="telephonepermanent" value="<?=($profile[0]->inf_contact_num) ? $profile[0]->inf_contact_num : ''; ?>" name="telephonepermanent"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="cellphone">Cellphone Number (639228638320): </label>
                    <input type="text" id="cellphone" value="<?=($profile[0]->inf_mobile_number) ? $profile[0]->inf_mobile_number : ''; ?>" name="cellphone"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="agency">Agency Employee Number : </label>
                    <input type="text" id="agency" value="<?=($profile[0]->inf_agency_emp_no) ? $profile[0]->inf_agency_emp_no : '';?>" name="agency"  class="input-xlarge"/>
                </p>

                <p>
                    <label class="required" for="tin">TIN: </label>
                    <input type="text" id="tin" value="<?=($profile[0]->inf_tin) ? $profile[0]->inf_tin : ''; ?>" name="tin"  class="input-xlarge"/>
                </p>

            </div>
    </div>
    <div class="span10">
        <p align="justify">
            <label class="checkbox">
                    <input type="checkbox" name="infoagree" id="infoagree" value="agree" /> 
                    I declare under oath that this Personal Data Sheet has been accomplished by me, and is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Repubic of the Philippines.  I also authorize the agency head / authorized representative to verify / validate the contents stated herein.  I trust that this information shall remain confedential.
            </label>
        </p>
        <p align="left">
            <input type="submit" value="Save Information" class="btn btn-primary" />
            <img src="<?=base_url()?>img/ajax-loader.gif" style="display:none;" id="preloader" /> 
        </p><br /><br /><br /><br />
    </div>
    </form>
</section>
</div>
<script src="<?=base_url()?>js/bootstrap-transition.js"></script>
<script src="<?=base_url()?>js/bootstrap-alert.js"></script>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tooltip.js"></script>
<script src="<?=base_url()?>js/bootstrap-popover.js"></script>
<script src="<?=base_url()?>js/bootstrap-button.js"></script>
<script src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script src="<?=base_url()?>js/ajaxupload.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.ui.datepicker.validation.min.js"></script>
<script src="<?=base_url()?>js/jquery.formobserver.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function(){
        /* TIPS */
        $('#profile_img').tooltip({
            placement: 'right'
        });
        
        
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
                        action: '?mc=account&m=upload',
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
        
        
//        
//        var button = $('#change_button');
//	var spinner = $('#spinner');
//        
//        spinner.hide();
//	button.css('opacity', 0);
//	spinner.css('top', ($('#profile-pic-wrapper').height() - spinner.height()) / 2)
//	spinner.css('left', ($('#profile-pic-wrapper').width() - spinner.width()) / 2)
//
//	$('#profile-pic-wrapper').live({
//            mouseover: function(){
//		button.css('opacity', .5);
//		button.stop(false,true).fadeIn(200);
//            },
//            mouseout: function() {
//		button.stop(true,true).fadeOut(3000);
//            }
//	});
//     
//        new AjaxUpload('change_button', {
//                action: '?mc=account&m=upload',
//                responseType: 'json',
//		onSubmit : function(file, ext){
//                            
//                            if (ext && /^(<?=$this->config->item('acceptable_files');?>)$/i.test(ext)){
//                                spinner.css('display', 'block');
//                                this.setData({ 'directory': "<?=$this->config->item('upload_dir'); ?>"});
//                            } else {
//                                $.alert('File not supported', 'Error');
//                                return false;
//                            }
//                            
//                            this.disable();
//		},
//		onComplete: function(file, response){
//                
//			button.stop(false,true).fadeOut('slow');
//			spinner.css('display', 'none');
//                        if(response.status == 'Success') {
//                            $.alert(response.issue, response.status);
//                            $('#profile_img').attr('src', response.filename);
//                        }else {
//                            $.alert(response.issue, response.status);
//                        }
//
//			this.enable();
//		}
//	});
    
    $("#birthdate").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        maxDate: '-18y'
                                           
    });
    
    
    $('#otherstatus').hide();
    $('#sub-menu-login').click(function(){
        $('#sub-menu-info').removeClass('selected');
        $(this).addClass('selected');
    });
    $('#sub-menu-info').click(function(){
        $('#sub-menu-login').removeClass('selected');
        $(this).addClass('selected');
    });
    
    if($('#specificstatus').val().length > 0 ) { $('#otherstatus').show(); }
    
    $('#civilstatus').change(function() {
        var civilstatus = this.value;
        if(civilstatus == 'other') {
            $('#otherstatus').show();
            $('#specificstatus').focus().addClass('required');
        } else {
            $('#otherstatus').hide();
            $('#specificstatus').removeClass('required');
        }
        
    }); 
    
    var validator = $('#personal-form').validate({
        rules: {
            lastname:'required',
            firstname:'required',
            middlename:{ required: true, minlength:2 },
            extension:{ minlength:2, maxlength:2 },
            birthdate:{ required:true, dpDate: true },
            pob:'required',
            sex:'required',
            civilstatus:'required',
            citizenship:'required',
            weight:{required: true, number: true },
            height:{required: true, number: true },
            bloodtype:'required',
            gsis:{required: true, digits: true },
            pagibig:{required: true, digits: true },
            philhealth:{required: true, digits: true },
            sss:{required: true, digits: true },
            residential:'required',
            zipresidential:{required: true, digits: true },
            telephoneres:{ digits: true },
            permanent:'required',
            zippermanent:{required: true, digits: true },
            telephonepermanent:{digits: true },
            cellphone:{required: true, digits: true },
            tin:{required: true, digits: true },
            infoagree: { required: true }
        },
        messages: { infoagree:"" },
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.attr("inputError");
            error.insertBefore(element)
            error.addClass('help-inline');  // add a class to the wrapper
            error.css('position', 'absolute');
            error.css('left', offset.left + element.outerWidth());
            error.css('top', offset.top);
        },
        submitHandler: function() {
            
                    if(! $('#infoagree').is(':checked')) { $('#infoagree').focus(); return false; } else { 
                        var cvlStatus;
                        if($('#civilstatus').val() == 'other') {
                            cvlStatus = $('#specificstatus').val();
                        } else {
                            cvlStatus = $('#civilstatus').val();
                        }
                    
                    $('#preloader').show();
                    $.ajax({
                                    type: 'post',
                                    url: '?mc=account&m=personal',
                                    cache:false,
                                    data: {
                                            lastname:$('#lastname').val(),
                                            firstname:$('#firstname').val(),
                                            middlename:$('#middlename').val(),
                                            extension:$('#extension').val(),
                                            birthdate:$('#birthdate').val(),
                                            pob:$('#pob').val(),
                                            sex:$('#sex').val(),
                                            civilstatus:cvlStatus,
                                            citizenship:$('#citizenship').val(),
                                            weight:$('#weight').val(),
                                            height:$('#height').val(),
                                            bloodtype:$('#bloodtype').val(),
                                            gsis:$('#gsis').val(),
                                            pagibig:$('#pagibig').val(),
                                            philhealth:$('#philhealth').val(),
                                            sss:$('#sss').val(),
                                            residential:$('#residential').val(),
                                            zipresidential:$('#zipresidential').val(),
                                            telephoneres:$('#telephoneres').val(),
                                            permanent:$('#permanent').val(),
                                            zippermanent:$('#zippermanent').val(),
                                            telephonepermanent:$('#telephonepermanent').val(),
                                            cellphone:$('#cellphone').val(),
                                            agency:$('#agency').val(),
                                            tin:$('#tin').val()
                                    },
                                    success: function(msg) {
                                            var json = $.parseJSON(msg);
                                            $.alert(json.message,json.title);
                                            $('#preloader').hide();
                                            $('#infoagree').removeAttr('checked');
                                            $('#personal-form').FormObserve_save();
                                    },
                                    error:function (xhr, ajaxOptions, thrownError){
                                        $('#preloader').hide();    
                                        $('#infoagree').removeAttr('checked');
                                        $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                    }    

                    }); }
                            
		},
		// set new class to error-labels to indicate valid fields
		success: function(label) {
			label.html("&nbsp;").addClass("ok");
		}
    });
    $('#personal-form').FormObserve();
    $.backstretch("<?=base_url()?>img/bg.jpg"); 
});
</script>
</body>
</html>