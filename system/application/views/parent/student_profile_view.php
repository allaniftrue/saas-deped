<?php $this->load->view('parent/header_view'); ?>
<section id="expwrap">
    <div class="span11">
         <div class="page-header">
             <h1>Student Profile</h1>
         </div>
    </div>
<div class="span12" > 
        <?php 
                $has_info = count($std_info);
                if($has_info > 0):
        ?>
        <div class="span5">
            <p>
                <div id="profile-pic-wrapper" class="thumbnail">
                    <?php $photo = ! empty($std_info[0]->std_photo) ? 'uploads/'.$std_info[0]->std_photo : 'img/user.png'; ?>
                    <img src="<?=base_url().$photo?>" />
                </div>
            </p>
            <p>
                <strong>School ID: </strong><?=$std_info[0]->std_sch_id?>
            </p>
            <p>
                <strong>Full Name: </strong><?=$std_info[0]->std_firstname?> <?=$std_info[0]->std_middlename?> <?=$std_info[0]->std_lastname?> <?=$std_info[0]->std_extname?>
            </p>
            <p>
                <strong>Sex: </strong><?=(! empty($std_info[0]->std_sex)) ? $std_info[0]->std_sex : '<em>Not available</em>'?>
            </p>
            <p>
                <strong>Address: </strong><?=!empty($std_info[0]->std_address) ? $std_info[0]->std_address : '<em>Not available</em>'?>
            </p>
            <p>
                <strong>Birth Date: </strong><?=($std_info[0]->std_dob != '0000-00-00') ? $std_info[0]->std_dob : '<em>Not available</em>'?>
            </p>
            <p>
                <strong>Contact Number: </strong><?=! empty($std_info[0]->std_contact) ? $std_info[0]->std_contact : '<em>Not available</em>'?>
            </p>
            <p>
                <strong>Email: </strong><?=! empty($std_info[0]->std_email) ? $std_info[0]->std_email : '<em>Not available</em>'?>
            </p>
            <p>
                <strong>Religion: </strong><?=! empty($std_info[0]->std_religion) ? $std_info[0]->std_religion : '<em>Not available</em>'?>
            </p>            
        </div>
        <div class="span5">
            <div class="page-header">
                <h3>Education History</h3>
            </div>
            <?php foreach($educ_history as $contents):?>
                <table class="table table-striped table-bordered table-condensed">
                    <tbody>
                        <tr>
                            <td><strong>School Year</strong></td>
                            <td><?=date('Y', strtotime($contents->sy_from)).' - '.date('Y', strtotime($contents->sy_to))?></td>
                        </tr>
                        <tr>
                            <td><strong>Grade Level</strong></td>
                            <td><?=$contents->grd_year?></td>
                        </tr>
                        <tr>
                            <td><strong>Section</strong></td>
                            <td><?=ucwords($contents->sec_name)?></td>
                        </tr>
                    </tbody>
                </table>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p>
            <em>No information found</em>
        </p>
        <?php endif; ?>
    </div>
    
<div id="myModal" class="modal hide fade">
<div class="modal-header">
    <button class="close" data-dismiss="modal">&times;</button>
    <h3>Result</h3>
</div>
    <div id="msg" class="modal-body">
    </div>
<br /><br />
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal" >Ok</a>
    </div>
</div>
</div>
</section>
<br /><br /><br />
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<?php $this->load->view('parent/footer_view'); ?>