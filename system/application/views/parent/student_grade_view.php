<?php $this->load->view('parent/header_view'); ?>
<!-- main -->
<div class="page-header">
    <h1 class="padleft">Grades</h1>
</div>
<div class="span7">
    <div class="btn-group">
      <button class="btn btn-primary"><i class="icon-calendar icon-white"></i> Select A School Year</button>
      <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
          <?php
            $tmp_stack = array();
            $num = count($mysys);
            for($x=0; $x<$num; $x++) {
                
                if(!in_array($mysys[$x]->sy_id, $tmp_stack)){
                    array_push($tmp_stack, $mysys[$x]->sy_id);
          ?>        
                    <li>
                        <a href="javascript:void(0);" data-id="<?=$mysys[$x]->sy_id?>" id="cursy"> 
                            SY <?=date('Y',  strtotime($mysys[$x]->sy_from))?> - <?=date('Y',  strtotime($mysys[$x]->sy_to))?>
                        </a>
                    </li>
          <?php
                }
            }
          ?>
      </ul>
    </div>
    <br /><br />
</div>
<div class="span4">
    <div class="alert alert-info">
        Information
    </div>
    <p align="justify">
        You can only see the years that the student has enrolled to the school.
    </p>
</div>
<div class="clearfix"></div>
<div class="page-header">
        <h3 class="padleft" id="selectedsy">SY <?=date('Y',  strtotime($mysys[0]->sy_from))?> - <?=date('Y',  strtotime($mysys[0]->sy_to))?></h3>
</div>
<div class="span11">
    <div class="well well-small">
        <strong>Name : </strong><?=$student_info[0]->std_firstname.' '.$student_info[0]->std_lastname.' '.$student_info[0]->std_extname?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
        <strong>Grade Level : </strong><?=$mysys[0]->grd_year?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 
        <strong>Section : </strong><?=$mysys[0]->sec_name?>
       
    </div>
    <?php
            $tmp_stack = array();
            $total = count($sublist);
            if($total > 0) {
    ?>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                 <th colspan="2"></th>
                 <th colspan="4">Quarter Grades</th>
                 <th></th>
            </tr>
            <tr>
                <th rowspan="2">Subject</th>
                <th rowspan="2">Teacher</th>
                <th>1st</th>
                <th>2nd</th>
                <th>3rd</th>
                <th>4th</th>
                <th rowspan="2">Final</th>
            </tr>
        </thead>
        <tbody>
    <?php
                for($x=0; $x<$total; $x++) {
                    if(!in_array($sublist[$x]->sub_id, $tmp_stack)) {
                        array_push($tmp_stack, $sublist[$x]->sub_id);
    ?>
        <tr>
            <td>
                <?=$sublist[$x]->sub_name?>
            </td>
            <td>
                <?=safe_mailto($sublist[$x]->usr_email,$sublist[$x]->inf_surname.', '.$sublist[$x]->inf_firstname)?>
            </td>
            <td>
                <span data-content="<?=$sublist[$x]->gra_1st_remarks?>" data-original-title="Remark"><?=($sublist[$x]->gra_1st) ? $sublist[$x]->gra_1st.' <i class="icon-comment"></i>' : ''?></span>
            </td>
            <td>
                <span data-content="<?=$sublist[$x]->gra_2nd_remarks?>" data-original-title="Remark"><?=($sublist[$x]->gra_2nd) ? $sublist[$x]->gra_2nd.' <i class="icon-comment"></i>' : ''?></span>
            </td>
            <td>
                <span data-content="<?=$sublist[$x]->gra_3rd_remarks?>" data-original-title="Remark"><?=($sublist[$x]->gra_3rd) ? $sublist[$x]->gra_3rd.' <i class="icon-comment"></i>' : ''?></span>
            </td>
            <td>
                <span data-content="<?=$sublist[$x]->gra_4th_remarks?>" data-original-title="Remark"><?=($sublist[$x]->gra_4th) ? $sublist[$x]->gra_4th.' <i class="icon-comment"></i>' : ''?></span>
            </td>
            <td></td>
        </tr>
    <?php
                    }
                }
            } else {
                echo '<em>No quarterly grades given</m>';
            }
    ?>
        </tbody>
    </table>
</div>
<script src="<?=base_url()?>js/bootstrap-tooltip.js"></script>
<script src="<?=base_url()?>js/bootstrap-popover.js"></script>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   var studId = getUrlVars()['id'];
   $('*').popover({trigger:"hover",placement:"top"}) ;
   $('#cursy').live('click', function(){
       var dataidVal = $(this).attr('data-id');
       $.ajax({
           type:'post',
           url:'?mc=student_main&m=get_grades',
           data:{sid:dataidVal,id:studId},
           dataType:'json',
           success: function(response) {
                var gradeLn = response.length;
                $('tbody').empty();
                if(gradeLn > 0) {
                    for(var i=0; i < gradeLn; i++) {
                        var grade1st = (response[i].gra_1st!=0) ? response[i].gra_1st+' <i class="icon-comment"></i>' : '';
                        var grade2nd = (response[i].gra_2nd!=0) ? response[i].gra_2nd+' <i class="icon-comment"></i>' : '';
                        var grade3rd = (response[i].gra_3rd!=0) ? response[i].gra_3rd+' <i class="icon-comment"></i>' : '';
                        var grade4th = (response[i].gra_4th!=0) ? response[i].gra_4th+' <i class="icon-comment"></i>' : '';
                        $('tbody').append('<tr><td>'+response[i].sub_name+'</td><td><a href="mailto:'+response[i].usr_email+'">'+response[i].inf_surname+', '+response[i].inf_firstname+'</a></td><td><span data-content="'+response[i].gra_1st_remarks+'" data-original-title="Remark">'+grade1st+'</span></td><td><span data-content="'+response[i].gra_2nd_remarks+'" data-original-title="Remark">'+grade2nd+'</span></td><td><span data-content="'+response[i].gra_3rd_remarks+'" data-original-title="Remark">'+grade3rd+'</span></td><td><span data-content="'+response[i].gra_4th_remarks+'" data-original-title="Remark">'+grade4th+'</span></td><td></td></tr>');
                    }
                 }else {
                     $('tbody').append('<tr><td collspan="7"></td></tr>');
                 }

           }
       });
       
   });
});
</script>
<!-- End of main -->
<?php $this->load->view('parent/footer_view'); ?>