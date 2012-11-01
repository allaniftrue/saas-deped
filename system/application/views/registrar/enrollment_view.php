<?php $this->load->view('registrar/main_header_view'); ?>
<section id="expwrap">
    <div class="span11">
         <div class="page-header">
             <h1>Enrollment <small><strong>SY <span id="syInfo"><?=date('Y', strtotime($cursy[0]->sy_from))?> - <?=date('Y', strtotime($cursy[0]->sy_to))?></span></strong></small></h1>
         </div>
    </div>
    <div class="span12" > 
        <div class="span11">
     <p>
        <div class="btn-group">
          <button class="btn" data-toggle="dropdown"><i class="icon-star-empty"></i> Select Grade Level</button>
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
            <ul class="dropdown-menu">
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
          </ul>&nbsp;&nbsp;&nbsp;
          <span id="grdSelected" class="">
            <span class="label label-info">Selected </span>&nbsp;&nbsp;
            <strong>
                <span id="grd">
                    Grade <?=$lvls[0]->grd_year?>
                </span>
            </strong>
          </span>
        </div>
    </p>
    
    <p>
         <div class="btn-group">
            <button class="btn" data-toggle="dropdown"><i class="icon-star-empty"></i> Select The Section</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
            <ul class="dropdown-menu" id="secNames">
        <?php 
                $num = count($sections);
                if($num > 0) {
                    for($x=0;$x<$num;$x++) {
            ?>
            <li>
                <a href="javascript:void(0);" data-id="<?=$sections[$x]->sec_id?>" id="secVal"><?=$sections[$x]->sec_name?></a>
            </li>
           <?php   
                    }
                } else {
           ?>
            <li>
                <a>
                    <i>
                        No sections found for Grade <?=$lvls[0]->grd_year?> (<?=date('Y',strtotime($cursy[0]->sy_from))?> - <?=date('Y',strtotime($cursy[0]->sy_to))?>)
                    </i>
                </a>
            </li>
           <?php
                }
            ?>
            </ul>&nbsp;&nbsp;&nbsp;
            <span id="secSelected" class="">
                <span class="label label-info">Selected </span>&nbsp;&nbsp;
                    <strong>
                        <span id="sec">
            <?php if(! empty($sections[0]->sec_name)) {?>
            Section <?=$sections[0]->sec_name?>
            <?php } else { ?>
            <i>None</i>
            <?php } ?>
                        </span>
                    </strong>
            </span>
        </div>
    </p>
    </div>
    <br /><br />
    <div id="formHolder" class="row"><br />
        <div class="span11">
        <div class="span5 well">
            <h4>Student Information</h4><br />
            <form id="enrollmentForm">
            <p>
                <label for="idnumber">ID Number</label>
                <input type="text" data-provide="typeahead" class="input-xlarge" id="idnumber" validate="required:true,digits:true" title="Press the tab button to autofill fields after entering the ID NUMBER provided that the id is already in use or click the check link" /> <small><a href="javascript:void(0);" id="manualCheck"><i class="icon-repeat"></i>Check</a></small>
            </p>
            <p>
                <div class="row-fluid">
                    <div class="span5">
                    <label for="lastname">Last Name</label>
                    <input type="text" data-provide="typeahead" class="span12" id="lastname" validate="required:true" />
                    </div>
                    <div class="span3">
                    <label for="namext" >Name Ext.</label>
                    <input type="text" class="input-mini" id="namext" />
                    </div>
                </div>
            </p>
            <p>
                <label for="middlename">Middle Name</label>
                <input type="text" data-provide="typeahead" class="input-xlarge" id="middlename" validate="required:true" />
            </p>
            <p>
                <label for="firstname">First Name</label>
                <input type="text" data-provide="typeahead" class="input-xlarge" id="firstname" validate="required:true" />
            </p>
            <p>
                <label for="address">Address</label>
                <input type="text" class="input-xlarge" id="address" validate="required:true" />
            </p>
            <p>
                <button type="submit" class="btn btn-primary"><i class="icon-hdd icon-white"></i> Enroll Student</button>
                <span id="pdf" class="hide">
                    <a href="javascript:void(0);" id="print" class="btn btn-success" target="_blank" title="This will generate a printable form of the newly enrolled student"><i class="icon-print icon-white"></i> Print</a>
                </span>
            </p>
            </form>
            </div>
            <div class="span4">
                <div class="alert alert-info"><h4>Summary Of Selected Section</h4></div>
                <table class="table table-striped table-bordered table-condensed">
                    <tbody>
                        <tr>
                            <td><strong>School Year</strong></td>
                            <td>
                                <?=date('Y',strtotime($cursy[0]->sy_from))?> - <?=date('Y',strtotime($cursy[0]->sy_to))?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Grade Level</strong></td>
                            <td><?=$lvls[0]->grd_year?></td>
                        </tr>
                        <tr>
                            <td><strong>Section Name</strong></td>
                            <td><?=$sections[0]->sec_name?></td>
                        </tr>
                        <tr>
                            <td><strong># of Enrolled Students</strong></td>
                            <td>
                                <?=$num_stds?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="span4">
                <div class="alert alert-info"><h4>What to know</h4></div>
                <ul align="justify">
                    <li>
                        Make sure you have selected the right grade level and section name before enrolling a student.
                    </li>
                    <li>
                        Fill-in the ID NUMBER and press the tab key to auto-fill the fields if the ID NUMBER is already in use by the student or click the check link to manually check for stored information.
                    </li>
                    <li>
                        If the student is newly enrolled an account is included in the generated enrollment form.
                    </li>
                </ul>
            </div>
    </div></div>
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
</section>
</div><br /><br /><br />
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/jquery.tipsy.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>js/bootstrap-typeahead.js"></script>
<script type="text/javascript">
$(document).ready(function(){  
     
     var secidVal = <?=($sections[0]->sec_id) ? $sections[0]->sec_id : ''?>;
     var gidVal = <?=($lvls[0]->grd_id) ? $lvls[0]->grd_id : ''?>;
     
//     $('#print').bind('click',function() {
//            var dataId = $(this).attr('data-id');
//            
//     });
     
     $('#idnumber').typeahead({
        source: function(typehead,query){
            $.ajax({
               url:'?mc=regtools&m=fetch_idnumber',
               type:'POST',
               data:'query='+query,
               dataType:'JSON',
               async:false,
               success:function(data){ 
                   typehead.process(data);
               }
            });
            return false;
        }, 
        items:5
    });
    
     $('#idnumber').focusout(function(){
        var stdId = $(this).val();
        $.ajax({
            url:'?mc=regtools&m=fetch_student_info',
            type:'POST',
            data:'query='+stdId,
            dataType:'JSON',
            async:false,
            success:function(data){ 
              
               if(data == null) {
                    $('#lastname,#lastname,#firstname,#namext,#middlename,#address').val('');
               } else {
                    $('#lastname').val(data[0].std_lastname);
                    $('#lastname').val(data[0].std_lastname);
                    $('#firstname').val(data[0].std_firstname);
                    $('#namext').val(data[0].std_extname);
                    $('#middlename').val(data[0].std_middlename);
                    $('#address').val(data[0].std_address);
               }
               
            }
        });
     });
     $('#manualCheck').click(function(){
        $('#idnumber').focus();
        $('#lastname').focus();
     });
     
     $('#middlename').typeahead({
        source: function(typehead,query){
            $.ajax({
               url:'?mc=regtools&m=fetch_middlename',
               type:'POST',
               data:'query='+query,
               dataType:'JSON',
               async:false,
               success:function(data){ 
                   typehead.process(data);
               }
            });
            return false;
        }, 
        items:5
    });
    
    $('#lastname').typeahead({
        source: function(typehead,query){
            $.ajax({
               url:'?mc=regtools&m=fetch_lastname',
               type:'POST',
               data:'query='+query,
               dataType:'JSON',
               async:false,
               success:function(data){ 
                   typehead.process(data);
               }
            });
            return false;
        }, 
        items:5
    });
    
    $('#firstname').typeahead({
        source: function(typehead,query){
            $.ajax({
               url:'?mc=regtools&m=fetch_firstname',
               type:'POST',
               data:'query='+query,
               dataType:'JSON',
               async:false,
               success:function(data){ 
                   typehead.process(data);
               }
            });
            return false;
        }, 
        items:5
    });
    
    $('#secVal').live('click',function(){
       var dataid = $(this).attr('data-id');
       var txt = $(this).text();
       secidVal = dataid;
       
       $('#sec').empty().append('Section ' + txt);
       $('tbody td:eq(5)').empty().append(txt);
       if(dataid == '' || typeof dataid == 'undefined') {
           return false;
       } else {
           $.ajax({
                    url:'?mc=regtools&m=fetch_num_enrolled',
                    type:'POST',
                    data:{gid:gidVal,secid:secidVal},
                    success:function(data){ 
                        var json = $.parseJSON(data);
                        $('tbody td:eq(7)').empty().append(json.num);
                    }
            });
            return false;
       }
    });
    
    $('#grdlvl').live('click',function(){
        var dataid=$(this).attr('data-id');
        var syid = $(this).attr('sy-id');
        var txt = $(this).text();
        
        $('#sec').empty().append('<i>None</i>');
        $('tbody td:eq(3)').empty().append(txt);
        $('tbody td:eq(7),tbody td:eq(5)').empty();
        if(dataid == '') {
            return false;
        } else {
            var x = 0;
            //$('#gid').attr('value',dataid);
            gidVal = dataid;
            secidVal='';
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
                    
                    $('#grd').empty().append(txt);
                    $('#secNames').empty();

                    if(totalArray > 0) {
                        for(x; x<totalArray; x++) {
                               $('#secNames').append('<li><a href="javascript:void(0);" data-id="'+json.sections[x].sec_id+'" id="secVal">'+json.sections[x].sec_name+'</a></li>');
                        }
                    }else {
                        $('#secNames').append('<li><a href="javascript:void:(0)"><i>No sections found for '+txt+'</i></a></li>');
                    }
                    
                },
                error:function (xhr, ajaxOptions, thrownError){
                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                } 
            });
            return false;
        }
        return false;
    });
    $.metadata.setType("attr", "validate");
    $('#enrollmentForm').validate({
         
         submitHandler: function(){
         
            if(gidVal == '' || typeof gidVal == 'undefined' || gidVal == null) {
                $('#msg').empty().append('Unable to get the Grade Level');
                $('#myModal').modal();
            } else if(secidVal == '' || typeof secidVal == 'undefined' || secidVal == null) {
                $('#msg').empty().append('Unable to get the Section');
                $('#myModal').modal();
            } else {
                $.ajax({
                    type:'post',
                    url:'?mc=regtools&m=enroll_student',
                    cache:false,
                    data:{gid:gidVal,secid:secidVal,idnumber:$('#idnumber').val(),lastname:$('#lastname').val(),namext:$('#namext').val(),middlename:$('#middlename').val(),firstname:$('#firstname').val(),address:$('#address').val()
                    },
                    success:function(data){
                        var json = $.parseJSON(data);
                        $('#print').attr('href',json.href);
                        $('#msg').empty().append(json.msg);
                        $('#myModal').modal('show');
                        if(json.enrolled == 1) {
                            $('#pdf').show();
                        }             
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                    }
             });
            }
         }
    });
    
    $('#idnumber,#pdf a').tipsy({trigger:'focus',fade: true,gravity:'sw'});
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>