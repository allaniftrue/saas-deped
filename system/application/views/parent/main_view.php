<?php $this->load->view('parent/header_view'); ?>
<!-- main -->
<div class="span5">
    <div class="page-header">
        <h3>Students Affiliated</h3>
    </div>
    <table class="table table-striped table-condensed">
        <thead>
            <tr>
                <th>Student Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                    $total = count($students);
                    for($x=0; $x<$total; $x++):
            ?>
            <tr>
                <td>
                    <a href="<?=base_url()?>?mc=parent_main&m=student_info&stdid=<?=$students[0]->std_id?>" rel="tooltip" id="tips" title="Click to view student information">
                        <?=$students[$x]->std_lastname?>, 
                        <?=$students[$x]->std_firstname?> 
                        <?=$students[$x]->std_middlename?> 
                        <?=$students[$x]->std_extname?>.
                    </a>
                </td>
                <td>
                        <div class="btn-group">
                            <button class="btn btn-mini btn-primary">Action</button>
                            <button class="btn btn-mini btn-primary dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?=base_url()?>?mc=parent_main&m=guardian_info&id=<?=$students[$x]->grd_id?>">
                                        <i class="icon-leaf"></i> Relationship to Student
                                    </a>
                                </li>
                                <li>
                                    <a href="<?=base_url()?>?mc=parent_main&m=grades&id=<?=$students[$x]->std_id?>">
                                        <i class="icon-star"></i> Grades
                                    </a>
                                </li>
                            </ul>
                        </div>
                </td>
            </tr>
            <?php   endfor; ?>
        </tbody>
    </table>
</div>
<!-- End of main -->
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.tipsy.js"></script>
<script type="text/javascript">
$(function(){
    $('#tips').tipsy({live:true,gravity: 'sw',opacity:1});
});
</script>
<?php $this->load->view('parent/footer_view'); ?>