<?php $this->load->view('registrar/main_header_view'); ?>
<section id="expwrap">
    <div class="span11">
         <div class="page-header">
             <h1>Subjects <small> { SY <span id="syInfo"><?=date('Y', strtotime($cursy[0]->sy_from))?> - <?=date('Y', strtotime($cursy[0]->sy_to))?> </span>}</small></h1>
         </div>
    </div>
<div class="span6" >
    <form id="subjectsForm">
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
            <span class="label label-info" id="sySelected">Selected </span>&nbsp; <strong>SY <span id="syInfo"><?=date('Y', strtotime($cursy[0]->sy_from))?> - <?=date('Y', strtotime($cursy[0]->sy_to))?></span></strong>
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
            <span class="label label-info">Selected </span>&nbsp;<strong><span id="grd">Grade <?=$lvls[0]->grd_year?></span></strong>
          </span>
        </div>
    </p>
    
    <!-- Sections -->
    <p>
        <div class="btn-group">
          <button class="btn" data-toggle="dropdown"><i class="icon-th-large"></i> Select The Section</button>
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu" id="sections">
            <?php
                $num = count($sections);
                if($num == 0) {
            ?>
                    <li><a href="javascript:void(0);"><i>No Section found for this grade level</i></a></li>
            <?php
                }else{
                    for($x=0; $x<$num; $x++) {
            ?>
              <li><a href="javascript:void(0);" id="indisec" sec-id="<?=$sections[$x]->sec_id?>"><?=$sections[$x]->sec_name?></a></li>
            <?php
                    }
                }
            ?>
          </ul>&nbsp;&nbsp;
          <span id="secSelected" class="">
            <span class="label label-info">Selected </span>&nbsp;<strong><span id="sec"><?=$sections[0]->sec_name?></span></strong>
          </span>
        </div>
    </p>
    <hr />
    <p>
        Existing Subjects:
        <div id="subjholder">
            <?php
                foreach($subjects as $indv) {
                    echo '
                            <span class="box">
                                <strong>'.
                                    $indv->sub_name.
                                '</strong>&nbsp; 
                                <a href="javascript:void(0);" id="rmsubj" data-id="'.$indv->sub_id.'" title="Remove this subject">x</a></span>&nbsp;';
                }
            ?>
            <img src="<?=base_url()?>img/ajax-loader.gif" id="preloader-listsubj" class="hide" />
        </div>
    </p><br />
    <p>
        <label>Subjects:</label>
        <textarea validate="required:true" name="subjects" placeholder="Add the subjects offered on the curret section separatedby a comma..." class="input input-xxlarge" id="newsubjects" id="newsubjects"></textarea>
    </p>
    <p>
        <button id="save" type="submit" class="btn btn-primary">
            <i class="icon-hdd icon-white"></i> Add Subjects
        </button> <img src="<?=base_url()?>img/ajax-loader.gif" id="preloader" class="hide" />
    </p>
</form>
</div>
<div class="span5">
    <div class="alert alert-info">
        <h3>What to know</h3>
    </div>
     <ul>
         <li>Subjects must be added on every section</li>
         <li>Existing Subjects will be ignored</li>
         <li>
             <p>Below is an example of how to add the subjects</p>
             <p class="well">
                Filipino<br />
                English<br />
                Mathematics<br />
                Science & Health <br />
                MAKABAYAN<br />
                HeKaSi <br />
                EPP <br />
                MSEP <br />
                Character Education<br />
             </p>
         </li>
        
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
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/jquery.masonry.min.js"></script>
<script src="<?=base_url()?>js/modernizr-transitions.js"></script>
<script src="<?=base_url()?>js/jquery.autosize-min.js"></script>
<script src="<?=base_url()?>js/jquery.tipsy.js"></script>
<script src="<?=base_url()?>js/application.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    var sid=<?=$cursy[0]->sy_id?>,gid=<?=$lvls[0]->grd_id?>, secid=<?=$sections[0]->sec_id?>;
    $('#rmsubj').live('click',function(){
        var conf=confirm('Are you sure you want to remove this subject?');  
        if(conf) {
            var curId=$(this).attr('data-id');
            var curBox=$(this);
            $.ajax({
                type:'POST',
                url:'?mc=regtools&m=rmsubj',
                data:{subjid:curId},
                success: function() {
                    curBox.parents("span").hide('slow');
                },
                error:function (xhr, ajaxOptions, thrownError){
                    $('#msg').empty().append('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                    $('#myModal').modal('show');
                }   
            }); return false;
        } return false;
    });
    $('textarea').autosize();  
    $.metadata.setType("attr", "validate");
    var validator = $("#subjectsForm").validate({
                                                    errorClass: "error",
                                                    errorPlacement:function(error, element) {
                                                        $(this).addClass('error');
                                                    },
                                                    submitHandler: function() { 
                                                        $('#preloader').show();
                                                        $.ajax({
                                                            type:'post',
                                                            url:'?mc=regtools&m=sv_subjects',
                                                            data:{syid:sid,grid:gid,seid:secid,subjects:$('#newsubjects').val()},
                                                            success:function(data) {                                                               
                                                                $.ajax({
                                                                        type:'POST',
                                                                        url:'?mc=regtools&m=fetch_subjects',
                                                                        data:{syid:sid,grid:gid,seid:secid},
                                                                        dataType:"json",
                                                                        success: function(response){
                                                                            var dataLn = response.length;
                                                                            var x=0;
                                                                           
                                                                            $('#subjholder').empty();
                                                                            for(x; x < dataLn; x++) {
                                                                                $('#subjholder').append('<span class="box"><strong>'+response[x].subject+'</strong>&nbsp;<a href="javascript:void(0);" id="rmsubj" data-id="'+response[x].uid+'" title="Remove this subject">x</a></span>&nbsp;').masonry('reload');
                                                                            }
                                                                            
                                                                        }, 
                                                                        error:function (xhr, ajaxOptions, thrownError){
                                                                            $('#subjholder').empty().append('Sorry there was an error: '+'xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                                        }  
                                                                });
                                                                $('#preloader').hide();
                                                                $('#subjectsForm').clearForm();
                                                                //$('#msg').empty().append(data);
                                                                //$('#myModal').modal('show');
                                                                return false;
                                                            },
                                                            error:function (xhr, ajaxOptions, thrownError){
                                                                $('#preloader').hide();
                                                                $('#msg').empty().append('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                                $('#myModal').modal('show');
                                                            }   
                                                        }); return false;
                                                    }
                    });
    
    $('#sy').live('click',function(){
        var dataid = $(this).attr('data-id');
        var sySelected = $(this).text().replace('SY','');
        sid = dataid;
        gid='';
        secid='';
        $('#sections').empty().append('<em>Must select a grade level</em>');
        $('#sypreloader').show();
        $('#grdSelected,#secSelected').hide('slow');
        $('[id=syInfo]').empty().append(sySelected);
        $('#secForm,#addSecHolder').hide(2000);
        $('#secForm').find('textarea').val('');
        if(dataid != '') {
            $('#sec').hide();
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
            $('#sec,#secSelected').hide('slow');
            
            gid=dataid;
            secid='';
            var x = 0;
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
                    
                    if(totalArray > 0) {
                        $('#sections').empty();
                        for(x; x<totalArray; x++) {
                            $('#sections').append('<li><a href="javascript:void(0);" sec-id="'+json.sections[x].sec_id+'" id="indisec">'+json.sections[x].sec_name+'</a></li>');
                        }
                    }else {
                        $('#sections').empty().append('<li><a href="javascript:void(0)"><em>No sections on current grade level</em></a></li>');
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
    
    $('#indisec').live('click',function() {
        secid = $(this).attr('sec-id');
        var txt = $(this).text();
        $('#secSelected,#sec').show('slow');
        $('#sec').empty().append(txt);
        $('#preloader-listsubj').show();
        $.ajax({
            type:'POST',
            url:'?mc=regtools&m=fetch_subjects',
            data:{syid:sid,grid:gid,seid:secid},
            dataType:"json",
            success: function(response){
                $('#preloader-listsubj').hide();
                //$('#subjholder').empty().append('');
                //console.log(data);
                var dataLn = response.length;
                var x=0;
                $('#subjholder').empty();
                if(dataLn > 0) {
                    for(x; x < dataLn; x++) {
                        $('#subjholder').append('<span class="box"><strong>'+response[x].subject+'</strong>&nbsp;<a href="javascript:void(0);" id="rmsubj" data-id="'+response[x].uid+'" title="Remove this subject">x</a></span>&nbsp;').masonry('reload');
                    }
                } else {
                    $('#subjholder').empty().append('<i>No  subjects found</i>');
                }
            },
            error:function (xhr, ajaxOptions, thrownError){
                $('#preloader-listsubj').hide();
                $('#msg').empty().append('xhr status: '+xhr.status + '\n Error:'+ thrownError);
            }   
        });
        
        
    });   
    
    $('#subjholder').masonry({
                        itemSelector: '.box',
                        isAnimated: !Modernizr.csstransitions
    });
    
    $('a#rmsubj').tipsy({live:true,gravity:'w',title:'title',trigger:'hover'});
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>