<?php $this->load->view('deped/teacher/teacher_header_view'); ?>   
<?php $this->load->view('deped/teacher/sub_header_view'); ?>   
<div class="row-fluid">
<!-- main content -->
    <div class="offset1"></div>
    <div class="span11">
         <table class="table  table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th rowspan="2">Name and Address of Organization</th>
                    <th colspan="2">Inclusive Dates <small>(<em>mm/dd/yyyy</em>)</small></th>
                    <th rowspan="2">Number of Hours</th>
                    <th rowspan="2">Position/Nature of Work</th>
                </tr>
                <tr>
                    <th>From</th>
                    <th>To</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $num=count($voluntary);
                    if($num > 0) {
                        for($x=0; $x<$num;$x++):
                ?>
                            <tr>

                                <td>
                                    <?=!empty($voluntary[$x]->vol_organization) ? "<address><strong>".$voluntary[$x]->vol_organization .
                                                                                    "</strong><br />". $voluntary[$x]->vol_address."</address>":' '?>
                                </td>
                                <td><?=!empty($voluntary[$x]->vol_from) ? date('m/d/Y',  strtotime($voluntary[$x]->vol_from)) : ' '?></td>
                                <td><?=!empty($voluntary[$x]->vol_to) ? date('m/d/Y',  strtotime($voluntary[$x]->vol_to)) : ' '?></td>
                                <td><?=!empty($voluntary[$x]->vol_hours) ? $voluntary[$x]->vol_hours : ' '?></td>
                                <td><?=!empty($voluntary[$x]->vol_position) ? $voluntary[$x]->vol_position : ' '?></td>
                            </tr>
                <?php
                        endfor;
                    } else {
                ?>
                    <tr>
                        <td colspan="8"><em>No voluntary work done.</em></td>
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