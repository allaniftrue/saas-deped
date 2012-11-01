<?php $this->load->view('deped/teacher/teacher_header_view'); ?>   
<?php $this->load->view('deped/teacher/sub_header_view'); ?>   
<div class="row-fluid">
<!-- main content -->
<div class="offset1"></div>
<div class="span11">
    <table class="table  table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th rowspan="2">Career Service/RA1080 (Board/Bar) Under Special Laws/CES/CSEE</th>
                <th rowspan="2">Rating</th>
                <th rowspan="2">Date of Examination/Conferment</th>
                <th rowspan="2">Place of Examination/Conferment</th>
                <th colspan="2">Licensure</th>
            </tr>
            <tr>
                <th>Number</th>
                <th>Date of Release</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $num = count($civil_service);
                if($num === 0):
                    
            ?>
            <tr>
                <td colspan="6"><em>No exams taken</em></td>
            </tr>
            <?php else: for($x=0; $x<$num;$x++):?>
            <tr>
                <td><?=! empty($civil_service[$x]->cvl_career_service) ? $civil_service[$x]->cvl_career_service : ''?></td>
                <td><?=! empty($civil_service[$x]->cvl_rating) ? $civil_service[$x]->cvl_rating : ''?></td>
                <td><?=! empty($civil_service[$x]->cvl_date_conferment) ? $civil_service[$x]->cvl_date_conferment : ''?></td>
                <td><?=! empty($civil_service[$x]->cvl_place_conferment) ? $civil_service[$x]->cvl_place_conferment : ''?></td>
                <td><?=! empty($civil_service[$x]->cvl_number) ? $civil_service[$x]->cvl_number : ''?></td>
                <td><?=! empty($civil_service[$x]->cvl_date_release) ? date('M d, Y',strtotime($civil_service[$x]->cvl_date_release)) : ''?></td>
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