<?php $this->load->view('deped/teacher/teacher_header_view'); ?>   
<?php $this->load->view('deped/teacher/sub_header_view'); ?>   
<div class="row-fluid">
<!-- main content -->
<div class="offset1"></div>
    <div class="span11">
        <table class="table table-condensed table-bordered table-striped">
            <tr>
                <th>Surname</th>
                <td colspan="3"><?=$inf[0]->inf_surname?></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td colspan="3"><?=$inf[0]->inf_firstname?></td>
            </tr>
            <tr>
                <th>Middle Name</th>
                <td><?=$inf[0]->inf_middlename?></td>
                <th>Name Extension</th>
                <td><?=$inf[0]->inf_name_ext?></td>
            </tr>
            <tr>
                <th>Date of Birth (mm/dd/yyyy)</th>
                <td><?=date('m/d/Y',strtotime($inf[0]->inf_dob))?></td>
                <td></td><td></td>
            </tr>
            <tr>
                <th>Sex</th>
                <td><?=($inf[0]->inf_sex === 'M') ? 'Male' : 'Female'?></td>
                <th>Residential Address</th>
                <td><?=$inf[0]->inf_res_address?></td>

            </tr>
            <tr>
                <th>Civil Status</th>
                <td><?=$inf[0]->inf_civil_status?></td>
                <th>Zip Code</th>
                <td><?=$inf[0]->inf_res_zip_code?></td>
            </tr>
            <tr>
                <th>Citizenship</th>
                <td><?=$inf[0]->inf_citizenship?></td>
                <th>Telephone Number</th>
                <td><?=$inf[0]->inf_telno?></td>
            </tr>
            <tr>
                <th>Height (m)</th>
                <td><?=$inf[0]->inf_height?></td>
                <th>Permanent Address</th>
                <td><?=$inf[0]->inf_perm_address?></td>
            </tr>
            <tr>
                <th>Weight (kg)</th>
                <td><?=$inf[0]->inf_weight?></td>
                <th>Zip Code</th>
                <td><?=$inf[0]->inf_perm_zip_code?></td>
            </tr>
            <tr>
                <th>Blood Type</th>
                <td><?=$inf[0]->inf_blood_type?></td>
                <th>Telephone Number</th>
                <td><?=$inf[0]->inf_contact_num?></td>
            </tr>
            <tr>
                <th>GSIS ID Number</th>
                <td><?=$inf[0]->inf_gsis_id?></td>
                <th>Email Address</th>
                <td><?=$inf[0]->usr_email?></td>
            </tr>
            <tr>
                <th>PAG-IBIG ID Number</th>
                <td><?=$inf[0]->inf_pagibig?></td>
                <th>Cellphone Number</th>
                <td><?=$inf[0]->inf_mobile_number?></td>
            </tr>
            <tr>
                <th>PHILHEALTH Number</th>
                <td><?=$inf[0]->inf_philhealth?></td>
                <th>Agency Employee Number</th>
                <td><?=$inf[0]->inf_agency_emp_no?></td>
            </tr>
            <tr>
                <th>SSS Number</th>
                <td><?=$inf[0]->inf_sss?></td>
                <th>TIN</th>
                <td><?=$inf[0]->inf_tin?></td>
            </tr>
        </table>
    </div>
<!-- end of main content -->
</div>
<p class="elapsed_time">Page rendered in {elapsed_time} seconds</p>
</body>
</html>