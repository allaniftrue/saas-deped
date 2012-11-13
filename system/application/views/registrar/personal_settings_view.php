<?php $this->load->view('registrar/main_header_view'); ?>
<header class="jumbotron subhead" id="overview">
<div class="subnav">
    <ul class="nav nav-pills">
        <li class="active"><a href="<?=base_url()?>?mc=account&t=<?=rand()?>&sess=<?=random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Personal Info</a></li>
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
<section id="pdsform">
        <h2>Personal Data Sheet <small> &nbsp;{ Personal Information }</small></h2>
        <form id="personal-form" method="POST" action="">
        <div id="form-wrapper">
            
            <div id="form-left" class="span5">
                
               <p>
                    <label class="required" for="avatar"><strong>Recent Formal Photo</strong></label>
                    <div clas="" id="avatar-holder" data-original-title="Click to change avatar<br />Image Size: 150x150 px<br />Maximum File Size: <?=MAX_UPLOAD?> MB ">
                        <div id="uploader"><center><i class="icon-upload icon-white"></i> File Select</center></div>
                        <img src="<?=($profile[0]->inf_photo) ? base_url().'uploads/'.$profile[0]->inf_photo : base_url().'img/user.png'; ?>" class="img-polaroid" />
                        </div> 
                    <div id="messages"></div>
                    <br />
               </p>
                
                <p>
                    <label class="required" for="lastname"><strong>Last Name</strong> </label>
                    <input type="text" id="lastname" value="<?=($profile[0]->inf_surname) ? $profile[0]->inf_surname : ''; ?>" name="lastname" class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="firstname"><strong>First Name</strong> </label>
                    <input type="text" id="firstname" value="<?=($profile[0]->inf_firstname) ? $profile[0]->inf_firstname : ''; ?>" name="firstname" class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="middlename"><strong>Middle Name</strong> </label>
                    <input type="text" id="middlename" value="<?=($profile[0]->inf_middlename) ? $profile[0]->inf_middlename : '';?>" name="middlename" class="input-xlarge" />
                </p>

                <p>
                    <label for="extension"><strong>Name Extension</strong> </label>
                    <input type="text" id="extension" value="<?=($profile[0]->inf_name_ext) ? $profile[0]->inf_name_ext : '';?>" name="extension" class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="birthdate"><strong>Date of Birth</strong> </label>
                    <input type="text" id="birthdate" value="<?=($profile[0]->inf_dob) ? $profile[0]->inf_dob : '';?>" name="birthdate"  class="input-xlarge" />
                </p>
                <p>
                    <label class="required" for="pob">Place of Birth: </label>
                    <input type="text" id="pob" value="<?=($profile[0]->inf_pob) ? $profile[0]->inf_pob : '';?>" name="pob"  class="input-xlarge" />
                </p>
                <p>
                    <label class="required" for="sex"><strong>Sex</strong> </label>
                    <select name="sex" class="input-xlarge" id="sex">
                        <option value="F" <?=($profile[0]->inf_sex === 'F') ? 'selected' : '';?>>Female</option>
                        <option value="M" <?=($profile[0]->inf_sex === 'M') ? 'selected' : '';?>>Male</option>
                    </select>
                </p>

                <p>
                    <label class="required" for="civilstatus"><strong>Civil Status</strong> </label>
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
                     <label class="required" for="specificstatus"><strong>Others, specify</strong> </label> 
                     <input type="text" id="specificstatus" value="<?php if(! empty($profile[0]->inf_civil_status) && $profile[0]->inf_civil_status != 'single' && $profile[0]->inf_civil_status != 'married' && $profile[0]->inf_civil_status != 'annulled' && $profile[0]->inf_civil_status != 'widowed' && $profile[0]->inf_civil_status != 'separated') { echo $profile[0]->inf_civil_status; } else {echo ''; } ?>" name="specificstatus"  class="input-xlarge" />
                </p>
                
                <p>
                    <label class="required" for="citizenship"><strong>Citizenship</strong> </label>
                    <input type="text" id="citizenship" value="<?=($profile[0]->inf_citizenship) ? $profile[0]->inf_citizenship : ''; ?>" name="citizenship"  class="input-xlarge" />
                </p>
                <p>
                    <label class="required" for="height"><strong>Height(m)</strong> </label>
                    <input type="text" id="height" value="<?=($profile[0]->inf_height) ? $profile[0]->inf_height : ''; ?>" name="height"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="weight"><strong>Weight(kg)</strong> </label>
                    <input type="text" id="weight" value="<?=($profile[0]->inf_weight) ? $profile[0]->inf_weight : '';?>" name="weight"  class="input-xlarge" />
                </p>


                <p>
                    <label class="required" for="bloodtype"><strong>Blood Type</strong> </label>
                    <input type="text" id="bloodtype" value="<?=($profile[0]->inf_blood_type) ? $profile[0]->inf_blood_type : ''; ?>" name="bloodtype"  class="input-xlarge" />
                </p>

            </div>


            <div id="form-right" class="span4">
                <p>
                    <label for="gsis"><strong>GSIS ID Number</strong> </label>
                    <input type="text" id="gsis" value="<?=($profile[0]->inf_gsis_id) ? $profile[0]->inf_gsis_id : '';?>" name="gsis"  class="input-xlarge" />
                </p>
                <p>
                    <label class="required" for="pagibig"><strong>Pag-ibig ID Number</strong> </label>
                    <input type="text" id="pagibig" value="<?=($profile[0]->inf_pagibig) ? $profile[0]->inf_pagibig : '';?>" name="pagibig"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="philhealth"><strong>Philhealth Number</strong> </label>
                    <input type="text" id="philhealth" value="<?=($profile[0]->inf_philhealth) ? $profile[0]->inf_philhealth : ''; ?>" name="philhealth"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="sss"><strong>SSS Number</strong> </label>
                    <input type="text" id="sss" value="<?=($profile[0]->inf_sss) ? $profile[0]->inf_sss : '';?>" name="sss"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="residential"><strong>Residential Address</strong> </label>
                    <input type="text" id="residential" value="<?=($profile[0]->inf_res_address) ? $profile[0]->inf_res_address : '';?>" name="residential"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="zipresidential"><strong>Zip Code</strong> </label>
                    <input type="text" id="zipresidential" value="<?=($profile[0]->inf_res_zip_code) ? $profile[0]->inf_res_zip_code : '';?>" name="zipresidential"  class="input-xlarge" />
                </p>

                <p>
                    <label for="telephoneres"><strong>Telephone Number</strong> </label>
                    <input type="text" id="telephoneres" value="<?=($profile[0]->inf_telno) ? $profile[0]->inf_telno : ''; ?>" name="telephoneres"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="permanent"><strong>Permanent Address</strong> </label>
                    <input type="text" id="permanent" value="<?=($profile[0]->inf_perm_address) ? $profile[0]->inf_perm_address : ''; ?>" name="permanent"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="zippermanent"><strong>Zip Code</strong> </label>
                    <input type="text" id="zippermanent" value="<?=($profile[0]->inf_perm_zip_code) ? $profile[0]->inf_perm_zip_code : ''; ?>" name="zippermanent"  class="input-xlarge" />
                </p>

                <p>
                    <label class="" for="telephonepermanent"><strong>Telephone Number</strong> </label>
                    <input type="text" id="telephonepermanent" value="<?=($profile[0]->inf_contact_num) ? $profile[0]->inf_contact_num : ''; ?>" name="telephonepermanent"  class="input-xlarge" />
                </p>

                <p>
                    <label class="required" for="cellphone"><strong>Cellphone Number (639439220125)</strong> </label>
                    <input type="text" id="cellphone" value="<?=($profile[0]->inf_mobile_number) ? $profile[0]->inf_mobile_number : ''; ?>" name="cellphone"  class="input-xlarge" />
                </p>

                <p>
                    <label class="" for="agency"><strong>Agency Employee Number</strong> </label>
                    <input type="text" id="agency" value="<?=($profile[0]->inf_agency_emp_no) ? $profile[0]->inf_agency_emp_no : '';?>" name="agency"  class="input-xlarge"/>
                </p>

                <p>
                    <label class="required" for="tin"><strong>TIN</strong> </label>
                    <input type="text" id="tin" value="<?=($profile[0]->inf_tin) ? $profile[0]->inf_tin : ''; ?>" name="tin"  class="input-xlarge"/>
                </p>
                
            </div>
    </div>
    <div class="span11">
        
        <p align="justify"><br />
            <label class="checkbox">
                    <input type="checkbox" name="infoagree" id="infoagree"> 
                    I declare under oath that this Personal Data Sheet has been accomplished by me, and is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the Philippines.  I also authorize the agency head / authorized representative to verify / validate the contents stated herein.  I trust that this information shall remain confidential.
            </label><br />
        </p>
        <p align="left">
            <input type="submit" value="Save Information" class="btn btn-success" id="button" data-loading-text="Saving Information..." />
        </p>
    </div>
    </form>
</section>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="myModalLabel">Result</h3>
</div><div class="modal-body"></div><div class="modal-footer"><button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Ok</button></div></div>
<script src="<?=base_url()?>js/bootstrap-transition.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
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
<!--<script src="<?=base_url()?>js/jquery.formobserver.js"></script>-->
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function(){
        /* TIPS */
        $('#avatar-holder').tooltip({
            placement: 'right',
            html: true
        });
                
        $('#avatar-holder').live({
                mouseenter: function() {
                        $('#uploader').css({
                                "display":"inline",
                                "z-index":10
                        });
                },
                mouseleave: function() {
                        $('#uploader').hide();
                }
        });
        
        $fub = $('#uploader');
        $messages = $('#messages');
        var uploader = new qq.FileUploaderBasic({
              button: $fub[0],
              action: '?mc=account&m=upload',
              debug: false,
              allowedExtensions: [<?=$this->config->item('acceptable_files');?>],
              sizeLimit: 204800, // 200 kB = 200 * 1024 bytes
              onSubmit: function(id, fileName) {
                $messages.append('<div id="file-' + id + '" class="alert" style="margin: 20px 0 0"></div>') 
              },
              onUpload: function(id, fileName) {
                $('#file-' + id).addClass('alert-info')
                                .html('<img src="<?=base_url()?>img/ajax-loader.gif" alt="Initializing. Please hold."> ' +
                                      'Initializing ' +
                                      '“' + fileName + '”')
              },
              onProgress: function(id, fileName, loaded, total) {
                if (loaded < total) {
                  progress = Math.round(loaded / total * 100) + '% of ' + Math.round(total / 1024) + ' kB';
                  $('#file-' + id).removeClass('alert-info')
                                  .html('<img src="<?=base_url()?>img/ajax-loader.gif" alt="In progress. Please hold."> ' +
                                        'Uploading ' +
                                        '“' + fileName + '” ' +
                                        progress)
                } else {
                  $('#file-' + id).addClass('alert-info')
                                  .html('<img src="<?=base_url()?>img/ajax-loader.gif" alt="Saving. Please hold."> ' +
                                        'Saving ' +
                                        '“' + fileName + '”')
                }
              },
              onComplete: function(id, fileName, responseJSON) {
                if (responseJSON.status === "Success") {

                  $('#file-' + id).removeClass('alert-info')
                                  .addClass('alert-success')
                                  .html('<i class="icon-ok"></i> ' + 'Successfully saved '+'“' + fileName + '”')
                                  .delay(3000).hide("slow");

                  $('.img-polaroid').attr("src",responseJSON.filename);
                  $('#uploader').hide();
                  $('#avatar-holder').tooltip("hide")

                } else {
                  $('#file-' + id).removeClass('alert-info')
                                  .addClass('alert-error')
                                  .html('<i class="icon-exclamation-sign"></i> ' +
                                        'Error with ' +
                                        '“' + fileName + '”: ' +
                                        responseJSON.error)
                }
              }
            });
            
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
    
   $('#personal-form').validate({
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
                infoagree:"required"
            },
            messages: { infoagree:"" },
            errorPlacement: function(error, element) {
                var offset = element.offset();
                error.attr("inputError");
                error.insertBefore(element)
                error.addClass('help-inline');  // add a class to the wrapper
                error.css('position', 'absolute');
                error.css('left', offset.left + element.outerWidth());
                error.css('top', offset.top);
            },
            submitHandler: function() {
                        
                    $('#button').button('loading')
                    var cvlStatus;

                    if($('#civilstatus').val() == 'other') {
                        cvlStatus = $('#specificstatus').val();
                    } else {
                        cvlStatus = $('#civilstatus').val();
                    }

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
                                        var json = $.parseJSON(msg)
                                        $('.modal-body').empty().append(json.message)
                                        $('#infoagree').removeAttr('checked')
                                        $('#button').button('reset')
                                        $('#myModal').modal("show")
                                },
                                error:function (xhr, ajaxOptions, thrownError){
                                    $('#button').button('reset')
                                    $('#infoagree').removeAttr('checked')
                                    $('.modal-body').empty().append('xhr status: '+xhr.status + '\n Error:'+ thrownError)
                                }    

                    })
		},
		success: function(label) {
			label.html("&nbsp;").addClass("ok");
		}
    });
//    $('#personal-form').FormObserve();
    $.backstretch("<?=base_url()?>img/bg.jpg"); 
});
</script>
</body>
</html>