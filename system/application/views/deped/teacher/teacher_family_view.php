<?php $this->load->view('deped/teacher/teacher_header_view'); ?>   
<?php $this->load->view('deped/teacher/sub_header_view'); ?>   
<div class="row-fluid">
<!-- main content -->
<div class="offset1"></div>
    <div class="span6">
        <table class="table table-condensed table-bordered table-striped">
            <tr>
                <th>Spouse's Surname</th>
                <td><?=$inf->inf_spouse_surname?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?=$inf->inf_spouse_fname?></td>
            </tr>
            <tr>
                <th>Middle Name</th>
                <td><?=$inf->inf_spouse_middlename?></td>
            </tr>
            <tr>
                <th>Occupation</th>
                <td><?=$inf->inf_spouse_occupation?></td>
            </tr>
            <tr>
                <th>Employer's Name</th>
                <td><?=$inf->inf_spouse_employer_name?></td>
            </tr>
            <tr>
                <th>Business Address</th>
                <td><?=$inf->inf_spouse_business_add?></td>
            </tr>
            <tr>
                <th>Telephone Number</th>
                <td><?=$inf->inf_spouse_buss_telno?></td>
            </tr>
            <tr>
                <th colspan="2">&nbsp;</th>
            </tr>
            <tr>
                <th>Father's Surname</th>
                <td><?=$inf->inf_father_lname?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?=$inf->inf_father_fname?></td>
            </tr>
            <tr>
                <th>Middle Name</th>
                <td><?=$inf->inf_father_mname?></td>
            </tr>
            <tr>
                <th colspan="2">Mother's Maiden Name</th>
            </tr>
            <tr>
                <th>Surname</th>
                <td><?=$inf->inf_mother_lname?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?=$inf->inf_mother_fname?></td>
            </tr>
            <tr>
                <th>Middle Name</th>
                <td><?=$inf->inf_mother_mname?></td>
            </tr>
        </table>
    </div>
    <div class="span4">
        <table class="table table-condensed table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name of child</th>
                    <th>Date of birth</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $min = ($num_child > 14) ? $num_child : 14;
                    for($x=0; $x<$min; $x++):
                ?>
                <tr>
                    <?php if(! empty($child[$x]->chl_fullname) && ! empty($child[$x]->chl_dob)): ?>
                    <td><?=$child[$x]->chl_fullname?></td>
                    <td><?=date('m/d/Y' ,strtotime($child[$x]->chl_dob))?></td>
                    <?php else: ?>
                    <td>&nbsp;</td><td>&nbsp;</td>
                    <?php endif; ?>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
<!-- end of main content -->
</div>
<p class="elapsed_time">Page rendered in {elapsed_time} seconds</p>
</body>
</html>