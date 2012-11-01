<?php $this->load->view('registrar/main_header_view'); ?>
<header class="jumbotron subhead" id="overview">
<div class="subnav">
    <ul class="nav nav-pills">
        <li><a href="<?=base_url()?>?mc=account<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Personal Info</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=family_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Family Background</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=educational_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Educational Background</a></li>
        <li class="active"><a href="javascript:void(0);">Civil Service Eligibility</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=work_experience<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Work Experience</a></li>
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
                <label for="examname">Career Service/RA 1080/CES/CSEE/Under Special Laws </label>
                <input type="text" class ="input-xlarge" name="examname[]" id="examname" validate="required:true" />
            </p>
            <p>
                <label for="rating">Rating</label>
                <input type="text" class="input-xlarge" name="rating[]" id="rating" validate="required:true,number:true" />
            </p>
            <p>
                <label for="examdate">Date of Examination (yyyy-mm-dd)</label>
                <input type="text" class="input-xlarge" name="examdate[]" id="datepicker-examdate-{0}" validate="required:true,date:true" />
            </p>
            <p>
                <label for="examplace">Place of Examination</label>
                <input type="text" class="input-xlarge" name="examplace[]" id="examplace" validate="required:true" />
            </p>
            <p>
                <fieldset><legend>Licensure (if applicable)</legend>
                    <div style="float:left; width: 50%;">
                        <label class="required" for="licensenumber">Number </label>
                        <input type="text" class="input-small" name="licensenumber[]" id="licensenumber" />
                    </div>
                    <div style="float:right;width:50%;">
                        <label class="required" for="releasedate">Date of Release </label>
                        <input type="text" class="input-small" name="releasedate[]" id="datepicker-releasedate-{0}" validate="date:true" />
                    </div>
                    <div class="clear"></div>
                </fieldset>
            </p>
        </div>
        
      </div>
</textarea>

<section id="cvlSrv"> <div class="span11">
    <div class="page-header">
        <h1>Personal Data Sheet <small> &nbsp;{ Civil Service Eligibility }</small></h1>
    </div></div> 
    <div class="alert alert-info span11">
        <strong>Information: </strong> Write in full the type of exam taken
    </div> <br />
    <div class="span11">
        <a href="javascript:void(0);" id="add-cse"><img src="<?=base_url()?>img/plus-white.png" /> Add a CSE form</a>
    </div>
    <div class="span12">
        <form id="form-civil-service">
        <div id="wrap">  

                <?php
                    $num = count($civil_srv);

                    if($num > 0) {
                        for($i=0; $i<$num; $i++) {

                            $float = $i%2 == 0 ? 'float:left' : 'float:right';

                ?>           


                    <div class="form-wrapper" id="<?=$civil_srv[$i]->cvl_id?>">
                        <label id="remove" class="<?=$civil_srv[$i]->cvl_id?>">
                            <a href="javascript:void(0);">
                                <img src="<?=base_url()?>img/cross-button.png" id="<?=$civil_srv[$i]->cvl_id?>-del-btn" alt="Delete" title="Remove Information" style="display:none;" />
                            </a>
                        </label>
                        <p>
                            <label for="examname">Career Service/RA 1080/CES/CSEE/Under Special Laws </label>
                            <input type="text" value ="<?=($civil_srv[$i]->cvl_career_service) ? $civil_srv[$i]->cvl_career_service : ''; ?>" class ="input-xlarge" name="examname[]" id="examname" validate="required:true" />
                        </p>
                        <p>
                            <label for="rating">Rating</label>
                            <input type="text" value="<?=($civil_srv[$i]->cvl_rating) ? $civil_srv[$i]->cvl_rating : ''; ?>" class="input-xlarge" name="rating[]" id="rating" validate="required:true,number:true" />
                        </p>
                        <p>
                            <label for="examdate">Date of Examination (yyyy-mm-dd)</label>
                            <input type="text" value="<?=($civil_srv[$i]->cvl_date_conferment) ? $civil_srv[$i]->cvl_date_conferment : ''; ?>" class="input-xlarge" name="examdate[]" id="datepicker-examdate-{0}" validate="required:true,date:true" />
                        </p>
                        <p>
                            <label for="examplace">Place of Examination</label>
                            <input type="text" value="<?=($civil_srv[$i]->cvl_place_conferment) ? $civil_srv[$i]->cvl_place_conferment : ''; ?>" class="input-xlarge" name="examplace[]" id="examplace" validate="required:true" />
                        </p>
                        <p>
                            <fieldset><legend>Licensure (if applicable)</legend>
                                <div style="float:left; width: 50%;">
                                    <label class="required" for="licensenumber">Number </label>
                                    <input type="text" value="<?=($civil_srv[$i]->cvl_number) ? $civil_srv[$i]->cvl_number : ''; ?>" class="input-small" name="licensenumber[]" id="licensenumber" />
                                </div>
                                <div style="float:right;width:50%;">
                                    <label class="required" for="releasedate">Date of Release </label>
                                    <input type="text" value="<?=($civil_srv[$i]->cvl_date_release) ? $civil_srv[$i]->cvl_date_release : ''; ?>" class="input-small" name="releasedate[]" id="datepicker-releasedate-{0}" validate="date:true" />
                                </div>
                                <div class="clear"></div>
                            </fieldset>
                        </p>
                    </div>

                                <?php //$i%2 == 0 ? '<div class="clear"></div>' : ''; ?>

                <?php }     } ?>



        </div>

        <div class="clear"></div>
        <br /><br />
        <div class="span11">
            <p align="justify">
                <input type="checkbox" name="infoagree" id="infoagree" value="agree" /> I declare under oath that this Personal Data Sheet has been accomplished by me, and is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Repubic of the Philippines.  I also authorize the agency head / authorized representative to verify / validate the contents stated herein.  I trust that this information shall remain confidential.
            </p>
            <p align="left">
                <input type="submit" id="save-btn-cvl" value="Save Information" class="btn btn-primary" />
                <img src="<?=base_url()?>img/ajax-loader.gif" style="display:none;" id="preloader" />
            </p>
        </div> 
        </form>
    </div>
</section>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/jquery.masonry.min.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/jquery.ui.datepicker.validation.min.js"></script>
<script src="<?=base_url()?>js/jquery.formobserver.js"></script>
<script src="<?=base_url()?>js/modernizr-transitions.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function(){

       $("div[class^=form-wrapper]").live({
            mouseover: function(){
                var curID = $(this).attr('id');
                $('#'+curID+'-del-btn').show();      
                //console.log('in:'+curID);
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
                                                        url: '?mc=account&m=civil_srv_data_rm',
                                                        cache: false,
                                                        data:{
                                                            boxid:curID
                                                        }, 
                                                        success: function(msg) {

                                                            var json = $.parseJSON(msg);
                                                            $.alert(json.message,json.title);
                                                            $('#preloader').hide();
                                                            $('#form-civil-service').FormObserve_save();
                                                          if(divCount == 1) { 
                                                              $('#form-civil-service').clearForm();
                                                          } else {
                                                              $('#'+curID).hide('slow');
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

        $.validator.setDefaults({
                submitHandler: function() {
                         if(! $('#infoagree').is(':checked')) { $('#infoagree').focus(); return false; } else { 
                                var outArr =[];
                                var nameArr = document.getElementsByName('examname[]'); 
                                var ratingArr = document.getElementsByName('rating[]'); 
                                var examdateArr   = document.getElementsByName('examdate[]'); 
                                var examplaceArr = document.getElementsByName('examplace[]'); 
                                var licenseArr = document.getElementsByName('licensenumber[]'); 
                                var releasedateArr = document.getElementsByName('releasedate[]'); 
                                var arrLn = nameArr.length;
                                
                                for(var i=0; i < arrLn; i++) {
                                    var cvlSrv= [ nameArr[i].value , ratingArr[i].value, examdateArr[i].value, examplaceArr[i].value, licenseArr[i].value, releasedateArr[i].value];
                                    outArr.push(cvlSrv);
                                }
                             
                                $('#preloader').show();
                                $.ajax({
                                                type: 'post',
                                                url: '?mc=account&m=civil_srv_data',
                                                cache:false,
                                                data: {
                                                       civilSrv:outArr
                                                },
                                                success: function(msg) {
                                                                var json = jQuery.parseJSON(msg);
                                                                $.alert(json.message,json.title);
                                                                $('#preloader').hide();
                                                                $('#personal-form').FormObserve_save();
                                                },
                                                error:function (xhr, ajaxOptions, thrownError){
                                                    $('#preloader').hide();    
                                                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                }    

                                });
                                $('#infoagree').removeAttr('checked');
                         }
                }
        });
        $.metadata.setType("attr", "validate");
        $("#form-civil-service").validate({errorPlacement: function(error, element) {error.css('display','none');}});
        
        var template = jQuery.format($("#template").val());
        
        function addRow(){
            var $boxes = template(i++);
            $('#wrap').prepend( $boxes ).masonry('reload');

             
             $("input[id^=datepicker]").datepicker({ 
                                    showAnim: 'slideDown', 
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat: 'yy-mm-dd',
                                    maxDate:'0'
            });
        }

        var i = 1;
        
        <?php if($num > 0) { ?>
            
        $("input[id^=datepicker]").datepicker({ 
                                    showAnim: 'slideDown', 
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat: 'yy-mm-dd',
                                    maxDate:'0'
        });
            
            
        <?php } else { ?> addRow(); <?php } ?>

        $('#add-cse').click(addRow);
        $('#wrap').masonry({
                        itemSelector: '.form-wrapper',
                        isAnimated: !Modernizr.csstransitions
        });
        
        $('#form-civil-service').FormObserve();
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>