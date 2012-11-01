<?php $this->load->view('student/student_header'); ?>
<header class="jumbotron subhead" id="overview">
<div class="subnav">
    <ul class="nav nav-pills">
        <li><a href="?mc=stdaccount&s=<?=rand(1,999999)?>&sess=<?=random_string('alnum', 64).'&r='.random_string('alnum', 32); ?>">Personal Information</a></li>
        <li class="active"><a href="?mc=stdaccount&m=guardian&s=<?=rand(1,999999)?>&sess=<?=random_string('alnum', 64).'&r='.random_string('alnum', 32); ?>">Guardian's Information</a></li>
        <li><a href="?mc=stdaccount&m=pwd&s=<?=rand(1,999999)?>&sess=<?=random_string('alnum', 64).'&r='.random_string('alnum', 32); ?>">Login Information</a></li>
    </ul>
</div>
</header>
<br />
<div class="page-header">
    <h1 class="padleft">Guardian's Information</h1>
</div>

<form id="infoForm" method="post" action="">
<div class="span4">
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

<div class="span4">
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
        <input type="text" value="<?=! empty($guardians[0]->grd_email) ? $guardians[0]->grd_email : ''?>" class="input input-large" placeholder="example: email@yahoo.com" id="emailaddress" name="emailaddress" />
    </p>
    <p>
        <label>Relation</label>
        <input type="text" value="<?=! empty($guardians[0]->grd_relation) ? $guardians[0]->grd_relation : ''?>" class="required input input-large" placeholder="example: father, mother" id="relation" name="relation" />
    </p>
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
<script src="<?=base_url()?>js/modernizr-transitions.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/bootstrap-tooltip.js"></script>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script src="<?=base_url()?>js/bootstrap-button.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function(){
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
          emailaddress: { required:true, email:true},
          relation:"required"
      } ,
      submitHandler: function() {
                $('#saveinformation').button('loading');
                $.ajax({
                    type:'post',
                    url:'?mc=stdaccount&m=savestdguardian',
                    data:{
                        lastname:$('#lastname').val(),
                        firstname:$('#firstname').val(),
                        mi:$('#mi').val(),
                        namext:$('#namext').val(),
                        sex:$('#sex:checked').val(),
                        address:$('#address').val(),
                        contactnumber:$('#contactnumber').val(),
                        emailaddress:$('#emailaddress').val(),
                        relation:$('#relation').val()
                    },
                    dataType:"json",
                    success: function(r){
                        var statMsg = '';
                        if(r.status == 1) {
                            statMsg = (r.msg != '' || r.msg != null) ? r.msg : '<p>Guardian information saved</p>';
                            $('.modal-body').empty().append(statMsg);
                        } else {
                            statMsg = (r.msg != '' || r.msg != null) ? r.msg : '<p>An error occured while saving the guardian\'s information.  Make sure you have filled up the required fields</p>';
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
<?php $this->load->view('student/student_footer'); ?>