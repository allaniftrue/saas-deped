<?php $this->load->view('parent/header_view'); ?>
<!-- main -->
<div class="span11">
    
<div class="page-header">
    <h1 class="padleft">Guardian's Information <small><?=$guardians[0]->std_lastname.', '.$guardians[0]->std_firstname?></small></h1>
</div>

<form id="infoForm" method="post" action="">
<div class="span3">
    <p>
        <label>Surname</label>
        <input type="text" value="<?=! empty($guardians[0]->grd_lastname) ? $guardians[0]->grd_lastname : ''?>" class="required input input-large" placeholder="Surname" name="lastname" id="lastname" />
    </p>
    <p>
        <label>First Name</label>
        <input type="text" value="<?=! empty($guardians[0]->grd_firstname) ? $guardians[0]->grd_firstname : ''?>" class="required input input-large" placeholder="First Name" id="firstname" name="firstname" />
    </p>
    <p>
        <div class="pull-left">
            <label>Middle Initial</label>
            <input type="text" value="<?=! empty($guardians[0]->grd_mid_init) ? $guardians[0]->grd_mid_init : ''?>" class="required input input-small" placeholder="Middle Initial" id="mi" name="mi" />&nbsp;&nbsp;&nbsp;
        </div>
        <div class="pull-left"> 
            <label>Name Extension</label>
            <input type="text" value="<?=! empty($guardians[0]->grd_extname) ? $guardians[0]->grd_extname : ''?>" class="input input-small" placeholder="example: Jr." name="namext" id="namext" />
        </div>
        <div class="clearfix"></div>
    </p>
    <p>
        <label>Gender</label>
        
        <?php if(! empty($guardians[0]->grd_sex)): 
                if($guardians[0]->grd_sex === 'male') { ?>
                    <label class="radio">
                        <input type="radio" id="sex" name="sex" value="male" checked /> Male
                    </label>
                    <label class="radio">
                        <input type="radio" id="sex" name="sex" value="female"  /> Female
                    </label>
          <?php } else { ?>
                    <label class="radio">
                        <input type="radio" id="sex" name="sex" value="male"  /> Male
                    </label>
                    <label class="radio">
                        <input type="radio" id="sex" name="sex" value="female"  checked /> Female
                    </label>
        <?php } else : ?>
                    <label class="radio">
                        <input type="radio" id="sex" name="sex" value="male"  /> Male
                    </label>
                    <label class="radio">
                        <input type="radio" id="sex" name="sex" value="female" checked /> Female
                    </label>
        <?php endif; ?>
    </p>
</div>

<div class="span3">
    <p>
        <label>Address</label>
        <textarea row="2" placeholder="address" name="address" id="address" class="required"><?=! empty($guardians[0]->grd_address) ? $guardians[0]->grd_address : ''?></textarea>
    </p>
    <p>
        <label>Contact Number</label>
        <input type="text" value="<?=! empty($guardians[0]->grd_contact) ? $guardians[0]->grd_contact : ''?>" class="required input input-large" placeholder="example: 09168192036" id="contactnumber" name="contactnumber" />
    </p>
    <p>
        <label>Email</label>
        <span class="input-large uneditable-input" id="tips" rel="tooltip" title="Change of email address is not allowed.">
            <?=! empty($guardians[0]->grd_email) ? $guardians[0]->grd_email : ''?>
        </span>
    </p>
    <p>
        <label>Relation</label>
        <input type="text" value="<?=! empty($guardians[0]->grd_relation) ? $guardians[0]->grd_relation : ''?>" class="required input input-large" placeholder="example: father, mother" id="relation" name="relation" />
    </p>
</div>
    <div cass="span4">
        <div class="span4 alert alert-info">
            <h3>Information</h3>
        </div>
        <p class="span4">Information on this page was provided by <strong><?=!empty($guardians[0]->std_firstname) ? $guardians[0]->std_firstname : 'the student'?></strong>.  Please make corrections or update the information if it was wrongly filled up.</p>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="page-header">&nbsp;</div>
<div class="span11">
    <p>
        <button class="btn btn-primary" id="saveinformation" data-loading-text="Saving Information...">Save Information</button>
    </p>
</div>
</form>
<div class="modal hide fade" id="myModal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Result</h3>
  </div>
  <div class="modal-body"></div>
  <div class="modal-footer">
    <a href="#" class="btn btn-primary" data-dismiss="modal">OK</a>
  </div>
</div>    
<!-- end of main -->
<script type="text/javascript" src="<?=base_url()?>js/modernizr-transitions.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-button.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var curId = getUrlVars()['id'];
    $('#tips').tipsy({live:true,gravity: 'sw',opacity:1});
    $('#infoForm').validate({
      rules: {
          surname:"required",
          firstname:"required",
          mi: {
              required:true,
              maxlength:2
          },
          address:"required",
          contactnumber:"required",
          relation:"required"
      } ,
      submitHandler: function() { 
                $('#saveinformation').button('loading');
                $.ajax({
                    type:'post',
                    url:'?mc=parent_main&m=savestdguardian',
                    data:{
                        lastname:$('#lastname').val(),
                        firstname:$('#firstname').val(),
                        mi:$('#mi').val(),
                        namext:$('#namext').val(),
                        sex:$('#sex:checked').val(),
                        address:$('#address').val(),
                        contactnumber:$('#contactnumber').val(),
                        relation:$('#relation').val(),
                        id:curId
                    },
                    dataType:"json",
                    success: function(r){
                        if(r.status == 1) {
                            var statMsg = (r.msg === "" || r.msg === null || typeof r.msg === "undefined") ? '<p>Information updated</p>' : r.msg;
                            $('.modal-body').empty().append(statMsg);
                        } else {
                            var statMsg = (r.msg === "" || r.msg === null || typeof r.msg === "undefined") ? '<p>An error occured while saving the information.  Make sure you have filled up the required fields</p>' : r.msg;
                            $('.modal-body').empty().append(statMsg);
                        }
                        $('#myModal').modal('show');
                        $('#saveinformation').button('reset');
                    },
                    error: function() {
                         $('#saveinformation').button('reset');
                    }
                });
               
      }
   });
});
</script>
<?php $this->load->view('parent/footer_view'); ?>