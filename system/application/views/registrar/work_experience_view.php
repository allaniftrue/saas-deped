<?php $this->load->view('registrar/main_header_view'); ?>
<header class="jumbotron subhead" id="overview">
<div class="subnav">
    <ul class="nav nav-pills">
        <li><a href="<?=base_url()?>?mc=account<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Personal Info</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=family_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Family Background</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=educational_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Educational Background</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=civil_srv_elegibility<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Civil Service Eligibility</a></li>
        <li class="active"><a href="<?=base_url()?>?mc=account&m=work_experience<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Work Experience</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=voluntary_work<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Voluntary Work</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=training_programs<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Training Programs</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=other_info<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Other Information</a></li>
        <li> <a href="<?=base_url()?>?mc=account&m=login<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Account</a></li>
    </ul>
</div>
</header>
<div id="delwarning" title="Confirmation" style="display: none;">
                <p>Are you sure you want to completely remove this information?</p>
</div>

<textarea style="display:none" id="template">
<div class="form-wrapper">
    <p>
        <fieldset><legend>Inclusive Dates (yyyy-mm-dd)</legend>
            <div style="float:left; width: 50%;">
                <label class="required" for="from">From</label>
                <input type="text" class="input-small" name="from[]" id="from" validate="required:true,date:true" />
            </div>
            <div style="float:right;width:50%;">
                <label class="required" for="to">To</label>
                <input type="text" class="input-small" name="to[]" id="to" validate="required:true, date:true" />
            </div>
            <div class="clear"></div>
        </fieldset>
    </p>
    <p>
        <label class="required" for="position">Position (Write in full)</label>
        <input type="text" class="input-xlarge" name="position[]" id="position" validate="required:true" />
    </p>

    <p>
        <label class="required" for="company">Department/Agency/Office/Company (Write in full)</label>
        <input type="text" class="input-xlarge" name="company[]" id="company" validate="required:true" />
    </p>
    <p>
        <label class="required" for="salary">Monthly Salary (PhP)</label>
        <input type="text" class="input-xlarge" name="salary[]" id="salary" validate="required:true,number:true" />
    </p>
    <p>
        <label class="required" for="salarygrade">Salary Grade & Step Increment (Format 00-0)</label>
        <input type="text" class="input-xlarge" name="salarygrade[]" id="salarygrade" />
    </p>
    <p>
        <label class="required" for="status">Status of Appointment</label>
        <input type="text" class="input-xlarge" name="status[]" id="status" validate="required:true" />
    </p>
    <p> <label class="required" for="govnt">Government Service?</label>
        <select name="govnt[]" size="2" class="input-xlarge">
                        <option value="yes">Yes</option>
                        <option value="no" selected>No</option>
        </select>
    </p>
</div>
</textarea>

<section id="expwrap"><div class="span11">
      <div class="page-header">
            <h1>Personal Data Sheet <small> &nbsp;{ Work Experience }</small></h1>
      </div>
      <div class="span10">
          <a href="javascript:void(0);" id="add-form"><img src="<?=base_url()?>img/plus-white.png" /> Add another form</a>
      </div><br /><br />
      <form id="form-work">
      <div id="wrap">  
          
          <?php
            $num_work = count($work);
            if($num_work > 0) {
                for($i=0; $i<$num_work; $i++) {
          ?>
          
          <div class="form-wrapper" id="<?=$work[$i]->wrk_id?>">
              <label id="remove" class="<?=$work[$i]->wrk_id?>"><a href="javascript:void(0);"><img src="<?=base_url()?>img/cross-button.png" id="<?=$work[$i]->wrk_id?>-del-btn" alt="Delete" title="Remove Information" style="display:none;" /></a>
                        </label>
                <p>
                    <fieldset><legend>Inclusive Dates (yyyy-mm-dd)</legend>
                        <div style="float:left; width: 50%;">
                            <label class="required" for="from">From</label>
                            <input type="text" class="input-small" name="from[]" id="from" validate="required:true,date:true" value="<?=($work[$i]->wrk_from) ? $work[$i]->wrk_from : ''; ?>" />
                        </div>
                        <div style="float:right;width:50%;">
                            <label class="required" for="to">To</label>
                            <input type="text" class="input-small" name="to[]" id="to" validate="required:true, date:true" value="<?=($work[$i]->wrk_to) ? $work[$i]->wrk_to : '';?>" />
                        </div>
                        <div class="clear"></div>
                    </fieldset>
                </p>
                <p>
                    <label class="required" for="position">Position (Write in full)</label>
                    <input type="text" class="input-xlarge" name="position[]" id="position" validate="required:true" value="<?=($work[$i]->wrk_position) ? $work[$i]->wrk_position : '';?>" />
                </p>

                <p>
                    <label class="required" for="company">Department/Agency/Office/Company (Write in full)</label>
                    <input type="text" class="input-xlarge" name="company[]" id="company" validate="required:true" value="<?=($work[$i]->wrk_department) ? $work[$i]->wrk_department : '';?>" />
                </p>
                <p>
                    <label class="required" for="salary">Monthly Salary (PhP)</label>
                    <input type="text" class="input-xlarge" name="salary[]" id="salary" validate="required:true,number:true" value="<?=($work[$i]->wrk_salary) ? $work[$i]->wrk_salary : '';?>" />
                </p>
                <p>
                    <label class="required" for="salarygrade">Salary Grade & Step Increment (Format 00-0)</label>
                    <input type="text" class="input-xlarge" name="salarygrade[]" id="salarygrade" value="<?=($work[$i]->wrk_salary_grade) ? $work[$i]->wrk_salary_grade : '';?>" />
                </p>
                <p>
                    <label class="required" for="status">Status of Appointment</label>
                    <input type="text" class="input-xlarge" name="status[]" id="status" validate="required:true" value="<?=($work[$i]->wrk_stat_appoint) ? $work[$i]->wrk_stat_appoint : '';?>" />
                </p>
                <p> <label class="required" for="govnt">Government Service?</label>
                    <select name="govnt[]" size="2" class="input-xlarge">
                        <option value="yes"<?=($work[$i]->wrk_gov_srv == 'yes') ? ' selected' : ''; ?>>Yes</option>
                        <option value="no"<?=($work[$i]->wrk_gov_srv == 'no' || empty($work[$i]->wrk_gov_srv) || $work[$i]->wrk_gov_srv == NULL) ? ' selected' : ''; ?>>No</option>
                    </select>
             
                </p>
            </div>
          
          
          <?php } } ?>
          
          
      </div>
      <br /><br />
      <div class="span11">
            <p align="justify">
                <label class="checkbox">
                <input type="checkbox" name="infoagree" id="infoagree" value="agree" /> I declare under oath that this Personal Data Sheet has been accomplished by me, and is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Repubic of the Philippines.  I also authorize the agency head / authorized representative to verify / validate the contents stated herein.  I trust that this information shall remain confidential.
                </label>
            </p>
            <p align="left">
                <input type="submit" id="save-btn-cvl" value="Save Information" class="btn btn-primary" />
                <img src="<?=base_url()?>img/ajax-loader.gif" style="display:none;" id="preloader" />
            </p><br /><br /><br />
      </div> 
    </form></div>
</section>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/jquery.masonry.min.js"></script>
<script src="<?=base_url()?>js/bootstrap-tooltip.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/modernizr-transitions.js"></script>
<script src="<?=base_url()?>js/jquery.ui.datepicker.validation.min.js"></script>
<script src="<?=base_url()?>js/jquery.formobserver.js"></script>
<script src="<?=base_url()?>js/jquery.maskedinput-1.3.min.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function($){
      
        $("div[class^=form-wrapper]").live({
            mouseover: function(){
                var curID = $(this).attr('id');
                $('#'+curID+'-del-btn').show();      
            },
            mouseout: function(){
                var curID = $(this).attr('id');
                $('#'+curID+'-del-btn').hide();      
            }
       });
        
       $("[id^=remove]").click(function(){
            
            var curID = $(this).attr('class');
            $( "#delwarning" ).dialog({
                resizable: false,
                modal: true,
                buttons: {
                        "Yes": function() {
                            var divCount = $('#wrap').children(".form-wrapper:visible").length; 
                            
                            
                             $.ajax({
                                type: 'post',
                                url: '?mc=account&m=work_data_rm',
                                cache: false,
                                data:{
                                    boxid:curID
                                }, 
                                success: function(msg) {

                                    var json = $.parseJSON(msg);
                                    $.alert(json.message,json.title);
                                    $('#preloader').hide();
                                    $('#form-work').FormObserve_save();
                                    
                                    if(divCount == 1) {
                                        $('#form-work').clearForm();
                                    } else {
                                        $('#'+curID).hide('slow')
                                    }
                                    
                                },
                                error: function() {
                                    $('#preloader').hide();
                                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                }
                            });

                            $(this).dialog( "close" );

                        },
                        "No": function() {
                                $(this).dialog( "close" );
                        }
                }});$('#infoagree').removeAttr('checked');
            
       });
       var template = jQuery.format($("#template").val());
       function addRow(){
            
            var $boxes = template(i++);
            $('#wrap').prepend($boxes).masonry('reload');
            
            var dates = $("#from,#to").datepicker({
			changeMonth: true,
                        changeYear: true,
                        dateFormat: 'yy-mm-dd',
                        maxDate:'0',
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			},
                        yearRange: '-70:-0'
            });
            $("#salarygrade").mask("99-9");
       }
       var i = 1;
       
       <?php if($num_work == 0 ) {?>addRow();<?php } else { ?>
   
                                                                $("input[id=salarygrade]").mask("99-9");
                                                                var dates = $("#from,#to").datepicker({
                                                                            changeMonth: true,
                                                                            changeYear: true,
                                                                            dateFormat: 'yy-mm-dd',
                                                                            maxDate:'0',
                                                                            numberOfMonths: 2,
                                                                            onSelect: function( selectedDate ) {
                                                                                    var option = this.id == "from" ? "minDate" : "maxDate",
                                                                                            instance = $( this ).data( "datepicker" ),
                                                                                            date = $.datepicker.parseDate(
                                                                                                    instance.settings.dateFormat ||
                                                                                                    $.datepicker._defaults.dateFormat,
                                                                                                    selectedDate, instance.settings );
                                                                                    dates.not( this ).datepicker( "option", option, date );
                                                                            },
                                                                            yearRange: '-70:-0'
                                                                });
                                                                    
                                                    <?php } ?>
       
       $.validator.setDefaults({
                submitHandler: function() {
                    if(! $('#infoagree').is(':checked')) { $('#infoagree').focus(); return false; } else {
                    
                    var outArr =[];
                    
                    var fromArr=document.getElementsByName('from[]'); 
                    var toArr=document.getElementsByName('to[]'); 
                    var positionArr=document.getElementsByName('position[]'); 
                    var companyArr=document.getElementsByName('company[]');
                    var salaryArr=document.getElementsByName('salary[]');
                    var salarygradeArr=document.getElementsByName('salarygrade[]');
                    var statusArr=document.getElementsByName('status[]');
                    var govntArr=document.getElementsByName('govnt[]');
                    
                    var arrLn = companyArr.length;
                    var temp=[];
                    var i=0;
                
                    for(i;i<arrLn;i++){ 
                        temp = [fromArr[i].value,toArr[i].value,positionArr[i].value, companyArr[i].value, salaryArr[i].value, salarygradeArr[i].value, statusArr[i].value,govntArr[i].value];
                        outArr.push(temp);
                    }
           
                    $('#preloader').show();
                    jQuery.ajax({
                        type:'post',
                        url:'?mc=account&m=work_data',
                        cache:false,
                        data:{
                            workdata:outArr
                        },
                        success:function(msg){
                            var json = $.parseJSON(msg);
                            $.alert(json.message,json.title);
                            $('#preloader').hide();
                            $('#form-work').FormObserve_save();
                        },
                        error:function(xhr,ajaxOptions,thrownError){
                            $('#preloader').hide();
                            $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                        }
                    });
                    
                }}
        });
       
       $.metadata.setType("attr", "validate");
       $("#form-work").validate({errorPlacement: function(error, element) {error.css('display','none');}});

       $('#add-form').click(addRow);
       $('#wrap').masonry({
                                itemSelector: '.form-wrapper',
                                isAnimated: !Modernizr.csstransitions
       });$('#form-work').FormObserve();
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>