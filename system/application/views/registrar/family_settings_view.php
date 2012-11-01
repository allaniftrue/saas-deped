<?php $this->load->view('registrar/main_header_view'); ?>
<header class="jumbotron subhead" id="overview">
<div class="subnav">
    <ul class="nav nav-pills">
        <li><a href="<?=base_url()?>?mc=account<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Personal Info</a></li>
        <li class="active"><a href="javascript:void(0)">Family Background</a></li>
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
<textarea id="template" class="hide">
    <div id="children">
        <p>
            <label class="required" for="childname">Full Name of Child: </label>
            <input type="text" id="childname" name="childname[]" class="input-xlarge" />
        </p>

        <p>
            <label class="required" for="childdob">Date of Birth <i>(yyyy-mm-dd)</i>: </label>
            <input type="text" id="childdob" name="childdob[]" class="input-xlarge" />
        </p>
    </div>
</textarea>
<section class="familybackground"><div class="span11">
    <div class="page-header">
            <h1>Personal Data Sheet <small> &nbsp;{ Family Background }</small></h1>
    </div></div>
    <form id="family-form">
        
         <div id="form-left" class="span6">
             
            <p>
                <label class="required" for="spousesurname">Spouse's Surname: </label>
                <input type="text" id="spousesurname" value="<?=($inf[0]->inf_spouse_surname) ? $inf[0]->inf_spouse_surname : ""; ?>" name="spousesurname"  class="input-xlarge"/>
            </p>
            
            <p>
                <label class="required" for="spousefirstname">Spouse's First Name: </label>
                <input type="text" id="spousefirstname" value="<?=($inf[0]->inf_spouse_fname) ? $inf[0]->inf_spouse_fname : ""; ?>" name="spousefirstname"  class="input-xlarge" />
            </p>
            
            <p>
                <label class="required" for="spousemiddlename">Spouse's Middle Name: </label>
                <input type="text" id="spousemiddlename" value="<?=($inf[0]->inf_spouse_middlename) ? $inf[0]->inf_spouse_middlename : ""; ?>" name="spousefirstname"  class="input-xlarge" />
            </p>
            
            <p>
                <label class="required" for="spouseoccupation">Spouse's Occupation: </label>
                <input type="text" id="spouseoccupation" value="<?=($inf[0]->inf_spouse_occupation) ? $inf[0]->inf_spouse_occupation : ""; ?>" name="spouseoccupation"  class="input-xlarge" />
            </p>
            
            <p>
                <label class="required" for="spouseemployer">Employer's Name: </label>
                <input type="text" id="spouseemployer" value="<?=($inf[0]->inf_spouse_employer_name) ? $inf[0]->inf_spouse_employer_name :  ""; ?>" name="spouseemployer"  class="input-xlarge" />
            </p>
            
            <p>
                <label class="required" for="spouseemployeraddress">Business Address: </label>
                <input type="text" id="spouseemployeraddress" value="<?=($inf[0]->inf_spouse_business_add) ? $inf[0]->inf_spouse_business_add : ""; ?>" name="spouseemployeraddress"  class="input-xlarge" />
            </p>
            
            <p>
                <label class="required" for="spouseemployertelno">Telephone Number: </label>
                <input type="text" id="spouseemployertelno" value="<?=($inf[0]->inf_spouse_buss_telno) ? $inf[0]->inf_spouse_buss_telno : ""; ?>" name="spouseemployertelno"  class="input-xlarge" />
            </p>
            
            <p>
                <label class="required" for="fathersurname">Father's Surname: </label>
                <input type="text" id="fathersurname" value="<?=($inf[0]->inf_father_lname) ? $inf[0]->inf_father_lname : ""; ?>" name="fathersurname"  class="input-xlarge" />
            </p>
            
            <p>
                <label class="required" for="fatherfirstname">Father's Firstname: </label>
                <input type="text" id="fatherfirstname" value="<?=($inf[0]->inf_father_fname) ? $inf[0]->inf_father_fname : ""; ?>" name="fatherfirstname"  class="input-xlarge" />
            </p>
            
             <p>
                <label class="required" for="fathermiddlename">Father's Middlename: </label>
                <input type="text" id="fathermiddlename" value="<?=($inf[0]->inf_father_mname) ? $inf[0]->inf_father_mname : ""; ?>" name="fathermiddlename"  class="input-xlarge" />
            </p>
            
            <p>
                <label class="required" for="fatherextension">Father's Name Extension: </label>
                <input type="text" id="fatherextension" value="<?=($inf[0]->inf_father_name_ext) ? $inf[0]->inf_father_name_ext : ""; ?>" name="fatherextension"  class="input-xlarge" />
            </p>
            
             <p>
                <label class="required" for="mothersurname">Mother's Maiden Name: </label>
                <input type="text" id="mothersurname" value="<?=($inf[0]->inf_mother_lname) ? $inf[0]->inf_mother_lname : ""; ?>" name="mothersurname"  class="input-xlarge" />
            </p>
            
            <p>
                <label class="required" for="motherfirstname">Mother's Firstname: </label>
                <input type="text" id="motherfirstname" value="<?=($inf[0]->inf_mother_fname) ? $inf[0]->inf_mother_fname : ""; ?>" name="motherfirstname"  class="input-xlarge" />
            </p>
            
             <p>
                <label class="required" for="mothermiddlename">Mother's Middlename: </label>
                <input type="text" id="mothermiddlename" value="<?=($inf[0]->inf_mother_mname) ? $inf[0]->inf_mother_mname : ""; ?>" name="mothermiddlename"  class="input-xlarge" />
            </p>
        </div>
        <div class="span5">
            <p id="options-familybg">
                <a href="javascript:void(0)" id="addfield"><img src="<?=base_url()?>img/plus-white.png" /> Add More Child Info </a>
            </p>
            
           
            <?php 
                $num_children = count($children);
                if($num_children > 0) {
                    
                    for($x=0; $x<$num_children; $x++) {
                        $indentifier = rand(1,100);
            ?>
                        <div id="children">
                            <p>
                                <label class="required" for="childname">Full Name of Child: </label>
                                <input type="text" id="childname" name="childname[]" class="input-xlarge" value="<?=($children[$x]->chl_fullname) ? $children[$x]->chl_fullname : ""?>" />
                            </p>

                            <p>
                                <label class="required" for="childdob">Date of Birth <i>(yyyy-mm-dd)</i>: </label>
                                <input type="text" id="childdob-<?=$indentifier?>" name="childdob[]" class="input-xlarge" value="<?=($children[$x]->chl_dob) ? $children[$x]->chl_dob : ""; ?>" />
                            </p>
                        </div>
            <script type="text/javascript">
                $(document).ready(function(){
                      $('#childdob-<?=$indentifier?>').datepicker({ 
                                    showAnim: 'slideDown', 
                                    yearRange: '-60:-0',
                                    maxDate: '-1w',
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat: 'yy-mm-dd'
                      });  
                });
            </script>
            
            
            <?php } } else { ?>
            <div id="children">
                <p>
                    <label class="required" for="childname">Full Name of Child: </label>
                    <input type="text" id="childname" name="childname[]" class="input-xlarge" value="" />
                </p>

                <p>
                    <label class="required" for="childdob">Date of Birth <i>(yyyy-mm-dd)</i>: </label>
                    <input type="text" id="childdob" name="childdob[]" class="input-xlarge" value="" />
                </p>
            </div>
            <?php } ?>
              
        </div>
        <div class="span10">
            <p align="justify">
                <label class="checkbox">
                <input type="checkbox" name="infoagree" id="infoagree" value="agree" /> I declare under oath that this Personal Data Sheet has been accomplished by me, and is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Repubic of the Philippines.  I also authorize the agency head / authorized representative to verify / validate the contents stated herein.  I trust that this information shall remain confedential.
                </label>
            </p>
            <p>            
                <input type="submit" name="submit" value="Save Information" class="btn btn-primary" />
                <img src="<?=base_url()?>img/ajax-loader.gif" style="display:none;" id="preloader" /> 
            </p>
            <br /><br /><br /><br />
        </div>
    </form>
</section>


<script src="<?=base_url()?>js/bootstrap-transition.js"></script>
<script src="<?=base_url()?>js/bootstrap-alert.js"></script>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/bootstrap-button.js"></script>
<script src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.ui.datepicker.validation.min.js"></script>
<script src="<?=base_url()?>js/jquery.formobserver.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
    
    /* Children Date of Birth */
    $("#family-form").FormObserve();
    
        
    $('#addfield').live('click', function(){
        
        var $template = $('#template').val();
        var randomnumber=Math.floor(Math.random()*1111);
        var $dob = $('#childdob');
     
        
        
        //template.find('input').attr('id','childdob'+randomnumber);
        var curDiv = $('#children').prepend($template);
        
        curDiv.find('#childdob').attr('id', 'childdob-'+randomnumber).datepicker({
                                                                                    showAnim: 'slideDown', 
                                                                                    yearRange: '-60:-0',
                                                                                    maxDate: '-1w',
                                                                                    changeMonth: true,
                                                                                    changeYear: true,
                                                                                    dateFormat: 'yy-mm-dd'
        });
        
        
//        var curDiv = jQuery(this).parents('div').attr('id');
//        var lastDiv = jQuery('#children').last();
//        var newDiv = lastDiv.clone(true);
//        var randomnumber=Math.floor(Math.random()*1111);
//        
//        
//        console.log(curDiv);
//        
//        jQuery('#'+curDiv).append(newDiv);
//        
//        $(newDiv).find("input").each(function(){
//            if($(this).hasClass("hasDatepicker")){ // if the current input has the hasDatpicker class
//                var this_id = $(this).attr("id"); // current inputs id
//		var new_id = this_id +randomnumber; // a new id
//		$(this).attr("id", new_id); // change to new id
//		$(this).removeClass('hasDatepicker'); // remove hasDatepicker class
//                $(this).val('');
//		$(this).datepicker({
//                                    dateFormat: 'yy-mm-dd',
//                                    showAnim: 'slideDown', 
//                                    yearRange: '-60:-0',
//                                    maxDate: '-1w',
//                                    changeMonth: true,
//                                    changeYear: true
//		});
//            }
//	});	
//        
//        return false;
        
    });
    
    $('input[id^=childdob]').datepicker({ 
                                    showAnim: 'slideDown', 
                                    yearRange: '-60:-0',
                                    maxDate: '-1w',
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat: 'yy-mm-dd'
    });

    var validator = $("#family-form").validate({
		rules: {
                        spousefirstname: {
                            required: function(){
                                var f_spousesurname=jQuery('#spousesurname').val();
                                if(f_spousesurname.length > 0){
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        },
                        spousemiddlename: {
                            required: function(){
                                var f_spousesurname=jQuery('#spousesurname').val();
                                if(f_spousesurname.length > 0){
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        },
                        spouseemployer: {
                            required: function() {
                                var f_employer = jQuery('#spouseemployer').val();
                                if(f_employer.length > 0) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        },
                        spouseemployertelno: {
                            digits: true
                        },
			fathersurname: {
				required: true
			},
			fatherfirstname: {
                                required: true
                        },
			fathermiddlename: {
				required: true,
                                minlength: 2
			},
                        fatherextension: {
                                minlength:2,
                                maxlength:2
                        },
			mothersurname: {
				required: true
			},
                        motherfirstname: {
                                required: true
                        },
                        mothermiddlename: {
                                required: true,
                                minlength: 2
                        },
                        childdob: {
                                    required: function() {
                                        var f_childname = jQuery('#childname').val();
                                        if(f_childname.length > 0) {
                                            return true;
                                        } else {
                                            return false;
                                        }
                                    },
                                    date: true
                        },
                        infoagree: "required"
		},
                messages: {
			fathersurname: {
				required: "Father's Surname is required"
			},
			fatherfirstname: {
                                required: "Father's First Name is required"
                        },
			fathermiddlename: {
				required: "Father's Middle Name is Required",
                                minlength: "Must not be the middle initial"
			},
                       
			mothersurname: {
				required: "Mother's Surname is required"
			},
                        motherfirstname: {
                                required: "Mother's First Name is required"
                        },
                        mothermiddlename: {
                                required: "Mother's Middle Name is Required",
                                minlength: "Must not be the middle initial"
                        },
			infoagree: ""
		},
		// the errorPlacement has to take the layout into account
		errorPlacement: function(error, element) {
			offset = element.offset();
                        error.attr("inputError");
                        error.insertBefore(element)
                        error.addClass('help-inline');  // add a class to the wrapper
                        error.css('position', 'absolute');
                        error.css('left', offset.left + element.outerWidth());
                        error.css('top', offset.top);
		},
		// specifying a submitHandler prevents the default submit, good for the demo
		submitHandler: function() {
 
                        var f_spousesurname = jQuery('#spousesurname').val();
                        var f_spousefirstname = jQuery('#spousefirstname').val();
                        var f_spousemiddlename = jQuery('#spousemiddlename').val();
                        var f_spouseoccupation = jQuery('#spouseoccupation').val();
                        var f_spouseemployer = jQuery('#spouseemployer').val();
                        var f_spouseemployeraddress = jQuery('#spouseemployeraddress').val();
                        var f_spouseemployertelno = jQuery('#spouseemployertelno').val();
                        
                        var f_fathersurname = jQuery('#fathersurname').val();
                        var f_fatherfirstname = jQuery('#fatherfirstname').val();
                        var f_fathermiddlename = jQuery('#fathermiddlename').val();
                        var f_fatherextension = jQuery('#fatherextension').val();
                        
                        var f_mothersurname = jQuery('#mothersurname').val();
                        var f_motherfirstname = jQuery('#motherfirstname').val();
                        var f_mothermiddlename = jQuery('#mothermiddlename').val();
                                             
                        var outArr =[];
                        var valArr = document.getElementsByName('childname[]'); 
                        var valArr2 = document.getElementsByName('childdob[]'); 
                        
                        for(var i=0; i < valArr.length; i++) {
                            var childinfo = [ valArr[i].value , valArr2[i].value];
                            outArr.push(childinfo);
                        }
                        
                        jQuery('#preloader').show();
                        jQuery.ajax({
                                        type: 'post',
                                        url: '?mc=account&m=ufbg',
                                        cache:false,
                                        data: {
                                                spousesurname: f_spousesurname, 
                                                spousefirstname: f_spousefirstname,
                                                spousemiddlename: f_spousemiddlename,
                                                spouseoccupation:f_spouseoccupation,
                                                spouseemployer:f_spouseemployer,
                                                spouseemployeraddress:f_spouseemployeraddress,
                                                spouseemployertelno:f_spouseemployertelno,
                                                fathersurname:f_fathersurname,
                                                fatherfirstname:f_fatherfirstname,
                                                fathermiddlename:f_fathermiddlename,
                                                fatherextension:f_fatherextension,
                                                mothersurname:f_mothersurname,
                                                motherfirstname:f_motherfirstname,
                                                mothermiddlename:f_mothermiddlename,
                                                children: outArr
                                                
                                        },
                                        success: function(msg) {
                                              var json = jQuery.parseJSON(msg);
                                              jQuery.alert(json.message,json.title);
                                              jQuery('#preloader').hide();
                                              jQuery('#infoagree').removeAttr('checked');
                                              jQuery('#family-form').FormObserve_save();
                                        },
                                        error:function (xhr, ajaxOptions, thrownError){
                                            jQuery('#preloader').hide();    
                                            jQuery('#infoagree').removeAttr('checked');
                                            jQuery.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                        }    

                        });
                            
		},
		// set new class to error-labels to indicate valid fields
		success: function(label) {
			label.html("&nbsp;").addClass("ok");
		}
	});        
         $.backstretch("<?=base_url()?>img/bg.jpg"); 
});
</script>
</body>
</html>