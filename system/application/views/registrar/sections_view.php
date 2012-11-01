<?php $this->load->view('registrar/main_header_view'); ?>
<section id="expwrap">
    <div class="span11">
         <div class="page-header">
             <h1>Sections  <small> { SY <span id="syInfo"><?=date('Y', strtotime($cursy[0]->sy_from))?> - <?=date('Y', strtotime($cursy[0]->sy_to))?> </span>}</small></h1>
         </div>
    </div>
<div class="span6" >
    <p>
        <div class="btn-group">
            <button class="btn" data-toggle="dropdown"><i class="icon-calendar"></i> Select School Year</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
            <ul class="dropdown-menu">
                <?php
                    $num = count($sys);
                    for($x=0; $x<$num; $x++) {
                ?>
                <li><a href="#" id="sy" data-id="<?=$sys[$x]->sy_id?>">SY <?=date('Y',  strtotime($sys[$x]->sy_from))?> - <?=date('Y',  strtotime($sys[$x]->sy_to))?></a></li>
                <?php
                    }
                ?>
            </ul>&nbsp;&nbsp;
            <img src="<?=base_url()?>img/ajax-loader.gif" id="sypreloader" class="hide" />
            <span class="label label-info" id="sySelected">Selected </span>&nbsp;&nbsp; <strong>SY <span id="syInfo"><?=date('Y', strtotime($cursy[0]->sy_from))?> - <?=date('Y', strtotime($cursy[0]->sy_to))?></span></strong>
        </div>
    </p>
    
    <p>
        <div class="btn-group">
          <button class="btn" data-toggle="dropdown"><i class="icon-star-empty"></i> Select Grade Level</button>
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu" id="grdlvl">
            <?php
                $num = count($lvls);
                if($num == 0) {
            ?>
                    <li><a href="javascript:void(0);"><i>No grade levels found</i></a></li>
            <?php
                }else{
                    for($x=0; $x<$num; $x++) {
            ?>
              <li><a href="javascript:void(0);" id="grdlvl" data-id="<?=$lvls[$x]->grd_id?>" sy-id="<?=$lvls[$x]->sy_id?>">Grade <?=$lvls[$x]->grd_year?></a></li>
            <?php
                    }
                }
            ?>
          </ul>&nbsp;&nbsp;
          <span id="grdSelected" class="">
            <span class="label label-info">Selected </span>&nbsp;&nbsp;<strong><span id="grd">Grade <?=$lvls[0]->grd_year?></span></strong>
          </span>
        </div>
    </p>
    
    <p>
        
    </p>
    <p class="" id="addSecHolder">
        <button type="button" id="addSec" class="btn btn-primary btn-mini">
            <i class="icon-plus-sign icon-white"></i> Add Sections 
        </button>
    </p> 
    <p>
        <div class="well hide"  id="secForm">
            <form class="form-inline">
                <p>
                    <textarea id="secNames" placeholder="Add the sections for your chosen grade level" class="input-xxlarge"></textarea>
                    <input type="hidden" id="sid" value="<?=$cursy[0]->sy_id?>" />
                    <input type="hidden" id="gid" value="<?=$lvls[0]->grd_id?>"/>
                </p>
                <p>
                    <button class="btn" id="saveSec" type="button">
                        <i class="icon-hdd"></i> Save Section Names
                    </button>
                </p>
            </form>
        </div>
    </p>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
               <th>Section Name</th>
               <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $num = count($sections);
                if($num > 0) {
                    for($x=0;$x<$num;$x++) {
           ?>
            <tr id="tr<?=$sections[$x]->sec_id?>">
                <td><?=$sections[$x]->sec_name?></td>
                <td>
                    <div class="btn-group">
                        <button class="btn" data-toggle="dropdown">Actions</button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          
                            <li><a href="javascript:void(0);" data-id="<?=$sections[$x]->sec_id?>" id="remove"><i class="icon-trash"></i> Remove</a></li>
                            <li>
                                <a href="javascript:void(0);" id="viewenrolled" data-id="<?=$sections[$x]->sec_id?>"><i class="icon-th-large"></i> Enrolled Students</a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
           <?php   
                    }
                } else {
           ?>
            <tr>
                <td colspan="3"><i>No sections found for Grade <?=$lvls[0]->grd_year?> (<?=date('Y',strtotime($cursy[0]->sy_from))?> - <?=date('Y',strtotime($cursy[0]->sy_to))?>)</i></td>
            </tr>
           <?php
                }
            ?>
        </tbody>
    </table>
   
</div>
<div class="span5">
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
    <h3>Result</h3>
</div><br />
    <div id="msg" class="modal-body">
    </div>
<br /><br />
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal" >Ok</a>
    </div>
</div>
<?php //mc=regtools&m=enrolledstudents&sess=<?=random_string('alnum', 64).'&s='.$sections[$x]->sec_id.'&k='.random_string('alnum', 32); ?>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
    $('#viewenrolled').live('click',function(){
        var syId = $('#sid').attr('value');
        var secId = $(this).attr('data-id');
        window.location.href='<?=base_url()?>?mc=regtools&m=enrolledstudents&sy='+syId+'&secd='+secId+'&sess=<?=random_string('alnum', 64)?>&al=<?=random_string('alnum', 64)?>';
    });
    
    $('#remove').live('click',function(){
        var dataid=$(this).attr('data-id');
        
        if(dataid == '') {
            $('#msg').empty().append('Failed to determine which section you want to remove');
        } else {
            var conf = confirm('Are you sure you want to remove this section?');
            if(conf){
                $.ajax({
                        type:'post',
                        url:'?mc=regtools&m=rmsection',
                        data:{sid:dataid},
                        success: function(msg) {
                            var json = $.parseJSON(msg);
                            if(json.status === 1) {
                                $('#msg').empty().append('Section successfully removed');
                     
                                $('tr#tr'+dataid).hide('slow');
                            } else {
                                $('#msg').empty().append('Failed to remove the section');
                            }$('#myModal').modal('show');
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                        } 
                });return false;
            }else {return false;}
        }
    });
    $('#saveSec').click(function(){
        var sections=$('#secNames').val();
        if(sections.length > 0) {
            
            var sid_val = $('#sid').val();
            var gid_val = $('#gid').val();
            var secNames_val = $('#secNames').val();
            
            $.ajax({
                type:'post',
                url:'?mc=regtools&m=addsections',
                data:{sid:sid_val,gid:gid_val,secNames:secNames_val},
                success:function(msg){
                    $('#secForm').find('textarea').val('');
                    var json = $.parseJSON(msg);
                    
                    $('#msg').empty().append('<p>'+json.msg+'</p>');
                    $('#myModal').modal('show');
//                    $.alert(json.msg,'Result');
                    if(json.is_first == 1) {
                        $('tbody').empty().append(json.tb_data);
                    } else {
                        $('tbody').append(json.tb_data);
                    }
                    
                    
                },
                error:function (xhr, ajaxOptions, thrownError){
                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
//                    $('#sypreloader').hide();
               } 
            });
        } else {
            $.alert('You should add at least 1 section name', 'Error');
        }
    });
    
    $('#addSec').click(function() {
        $('#secForm').toggle('fast');
        $('#secNames').focus();
    });
    
    $('#sy').live('click',function(){
        var dataid = $(this).attr('data-id');
        var sySelected = $(this).text().replace('SY','');
        
        $('#sid').attr('value',dataid);
        $('#sypreloader').show();
        $('#grdSelected').hide('slow');
        $('tbody').empty().append('<tr><td colspan="2"><i>Select a Grade Level</i></td></tr>');
        $('[id=syInfo]').empty().append(sySelected);
        $('#secForm,#addSecHolder').hide(2000);
        $('#secForm').find('textarea').val('');
        if(dataid != '') {
            $.ajax({
               type:'post',
               url:'?mc=regtools&m=fetchselectedlvl',
               data:{sid:dataid},
               success:function(msg){
                    var json = $.parseJSON(msg);
                    var totalArray = (typeof json.result != 'undefined') ? json.result.length : 0;
                    var x = 0;
                    
                    $('#grdlvl').empty();
                    if(totalArray > 0) {
                        for(x; x<totalArray; x++) {
                            $('#grdlvl').append('<li><a href="javascript:void(0);" sy-id="'+json.result[x].sy_id+'" data-id="'+json.result[x].grd_id+'" id="grdlvl">Grade '+json.result[x].grd_year+'</a></li>');
                        }
                    }else {
                        $('#grdlvl').append('<li><a href="javascript:void(0);">No Grade Levels Found</a></li>');
                    }
                    $('#sypreloader').hide();
                  
               },
               error:function (xhr, ajaxOptions, thrownError){
                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                    $('#sypreloader').hide();
               } 
            }); return false;
        } else {
            return false;
        }
    });

    $('#grdlvl').live('click',function(){
        var dataid=$(this).attr('data-id');
        var syid = $(this).attr('sy-id');
        var txt = $(this).text();
        
        if(dataid == '') {
            return false;
        } else {
            
            var x = 0;
            $('#gid').attr('value',dataid);
            $('#secForm').hide(1000);
            $.ajax({
                type:'post',
                url:'?mc=regtools&m=fetchsections',
                cache:false,
                data:{gid:dataid,sid:syid},
                success:function(msg) {
                    var json = $.parseJSON(msg);
                    var totalArray = (typeof json.sections != 'undefined') ? json.sections.length : 0;              
                    var sySelected = $('#sy').text();
                    
                    $('#grdSelected,#addSecHolder').show('slow');
                    $('#grd').empty().append(txt);
                    $('tbody').empty();
                    if(totalArray > 0) {
                        for(x; x<totalArray; x++) {
                            $('tbody').append('<tr id="tr'+json.sections[x].sec_id+'"><td>'+json.sections[x].sec_name+'</td><td><div class="btn-group"><button class="btn" data-toggle="dropdown">Actions</button><button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button><ul class="dropdown-menu"><li><a href="javascript:void(0);" data-id="'+json.sections[x].sec_id+'" id="remove"><i class="icon-trash"></i>Remove</a></li><li><a href="javascript:void(0);" id="viewenrolled" data-id="'+json.sections[x].sec_id+'"><i class="icon-th-large"></i> Enrolled Students</a></li></ul></div></td></tr>');
                        }
                    }else {
                        $('tbody').append('<tr><td colspan="2"><i>No sections found for '+txt+'</i> (SY '+sySelected+')</td></tr>');
                    }
                    
                },
                error:function (xhr, ajaxOptions, thrownError){
                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                    //$('#sypreloader').hide();
                } 
            });
            return false;
        }
        return false;
    });
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>