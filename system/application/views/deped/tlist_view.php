<?php $this->load->view('deped/header_view'); ?>
<!-- main -->
<div class="span11">
    <div class="span10">
        <div class="page-header span10">
            <h3>Teachers List</h3>
        </div>
        <div class="span10">
            <table class="table table-condensed table-striped table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            Teacher
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            $total = count($teachers);
                            
                            if($total > 0) {
                                for($x=0; $x<$total; $x++):
                    ?>
                                    <tr>
                                        <td><?=$d=$x+1?></td>
                                        <td><?=(empty($teachers[$x]->inf_surname) && empty($teachers[$x]->inf_firstname)) ? '<em>Teacher has not updated his/her information <small>(<span rel="tooltip" id="tips" title="Click to contact teacher via email">'.safe_mailto($teachers[$x]->usr_email,$teachers[$x]->usr_email).'</span>)</small></em>' : $teachers[$x]->inf_surname.', '.$teachers[$x]->inf_firstname.' '.substr($teachers[$x]->inf_middlename,0,1).'. '. $teachers[$x]->inf_name_ext?></td>
                                        <td>
                                            
                                            <div class="btn-group">
                                                <button class="btn btn-small btn-primary">Actions</button>
                                                <button class="btn dropdown-toggle btn-small btn-primary" data-toggle="dropdown">
                                                  <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?=base_url()?>?mc=deped&m=tprofile&id=<?=$teachers[$x]->inf_id?>&shw=personal"><i class="icon-eye-open"></i> CS FORM 212 (Personal Data Sheet)</a></li>
                                                    <li>
                                                        <a href="<?=base_url()?>?mc=deped&m=wload&id=<?=$teachers[$x]->inf_id?>">
                                                           <i class="icon-hand-right"></i> Work Load
                                                        </a>
                                                    </li>
                                                </ul>
                                              </div> 
                                        </td>
                                    </tr>
                    <?php
                                endfor;
                            } else {
                    ?>
                                <tr>
                                    <td colspan="2"><em>No teachers registered</em></td>
                                </tr>
                    <?php
                            }
                            
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End of main -->
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-transition.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.tipsy.js"></script>
<script type="text/javascript">
$(function(){
    $('#tips').tipsy({live:true,gravity: 'sw',opacity:1});
});
</script>
<?php $this->load->view('deped/footer_view'); ?>