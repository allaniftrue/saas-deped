<?php $this->load->view('deped/teacher/teacher_header_view'); ?>   
<?php $this->load->view('deped/teacher/sub_header_view'); ?>   
<div class="row-fluid">
<!-- main content -->
<div class="offset1"></div>
<div class="span11">
    <table class="table table-condensed table-bordered table-striped">
        <thead>
            <tr>
                <th rowspan="2">Level</th>
                <th rowspan="2">Name of School</th>
                <th rowspan="2">Degree Course</th>
                <th rowspan="2">Year Graduated</th>
                <th rowspan="2">Highest Grade/ <br />Level/<br />Units Earned<br /><small>(if not graduated)</small></th>
                <th colspan="2">Inclusive Dates of Attendance</th>
                <th rowspan="2">Scholarships/Academic Honors Received</th>
            </tr>
             <tr>
                <th>From</th>
                <th>To</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $num_elem = count($elem); 
                for($x=0; $x<$num_elem; $x++):
            ?>
                <tr>
                    <?php if($x===0): ?>
                    <th>Elementary</th>
                    <?php else: ?>
                    <th></th>
                    <?php endif; ?>
                    
                    <td><?=$elem[$x]->elem_name?></td>
                    <td></td>
                    <td><?=date('Y',strtotime($elem[$x]->elem_graduated))?></td>
                    <td></td>
                    <td><?=$elem[$x]->elem_from?></td>
                    <td><?=$elem[$x]->elem_to?></td>
                    <td><?=$elem[$x]->elem_awards?></td>
                </tr>
            <?php endfor; ?>
            <?php 
                $num_sec = count($sec); 
                for($x=0; $x<$num_sec; $x++):
            ?>
                <tr>
                    <?php if($x===0): ?>
                    <th>Secondary</th>
                    <?php else: ?>
                    <th></th>
                    <?php endif; ?>
                    
                    <td><?=$sec[$x]->sec_name?></td>
                    <td></td>
                    <td><?=date('Y',strtotime($sec[$x]->sec_graduated))?></td>
                    <td></td>
                    <td><?=$sec[$x]->sec_from?></td>
                    <td><?=$sec[$x]->sec_to?></td>
                    <td><?=$sec[$x]->sec_awards?></td>
                </tr>
            <?php endfor; ?>
            <?php 
                $count = count($voc);
                $num_voc =  $count == 0 ? 1 : $count; 
                for($x=0; $x<$num_voc; $x++):
            ?>
                <tr>
                    <?php if($x===0): ?>
                    <th>Vocational</th>
                    <?php else: ?>
                    <th></th>
                    <?php endif; ?>
                    
                    <td><?=! empty($voc[$x]->voc_name) ? $voc[$x]->voc_name : ''?></td>
                    <td><?=! empty($voc[$x]->voc_course) ? $voc[$x]->voc_course : ''?></td>
                    <td><?=! empty($voc[$x]->voc_graduated) ? date('Y',strtotime($voc[$x]->voc_graduated)) : ''?></td>
                    <td><?=! empty($voc[$x]->voc_highest_grade) ? $voc[$x]->voc_highest_grade : ''?></td>
                    <td><?=! empty($voc[$x]->voc_from) ? $voc[$x]->voc_from : ''?></td>
                    <td><?=! empty($voc[$x]->voc_to) ? $voc[$x]->voc_to : ''?></td>
                    <td><?=! empty($voc[$x]->voc_awards) ? $voc[$x]->voc_awards : ''?></td>
                </tr>
            <?php endfor; ?>
            <?php 
                $count = count($college);
                $num_college =  $count == 0 ? 1 : $count; 
                for($x=0; $x<$num_college; $x++):
            ?>
                <tr>
                    <?php if($x===0): ?>
                    <th>College</th>
                    <?php else: ?>
                    <th></th>
                    <?php endif; ?>
                    
                    <td><?=! empty($college[$x]->col_name) ? $college[$x]->col_name : ''?></td>
                    <td><?=! empty($college[$x]->col_course) ? $college[$x]->col_course : ''?></td>
                    <td><?=! empty($college[$x]->col_graduated) ? date('Y',strtotime($college[$x]->col_graduated)) : ''?></td>
                    <td><?=! empty($college[$x]->col_units) ? $college[$x]->col_units : ''?></td>
                    <td><?=! empty($college[$x]->col_from) ? $college[$x]->col_from : ''?></td>
                    <td><?=! empty($college[$x]->col_to) ? $college[$x]->col_to : ''?></td>
                    <td><?=! empty($college[$x]->col_awards) ? $college[$x]->col_awards : ''?></td>
                </tr>
            <?php endfor; ?>
            <?php 
                $count = count($graduate);
                $num_graduate =  $count == 0 ? 1 : $count; 
                for($x=0; $x<$num_graduate; $x++):
            ?>
                <tr>
                    <?php if($x===0): ?>
                    <th>Graduate Studies</th>
                    <?php else: ?>
                    <th></th>
                    <?php endif; ?>
                    
                    <td><?=! empty($graduate[$x]->grad_name) ? $graduate[$x]->grad_name : ''?></td>
                    <td><?=! empty($graduate[$x]->grad_course) ? $graduate[$x]->grad_course : ''?></td>
                    <td><?=! empty($graduate[$x]->grad_graduated) ? date('Y',strtotime($graduate[$x]->grad_graduated)) : ''?></td>
                    <td><?=! empty($graduate[$x]->grad_units) ? $graduate[$x]->grad_units : ''?></td>
                    <td><?=! empty($graduate[$x]->grad_from) ? $graduate[$x]->grad_from : ''?></td>
                    <td><?=! empty($graduate[$x]->grad_to) ? $graduate[$x]->grad_to : ''?></td>
                    <td><?=! empty($graduate[$x]->grad_awards) ? $graduate[$x]->grad_awards : ''?></td>
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