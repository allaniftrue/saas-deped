<?php $this->load->view('registrar/main_header_view'); ?>
<header class="jumbotron subhead" id="overview">
<div class="subnav">
    <ul class="nav nav-pills">
        <li><a href="<?=base_url()?>?mc=account<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Personal Info</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=family_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Family Background</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=educational_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Educational Background</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=civil_srv_elegibility<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Civil Service Eligibility</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=work_experience<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Work Experience</a></li>
        <li class="active"><a href="<?=base_url()?>?mc=account&m=voluntary_work<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Voluntary Work</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=training_programs<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Training Programs</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=other_info<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Other Information</a></li>
        <li> <a href="<?=base_url()?>?mc=account&m=login<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Account</a></li>
    </ul>
</div>
</header>
<textarea style="display:none" id="template">
<div class="form-wrapper">
    
    <p>
        <label class="required" for="organization">Name of organization</label>
        <input type="text" class="full" name="organization[]" id="organization" validate="required:true" />
    </p>
    <p>
        <label class="required" for="organizationaddress">Address of organization</label>
        <input type="text" class="full" name="organizationaddress[]" id="organizationaddress" validate="required:true" />
    </p>
    <p>
        <fieldset><legend>Inclusive Dates (yyyy-mm-dd)</legend>
            <div style="float:left; width: 50%;">
                <label class="required" for="from">From</label>
                <input type="text" class="input-small" name="from[]" id="from" validate="required:true,date:true" />
            </div>
            <div style="float:right;width:50%;">
                <label class="required" for="to">To</label>
                <input type="text" class="input-small" name="to[]" id="to" validate="required:true,date:true" />
            </div>
            <div class="clear"></div>
        </fieldset>
    </p>
   

    <p>
        <label class="required" for="hours">Number of hours</label>
        <input type="text" class="input-xlarge" name="hours[]" id="hours" validate="required:true,digits:true" />
    </p>
    <p>
        <label class="required" for="position">Position / Nature of work</label>
        <input type="text" class="input-xlarge" name="position[]" id="position" validate="required:true" />
    </p>
</div>
</textarea>

<section id="expwrap">
      <div class="span11">
        <div class="page-header">
                <h1>Personal Data Sheet <small> &nbsp;{ Voluntary Work }</small></h1>
        </div>
        <div class="alert alert-info">
            <strong>Information: </strong> Voluntary work or Involvement in civic / non-government / people / voluntary organizations.  Write in full the organization's name.
        </div> <br />
      <div class="m-content">
      <div style="margin:0px 0px 12px 0px;padding:5px 0;border-bottom: 1px dotted #ccc;" id="drop-shadow-bottom">
          <a href="javascript:void(0);" id="add-form"><img src="<?=base_url()?>img/plus-white.png" /> Add another form</a>
      </div>
      <form id="vol-work">
      <div id="wrap">  
          
          <?php        
            $num_count=count($voluntary);
            if($num_count > 0) {
                for($i=0; $i<$num_count;$i++){
          ?>
          <div class="form-wrapper" id="<?=$voluntary[$i]->vol_id?>">
            <label id="remove" class="<?=$voluntary[$i]->vol_id?>"><a href="javascript:void();"><img src="<?=base_url()?>img/cross-button.png" id="<?=$voluntary[$i]->vol_id?>-del-btn" alt="Delete" title="Remove Information" style="display:none;" /></a>
            </label>
            <br />
            <p>
                <label class="required" for="organization">Name of organization</label>
                <input type="text" class="input-xlarge" name="organization[]" id="organization" validate="required:true" value="<?=($voluntary[$i]->vol_organization) ? $voluntary[$i]->vol_organization : '';?>" />
            </p>
             <p>
                <label class="required" for="organizationaddress">Address of organization</label>
                <input type="text" class="input-xlarge" name="organizationaddress[]" id="organizationaddress" validate="required:true" value="<?=($voluntary[$i]->vol_address) ? $voluntary[$i]->vol_address : '';?>" />
            </p>
            <p>
                <fieldset><legend>Inclusive Dates (yyyy-mm-dd)</legend>
                    <div style="float:left; width: 50%;">
                        <label class="required" for="from">From</label>
                        <input type="text" class="input-small" name="from[]" id="from" validate="required:true,date:true" value="<?=($voluntary[$i]->vol_from) ? $voluntary[$i]->vol_from : '';?>" />
                    </div>
                    <div style="float:right;width:50%;">
                        <label class="required" for="to">To</label>
                        <input type="text" class="input-small" name="to[]" id="to" validate="required:true, date:true" value="<?=($voluntary[$i]->vol_to) ? $voluntary[$i]->vol_to : '';?>" />
                    </div>
                    <div class="clear"></div>
                </fieldset>
            </p>
            <p>
                <label class="required" for="hours">Number of hours</label>
                <input type="text" class="input-xlarge" name="hours[]" id="hours" validate="required:true,digits:true" value="<?=($voluntary[$i]->vol_hours) ? $voluntary[$i]->vol_hours : '';?>"  />
            </p>
            <p>
                <label class="required" for="position">Position / Nature of work</label>
                <input type="text" class="input-xlarge" name="position[]" id="position" validate="required:true" value="<?=($voluntary[$i]->vol_position) ? $voluntary[$i]->vol_position : '';?>" />
            </p>
            
          </div>
          <?php
                }
            }
          ?>

      </div>
      <div id="delwarning" title="Confirmation" style="display: none;">
                <p>Are you sure you want to completely remove this information?</p>
      </div>
      <div style="margin-top: 30px;padding-top: 10px;" id="drop-shadow-top">
            <p align="justify">
                <label  class="checkbox">
                <input type="checkbox" name="infoagree" id="infoagree" value="agree" validate="required:true" /> I declare under oath that this Personal Data Sheet has been accomplished by me, and is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the Philippines.  I also authorize the agency head / authorized representative to verify / validate the contents stated herein.  I trust that this information shall remain confidential.
                </label>
            </p>
            <p align="left">
                <input type="submit" id="save-btn-cvl" value="Save Information" class="btn btn-primary" />
                <img src="<?=base_url()?>img/ajax-loader.gif" style="display:none;" id="preloader" />
            </p>
      </div> 
    </form>
      </div>
      </div>
</section>
<div id="delwarning" title="Confirmation" style="display: none;">
                <p>Are you sure you want to completely remove this information?</p>
</div>
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
$(document).ready(function(){
      
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
            $("#delwarning").dialog({
                resizable: false,
                modal: true,
                buttons: {
                        "Yes": function() {
                            var divCount = $('#wrap').children(".form-wrapper:visible").length; 
                            
                            
                             $.ajax({
                                type: 'post',
                                url: '?mc=account&m=vol_data_rm',
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
			}
            });
       }
       var i = 1;
       
       <?php if($num_count == 0 ) {?>addRow();<?php } else { ?>
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
                        }
            });
        <?php } ?>
       
       $.validator.setDefaults({
                submitHandler: function() {
                   
                    var outArr =[];
                    var organizationArr=document.getElementsByName('organization[]'); 
                    var organizationAddressArr=document.getElementsByName('organizationaddress[]'); 
                    var fromArr=document.getElementsByName('from[]'); 
                    var toArr=document.getElementsByName('to[]');
                    var hoursArr=document.getElementsByName('hours[]');
                    var positionArr=document.getElementsByName('position[]');
                    var arrLn = organizationArr.length;
                    var temp=[];
                    var i=0;
                
                    for(i;i<arrLn;i++){ 
                        temp = [organizationArr[i].value,organizationAddressArr[i].value,fromArr[i].value, toArr[i].value, hoursArr[i].value, positionArr[i].value];
                        outArr.push(temp);
                    }
           
                    $('#preloader').show();
                    $.ajax({
                        type:'post',
                        url:'?mc=account&m=voluntary_work_data',
                        cache:false,
                        data:{
                            voluntarydata:outArr
                        },
                        success:function(msg){
                            var json = $.parseJSON(msg);
                            $.alert(json.message,json.title);
                            $('#preloader').hide();
                            $('#infoagree').removeAttr('checked');
                            $('#vol-work').FormObserve_save();   
                        },
                        error:function(xhr,ajaxOptions,thrownError){
                            $('#preloader').hide();
                            $('#infoagree').removeAttr('checked');
                            $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                        }
                    });
                    
                }
        });
       
       $.metadata.setType("attr", "validate");
       $("#vol-work").validate({errorPlacement: function(error, element) {error.css('display','none');}});

       $('#add-form').click(addRow);
       $('#wrap').masonry({
                                itemSelector: '.form-wrapper',
                                isAnimated: !Modernizr.csstransitions
       });$('#vol-work').FormObserve();
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>