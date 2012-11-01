<?php $this->load->view('registrar/main_header_view'); ?>
<section id="expwrap">
    <div class="span11">
         <div class="page-header">
            <h1>School Year</h1>
         </div>
    </div>
<div class="span6" >
    <p>
        <a href="javascript:void(0);" id="add" class="btn btn-primary">
            <i class="icon-plus-sign icon-white"></i> Add New School Year
        </a>
    </p>
    <form class="well form-inline hide" id="syform">
        <input type="date" class="input-large" placeholder="Start of school year" id="from">
        <input type="date" class="input-large" placeholder="End of school year" id="to">
        <button type="submit" class="btn"><i class="icon-hdd"></i> Save</button> <img src="<?=base_url()?>img/ajax-loader.gif" id="preloader" class="hide" />
    </form>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $num = count($sys);
                for($x=0;$x<$num;$x++) {
           ?>
            <tr>
                <td><?=date( 'F d, Y',  strtotime($sys[$x]->sy_from));?></td>
                <td><?=date( 'F d, Y',  strtotime($sys[$x]->sy_to));?></td>
                <td>
                    <div class="btn-group">
                        <button class="btn" data-toggle="dropdown">Actions</button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="javascript:void(0);" data-id="<?=$sys[$x]->sy_id?>" id="edit">
                                    <i class="icon-edit"></i> Edit</a>
                            </li>
                            <li><a href="javascript:void(0);" data-id="<?=$sys[$x]->sy_id?>" id="remove"><i class="icon-trash"></i> Remove</a></li>
                        </ul>
                    </div>
                </td>
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
        <li>Adding of school year must be done first before doing other transactions such as enrollment of students</li>
        <li>All school year must be unique</li>
        <li align="justify">If mistakenly added the dates you can edit the dates or you can remove the school year provided that there are no data added. An example of the a data added for the school year is adding of teachers</li>
     </ul>
</div>
</span>
<div id="myModal" class="modal hide fade">
<div class="modal-header">
    <button class="close" data-dismiss="modal">&times;</button>
    <h3>School Year Dates</h3>
</div>
<form id="changedateform" novalidate="" method="post">
    <div class="modal-body">

        <p>
            <span class="label label-info">Notes:</span> Changes are only made if the month and day are being changed.  Changes on the year can also be made provided that the school year is non-existing.  The date format is yyyy-mm-dd <em>(e.g. June 05, 2012 is 2012-06-05) </em>
        </p> 
        <hr>
        <p>
        <h4>School Year dates:</h4>
        <form class="well form-inline " id="syform">
            <input type="date" class="input-large" placeholder="Start of school year" id="fromedit">
            <input type="date" class="input-large" placeholder="End of school year" id="toedit">
            <input type="hidden" class="dataid" />
        </form>
        </p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal" >Close</a>
        <a href="#" class="btn btn-primary" id="changedates">Change the dates</a> <img src="<?=base_url()?>img/ajax-loader.gif" class="hide" id="preloader0" />
    </div>
</form>
</div>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/bootstrap-modal.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
       $('#remove').live('click',function(){
          var dataid = $(this).attr('data-id');
          var txt = $('.dataid').attr('id');
          
          var conf = confirm('Are you sure you want to remove this school year '+txt+' ?');
          
//          $.ajax({
//                    type:'post',
//                    url:'?mc=regtools&m=remsy',
//                    data:{did:dataid},
//                    
//          });
       });
       $('#add').click(function(){
            $('#syform').slideToggle('slow');
       });
       $("#from,#fromedit").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                dateFormat:'yy-mm-dd',
                numberOfMonths: 1,
                onSelect: function( selectedDate ) {
                        $( "#to,#toedit" ).datepicker( "option", "minDate", selectedDate );
                }
       });
       $("#to,#toedit").datepicker({
                defaultDate: "+9m",
                changeMonth: true,
                dateFormat:'yy-mm-dd',
                numberOfMonths: 1,
                onSelect: function( selectedDate ) {
                        $( "#from,#fromedit" ).datepicker( "option", "maxDate", selectedDate);
                }
       });
       
       $("#syform").validate({
           rules:{
               from: 'required',
               to:'required'
           },
           errorPlacement: function(error, element) {
                error.insertAfter(element.parent().find('label:first'));
           },
           submitHandler:function() {
               $('#preloader').show();
               $.ajax({
                   type:'post',
                   url:'?mc=regtools&m=syadd',
                   data:{
                       dfrom:$('#from').val(),
                       dto:$('#to').val()
                   },
                   cache:'false',
                   success: function(msg){
                       var json = $.parseJSON(msg); 
                       $.alert(json.msg,'Status');
                       $('form').clearForm();
                       $('#preloader').hide();
                   },
                   error:function (xhr, ajaxOptions, thrownError){
                       $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                       $('#preloader').hide();
                   } 
               });
           }
       });
       
       $('#edit').live('click',function(){
          var $data_id = jQuery(this).attr('data-id');
          jQuery("#myModal").find('.dataid').attr('id', $data_id);
          jQuery('#myModal').modal('show');
          return false;
       });
       
       jQuery('#changedateform').validate();
       $('#changedates').click(function(){
           var did_val=jQuery("#myModal").find('.dataid').attr('id');
           var from_val = $('#fromedit').val();
           var to_val = $('#toedit').val();
           var ValidStatus = jQuery("#changedateform").valid();
           
           if(ValidStatus === false) {
            return false;
           } else {
            jQuery('#preloader0').show();
            
            $.ajax({
                type:'post',
                url:'?mc=regtools&m=syupdate',
                cache:false,
                data:{
                    did:did_val,
                    dfrom:from_val,
                    dto:to_val
                },
                success: function(msg) {
                    jQuery('#myModal').modal('hide');
                    
                    var json = jQuery.parseJSON(msg);
                    if(json.status === 0) {
                        jQuery.alert(json.msg,'Error');
                    } else {
                        jQuery.alert(json.msg,'Success',function(){
                            window.location.reload(true);
                        });
                        
                    }
                    
                    jQuery("#preloader0").hide();
                },
                error:function (xhr, ajaxOptions, thrownError){
                    jQuery.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                    jQuery("#preloader0").hide();
                } 
            });
            return false;
            
           }
       });
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>
