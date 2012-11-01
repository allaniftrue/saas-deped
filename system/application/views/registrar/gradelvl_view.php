<?php $this->load->view('registrar/main_header_view'); ?>
<section id="expwrap">
    <div class="span11">
         <div class="page-header">
             <h1>Grade Level <small>{ <span id="hsy"></span> }</small></h1>
         </div>
    </div>
<div class="span6" >

<div class="btn-group">
        <button class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <button class="btn" data-toggle="dropdown"><i class="icon-calendar"></i> Select School Year</button>
        <ul class="dropdown-menu">
            <?php 
                    $num = count($sys);
                    for($x=0;$x<$num;$x++) {
            ?>
            <li>
                <a href="javascript:void(0);" data-id="<?=$sys[$x]->sy_id?>" id="select">
                     SY <?=date('Y',  strtotime($sys[$x]->sy_from))?> - <?=date('Y',  strtotime($sys[$x]->sy_to))?>
                </a>
            </li>
            <?php
                    }
            ?>
        </ul>
        <button class="btn btn-primary" id="add"><i class="icon-plus-sign icon-white"></i> Add a Grade Level</button>
        <img src="<?=base_url()?>img/ajax-loader.gif" class="hide" id="preloader-sel" />
    </div>

    <form class="well form-inline hide" id="grdform">
        <input type="text" class="input-large" placeholder="Year levels (e.g. 1,2,3,4)" id="lvls">
        <button type="submit" class="btn" id="save"><i class="icon-hdd"></i> Save</button> <img src="<?=base_url()?>img/ajax-loader.gif" id="preloader" class="hide" />
    </form><br />
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th colspan="2" align="center"><input type="hidden" id="sid" value="" /><span id="sy"></span></th>
            </tr>
            <tr>
                <th>Grade Level</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="span5">
    <div class="alert alert-info">
        <h3>What to know</h3>
    </div>
     <ul>
        <li>The school year must be checked first before adding a year level.</li>
        <li>All year level must be unique</li>
        <li>If mistakenly added a year level, remove the entry and add the correct year level again</li>
        <li>Multiple year levels can be added separated by a comma (e.g. <em>pre-school,1,2,3,4,5,6,7</em>)</li>
     </ul>
</div>
<div id="myModal" class="modal hide fade">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">&times;</button>
        <h3>Result</h3>
    </div>
    <div class="modal-body">

    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal" id="ok">Ok</a>
        
    </div>
</div>
</section>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    
   function fetchInfo(vrid,txt) {
        $('#preloader-sel').show();
     
        $.ajax({
            type:'post',
            url:'?mc=regtools&m=fetchlvls',
            data:{
                did:vrid
            },
            success: function(msg) {
                var json = $.parseJSON(msg);
                $('tbody').append(json.tbl);
                if(txt === '') {
                    $('#sy,#hsy').empty().append(json.sy);
                }else {
                    $('#sy,#hsy').empty().append(txt);
                }
                $('#sid').val(json.sid);
                $('#preloader-sel').hide();
            },
            error:function (xhr, ajaxOptions, thrownError){
                $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                $('#preloader-sel').hide();
            } 
        });
   }
   
   fetchInfo('','');
   $('#add').click(function(){
        $('#grdform').slideToggle('slow');
        return false;
   });
   
   $('#save').click(function(){
        var lvls_str = $('#lvls').val();
        $.ajax({
           type:'post',
           url:'?mc=regtools&m=lvladd',
           data:{lvls:lvls_str,sid:$('#sid').val()},
           success: function(msg){
               $('#grdform').clearForm();
               var json = $.parseJSON(msg);
               $('.modal-body').empty().append(json.msg);
               $('#myModal').modal('show');
           },
           error:function (xhr, ajaxOptions, thrownError){
                $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                $('#preloader-sel').hide();
           } 
        });
        return false;
   });
   
   $('#select').live('click', function(){
      var curID = $(this).attr('data-id');
      var txt = $(this).text();
      $('tbody,#sy').empty();
      fetchInfo(curID,txt);
   });
   $('#ok').click(function(){ window.location.reload(true); });
   
   $('a#remove').live('click',function(){
      var did_val = $(this).attr("data-id");
      var conf = confirm("Are you sure you want to remove this grade level?");
      
      if(conf == true) {
          $.ajax({
                    type:'post',
                    url:'?mc=regtools&m=rmlvl',
                    data:{did:did_val},
                    success: function(msg){
                        var json = $.parseJSON(msg);
                        
                        $('.modal-body').empty().append(json.msg);
                        
                        if(json.status === 0) {
                            return false;
                        } else {
                            $('tr#'+did_val).remove('slow');
                        }
                                           
                        $('#myModal').modal('show');
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                            $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                            $('#preloader-sel').hide();
                    } 
          });
      } else {
          return false;
      }
      
   });
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>
