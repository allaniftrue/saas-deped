<?php $this->load->view('deped/header_view'); ?>
<!-- main -->
 <div class="page-header">
     <h2 class="padleft">
            Work Load <small id="sytop">SY <?=date('Y', strtotime($sys[0]->sy_from))?> - <?=date('Y', strtotime($sys[0]->sy_to))?></small>
     </h2>
</div>
<div class="well well-small span11">
    <b>Teacher's Name:</b> <?=$current_teacher[0]->inf_surname.', '.$current_teacher[0]->inf_firstname.' '.$current_teacher[0]->inf_middlename.' '.$current_teacher[0]->inf_name_ext?>
</div>
<div class="span11">
    <p>
        <div class="btn-group">
            <button class="btn btn-primary" data-loading-text="Loading..." id="mustload"><i class="icon-calendar icon-white"></i> Select School Year</button>
            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <?php foreach($sys as $sy) { ?>
                <li>
                    <a href="javascript:void(0);" id="thesy" data-id="<?=$sy->sy_id?>"><?=date('Y', strtotime($sy->sy_from))?> - <?=date('Y', strtotime($sy->sy_to))?></a>
                </li>
              <?php } ?>
            </ul>
            <img src="<?=base_url()?>img/ajax-loader.gif" id="preloader" class="hide" />
        </div>
    </p>
    <table class="table table-bordered table-condensed table-condensed">
        <thead>
            <tr>
                <th>Subject Name</th>
                <th>Grade & Section</th>
                <th># of Students</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $num = count($subjects);
                if($num > 0):
                    for($x=0; $x<$num;$x++):
            ?>
            <tr>
                <td><?=$subjects[$x]['sub_name']?></td>
                <td><?=$subjects[$x]['grd_year']." &middot; ".$subjects[$x]['sec_name']?></td>
                <td><?=$subjects[$x][0]?></td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-small">Action</button>
                        <button class="btn dropdown-toggle btn-small" data-toggle="dropdown">
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="icon-eye-open"></i> View Students</a></li>
                        </ul>
                      </div>
                </td>
            </tr>
            <?php endfor; else: ?>
            <tr>
                <td colspan="4"><em>No subjects handled</em></td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<!-- End of main -->
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-transition.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.tipsy.js"></script>
<script type="text/javascript">
$(function(){
    $('#tips').tipsy({live:true,gravity: 'sw',opacity:1});
});
</script>
<?php $this->load->view('deped/footer_view'); ?>