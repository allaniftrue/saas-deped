<?php $this->load->view('teacher/main_header_view'); ?>
<section class="span11">
    <div class="page-header">
            <h1 class="">
                Student List <small id="sytop">SY <?=date('Y', strtotime($sys[0]->sy_from))?> - <?=date('Y', strtotime($sys[0]->sy_to))?></small>
            </h1>
    </div>
    <div class="span8">
        <div class="alert alert-info">
            <strong>Grade and Section:</strong> <em><?=$subject_info[0]->grd_year?> <?=$subject_info[0]->sec_name?></em><br />
            <strong>Subject</strong>: <em><?=$subject_info[0]->sub_name?></em>
        </div>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>ID #</th>
                    <th>Student Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list as $key => $val):?>
                    <tr>
                        <td><?=$key+1?></td>
                        <td>
                            <?=$val->std_sch_id?>
                        </td>
                        <td>
                            <a href="?mc=regtools&m=complete_info&stdid=<?=$val->std_id.'&sess='.random_string('alnum', 64).'&al='.random_string('alnum', 64)?>" target="_blank" title="View student profile" id="tips"><?=$val->std_lastname?>, <?=$val->std_firstname?></a>
                        </td>
                        <td>
                            <a class="btn" href="javascript:void(0);" id="grade" data-id="<?=$val->std_id?>"><i class="icon-user"></i> Grades</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
     </div>
</section>
<div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"></h3>
  </div>
  <div class="modal-body">
      <div class="alert alert-info" id="subjinfo"></div>
      <table class="table table-condensed table-striped">
          <thead>
              <tr>
                  <th></th>
                  <th>Grade</th>
                  <th>Remarks</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>1st Quarter</td>
                  <td><input type="text" class="input input-mini" id="1stgrade" /></td>
                  <td><textarea rows="1" id="1stremark" class="span3"></textarea></td>
              </tr>
              <tr>
                  <td>2nd Quarter</td>
                   <td><input type="text" class="input input-mini" id="2ndgrade" /></td>
                  <td><textarea rows="1" id="2ndremark" class="span3"></textarea></td>
              </tr>
              <tr>
                  <td>3rd Quarter</td>
                   <td><input type="text" class="input input-mini" id="3rdgrade" /></td>
                  <td><textarea rows="1" id="3rdremark" class="span3"></textarea></td>
              </tr>
              <tr>
                  <td>4th Quarter</td>
                   <td><input type="text" class="input input-mini" id="4thgrade" /></td>
                  <td><textarea rows="1" id="4thremark" class="span3"></textarea></td>
              </tr>
          </tbody>
      </table>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" id="save-grade">Save changes</button>
  </div>
</div>
<script src="<?=base_url()?>js/bootstrap-transition.js"></script>
<script src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-alert.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/bootstrap-button.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/jquery.tipsy.js"></script>
<script src="<?=base_url()?>js/jquery.autosize-min.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var syidVal=<?=$subject_info[0]->sy_id?>;
    var gidVal=<?=$subject_info[0]->grd_id?>;
    var secidVal=<?=$subject_info[0]->sec_id?>;
    var subidVal=<?=$subject_info[0]->sub_id?>;
    var curid='';
    var studentId='';
    
    $('#grade').live('click', function() {
        
            var dataidVal=$(this).attr('data-id');
            
            $.ajax({
                        type:'post',
                        url:'?mc=mysubjects&m=studgrade',
                        data:{syid:syidVal,gid:gidVal,secid:secidVal,subid:subidVal,dataid:dataidVal},
                        dataType:'json',
                        success: function(resp) {
                           studentId=resp.student[0].std_id;
                           $('#myModalLabel').empty().append(resp.student[0].std_lastname+', '+resp.student[0].std_firstname+'&nbsp;'+resp.student[0].std_middlename+'&nbsp;'+resp.student[0].std_extname);
                           $('#subjinfo').empty().append('<strong>School Year:</strong> '+resp.info[0].schfrom+' - '+resp.info[0].schto+'<br />'+'<strong>Grade & Section:</strong> '+resp.info[0].grd_year+' '+resp.info[0].sec_name+'<br /><strong>Subject:</strong> '+resp.info[0].sub_name);
                           if(resp.result.length > 0) {
                                curid = resp.result[0].gra_id;
                                $('#1stgrade').empty().val(resp.result[0].gra_1st);
                                $('#2ndgrade').empty().val(resp.result[0].gra_2nd);
                                $('#3rdgrade').empty().val(resp.result[0].gra_3rd);
                                $('#4thgrade').empty().val(resp.result[0].gra_4th);
                                $('#1stremark').empty().val(resp.result[0].gra_1st_remarks);
                                $('#2ndremark').empty().val(resp.result[0].gra_2nd_remarks);
                                $('#3rdremark').empty().val(resp.result[0].gra_3rd_remarks);
                                $('#4thremark').empty().val(resp.result[0].gra_4th_remarks);
                           } else {
                                curid = '';
                                $('#1stgrade').empty().val();
                                $('#2ndgrade').empty().val();
                                $('#3rdgrade').empty().val();
                                $('#4thgrade').empty().val();
                                $('#1stremark').empty().val();
                                $('#2ndremark').empty().val();
                                $('#3rdremark').empty().val();
                                $('#4thremark').empty().val();
                           }
                        }
            });
            $('#myModal').modal({
                backdrop: true,
                keyboard: true
            }); return false;
    });
    $('#save-grade').click(function(){
        $('#save-grade').button('loading');
        var firstgradeVal=$('#1stgrade').val();
        var firstremarkVal=$('#1stremark').val();
        var secondgradeVal=$('#2ndgrade').val();
        var secondremarkVal=$('#2ndremark').val();
        var thirdgradeVal=$('#3rdgrade').val();
        var thirdremarkVal=$('#3rdremark').val();
        var fourthgradeVal=$('#4thgrade').val();
        var fourthremarkVal=$('#4thremark').val();
        
        $.ajax({
                type:'post',
                url:'?mc=mysubjects&m=savesubject',
                data:{syid:syidVal,gid:gidVal,secid:secidVal,subid:subidVal,stdid:studentId,firstgrade:firstgradeVal,firstremark:firstremarkVal,secondgrade:secondgradeVal,secondremark:secondremarkVal,thirdgrade:thirdgradeVal,thirdremark:thirdremarkVal,fourthgrade:fourthgradeVal,fourthremark:fourthremarkVal,cur_Id:curid},
                dataType:'json',
                success: function(resp) {
                    if(resp.status > 0) {
                        alert('Grade saved!');
                    } else {
                        alert('Failed to save grade!');
                    }
                }
        });
        $('#save-grade').button('reset');
        return false;
    });
    $('#tips').tipsy({live:true,gravity:'sw'});
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>