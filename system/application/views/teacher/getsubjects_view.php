<?php $this->load->view('teacher/main_header_view'); ?>
<section class="span11">
    <div class="page-header">
            <h1 class="">
                Get Subjects <small>SY <?=date('Y', strtotime($cursy[0]->sy_from))?> - <?=date('Y', strtotime($cursy[0]->sy_to))?></small>
            </h1>
    </div>

    <p>
        <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown"  data-loading-text="Loading..." id="grd-mustload">Select Grade Level</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <?php foreach ($levels as $cont): ?>
                    <li><a href="javascript:void(0);" id="grade" data-id="<?=$cont->grd_id?>">Grade <?=$cont->grd_year?></a></li>
                <?php endforeach; ?>
            </ul>
            &nbsp;&nbsp;
            <span class="label label-info">Selected  </span>&nbsp;<span id="selectedgrade">Grade <?=$levels[0]->grd_year?></span>
        </div>
    </p><!-- End of grade levels -->
    
    <p>
        <div class="btn-group">
            <button class="btn dropdown-toggle" data-toggle="dropdown"  data-loading-text="Loading..." id="sec-mustload">Select The Section</button>
            <button class="btn dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" id="sectionList">
                <?php $num_res = count($sections); if($num_res > 0) foreach ($sections as $cont): ?>
                    <li><a href="javascript:void(0);" id="section" data-id="<?=$cont->sec_id?>"><?=$cont->sec_name?></a></li>
                <?php endforeach; ?>
            </ul>
            &nbsp;&nbsp;
            <span class="label label-info">Selected </span>&nbsp;<span id="selectedsection"><?=$sections[0]->sec_name?></span>
        </div>
    </p>
    <div class="page-header">
        <h3>Available Subjects</h3>
    </div>
    <div class="row subjectslist" id="subjectsHolder">
        <?php foreach($subjects as $cont): ?>
        <div class="span3">
            <label class="checkbox" id="tips" title="Click if you will handle this subject">
                <input type="checkbox" value="<?=$cont->sub_id?>" name="subjects[]" id="subjval" data-id="<?=$cont->sub_id?>"> <?=$cont->sub_name?>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
    <br /><br />
    <div class="page-header">
        <h3>Subjects With Teachers</h3>
    </div>
    <div class="row subjectslist" id="subjectsHolder2">
        <?php foreach($taken_subjects as $val): ?>
        <div class="span3">
            <label class="checkbox muted" id="tips" title="Was added by <b><?=$val->inf_firstname?> <?=$val->inf_surname?></b>">
                <?=$val->sub_name?>
            </label>
        </div>
        <?php endforeach;?>
    </div>
    <br /><hr />
    <span class="label label-info">Note </span>&nbsp;Select the subjects that you will be handling. The subject selected will automatically be saved on your profile.
</section>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-alert.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/bootstrap-button.js"></script>
<script src="<?=base_url()?>js/jquery.tipsy.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(function(){
    var secidVal=<?=$sections[0]->sec_id?>;
    var gidVal=<?=$levels[0]->grd_id?>;
    
    $('#section').live('click',function(){
        var dataid=$(this).attr('data-id');
        var txt=$(this).text();
        secidVal=dataid;
        $('#sec-mustload').button('loading');
        $('#selectedsection').empty().append(txt).fadeIn();
        $.ajax({
                    type:'post',
                    url:'?mc=getsubjects&m=fetch_subjects',
                    data:{gid:gidVal,secid:secidVal},
                    dataType:'json',
                    success: function(response) {
                        var responseLn = response.result1.length;
                        var result2Ln = response.result2.length;
                        
                        if(responseLn > 0) {
                            $('#subjectsHolder').empty();
                            for(var i=0; i < responseLn; i++) {
                                $('#subjectsHolder').append('<div class="span3"><label class="checkbox" id="tips" title="Click if you will handle this subject"><input type="checkbox" value="'+response.result1[i].sub_id+'" name="subjects[]" id="subjval" data-id="'+response.result1[i].sub_id+'">'+response.result1[i].sub_name+'</label></div>').fadeIn();
                            }
                        } else {
                            $('#subjectsHolder').empty().append('<div class="span11"><p><em>No subjects found</em></p></div>').fadeIn();
                        }
                        
                        if(result2Ln > 0) {
                            $('#subjectsHolder2').empty();
                                for(var i=0; i < responseLn; i++) {
                                $('#subjectsHolder2').append('<div class="span3"><label class="checkbox" id="tips" title="Was added by '+response.result2[i].inf_firstname+' '+response.result2[i].inf_surname+'">'+response.result2[i].sub_name+'</label></div>').fadeIn();
                            }
                        } else {
                            $('#subjectsHolder2').empty().append('<div class="span11"><p><em>No subjects assigned</em></p></div>').fadeIn();
                        }
                        
                        
                        $('#sec-mustload').button('reset');
                    },
                    error: function() {
                        $('#sec-mustload').button('reset');
                    }
        });
        
        return false;
    });
    
    $('#grade').live('click',function() {
        var dataid = $(this).attr('data-id');
        gidVal = dataid;
        
        $('#grd-mustload').button('loading');
        $('#selectedgrade').empty().append($(this).text());
        $('#selectedsection,#subjectsHolder,#subjectsHolder2').fadeOut();
        
        $.ajax({
            type:'post',
            url:'?mc=getsubjects&m=fetch_sections',
            data:{gid:gidVal},
            dataType:'json',
            success: function(response) {
                var responseLn = response.length;
                $('#sectionList').empty();
                if(responseLn > 0) {
                    for(var i=0; i<responseLn;i++) {
                        $('#sectionList').append('<li><a href="javascript:void(0);" id="section" data-id="'+response[i].sec_id+'">'+response[i].sec_name+'</a></li>')
                    }
                } else {
                   $('#sectionList').append('<li><a href="javascript:void(0);"><em>No sections for this grade level</em></a>'); 
                };
                $('#grd-mustload').button('reset');
            },
            error:function() {
                $('#grd-mustload').button('reset');
            }
        });
        
    });
    
    $('#subjval').live('change',function(){
        var $this = $(this);
        var $val = $this.attr('data-id');

        if(this.checked) {
            $.ajax({
                type:'post',
                url:'?mc=getsubjects&m=save_subj',
                data:{gid:gidVal,secid:secidVal,subid:$val},
                dataType:'json',
                success: function(resp) {
                    if(resp.status == 0) {
                       $this.hide().closest('label').css('background','#F2DEDE').attr('title','Failed to add the subject to your work load.');
                    } else {
                        $this.hide().closest('label').css('background','#DFF0D8').attr('title','Was successfully added to you work load.');
                    } return false;
                }
            });
        }
        return false;
    });
    
    $('#tips').tipsy({live:true,trigger:'hover',gravity:'sw',opacity:1,html:true});
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>