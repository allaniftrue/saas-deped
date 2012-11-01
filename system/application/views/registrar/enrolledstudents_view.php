<?php $this->load->view('registrar/main_header_view'); ?>
<section id="expwrap">
<div class="span11">
     <div class="page-header">
         <h1>Section <?=ucwords($secname[0]->sec_name)?><small> { SY <span id="syInfo"><?=date('Y', strtotime($sy[0]->sy_from))?> - <?=date('Y', strtotime($sy[0]->sy_to))?> </span>}</small></h1>
     </div>
</div>
<div class="span6" >
    <h4>List of students enrolled in this section</h4>
    <table class="table table-striped table-bordered table-condensed">
        <tr>
            <th>#</th>
            <th>ID Number</th>
            <th>Full Name</th>
            <th>Action</th>
        </tr>
        <?php
            $num_res = count($result);
            if($num_res > 0):
                for($x=0; $x < $num_res; $x++):
        ?>
        <tr>
            <td><?=$x+1?></td>
            <td><?=$result[$x]->std_sch_id?></td>
            <td><a href="javascript:void(0);" title="Click to view student's basic information" data-id="<?=$result[$x]->std_id?>" id="profile"><?=$result[$x]->std_lastname?>, <?=$result[$x]->std_firstname?> <?=ucfirst(substr($result[$x]->std_middlename,0,1))?>.</a></td>
            <!-- Actions -->
            <td>
                <div class="btn-group">
                    <a href="#" class="btn">Actions</a>
                    <a href="#" data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#"><i class="icon-pencil"></i> Transfer</a></li>
                      <li><a href="?mc=regtools&m=complete_info&stdid=<?=$result[$x]->std_id.'&sess='.random_string('alnum', 64).'&al='.random_string('alnum', 64)?>"><i class="icon-user"></i> View Complete Profile</a></li>
                      <li><a href="javascript:void(0);" id="unenroll" data-id="<?=$result[$x]->enr_id?>"><i class="icon-remove"></i> Unenroll</a></li>
                    </ul>
               </div>
            </td>
        </tr>
        <?php
                endfor;
           else:
        ?>
        <tr>
            <td colspan="4"><em>No students enrolled on this section.</em></td>
        </tr>
        <?php endif; ?>
    </table>
</div>
<div class="span5">
    <div class="alert alert-info">
        <h3>Sections on this grade level</h3>
    </div>
    <table class="table table-bordered table-condensed">
        <tbody>
            <?php
                foreach($same_sections as $sec):
            ?>
            <tr>
                <td>
                    <a href="?mc=regtools&m=enrolledstudents&sy=<?=$sec->sy_id."&secd=".$sec->sec_id.'&sess='.random_string('alnum', 64).'&al='.random_string('alnum', 64)?>"><?=ucwords($sec->sec_name)?></a>
                </td>
            </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>
    
    
    
    <div class="alert alert-info">
        <h3>What to know</h3>
    </div>
     <ul>
        <li>Every new school year sections should be added</li>
        <li>Sections should be unique.  Sections found on other grade levels are not added</li>
        <li align="justify">If mistakenly added a section, remove the section by clicking the actions menu and add the section</li>
        <li>Multiple sections can be added by separating each section with a new line. An example can be seen below</li>
            <br />
            <p>
                <strong>Example</strong><br />
            <div class="span4">
                Farad<br />
                Einstein<br />
                Pascal<br />
                Aristotle
            </div>
            </p>
        
     </ul>
</div>
<div id="myModal" class="modal hide fade">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">&times;</button>
        <h3 id="title">Student Information</h3>
    </div>
    <div id="msg" class="modal-body">
        <div id="profile-pic-wrapper" class="span3">
            
        </div>
        <div class="span3" id="info">
            <table class="table table-striped table-bordered table-condensed">
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
<br /><br />
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal" >Ok</a>
    </div>
</div>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/jquery.tipsy.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#unenroll').live('click',function() {
        var curId = $(this).attr('data-id');
        var $item = $(this);
        var conf = confirm('Are you sure you want to unenroll this student?');
        
        if(conf) {
            $.ajax({
                type:'POST',
                url:'?mc=regtools&m=rmenrolled',
                data:{id:curId},
                dataType:'json',
                success: function(response) {
                    if(response.stats == 1) {
                        $item.parents('tr').hide('slow');
                    } else {
                        $('#title').empty().append('Result');
                        $('#msg').empty().append('Failed to unenroll the student');
                        return false;
                    } 
                }
            }); 
        }
        
        return false;
    });
    
    $('#profile').live('click',function(){
        var curId = $(this).attr('data-id');
        $.ajax({
            type:'POST',
            url:'?mc=regtools&m=profile',
            data:{proid:curId},
            dataType:'json',
            success:function(response) {
                $('#title').empty().append('Basic Student Information');
                var xtname = (response[0].std_extname != '' && response[0].std_extname != null) ? response[0].std_extname : '';
                var sex = ((response[0].std_sex != '' && response[0].std_sex != null) || response[0].std_sex == 'NULL') ? response[0].std_sex : ' <em>not defined</em>';
                var address = (response[0].std_address != '' && response[0].std_address != null) ? response[0].std_address : ' <em>not defined</em>';
                var contact = (response[0].std_contact != '' && response[0].std_contact != null) ? response[0].std_contact : ' <em>not defined</em>';
                var dob = (response[0].std_dob != '0000-00-00' && response[0].std_dob != null) ? response[0].std_dob : ' <em>not defined</em>';
                var religion = (response[0].std_religion != '' && response[0].std_religion != null) ? response[0].std_religion : ' <em>not defined</em>';
                $('#info tbody').empty().append('<tr><td><strong>ID</strong></td><td>'+response[0].std_sch_id+'</td></tr><tr><td><strong>Name</strong></td><td>'+ response[0].std_firstname + ' ' + response[0].std_middlename+ ' ' +response[0].std_lastname+ ' ' +xtname+'</td></tr><tr><td><strong>Sex</strong></td><td>'+sex+'</td></tr><tr><td><strong>Address</strong></td><td>'+address+'</td></tr><tr><td><strong>Contact</strong></td><td>'+contact+'</td></tr><tr><td><strong>Birth Date</strong></td><td>'+dob+'</td></tr><tr><td><strong>Religion</strong></td><td>'+religion+'</td></tr>');
                $('#myModal').modal('show');
            }
        });
    });
    $('#profile').tipsy({live:true,gravity:'w',trigger:'hover',fade:true});
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>