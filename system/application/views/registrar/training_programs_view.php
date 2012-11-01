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
        <li  class="active"><a href="<?=base_url()?>?mc=account&m=training_programs<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Training Programs</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=other_info<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Other Information</a></li>
        <li> <a href="<?=base_url()?>?mc=account&m=login<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Account</a></li>
    </ul>
</div>
</header>

<textarea style="display:none" id="template">
<div class="form-wrapper">
    
    <p>
        <label class="required" for="seminar">Title of seminar</label>
        <input type="text" class="input-xlarge" name="seminar[]" id="seminar" validate="required:true" />
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
        <label class="required" for="sponsor">Conducted / Sponsored by</label>
        <input type="text" class="input-xlarge" name="sponsor[]" id="sponsor" validate="required:true" />
    </p>
</div>
</textarea>

<section id="expwrap">
    <div class="span11">
      <div class="page-header">
                <h1>Personal Data Sheet <small> &nbsp;{ Training Programs }</small></h1>
      </div>
      <div class="alert alert-info">
            <strong>Information: </strong>Training programs (Start from the most recent training).  Write in full the training.
      </div> <br />
      <div style="margin:0px 0px 12px 0px;padding:5px 0;border-bottom: 1px dotted #ccc;" id="drop-shadow-bottom">
          <a href="javascript:void(0);" id="add-form"><img src="<?=base_url()?>img/plus-white.png" /> Add another form</a>
      </div>
      <form id="vol-work">
      <div id="wrap">  
          
           <?php        
            $num_count=count($seminars);
            if($num_count > 0) {
                for($i=0; $i<$num_count;$i++){
            ?>
                <div class="form-wrapper" id="<?=$seminars[$i]->tra_id?>">
                     <label id="remove" class="<?=$seminars[$i]->tra_id?>"><a href="javascript:void();"><img src="<?=base_url()?>img/cross-button.png" id="<?=$seminars[$i]->tra_id?>-del-btn" alt="Delete" title="Remove Information" style="display:none;" /></a>
                        </label>
                    <p>
                        <label class="required" for="seminar">Title of seminar</label>
                        <input type="text" class="input-xlarge" name="seminar[]" id="seminar" validate="required:true" value="<?=($seminars[$i]->tra_title) ? $seminars[$i]->tra_title : ''; ?>" />
                    </p>
                    <p>
                        <fieldset><legend>Inclusive Dates (yyyy-mm-dd)</legend>
                            <div style="float:left; width: 50%;">
                                <label class="required" for="from">From</label>
                                <input type="text" class="input-small" name="from[]" id="from" validate="required:true,date:true" value="<?=($seminars[$i]->tra_from) ? $seminars[$i]->tra_from : '';?>" />
                            </div>
                            <div style="float:right;width:50%;">
                                <label class="required" for="to">To</label>
                                <input type="text" class="input-small" name="to[]" id="to" validate="required:true,date:true" value="<?=($seminars[$i]->tra_to) ? $seminars[$i]->tra_to : '';?>" />
                            </div>
                            <div class="clear"></div>
                        </fieldset>
                    </p>


                    <p>
                        <label class="required" for="hours">Number of hours</label>
                        <input type="text" class="input-xlarge" name="hours[]" id="hours" validate="required:true,digits:true" value="<?=($seminars[$i]->tra_hours) ? $seminars[$i]->tra_hours : ''; ?>" />
                    </p>
                    <p>
                        <label class="required" for="sponsor">Sponsor / Conducted by</label>
                        <input type="text" class="input-xlarge" name="sponsor[]" id="sponsor" validate="required:true" value="<?=($seminars[$i]->tra_sponsor) ? $seminars[$i]->tra_sponsor : ''; ?>" />
                    </p>
                </div>
          
          
            <?php } } ?>
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
</section>
<div id="delwarning" title="Confirmation" style="display: none;">
                <p>Are you sure you want to completely remove this information?</p>
</div>

<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/jquery.masonry.min.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/modernizr-transitions.js"></script>
<script src="<?=base_url()?>js/jquery.ui.datepicker.validation.min.js"></script>
<script src="<?=base_url()?>js/jquery.formobserver.js"></script>
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
                                url: '?mc=account&m=seminar_rm',
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
                    var seminarArr=document.getElementsByName('seminar[]'); 
                    var fromArr=document.getElementsByName('from[]'); 
                    var toArr=document.getElementsByName('to[]');
                    var hoursArr=document.getElementsByName('hours[]');
                    var sponsorArr=document.getElementsByName('sponsor[]');
                    var arrLn = seminarArr.length;
                    var temp=[];
                    var i=0;
                
                    for(i;i<arrLn;i++){ 
                        temp = [seminarArr[i].value,fromArr[i].value, toArr[i].value, hoursArr[i].value, sponsorArr[i].value];
                        outArr.push(temp);
                    }
           
                    $('#preloader').show();
                    $.ajax({
                        type:'post',
                        url:'?mc=account&m=training_data',
                        cache:false,
                        data:{
                            seminarsdata:outArr
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