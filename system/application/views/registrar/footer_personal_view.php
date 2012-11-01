</div>
<script src="<?=base_url()?>js/bootstrap-transition.js"></script>
<script src="<?=base_url()?>js/bootstrap-alert.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
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
        
        $.backstretch("<?=base_url()?>img/bg.jpg"); 
        
        var button = $('#change_button');
	var spinner = $('#spinner');
        
        spinner.hide();
	button.css('opacity', 0);
	spinner.css('top', ($('#profile-pic-wrapper').height() - spinner.height()) / 2)
	spinner.css('left', ($('#profile-pic-wrapper').width() - spinner.width()) / 2)

	$('#profile-pic-wrapper').live({
            mouseover: function(){
		button.css('opacity', .5);
		button.stop(false,true).fadeIn(200);
            },
            mouseout: function() {
		button.stop(true,true).fadeOut(3000);
            }
	});
     
        new AjaxUpload('change_button', {
                action: '?mc=account&m=upload',
                responseType: 'json',
		onSubmit : function(file, ext){
                            if (ext && /^(<?php echo $this->config->item('acceptable_files'); ?>)$/i.test(ext)){
                                spinner.css('display', 'block');
                                this.setData({ 'directory': "<?php echo $this->config->item('upload_dir'); ?>"});
                            } else {
                                $.alert('File not supported', 'Error');
                                return false;
                            }
                            this.disable();
		},
		onComplete: function(file, response){
                
			button.stop(false,true).fadeOut('slow');
			spinner.css('display', 'none');
                        if(response.status == 'Success') {
                            $.alert(response.issue, response.status);
                            $('#profile_img').attr('src', response.filename);
                        }else {
                            $.alert(response.issue, response.status);
                        }

			this.enable();
		}
	});
    
    $("#birthdate").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        maxDate: '-18y'
                                           
    });
    
    $('#personal-form').FormObserve();
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
            $('#specificstatus').focus();
        } else {
            $('#otherstatus').hide();
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
			error.insertAfter(element.parent().find('label:first'));
        },
        submitHandler: function() {
                    if(! $('#infoagree').is(':checked')) { $('#infoagree').focus(); return false; } else { 
                        
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
                                            civilstatus:$('#civilstatus').val(),
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
});
</script>
</body>
</html>