<?php $this->load->view('deped/teacher/teacher_header_view'); ?>   
<?php $this->load->view('deped/teacher/sub_header_view'); ?>   
<div class="row-fluid">
<!-- main content -->
<div class="offset1"></div>
<div class="span3">
    <table class="table  table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th>Special Skills/Hobbies</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $parts = explode(',', $inf->inf_skills);
            
                $num = count($parts);
                if($num === 0):
                    
            ?>
            <tr>
                <td colspan="6"><em>No special skills/hobbies.</em></td>
            </tr>
            <?php else: for($x=0; $x<$num;$x++):?>
            <tr>
                <td><?=! empty($parts[$x]) ? $parts[$x] : ''?></td>
            </tr>
            <?php endfor; endif; ?>
        </tbody>
    </table>
</div>

<div class="span3">
    <table class="table  table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th>Non-Academic Distinctions / Recognition</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $num = count($recognition);
                if($num === 0):
                    
            ?>
            <tr>
                <td colspan="6"><em>No non-academic distinctions/recognition.</em></td>
            </tr>
            <?php else: for($x=0; $x<$num;$x++):?>
            <tr>
                <td><?=! empty($recognition[$x]->rec_recognition) ? $recognition[$x]->rec_recognition : ''?></td>
            </tr>
            <?php endfor; endif; ?>
        </tbody>
    </table>
</div>

<div class="span3">
    <table class="table  table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th>Membership in Association/Organization</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $num = count($organizations);
                if($num === 0):
                    
            ?>
            <tr>
                <td colspan="6"><em>No non-academic distinctions/recognition.</em></td>
            </tr>
            <?php else: for($x=0; $x<$num;$x++):?>
            <tr>
                <td><?=! empty($organizations[$x]->tch_organization) ? $organizations[$x]->tch_organization : ''?></td> 
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