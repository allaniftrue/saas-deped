<?php $this->load->view('teacher/main_header_view'); ?>
<section class="span11">
    <div class="page-header">
            <h1>
                Handled Subjects <small id="sytop">SY <?=date('Y', strtotime($sys[0]->sy_from))?> - <?=date('Y', strtotime($sys[0]->sy_to))?></small>
            </h1>
    </div>
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
    <div class="page-header"><br />
            <h2>
                Subject Lists
            </h2>
    </div>
    <div id="lolbox">
        <?php foreach($mysubjects as $cont): ?>
        <div class="span3 well well-small subjectHolder" id="subjectHolder">
            <?=$cont->sub_name?> - <?=$cont->grd_year.' '.$cont->sec_name?>
            <hr />
            <small>
                <a href="?mc=mysubjects&m=studlist&t=<?=rand(1,9999)?>&sess=<?=random_string('alnum', 64)."&tcs=".$cont->sub_id."&k=".random_string('alnum', 32); ?>" id="tips" rel="tooltip" data-placement="right" data-original-title="This will show the student list">
                    <i class="icon-list"></i> Details
                </a>
                &nbsp;&middot;&nbsp; 
                <a href="javascript:void(0);" id="withdraw" data-id="<?=$cont->tcs_id?>">
                        <i class="icon-remove-circle"></i> Withdraw
                </a>
            </small>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-alert.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/bootstrap-button.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/bootstrap-tooltip.js"></script>
<script src="<?=base_url()?>js/bootstrap-popover.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(function(){
    $('#withdraw').live('click',function() {
        var conf=confirm('Are you sure you want to withdraw this?');
        if(conf) {
            var $this=$(this);
            var dataidVal=$this.attr('data-id');
            $.ajax({
                    type:'post',
                    url:'?mc=mysubjects&m=withdraw',
                    data:{dataid:dataidVal},
                    dataType:'json',
                    success: function(resp) {
                        if(resp.status == 1) {
                            $this.parents('#subjectHolder').slideUp();
                        } else {
                            $this.parents('#subjectHolder').css('border','1px solid red');
                        }
                    }
            });
        }
    });
    $('#thesy').live('click',function(){
        var dataid = $(this).attr('data-id');
        $('#mustload').button('loading');
        $.ajax({
            type:'post',
            url:'?mc=mysubjects&m=mysubjectsonsy',
            data:{syid:dataid},
            dataType:'json',
            success: function(response) {
                var responseLn = response.result.length;
                if(responseLn > 0) {
                    $('#lolbox').empty();
                    if(response.status == 1) {
                         for(var i=0; i<responseLn; i++) {
                             $('#lolbox').append('<div class="span3 well well-small subjectHolder"  id="subjectHolder">'+response.result[i].sub_name+' - '+response.result[i].grd_year+' '+response.result[i].sec_name+'<hr /><small><a href="?mc=mysubjects&m=studlist&t='+response.result[i].url+'" id="tips" rel="tooltip" data-placement="right" data-original-title="This will show the student list"><i class="icon-list"></i> Details</a> &nbsp;&middot;&nbsp; <a href="javascript:void(0);" id="withdraw" data-id="'+response.result[i].tcs_id+'"><small><i class="icon-remove-circle"></i> Withdraw</small></a></small></div>');
                        }   
                    } else {
                        for(var i=0; i<responseLn; i++) {
                            $('#lolbox').append('<div class="span3 well well-small subjectHolder"  id="subjectHolder">'+response.result[i].sub_name+' - '+response.result[i].grd_year+' '+response.result[i].sec_name+'<hr /><small><a href="?mc=mysubjects&m=studlist&t='+response.result[i].url+'" id="tips" rel="tooltip" data-placement="right" data-original-title="This will show the student list"><i class="icon-list"></i> Details</a></small></div>');
                        }  
                    }
                }
                $('#mustload').button('reset');
            }
        });
    });
    $('[id^=tips]').tooltip({animation:'fade',opacity:1});
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>