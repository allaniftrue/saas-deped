<?php $this->load->view('deped/teacher/teacher_header_view'); ?>   
<?php $this->load->view('deped/teacher/sub_header_view'); ?>   
<div class="row-fluid">
<!-- main content -->
<div class="offset1"></div>
<div class="span11">
    <table class="table  table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th colspan="2">Inclusive Dates <small>(<em>mm/dd/yyyy</em>)</small></th>
                <th rowspan="2">Position Title</th>
                <th rowspan="2">Department/Agency/Office/Company</th>
                <th rowspan="2">Monthly Salary</th>
                <th rowspan="2">Salary Grade &<br />Step Increment<br /><small>(<em>Format 00-0</em>)</small></th>
                <th rowspan="2">Status of Appointment</th>
                <th rowspan="2">Government<br />Service</th>
            </tr>
            <tr>
                <th>From</th>
                <th>To</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $num=count($experience);
                if($num > 0) {
                    for($x=0; $x<$num;$x++):
            ?>
                        <tr>
                            <td><?=!empty($experience[$x]->wrk_from) ? date('m/d/Y',  strtotime($experience[$x]->wrk_from)) : ' '?></td>
                            <td><?=!empty($experience[$x]->wrk_to) ? date('m/d/Y',  strtotime($experience[$x]->wrk_to)) : ' '?></td>
                            <td><?=!empty($experience[$x]->wrk_position) ? $experience[$x]->wrk_position : ' '?></td>
                            <td><?=!empty($experience[$x]->wrk_department) ? $experience[$x]->wrk_department : ' '?></td>
                            <td><?=!empty($experience[$x]->wrk_salary) ? $experience[$x]->wrk_salary : ' '?></td>
                            <td><?=!empty($experience[$x]->wrk_salary_grade) ? $experience[$x]->wrk_salary_grade : ' '?></td>
                            <td><?=!empty($experience[$x]->wrk_stat_appoint) ? $experience[$x]->wrk_stat_appoint : ' '?></td>
                            <td><?=!empty($experience[$x]->wrk_gov_srv) ? $experience[$x]->wrk_gov_srv : ' '?></td>
                        </tr>
            <?php
                    endfor;
                } else {
            ?>
                <tr>
                    <td colspan="8"><em>No work experience</em></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>
<!-- end of main content -->
</div>
<p class="elapsed_time">Page rendered in {elapsed_time} seconds</p>
</body>
</html>