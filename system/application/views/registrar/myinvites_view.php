<?php 
if($this->session->userdata('usertype') === 'registrar') {
    $this->load->view('registrar/main_header_view');
} elseif($this->session->userdata('usertype') === 'teacher') {
    $this->load->view('teacher/main_header_view');
} else { redirect(base_url(), 'location'); }?>
<section class="span11">
    <h2>List of Users Invited</h2>    
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>Status</th>
                <th>Email Address</th>
                <th>Account</th>
                <th>Date of Invitation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $total = count($list);
                if($total > 0):
                    $i=0;
                    for($i; $i<$total; $i++) {
            ?>
            <tr id="<?=$list[$i]->inv_user?>">
                <td>
                    <?=($list[$i]->usr_status === 'verified') ? '<span class="label label-success">Verified</span>' : '<span class="label label-important">Unverified</span>'?>
                </td>
                <td>
                    <?=$list[$i]->usr_email?>
                </td>
                <td>
                    <?=ucfirst($list[$i]->usr_user_type)?>
                </td>
                <td>
                    <?=date('F d, Y - D g:i a',  strtotime($list[$i]->usr_reg_date));?>
                </td>
                <td>
                    <?php
                        if($list[$i]->usr_status === 'verified') {
                    ?>
                             <div class="btn-group">
                                <button class="btn btn-mini" data-toggle="dropdown">Actions</button>
                                <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                                    <span class="caret"></span>
                                </button>    
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="javascript:void(0);" id="report" data-id="<?=$list[$i]->inv_user?>">
                                            <i class="icon-exclamation-sign"></i> Report this user
                                        </a>
                                    </li> 
                                </ul><img src="<?=base_url()?>img/ajax-loader.gif" class="hide" id="img<?=$list[$i]->inv_user?>" />
                             </div>
                    <?php
                        } else {
                    ?>
                            <div class="btn-group">
                                <button class="btn btn-mini" data-toggle="dropdown" data-loading-text="Sending..." id="action<?=$list[$i]->inv_user?>">Actions</button>
                                <button class="btn btn-mini dropdown-toggle" data-loading-text="" id="action<?=$list[$i]->inv_user?>"><span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="javascript:void(0);" id="rm" data-id="<?=$list[$i]->inv_user?>" title="Remove this invitation"><i class="icon-trash"></i> Remove invitation</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" id="resend" data-id="<?=$list[$i]->inv_user?>" title="Resend the activation link">
                                            <i class="icon-envelope"></i> Resend Invitation
                                        </a>
                                    </li>
                                </ul><img src="<?=base_url()?>img/ajax-loader.gif" class="hide" id="img<?=$list[$i]->inv_user?>" />
                            </div>
                            
                         
                    <?php
                        }
                    ?>
                    
                </td>
            </tr>
            <?php }//end of list loop
            else:
            ?>
                <tr>
                    <td colspan="5"><em>No invites found</em></td>
                </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php 
        if(! empty($pagination))
            echo $pagination; 
        ?>
    </div>
</section>
<div id="myModal" class="modal hide fade">
<div class="modal-header">
    <button class="close" data-dismiss="modal">&times;</button>
    <h3>Detailed Report</h3>
</div>
<form id="reportform" novalidate="" method="post">
    <div class="modal-body">

        <p>
            <span class="label label-info">Note:</span> Please provide a full detail why you want to report this user
        </p> 
        <hr>
        <p>
        <h4>Details:</h4>
        <textarea class="required input-xxlarge" id="reportdetails" autofocus="autofocus"></textarea>
        <input type="hidden" class="dataid" />
        </p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal" >Close</a>
        <a href="#" class="btn btn-primary" id="sendreport">Send Report</a> <img src="<?=base_url()?>img/ajax-loader.gif" class="hide" id="preloader" />
    </div>
</form>
</div>


<div class="modal hide fade" id="myModal01">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Result</h3>
  </div>
  <div class="modal-body" id="modal01"></div>
  <div class="modal-footer">
    <a href="#" class="btn btn-primary" data-dismiss="modal">Ok</a>
  </div>
</div>

<script src="<?=base_url()?>js/bootstrap-transition.js"></script>
<script src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>js/bootstrap-button.js"></script>
<script src="<?=base_url()?>js/jquery.tipsy.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  
    $('#rm').live("click",function(){
        
       var $data_id = $(this).attr('data-id');
       var conf = confirm('Are you sure you want to remove this invitation?');
       
       if(conf === true) {
           var $button = $('#action'+$data_id)
           $button.button('loading')
           $.ajax({
                type:'post',
                url:'?mc=invite&m=rm',
                cache: false,
                data:{did:$data_id},
                dataType:"json",
                success: function(json) {
                    
                    if(json.status == 1) {
                        $('#modal01').empty().append('<p>'+json.msg+'</p>');
                    } else {
                        $('#modal01').empty().append('<p>'+json.msg+'</p>');
                    }
                    
                    $('#myModal01').modal('show')
                    $button.button('reset')
                    
                },           
                error:function (xhr, ajaxOptions, thrownError){
                        $('#modal01').empty().append('<p>There was an error in removing the invitation.'+thrownError+'</p>')
                        $('#myModal01').modal('show')
                        $button.button('reset')
                } 
            });    
           $('tr#'+$data_id).hide();
           return false;
       }
       
    });
    
    $('#resend').live("click",function(){
       
        var $data_id = $(this).attr('data-id')
        var $button = $('#action'+$data_id)
        $button.button('loading')
//        $("#img"+$data_id).show()
        
        $.ajax({
           type:'post',
           url:'?mc=invite&m=resend',
           cache: false,
           data:{did:$data_id},
           dataType:'json',
           success: function(json) {
               $('#modal01').empty().append('<p>'+json.msg+'</p>');
               $('#myModal01').modal('show');
//               $("#img"+$data_id).hide();
               $button.button('reset')

           },           
           error:function (xhr, ajaxOptions, thrownError){
                $('#modal01').empty().append('<p>There was an error in removing the invitation.'+thrownError+'</p>');
                $('#myModal01').modal('show');
//                $("#img"+$data_id).hide();
                $button.button('reset')
           } 
        });
    });
    
    $('#report').live("click",function(){
        var $data_id = $(this).attr('data-id');
        $("#myModal").find('.dataid').attr('id', $data_id);
        $('#myModal').modal('show');
        
        return false;
    });
    
    $('#reportform').validate();
    $('#sendreport').click(function(){

        var did=$("#myModal").find('.dataid').attr('id');
        var details=$('#reportdetails').val();
        var ValidStatus = $("#reportform").valid();
        
        if(ValidStatus === false) {
            return false;
        } else {
            
            $('#preloader').show();
            $.ajax({
                type:'post',
                url:'?mc=invite&m=report',
                cache:false,
                data: {
                    id:did,detail:details
                },
                dataType:'json',
                success: function(json) {
                    $('#myModal').modal('hide');
                    $('#modal01').empty().append('<p>'+json.msg+'</p>');
                    $('#myModal01').modal('show');
                    $("#preloader").hide();
                    $('#reportform').clearForm();
                },
                error:function (xhr, ajaxOptions, thrownError){
                    $('#modal01').empty().append('<p>There was an error in removing the invitation.'+thrownError+'</p>');
                    $('#myModal01').modal('show');
                    $('#preloader').hide();
                } 
            });
        }
    });

    $("#dialog:ui-dialog").dialog("destroy");
    $('#rm,#resend').tipsy({live: true,gravity: 'e'});
    $('[id^=show-tips]').tipsy('show');
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>