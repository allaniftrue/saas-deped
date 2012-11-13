<?php 
if($this->session->userdata('usertype') === 'registrar') {
    $this->load->view('registrar/main_header_view');
} elseif($this->session->userdata('usertype') === 'teacher') {
    $this->load->view('teacher/main_header_view');
}?>
<section class="span11">
    <h2>Invitation</h2>
    <div class="span5">
        <div class="hide" id="stat">
            
        </div>
        <form id="invitation-form" method="post" action="">
            <div style="margin:0px 0px 12px 0px;padding:5px 0;border-bottom: 1px dotted #ccc;" id="drop-shadow-bottom">
            <a href="javascript:void(0);" id="add-field"><img src="<?=base_url()?>img/plus-white.png" /> Add more fields</a>
            </div>
            <label class="required"><strong>Teacher's Email Address</strong></label>
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
            </p>
        </form>
    </div>
    <div class="span5">
        
        <div class="popover right" id="popover">
            <div class="arrow"></div>
            <h2 class="popover-title"><strong>Sending Invitations</strong></h2>
            <div class="popover-content">
              <h4>Faculty and Staff</h4>
              <p align="justify">Allows registered teachers to invite co-teachers in their respective institution.  The invitation allows the owner of the email to access data provided for teachers.</p><br />
              
              <h4>DepEd Officials</h4>
              <p align="justify">
                  Allows the registrar to invite DepEd officials who are assigned to check school reports.  The invitation allows the owner of the email to access data provided for DepEd officials.
              </p> <br />
              
              <div class="alert alert-error">
                  <p align="justify">
                  <i class="icon-exclamation-sign"></i> All invites are tracked and you could be liable for inviting anybody not from your school.
                  </p>
              </div>
            </div>
        </div>
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
<script src="<?=base_url()?>js/bootstrap-tooltip.js"></script>
<script src="<?=base_url()?>js/bootstrap-popover.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script src="<?=base_url()?>js/jquery.masonry.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

    var varsVal = getUrlVars()['act']; 
    
    $('#add-field').click(function(){
        $('#field-wrap').prepend('<p><input type="email" name="email[]" id="email" class="input-xlarge" validate="required:true,email: true" /></p>')
                        .masonry('reload');
    });
    
    $("#invitation-form").validate({
                meta: "validate",
                errorPlacement: function(error, element) {element.css('border','1px solid #B94A48').attr('placeholder','Enter email address')},
                submitHandler: function() {
                    $('button').button('loading')
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
                                    $('#stat').show('slow')
                                    var $this = $('#stat')
                                    if(msg.status == 1) {
                                        $this.append('<div class="alert alert-success">'+msg.msg+'</div>');
                                    } else {
                                        $this.append('<div class="alert alert-error">'+msg.msg+'</div>');
                                    }
                                    setTimeout(function () {
                                        $this.slideUp('slow').empty('slow');
                                    }, 4000)
                                    $('button').button('reset')
                                },
                                error:function(xhr,ajaxOptions,thrownError){
                                    $('.modal-body').empty().append("<p>"+'xhr status: '+xhr.status + '\n Error:'+ thrownError+"</p>")
                                    $('#myModal').modal('show')
                                    $('button').button('reset')
                                }
                            });
                        }
                    }  
                    $("#field-wrap").load(location.href + " #field-wrap")
                    
                }
     });    
     
     $('#field-wrap').masonry({
            isAnimated: true,
            animationOptions: {
            duration: 100,
            easing: 'linear',
            queue: false
        }
     })
     
     
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>