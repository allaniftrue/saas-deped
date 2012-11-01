<?php 
if($this->session->userdata('usertype') === 'registrar') {
    $this->load->view('registrar/main_header_view');
} elseif($this->session->userdata('usertype') === 'teacher') {
    $this->load->view('teacher/main_header_view');
}?>
<section class="span11">
     <div class="page-header">
            <h1>Invitation</h1>
     </div>
 
    <div class="span5">
        <div class="hide" id="stat">
            
        </div>
        
         <form id="invitation-form" method="post" action="">
            <div style="margin:0px 0px 12px 0px;padding:5px 0;border-bottom: 1px dotted #ccc;" id="drop-shadow-bottom">
            <a href="javascript:void(0);" id="add-field"><img src="<?=base_url()?>img/plus-white.png" /> Add more fields</a>
            </div>
            <label>Teacher's Email Address</label>
            <div id="field-wrap">
            <p>
                <label for="email"></label>
                <input type="email" name="email[]" id="email" class="required input-xlarge" validate="required:true,email:true" />
            </p>
            </div>
            <p align="left">
                <button type="submit" class="btn btn-primary" id="send-invitation" data-loading-text="Sending Invitation...">
                    <i class="icon-envelope icon-white"></i> Send Invitation
                </button>
                <img src="<?=base_url()?>img/ajax-loader.gif" style="display:none;" id="preloader" />
            </p>
        </form>
    </div>
    <div class="span5">
            <div class="alert alert-info"><h3>Invite a faculty member</h3></div>
                <p align="justify">This allow registered teachers to invite co-teachers in their respective institution.  All invites are tracked and you could be liable for inviting anybody not from your school.</p>
   </div>
</section>
<div class="modal hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Result</h3>
  </div>
  <div class="modal-body">
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-button.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<!--<script src="<?=base_url()?>js/jquery-ui.min.js"></script>-->
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/application.js"></script>

<script type="text/javascript">
$(document).ready(function(){
     var varsVal = getUrlVars()['act']; 
     $('#add-field').click(function(){
        $('#field-wrap').prepend('<p><input type="email" name="email[]" id="email" class="input-xlarge" validate="required:true,email: true" /></p>');
     });
       $("#invitation-form").validate({
                meta: "validate",
                submitHandler: function() {
                    $('#preloader').show();
                    var outArr =[];
                    var emailArr=document.getElementsByName('email[]'); 
                    var arrLn = emailArr.length;
                    var i=0;
                    var curEmail='';
                    
                    for(i;i<arrLn;i++){ 
                        curEmail = emailArr[i].value;
                        if(emailArr[i].value != ''){
                            $.ajax({
                                type:'post',
                                url:'?mc=invite&m=send_invites',
                                data:{email:curEmail,utype:varsVal},
                                dataType:'json',
                                success:function(msg){
                                    console.log(msg);                                 
                                    $('#stat').show('slow');
                                    var $this = $('#stat');
                                    if(msg.status == 1) {
                                        $this.append('<div class="alert alert-success">'+msg.msg+'</div>');
                                    } else {
                                        $this.append('<div class="alert alert-error">'+msg.msg+'</div>');
                                    }
                                    setTimeout(function () {
                                        $this.slideUp('slow').empty('slow');
                                    }, 4000);
                                    $('#preloader').hide();
                                },
                                error:function(xhr,ajaxOptions,thrownError){
                                    $('#preloader').hide();
                                    $('.modal-body').empty().append("<p>"+'xhr status: '+xhr.status + '\n Error:'+ thrownError+"</p>");
                                    $('#myModal').modal('show');
                                }
                            });
                        }
                    }  $("#field-wrap").load(location.href + " #field-wrap");
                }
     });    
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>