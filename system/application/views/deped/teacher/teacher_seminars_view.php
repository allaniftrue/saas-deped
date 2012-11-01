<?php $this->load->view('deped/teacher/teacher_header_view'); ?>   
<?php $this->load->view('deped/teacher/sub_header_view'); ?>   
<div class="row-fluid">
<!-- main content -->
<div class="offset1"></div>
<div class="span11">
    <table class="table  table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th rowspan="2">Title of Seminar/Conference/Workshop/Short Courses</th>
                <th colspan="2">Inclusive Dates of Attendance</th>
                <th rowspan="2">Number of Hours</th>
                <th rowspan="2">Conducted / Sponsored By</th>
            </tr>
            <tr>
                <th>From</th>
                <th>To</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $num = count($training);
                if($num === 0):
                    
            ?>
            <tr>
                <td colspan="6"><em>No trainings attended.</em></td>
            </tr>
            <?php else: for($x=0; $x<$num;$x++):?>
            <tr>
                <td><?=! empty($training[$x]->tra_title) ? $training[$x]->tra_title : ''?></td>
                <td><?=! empty($training[$x]->tra_from) ? date('M d, Y',strtotime($training[$x]->tra_from)) : ''?></td>
                <td><?=! empty($training[$x]->tra_to) ? date('M d, Y',strtotime($training[$x]->tra_to)) : ''?></td>
                <td><?=! empty($training[$x]->tra_hours) ? $training[$x]->tra_hours : ''?></td>
                <td><?=! empty($training[$x]->tra_sponsor) ? $training[$x]->tra_sponsor : ''?></td>
            </tr>
            <?php endfor; endif; ?>
        </tbody>
    </table>
</div>
<!-- end of main content -->
</div>
<p class="elapsed_time">Page rendered in {elapsed_time} seconds</p>
</body>
</html>