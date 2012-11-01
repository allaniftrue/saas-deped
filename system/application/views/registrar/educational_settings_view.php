<?php $this->load->view('registrar/main_header_view'); ?>
<header class="jumbotron subhead" id="overview">
<div class="subnav">
    <ul class="nav nav-pills">
        <li><a href="<?=base_url()?>?mc=account<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Personal Info</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=family_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Family Background</a></li>
        <li class="active"><a href="javascript:void(0);">Educational Background</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=civil_srv_elegibility<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Civil Service Eligibility</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=work_experience<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Work Experience</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=voluntary_work<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Voluntary Work</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=training_programs<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Training Programs</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=other_info<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Other Information</a></li>
        <li> <a href="<?=base_url()?>?mc=account&m=login<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Account</a></li>
    </ul>
</div>
</header>
<section class="edubackground"><div class="span11">
     <div class="page-header">
            <h1>Personal Data Sheet <small> &nbsp;{ Educational Background }</small></h1>
     </div></div>
<div class="m-content">
        <div id="delwarning" class="hide" title="Confirmation">
                <p>Are you sure you want to completely remove this information?</p>
        </div>
        <div id="dialog-confirm" class="hide" title="CONFIRMATION OF INFORMATION">
                <p align="center"><b>CONFIRMATION OF INFORMATION</b></p>
                <p align="justify">I declare under oath that this Personal Data Sheet has been accomplished by me, and is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the Philippines.  I also authorize the agency head / authorized representative to verify / validate the contents stated herein.  I trust that this information shall remain confidential.</p>
        </div>
        <div class="alert alert-info span11">
        <strong>Information: </strong> Write in full the school name
        </div> <br />
        <div id="form-left-educ" class="span6 pull-left">
            <div class="span4">
                    <p id="options-familybg">
                                <a href="javascript:void(0)" id="addelem"><img src="<?=base_url()?>img/plus-white.png" /> 
                                Add More Elementary School Info 
                                </a>
                    </p>
                    <form id="elem-form">
                        <div class="elem-box">
                            <?php
                                $total_elem = count($elementary);
                                if($total_elem > 0):
                                for($i_elem=0; $i_elem<$total_elem; $i_elem++) {
                            ?>
                            <div id="elementary" class="elem-<?=$elementary[$i_elem]->elem_id?>">
                                <label id="remove-elem" class="<?=$elementary[$i_elem]->elem_id?>"><a href="javascript:void()"><img src="<?=base_url()?>img/cross-button.png" id="elem-<?=$elementary[$i_elem]->elem_id?>-del-btn" alt="Detele" title="Remove Information" style="display:none;" /></a></label>
                                <p>
                                    <label class="required" for="elemschool">Elementary School Name: </label>
                                    <input type="text" class="input-xlarge" id="elemschool" value="<?=($elementary[$i_elem]->elem_name) ? $elementary[$i_elem]->elem_name : ''; ?>" name="elemschool[]" title="Your school name is needed" />
                                </p>
                                <p>
                                    <fieldset> <legend>Inclusive Date of Attendance</legend>
                                        <div  style="float:left; width: 50%;">
                                            <label class="required" for="elemschoolinfofrom">From: </label>
                                            <input type="text" class="datepicker input-small" id="elemschoolinfofrom" value="<?=($elementary[$i_elem]->elem_from) ? $elementary[$i_elem]->elem_from : ''; ?>" name="elemschoolinfofrom[]" />
                                        </div>
                                        <div style="float:right;width:50%">
                                                <label class="required" for="elemschoolinfoto">To: </label>
                                                <input type="text" id="elemschoolinfoto" value="<?=($elementary[$i_elem]->elem_to) ? $elementary[$i_elem]->elem_to : ''; ?>" name="elemschoolinfoto[]" class="input-small" />
                                        </div>
                                        <div class="clear"></div>
                                    </fieldset>
                                </p>
                                <p>
                                    <label class="required" for="elemschoolinfograduated">Year Graduated: </label>
                                    <input type="text" id="elemschoolinfograduated" value="<?=($elementary[$i_elem]->elem_graduated) ? $elementary[$i_elem]->elem_graduated : ''; ?>" name="elemschoolinfograduated[]" class="input-xlarge" />
                                </p>
                                <p>
                                    <label class="required" for="elementaryawards">Scholarship / Academic Honor Received: </label>
                                    <input type="text" id="elementaryawards" class="input-xlarge" value="<?=($elementary[$i_elem]->elem_awards) ? $elementary[$i_elem]->elem_awards : ''; ?>" name="elementaryawards[]" />
                                </p>


                            </div>
                            <?php 

                            } 
                            else:
                            ?>
                            <div id="elementary">
                                <p>
                                    <label class="required" for="elemschool">Elementary School Name: </label>
                                    <input type="text" class="full" id="elemschool" value="" name="elemschool[]" title="Your school name is needed" />
                                </p>
                                <p>
                                <fieldset> <legend>Inclusive Date of Attendance</legend>
                                    <div style="float:left; width: 50%;">
                                        <label class="required" for="elemschoolinfofrom">From: </label>
                                        <input type="text" class="datepicker input-small" id="elemschoolinfofrom" value="" name="elemschoolinfofrom[]" />
                                    </div>
                                    <div style="float:right;width: 50%;">
                                            <label class="required" for="elemschoolinfoto">To: </label>
                                            <input type="text" id="elemschoolinfoto" value="" class="input-small" name="elemschoolinfoto[]" />
                                    </div>
                                    <div class="clear"></div>
                                </fieldset>
                                </p>
                                <p>
                                    <label class="required" for="elemschoolinfograduated">Year Graduated: </label>
                                    <input type="text" id="elemschoolinfograduated" value="" name="elemschoolinfograduated[]" />
                                </p>
                                <p>
                                    <label class="required" for="elementaryawards">Scholarship / Academic Honor Received: </label>
                                    <input type="text" id="elementaryawards" class="full" value="" name="elementaryawards[]" />
                                </p>

                            </div>
                            <?php endif; ?>
                            <p align="right">
                                <img src="<?=base_url()?>img/ajax-loader.gif" style="display:none;" id="preloader" /> 
                                <input type="button" id="save-btn-elementary" value="Save Information" class="btn btn-primary" />
                            </p>
                        </div>
                    </form>
            </div>
               
                <!-- HS -->
                <div class="span4">
                    <p id="options-familybg">
                            <a href="javascript:void(0)" id="addsecon">
                                <img src="<?=base_url()?>img/plus-white.png" /> Add More Secondary School Info 
                            </a>
                    </p>

                    <form id="sec-form">
                        <div class="sec-box">

                            <?php
                                    $total_sec = count($secondary);
                                    if($total_sec > 0):
                                    for($i_sec=0; $i_sec<$total_sec; $i_sec++) {
                            ?>

                            <div id="secondary" class="sec-<?=$secondary[$i_sec]->sec_id?>">
                                <label id="remove-sec" class="<?=$secondary[$i_sec]->sec_id?>"><a href="javascript:void()"><img src="<?=base_url()?>img/cross-button.png" id="sec-<?=$secondary[$i_sec]->sec_id?>-del-btn" alt="Detele" title="Remove Information" style="display:none;" /></a></label>
                                <p>
                                    <label class="required" for="Secondary">Secondary School Name: </label>
                                    <input type="text" class="input-xlarge" id="secondaryname" value="<?=($secondary[$i_sec]->sec_name) ? $secondary[$i_sec]->sec_name : ''; ?>"  name="secondaryname[]" />
                                </p>
                                <p>
                                <fieldset> <legend>Inclusive Date of Attendance</legend>
                                    <div style="float:left; width: 50%;">
                                        <label class="required" for="secondaryinfofrom">From: </label>
                                        <input type="text" class="datepicker input-small" id="secondaryinfofrom" value="<?=($secondary[$i_sec]->sec_from) ? $secondary[$i_sec]->sec_from : ''; ?>" name="secondaryinfofrom[]" />
                                    </div>
                                    <div style="float:right;width:50%">
                                            <label class="required" for="secondaryinfoto">To: </label>
                                            <input type="text" id="secondaryinfoto" value="<?=($secondary[$i_sec]->sec_to) ? $secondary[$i_sec]->sec_to : ''; ?>" name="secondaryinfoto[]" class="input-small" />
                                    </div>
                                    <div class="clear"></div>
                                </fieldset>
                                </p>
                                <p>
                                    <label class="required" for="secondaryinfograduated">Year Graduated: </label>
                                    <input type="text" id="secondaryinfograduated" value="<?=($secondary[$i_sec]->sec_graduated) ? $secondary[$i_sec]->sec_graduated : ''; ?>" name="secondaryinfograduated[]" class="input-small" />
                                </p>
                                <p>
                                    <label class="required" for="secondaryawards">Scholarship / Academic Honor Received: </label>
                                    <input type="text" id="secondaryawards" class="input-xlarge" value="<?=($secondary[$i_sec]->sec_awards) ? $secondary[$i_sec]->sec_awards : ''; ?>" name="secondaryawards[]" />
                                </p>
                            </div>

                            <?php   } else: ?>
                            <div id="secondary">
                                <p>
                                    <label class="required" for="Secondary">Secondary School Name: </label>
                                    <input type="text" class="input-xlarge" id="secondaryname" value="" name="secondaryname[]" />
                                </p>
                                <p>
                                    <fieldset> <legend>Inclusive Date of Attendance</legend>
                                        <div style="float:left; width: 50%;">
                                            <label class="required" for="secondaryinfofrom">From: </label>
                                            <input type="text" class="datepicker input-small" id="secondaryinfofrom" value="" name="secondaryinfofrom[]" />
                                        </div>
                                        <div style="float:right;width:50%">
                                                <label class="required" for="secondaryinfoto">To: </label>
                                                <input type="text" id="secondaryinfoto" value="" name="secondaryinfoto[]" class="input-small" />
                                        </div>
                                        <div class="clear"></div>
                                    </fieldset>
                                </p>
                                <p>
                                    <label class="required" for="secondaryinfograduated">Year Graduated: </label>
                                    <input type="text" id="secondaryinfograduated" value="" name="secondaryinfograduated[]" />
                                </p>
                                <p>
                                    <label class="required" for="secondaryawards">Scholarship / Academic Honor Received: </label>
                                    <input type="text" id="secondaryawards" class="input-xlarge" value="" name="secondaryawards[]" />
                                </p>
                            </div>
                            <?php endif; ?>
                            <p align="right">
                                <img src="<?=base_url()?>img/ajax-loader.gif" style="display:none;" id="preloader" /> 
                                <input type="button" id="save-btn-secondary" value="Save Information" class="btn btn-primary" />
                            </p>

                        </div>
                    </form> 
            </div>
            <!-- Vocational -->
            <div class="span4">
                <p id="options-familybg">
                        <a href="javascript:void(0)" id="addvocational">
                            <img src="<?=base_url()?>img/plus-white.png" /> Add More Vocational/Trade Course Info 
                        </a>
                </p>
                
                <form id="voc-form">
                    <div class="voc-box">

                        <?php
                                $total_voc = count($vocational);
                                if($total_voc > 0):
                                for($i_voc=0; $i_voc<$total_voc; $i_voc++) {
                        ?>
                        <div id="vocational" class="voc-<?=$vocational[$i_voc]->voc_id?>">
                                        <p>
                                            <label id="remove-voc" class="<?=$vocational[$i_voc]->voc_id?>">
                                                    <a href="javascript:void()">
                                                        <img src="<?=base_url()?>img/cross-button.png" id="voc-<?=$vocational[$i_voc]->voc_id?>-del-btn" alt="Detele" title="Remove Information" style="display:none;" />
                                                    </a>
                                                </label>
                                                <label class="required" for="vocationalname">Vocational School Name: </label>
                                                <input type="text" class="input-xlarge" id="vocationalname" value="<?=($vocational[$i_voc]->voc_name) ? $vocational[$i_voc]->voc_name : '';?>" name="vocationalname[]" />
                                            </p>
                                            <p>
                                                <label class="required" for="vocationalcourse">Degree Course: </label>
                                                <input type="text" class="input-xlarge" id="vocationalcourse" value="<?=($vocational[$i_voc]->voc_course) ? $vocational[$i_voc]->voc_course : ''; ?>" name="vocationalcourse[]" />
                                            </p>
                                            <p>
                                            <fieldset> <legend>Inclusive Date of Attendance</legend>
                                                <div style="float:left; width: 50%;">
                                                    <label class="required" for="vocationalinfofrom">From: </label>
                                                    <input type="text" class="datepicker input-small" id="vocationalinfofrom" value="<?=($vocational[$i_voc]->voc_from) ? $vocational[$i_voc]->voc_from : '';?>" name="vocationalinfofrom[]" />
                                                </div>
                                                <div style="float:right; width: 50%;">
                                                        <label class="required" for="vocationalinfoto">To: </label>
                                                        <input type="text" id="vocationalinfoto" value="<?=($vocational[$i_voc]->voc_to) ? $vocational[$i_voc]->voc_to : ''; ?>" name="vocationalinfoto[]" class="input-small" />
                                                </div>
                                                <div class="clear"></div>
                                            </fieldset>
                                            </p>
                                            <p>
                                                <fieldset> <legend>If Not Graduated Fill-in the Total Units Earned</legend>
                                                <div style="float:left; width: 50%;">
                                                    <label class="required" for="vocationalinfograduated">Year Graduated: </label>
                                                    <input type="text" id="vocationalinfograduated" value="<?=($vocational[$i_voc]->voc_graduated) ? $vocational[$i_voc]->voc_graduated : ''; ?>" name="vocationalinfograduated[]" class="input-small" />

                                                </div>
                                                <div style="float:right; width: 50%;">
                                                        <label class="required" for="vocationalunits">Highest Grade/Units Earned:</label>
                                                        <input type="text" id="vocationalunits" value="<?=($vocational[$i_voc]->voc_highest_grade) ? $vocational[$i_voc]->voc_highest_grade : ''; ?>" name="vocationalunits[]" class="input-small" />
                                                </div>
                                                <div class="clear"></div>
                                                </fieldset>
                                            </p>
                                            <p>
                                                <label class="required" for="vocationalawards">Scholarship / Academic Honor Received: </label>
                                                <input type="text" id="vocationalawards" class="input-xlarge" value="<?=($vocational[$i_voc]->voc_awards) ? $vocational[$i_voc]->voc_awards : ''; ?>" name="vocationalawards[]" />
                                            </p>
                            </div>

                        <?php } else: ?>
                            <div id="vocational">
                                <p>
                                    <label class="required" for="vocationalname">Vocational School Name: </label>
                                    <input type="text" class="input-xlarge" id="vocationalname" value="" name="vocationalname[]" />
                                </p>
                                <p>
                                    <label class="required" for="vocationalcourse">Degree Course: </label>
                                    <input type="text" class="input-xlarge" id="vocationalcourse" value="" name="vocationalcourse[]" />
                                </p>
                                <p>
                                <fieldset> <legend>Inclusive Date of Attendance</legend>
                                    <div style="float:left; width: 50%;">
                                        <label class="required" for="vocationalinfofrom">From: </label>
                                        <input type="text" class="datepicker input-small" id="vocationalinfofrom" value="" name="vocationalinfofrom[]" class="input-small" />

                                    </div>
                                    <div style="float:right; width: 50%;">
                                            <label class="required" for="vocationalinfoto">To: </label>
                                            <input type="text" id="vocationalinfoto" value="" name="vocationalinfoto[]" class="input-small" />
                                    </div>
                                    <div class="clear"></div>
                                </fieldset>
                                </p>
                                <p>
                                    <fieldset> <legend>If Not Graduated Fill-in the Total Units Earned</legend>
                                        <div style="float:left; width: 50%;">
                                            <label class="required" for="vocationalinfograduated">Year Graduated: </label>
                                            <input type="text" id="vocationalinfograduated" value="" name="vocationalinfograduated[]" class="input-small" />

                                        </div>
                                        <div style="float:right; width: 50%;">
                                                <label class="required" for="vocationalunits">Units Earned:</label>
                                                <input type="text" id="vocationalunits" value="" name="vocationalunits[]" class="input-small" />
                                        </div>
                                        <div class="clear"></div>
                                    </fieldset>
                                </p>
                                <p>
                                    <label class="required" for="vocationalawards">Scholarship / Academic Honor Received: </label>
                                    <input type="text" id="vocationalawards" class="input-xlarge" value="" name="vocationalawards[]" />
                                </p>
                            </div>

                        <?php endif; ?>
                        <p align="right">
                            <input type="button" name="submit" value="Save Information" id="save-btn-vocational" class="btn btn-primary" />
                        </p>
                    </div>
                    
                </form>
        </div>
        </div>
         
        <div id="form-right" class="span5 pull-right">
            <!-- College Degree -->
            <div class="span4">
                <p id="options-familybg">
                        <a href="javascript:void(0)" id="addcollege">
                            <img src="<?=base_url()?>img/plus-white.png" /> Add More College Info 
                        </a>
                </p>
            
                <form id="col-form">
                    <div class="col-box">
                        <?php
                                $total_col = count($college);
                                if($total_col > 0):
                                for($i_col=0; $i_col<$total_col; $i_col++) {
                        ?>
                        <div id="college" class="col-<?=$college[$i_col]->col_id?>">
                            <label id="remove-col" class="<?=$college[$i_col]->col_id?>"><a href="javascript:void()"><img src="<?=base_url()?>img/cross-button.png" id="col-<?=$college[$i_col]->col_id?>-del-btn" alt="Detele" title="Remove Information" style="display:none;" /></a></label>
                            <p>
                                <label class="required" for="collegename">College School Name: </label>
                                <input type="text" class="input-xlarge" id="collegename" value="<?=($college[$i_col]->col_name) ? $college[$i_col]->col_name : '';?>" name="collegename[]" />
                            </p>
                            <p>
                                <label class="required" for="collegecourse">Degree Course: </label>
                                <input type="text" class="input-xlarge" id="collegecourse" value="<?=($college[$i_col]->col_course) ? $college[$i_col]->col_course : ''; ?>" name="collegecourse[]" />
                            </p>
                            <p>
                            <fieldset> <legend>Inclusive Date of Attendance</legend>
                                <div style="float:left; width: 50%;">
                                    <label class="required" for="collegeinfofrom">From: </label>
                                    <input type="text" id="collegeinfofrom" value="<?=($college[$i_col]->col_from) ? $college[$i_col]->col_from : ''; ?>" name="collegeinfofrom[]" class="input-small" />
                                </div>
                                <div style="float:right; width: 50%;">
                                        <label class="required" for="collegeinfoto">To: </label>
                                        <input type="text" id="collegeinfoto" value="<?=($college[$i_col]->col_to) ? $college[$i_col]->col_to : ''; ?>" name="collegeinfoto[]" class="input-small" />
                                </div>
                                <div class="clear"></div>
                            </fieldset>
                            </p>
                            <p>
                            <fieldset> <legend>If Not Graduated Fill-in the Total Units Earned</legend>
                            <div style="width:50%; float: left;">
                                <label class="required" for="collegeinfograduated">Year Graduated: </label>
                                <input type="text" id="collegeinfograduated" value="<?=($college[$i_col]->col_graduated) ? $college[$i_col]->col_graduated : ''; ?>" name="collegeinfograduated[]" class="input-small" />
                            </div>
                            <div style="float:right; width: 50%;">
                                                        <label class="required" for="collegeunits">Highest Grade/Units Earned:</label>
                                                        <input type="text" id="collegeunits" value="<?=($college[$i_col]->col_units) ? $college[$i_col]->col_units : ''; ?>" name="collegeunits[]" class="input-small" />
                            </div>
                            <div class="clear"></div>
                            </fieldset>
                            </p>
                            <p>
                                <label class="required" for="collegeawards">Scholarship / Academic Honor Received: </label>
                                <input type="text" id="collegeawards" class="input-xlarge" value="<?=($college[$i_col]->col_awards) ? $college[$i_col]->col_awards : ''; ?>" name="collegeawards[]" />
                            </p>
                        </div>
                        <?php } else: ?>
                        <div id="college">
                            <p>
                                <label class="required" for="collegename">College School Name: </label>
                                <input type="text" class="input-xlarge" id="collegename" value="" name="collegename[]" />
                            </p>
                            <p>
                                <label class="required" for="collegecourse">Degree Course: </label>
                                <input type="text" class="input-xlarge" id="collegecourse" value="" name="collegecourse[]" />
                            </p>
                            <p>
                            <fieldset> <legend>Inclusive Date of Attendance</legend>
                                <div style="float:left; width: 50%;">
                                    <label class="required" for="collegeinfofrom">From: </label>
                                    <input type="text" class="datepicker input-small" id="collegeinfofrom" value="" name="collegeinfofrom[]" />
                                </div>
                                <div style="float:right; width: 50%;">
                                        <label class="required" for="collegeinfoto">To: </label>
                                        <input type="text" id="collegeinfoto" value="" name="collegeinfoto[]" class="input-small" />
                                </div>
                                <div class="clear"></div>
                            </fieldset>
                            </p>
                            <p>
                            <fieldset> <legend>If Not Graduated Fill-in the Total Units Earned</legend>
                            <div style="width:50%; float: left;">
                                <label class="required" for="collegeinfograduated">Year Graduated: </label>
                                <input type="text" id="collegeinfograduated" value="" name="collegeinfograduated[]" class='input-small' />
                            </div>
                            <div style="float:right; width: 50%;">
                                <label class="required" for="collegeunits">Highest Grade/Units Earned:</label>
                                <input type="text" id="collegeunits" value="" name="collegeunits[]" class="input-small" />
                            </div>
                            <div class="clear"></div>
                            </fieldset>
                            </p>
                            <p>
                                <label class="required" for="collegeawards">Scholarship / Academic Honor Received: </label>
                                <input type="text" id="collegeawards" class="input-xlarge" value="" name="collegeawards[]" />
                            </p>
                        </div> 
                        <?php endif; ?>
                         <p align="right">
                            <input type="button" name="submit" value="Save Information" id="save-btn-college" class="btn btn-primary" />
                        </p>
                </div>
                </form>
            </div>
                <!-- Graduate Studies -->
                <div class="span4">
                <p id="options-familybg">
                        <a href="javascript:void(0)" id="addgraduate">
                            <img src="<?=base_url()?>img/plus-white.png" /> Add More Graduate Studies Info 
                        </a>
                </p>
            
                <form id="gra-form">
                <div class="gra-box">
                    <?php
                                $total_gra = count($graduate);
                                if($total_gra > 0):
                                for($i_gra=0; $i_gra < $total_gra; $i_gra++) {
                    ?>
                    <div class="grad-<?=$graduate[$i_gra]->grad_id?>" id="graduate">
                        <label id="remove-gra" class="<?=$graduate[$i_gra]->grad_id?>"><a href="javascript:void()"><img src="<?=base_url()?>img/cross-button.png" id="grad-<?=$graduate[$i_gra]->grad_id?>-del-btn" alt="Delete" title="Remove Information" style="display:none;" /></a></label>
                        <p>
                            <label class="required" for="graduatename">Graduate School Name: </label>
                            <input type="text" class="input-xlarge" id="graduatename" value="<?=($graduate[$i_gra]->grad_name) ? $graduate[$i_gra]->grad_name : ''; ?>" name="graduatename[]" />
                        </p>
                        <p>
                            <label class="required" for="graduatecourse">Degree Course: </label>
                            <input type="text" class="input-xlarge" id="graduatecourse" value="<?=($graduate[$i_gra]->grad_course) ? $graduate[$i_gra]->grad_course : ''; ?>" name="graduatecourse[]" />
                        </p>
                        <p>
                        <fieldset> <legend>Inclusive Date of Attendance</legend>
                            <div style="float:left;width: 50%;">
                                <label class="required" for="graduateinfofrom">From: </label>
                                <input type="text" class="datepicker input-small" id="graduateinfofrom" value="<?=($graduate[$i_gra]->grad_from) ? $graduate[$i_gra]->grad_from : ''; ?>" name="graduateinfofrom[]" />
                            </div>
                            <div style="float:right;width: 50%;">
                                    <label class="required" for="graduateinfoto">To: </label>
                                    <input type="text" id="graduateinfoto" value="<?=($graduate[$i_gra]->grad_to) ? $graduate[$i_gra]->grad_to : ''; ?>" name="graduateinfoto[]" class="input-small" />
                            </div>
                            <div class="clear"></div>
                        </fieldset>
                        </p>
                       <p>
                            <fieldset> <legend>If Not Graduated Fill-in the Total Units Earned</legend>
                            <div style="width:50%; float: left;">
                                <label class="required" for="graduateinfograduated">Year Graduated: </label>
                                <input type="text" id="graduateinfograduated" value="<?=($graduate[$i_gra]->grad_graduated) ? $graduate[$i_gra]->grad_graduated : ''; ?>" name="graduateinfograduated[]" class="input-small" />
                            </div>
                            <div style="float:right; width: 50%;">
                                <label class="required" for="graduateunits">Highest Grade/Units Earned:</label>
                                <input type="text" id="graduateunits" value="<?=($graduate[$i_gra]->grad_units) ? $graduate[$i_gra]->grad_units : ''; ?>" name="graduateunits[]" class="input-small" />
                            </div>
                            <div class="clear"></div>
                            </fieldset>
                            </p>
                        <p>
                            <label class="required" for="vocationalawards">Scholarship / Academic Honor Received: </label>
                            <input type="text" id="graduateawards" class="input-xlarge" value="<?=($graduate[$i_gra]->grad_awards) ? $graduate[$i_gra]->grad_awards : ''; ?>" name="graduateawards[]" />
                        </p>
                    </div>
                    <?php } else:  ?>
                    <div id="graduate">
                        <p>
                            <label class="required" for="graduatename">Graduate School Name: </label>
                            <input type="text" class="input-xlarge" id="graduatename" value="" name="graduatename[]" />
                        </p>
                        <p>
                            <label class="required" for="graduatecourse">Degree Course: </label>
                            <input type="text" class="input-xlarge" id="graduatecourse" value="" name="graduatecourse[]" />
                        </p>
                        <p>
                        <fieldset> <legend>Inclusive Date of Attendance</legend>
                            <div style="float:left; width: 50%;">
                                <label class="required" for="graduateinfofrom">From: </label>
                                <input type="text" class="datepicker input-small" id="graduateinfofrom" value="" name="graduateinfofrom[]" />
                            </div>
                            <div style="float:right;width:50%">
                                    <label class="required" for="graduateinfoto">To: </label>
                                    <input type="text" id="graduateinfoto" class="input-small" value="" name="graduateinfoto[]" />
                            </div>
                            <div class="clear"></div>
                        </fieldset>
                        </p>
                         <p>
                            <fieldset> <legend>If Not Graduated Fill-in the Total Units Earned</legend>
                            <div style="width:50%; float: left;">
                                <label class="required" for="graduateinfograduated">Year Graduated: </label>
                                <input type="text" id="graduateinfograduated" class="input-small" value="" name="graduateinfograduated[]" />
                            </div>
                            <div style="float:right; width: 50%;">
                                <label class="required" for="graduateunits">Highest Grade/Units Earned:</label>
                                <input type="text" id="graduateunits" class="input-small" value="" name="graduateunits[]" />
                            </div>
                            <div class="clear"></div>
                            </fieldset>
                            </p>
                        <p>
                        <p>
                            <label class="required" for="vocationalawards">Scholarship / Academic Honor Received: </label>
                            <input type="text" id="graduateawards" class="input-xlarge" value="" name="graduateawards[]" />
                        </p>
                    </div>
                    
                    <?php endif; ?>
                    <p align="right">
                            <input type="button" name="submit" value="Save Information" id="save-btn-graduate" class="btn btn-primary" />
                    </p>
                </div>
                </form>
        </div>
    <!-- </form> -->
    <br /><br /><br /><br /><br /><br /><br /><br />
</div>
</section>
<script src="<?=base_url()?>js/bootstrap-transition.js"></script>
<script src="<?=base_url()?>js/bootstrap-alert.js"></script>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/jquery.tipsy.js"></script>
<script src="<?=base_url()?>js/bootstrap-button.js"></script>
<script src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script src="<?=base_url()?>js/ajaxupload.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>js/jquery.formobserver.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    /*general*/
    $("#elem-form, #sec-form, #voc-form, #col-form, #gra-form").FormObserve();
      
    $("div[id=elementary],div[id=secondary],div[id=vocational],div[id=college],div[id=graduate]").live({
        mouseover: function(){
            var curID = $(this).attr('class');
            $('#'+curID+'-del-btn').show();      
            //console.log('in:'+curID);
        },
        mouseout: function(){
            var curID = $(this).attr('class');
            $('#'+curID+'-del-btn').hide();      
        }
    });
    
    /* elementary */
    $('#elem-form :input').each(function() {
            $(this).data('initialValue', $(this).val());
    });

    $('#save-btn-elementary').click(function(){
        if(checker('elem-form') === true) {
                $( "#dialog-confirm" ).dialog({
                                resizable: false,
                                height:255,
                                width: '45%',
                                modal: true,
                                buttons: {
                                        "I agree": function() {
                                                $( this ).dialog( "close" );

                                                /* process data */
                                                var outArr =[];
                                                var elemArr = document.getElementsByName('elemschool[]'); 
                                                var fromArr = document.getElementsByName('elemschoolinfofrom[]'); 
                                                var toArr   = document.getElementsByName('elemschoolinfoto[]'); 
                                                var graduatedArr = document.getElementsByName('elemschoolinfograduated[]'); 
                                                var awardsArr = document.getElementsByName('elementaryawards[]'); 

                                                for(var i=0; i < elemArr.length; i++) {
                                                    var skulInfo= [ elemArr[i].value , fromArr[i].value, toArr[i].value, graduatedArr[i].value, awardsArr[i].value];
                                                    outArr.push(skulInfo);
                                                }

                                                $('#preloader').show();
                                                $.ajax({
                                                    type: 'post',
                                                    url: '?mc=account&m=ueduc_elem',
                                                    cache:false,
                                                    data: {
                                                            elementary: outArr
                                                    },
                                                    success: function(msg) {

                                                        var json = $.parseJSON(msg);
                                                        $.alert(json.message,json.title);
                                                        $('#preloader').hide();
                                                        $('#elem-form').FormObserve_save();

                                                    },
                                                    error:function (xhr, ajaxOptions, thrownError){
                                                        $('#preloader').hide();    
                                                        $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                    }    

                                                });
                                        },
                                        Cancel: function() {
                                                $( this ).dialog( "close" );
                                        }
                                }
                });
        
        }
    });
    
    /*del info*/
    $('[id=remove-elem]').click(function(){
            var curClass = $(this).attr('class');
            
            $( "#delwarning" ).dialog({
			resizable: false,
			modal: true,
			buttons: {
				"Yes": function() {
					
                                      
                                        divCount = $('.elem-box').children("#elementary:visible").length;
                                        
                                        if(divCount > 1){
                                           
                                            
                                            $.ajax({
                                                type: 'post',
                                                url: '?mc=account&m=ueduc_elem_rm',
                                                cache:false,
                                                data: {
                                                        curID: curClass
                                                },
                                                success: function(msg) {
                                                    var json = $.parseJSON(msg);
                                                    
                                                    if(json.status == 1) {
                                                        $.alert(json.message,json.title);
                                                        $('.elem-'+curClass).hide('slow');
                                                    } else {
                                                        $.alert(json.message,json.title);
                                                    }
                                                },
                                                error:function (xhr, ajaxOptions, thrownError){
                                                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                }    
                                            });
                                            
                                            $(this).dialog("close");
                                            
                                        } else {
                                            $.alert('You can\'t delete this information, just update it.', 'Not Allowed');
                                            $(this).dialog("close");
                                        }
				},
				"No": function() {
					$( this ).dialog( "close" );
				}
			}
	});

    });
    /*end of elementary*/
    
    /* secondary */
    $('#sec-form :input').each(function() {
            $(this).data('initialValue', $(this).val());
    });
    $('#save-btn-secondary').click(function(){
        if(checker('sec-form') == true) {
                $( "#dialog-confirm" ).dialog({
                                resizable: false,
                                height:255,
                                width: '45%',
                                modal: true,
                                buttons: {
                                        "I agree": function() {
                                                $( this ).dialog( "close" );

                                                /* process data */
                                                var outArr =[];
                                                var secArr = document.getElementsByName('secondaryname[]'); 
                                                var fromArr = document.getElementsByName('secondaryinfofrom[]'); 
                                                var toArr   = document.getElementsByName('secondaryinfoto[]'); 
                                                var graduatedArr = document.getElementsByName('secondaryinfograduated[]'); 
                                                var awardsArr = document.getElementsByName('secondaryawards[]'); 

                                                for(var i=0; i < secArr.length; i++) {
                                                    var skulInfo= [ secArr[i].value , fromArr[i].value, toArr[i].value, graduatedArr[i].value, awardsArr[i].value];
                                                    outArr.push(skulInfo);
                                                }

                                                $('#preloader').show();
                                                $.ajax({
                                                    type: 'post',
                                                    url: '?mc=account&m=ueduc_sec',
                                                    cache:false,
                                                    data: {
                                                            secondary: outArr
                                                    },
                                                    success: function(msg) {

                                                        var json = $.parseJSON(msg);
                                                        $.alert(json.message,json.title);
                                                        $('#preloader').hide();
                                                        $('#sec-form').FormObserve_save();

                                                    },
                                                    error:function (xhr, ajaxOptions, thrownError){
                                                        $('#preloader').hide();    
                                                        $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                    }    

                                                });
                                        },
                                        Cancel: function() {
                                                $( this ).dialog( "close" );
                                        }
                                }
                });
        
        }
    });
    
    
    
    /*del info*/
    $('[id=remove-sec]').click(function(){
            var curClass = $(this).attr('class');
            $( "#delwarning" ).dialog({
			resizable: false,
			modal: true,
			buttons: {
				"Yes": function() {
                                    
                                        divCount = $('.sec-box').children("#secondary:visible").length;
                                        
                                        if(divCount > 1){
                                           
                                            
                                            $.ajax({
                                                type: 'post',
                                                url: '?mc=account&m=ueduc_sec_rm',
                                                cache:false,
                                                data: {
                                                        curID: curClass
                                                },
                                                success: function(msg) {
                                                    var json = $.parseJSON(msg);
                                                    
                                                    if(json.status == 1) {
                                                        $.alert(json.message,json.title);
                                                        $('.sec-'+curClass).hide('slow');
                                                    } else {
                                                        $.alert(json.message,json.title);
                                                    }
                                                },
                                                error:function (xhr, ajaxOptions, thrownError){
                                                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                }    
                                            });
                                            
                                            $(this).dialog("close");
                                            
                                        } else {
                                            $.alert('You can\'t delete this information, just update it.', 'Not Allowed');
                                            $(this).dialog("close");
                                        }
				},
				"No": function() {
					$( this ).dialog( "close" );
				}
			}
        });
    });
    
    /* sec ends here */
    
    /* Vocational starts here */
    $('#voc-form :input').each(function() {
            $(this).data('initialValue', $(this).val());
    });
    $('#save-btn-vocational').click(function(){
        if(checker('voc-form') == true) {
                $( "#dialog-confirm" ).dialog({
                                resizable: false,
                                height:255,
                                width: '45%',
                                modal: true,
                                buttons: {
                                        "I agree": function() {
                                                $(this).dialog( "close" );

                                                /* process data */
                                                var outArr =[];
                                                var vocArr = document.getElementsByName('vocationalname[]'); 
                                                var courseArr = document.getElementsByName('vocationalcourse[]'); 
                                                var fromArr = document.getElementsByName('vocationalinfofrom[]'); 
                                                var toArr   = document.getElementsByName('vocationalinfoto[]'); 
                                                var graduatedArr = document.getElementsByName('vocationalinfograduated[]'); 
                                                var unitsArr = document.getElementsByName('vocationalunits[]'); 
                                                var awardsArr = document.getElementsByName('vocationalawards[]'); 

                                                for(var i=0; i < vocArr.length; i++) {
                                                    var skulInfo= [ vocArr[i].value, courseArr[i].value, fromArr[i].value, toArr[i].value, graduatedArr[i].value, unitsArr[i].value, awardsArr[i].value];
                                                    outArr.push(skulInfo);
                                                }

                                                $('#preloader').show();
                                                $.ajax({
                                                    type: 'post',
                                                    url: '?mc=account&m=ueduc_voc',
                                                    cache:false,
                                                    data: {
                                                            vocational: outArr
                                                    },
                                                    success: function(msg) {

                                                        var json = $.parseJSON(msg);
                                                        $.alert(json.message,json.title);
                                                        $('#preloader').hide();
                                                        $('#voc-form').FormObserve_save();

                                                    },
                                                    error:function (xhr, ajaxOptions, thrownError){
                                                        $('#preloader').hide();    
                                                        $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                    }    

                                                });
                                        },
                                        Cancel: function() {
                                                $( this ).dialog( "close" );
                                        }
                                }
                });
        }
    });
    
    /*del info vocational*/
    $('[id=remove-voc]').click(function(){
            var curClass = $(this).attr('class');
            $( "#delwarning" ).dialog({
			resizable: false,
			modal: true,
			buttons: {
				"Yes": function() {
                                    
                                        divCount = $('.voc-box').children("#vocational:visible").length;
                                        
                                        if(divCount > 1){
                                           
                                            
                                            $.ajax({
                                                type: 'post',
                                                url: '?mc=account&m=ueduc_voc_rm',
                                                cache:false,
                                                data: {
                                                        curID: curClass
                                                },
                                                success: function(msg) {
                                                    var json = $.parseJSON(msg);
                                                    
                                                    if(json.status == 1) {
                                                        $.alert(json.message,json.title);
                                                        $('.voc-'+curClass).hide('slow');
                                                        $('#voc-form').FormObserve_save();
                                                    } else {
                                                        $.alert(json.message,json.title);
                                                    }
                                                },
                                                error:function (xhr, ajaxOptions, thrownError){
                                                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                }    
                                            });
                                            
                                            $(this).dialog("close");
                                            
                                        } else {
                                        
                                            $.ajax({
                                                type: 'post',
                                                url: '?mc=account&m=ueduc_voc_rm',
                                                cache:false,
                                                data: {
                                                        curID: curClass
                                                },
                                                success: function(msg) {
                                                    var json = $.parseJSON(msg);
                                                    
                                                    if(json.status == 1) {
                                                        $.alert(json.message,json.title);
                                                        $('#voc-form').clearForm().FormObserve_save();
                                                       
                                                    } else {
                                                        $.alert(json.message,json.title);
                                                    }
                                                },
                                                error:function (xhr, ajaxOptions, thrownError){
                                                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                }    
                                            });
                                            
                                            $(this).dialog("close");
                                        }
				},
				"No": function() {
					$( this ).dialog( "close" );
				}
			}
        });
    });
    /* vocational ends here */
    
    /*college starts here */
     $('#col-form :input').each(function() {
            $(this).data('initialValue', $(this).val());
    });
    $('#save-btn-college').click(function(){
        if(checker('col-form') == true) {
                $( "#dialog-confirm" ).dialog({
                                resizable: false,
                                height:255,
                                width: '45%',
                                modal: true,
                                buttons: {
                                        "I agree": function() {
                                                $(this).dialog( "close" );

                                                /* process data */
                                                var outArr =[];
                                                var colArr = document.getElementsByName('collegename[]'); 
                                                var courseArr = document.getElementsByName('collegecourse[]'); 
                                                var fromArr = document.getElementsByName('collegeinfofrom[]'); 
                                                var toArr   = document.getElementsByName('collegeinfoto[]'); 
                                                var graduatedArr = document.getElementsByName('collegeinfograduated[]'); 
                                                var unitsArr = document.getElementsByName('collegeunits[]'); 
                                                var awardsArr = document.getElementsByName('collegeawards[]'); 

                                                for(var i=0; i < colArr.length; i++) {
                                                    var skulInfo= [ colArr[i].value, courseArr[i].value, fromArr[i].value, toArr[i].value, graduatedArr[i].value, unitsArr[i].value, awardsArr[i].value];
                                                    outArr.push(skulInfo);
                                                }

                                                $('#preloader').show();
                                                $.ajax({
                                                    type: 'post',
                                                    url: '?mc=account&m=ueduc_col',
                                                    cache:false,
                                                    data: {
                                                            college: outArr
                                                    },
                                                    success: function(msg) {

                                                        var json = $.parseJSON(msg);
                                                        $.alert(json.message,json.title);
                                                        $('#preloader').hide();
                                                        $('#col-form').FormObserve_save();

                                                    },
                                                    error:function (xhr, ajaxOptions, thrownError){
                                                        $('#preloader').hide();    
                                                        $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                    }    

                                                });
                                        },
                                        Cancel: function() {
                                                $( this ).dialog( "close" );
                                        }
                                }
                });
        }
    });
    /*del info college*/
    $('[id=remove-col]').click(function(){
            var curClass = $(this).attr('class');
            $( "#delwarning" ).dialog({
			resizable: false,
			modal: true,
			buttons: {
				"Yes": function() {
                                    
                                        divCount = $('.col-box').children("#college:visible").length;
                                        
                                        if(divCount > 1) {
                                           
                                            
                                            $.ajax({
                                                type: 'post',
                                                url: '?mc=account&m=ueduc_col_rm',
                                                cache:false,
                                                data: {
                                                        curID: curClass
                                                },
                                                success: function(msg) {
                                                    var json = $.parseJSON(msg);
                                                    
                                                    if(json.status == 1) {
                                                        $.alert(json.message,json.title);
                                                        $('.col-'+curClass).hide('slow');
                                                    } else {
                                                        $.alert(json.message,json.title);
                                                    }
                                                     $('#infoagree').removeAttr('checked');
                                                },
                                                error:function (xhr, ajaxOptions, thrownError){
                                                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                     $('#infoagree').removeAttr('checked');
                                                }    
                                            });
                                            
                                            $(this).dialog("close");
                                            
                                        } else {
                                            $.alert('You can\'t delete this information, just update it.', 'Not Allowed');
                                            $(this).dialog("close");
                                        }
				},
				"No": function() {
					$( this ).dialog( "close" );
				}
			}
        });
    });
    /* college ends here */
    
    /* graduate starts here */
    $('#gra-form :input').each(function() {
            $(this).data('initialValue', $(this).val());
    });
    $('#save-btn-graduate').click(function(){
        if(checker('gra-form') == true) {
                $( "#dialog-confirm" ).dialog({
                                resizable: false,
                                height:255,
                                width: '45%',
                                modal: true,
                                buttons: {
                                        "I agree": function() {
                                                $(this).dialog( "close" );

                                                /* process data */
                                                var outArr =[];
                                                var graArr = document.getElementsByName('graduatename[]'); 
                                                var courseArr = document.getElementsByName('graduatecourse[]'); 
                                                var fromArr = document.getElementsByName('graduateinfofrom[]'); 
                                                var toArr   = document.getElementsByName('graduateinfoto[]'); 
                                                var graduatedArr = document.getElementsByName('graduateinfograduated[]'); 
                                                var unitsArr = document.getElementsByName('graduateunits[]'); 
                                                var awardsArr = document.getElementsByName('graduateawards[]'); 

                                                for(var i=0; i < graArr.length; i++) {
                                                    var skulInfo= [ graArr[i].value, courseArr[i].value, fromArr[i].value, toArr[i].value, graduatedArr[i].value, unitsArr[i].value, awardsArr[i].value];
                                                    outArr.push(skulInfo);
                                                }

                                                $('#preloader').show();
                                                $.ajax({
                                                    type: 'post',
                                                    url: '?mc=account&m=ueduc_grad',
                                                    cache:false,
                                                    data: {
                                                            graduate: outArr
                                                    },
                                                    success: function(msg) {

                                                        var json = $.parseJSON(msg);
                                                        $.alert(json.message,json.title);
                                                        $('#preloader').hide();
                                                        $('#gra-form').FormObserve_save();

                                                    },
                                                    error:function (xhr, ajaxOptions, thrownError){
                                                        $('#preloader').hide();    
                                                        $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                    }    

                                                });
                                        },
                                        Cancel: function() {
                                                $( this ).dialog( "close" );
                                        }
                                }
                });
        }
    });
    /*del info college*/
    $('[id=remove-gra]').click(function(){
            var curClass = $(this).attr('class');
            $( "#delwarning" ).dialog({
			resizable: false,
			modal: true,
			buttons: {
				"Yes": function() {
                                    
                                        divCount = $('.gra-box').children("#graduate:visible").length;
                                        
                                        if(divCount > 1){
                                           
                                            
                                            $.ajax({
                                                type: 'post',
                                                url: '?mc=account&m=ueduc_gra_rm',
                                                cache:false,
                                                data: {
                                                        curID: curClass
                                                },
                                                success: function(msg) {
                                                    var json = $.parseJSON(msg);
                                                    
                                                    if(json.status == 1) {
                                                        $.alert(json.message,json.title);
                                                        $('.grad-'+curClass).hide('slow');
                                                    } else {
                                                        $.alert(json.message,json.title);
                                                    }
                                                },
                                                error:function (xhr, ajaxOptions, thrownError){
                                                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                }    
                                            });
                                            
                                            $(this).dialog("close");
                                            
                                        } else {
                                            $.ajax({
                                                type: 'post',
                                                url: '?mc=account&m=ueduc_gra_rm',
                                                cache:false,
                                                data: {
                                                        curID: curClass
                                                },
                                                success: function(msg) {
                                                    var json = $.parseJSON(msg);
                                                    
                                                    if(json.status == 1) {
                                                        $.alert(json.message,json.title);
                                                        $('#gra-form').clearForm().FormObserve_save().FormObserve();
                                                    } else {
                                                        $.alert(json.message,json.title);
                                                    }
                                                },
                                                error:function (xhr, ajaxOptions, thrownError){
                                                    $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                                }    
                                            });
                                            
                                            $(this).dialog("close");
                                        }
				},
				"No": function() {
					$( this ).dialog( "close" );
				}
			}
        });
    });
 
    
    /*elementary school info */
    $("[id^=elemschoolinfo], [id^=secondaryinfo], [id^=vocationalinfo], [id^=collegeinfo], [id^=graduateinfo]").datepicker({
                                                changeMonth: true,
                                                changeYear: true,
                                                dateFormat: 'MM yy',
                                                onClose: function(dateText, inst) { 
                                                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                                    $(this).datepicker('setDate', new Date(year, month, 1));
                                                },
                                                maxDate: "0",
                                                yearRange: '-70:-0'
    });
  
    
    $('#addelem').live('click', function(){
    
        var curDiv = $(this).closest('div').attr('id');
        var lastDiv = $('#elementary').last();
        var newDiv = lastDiv.clone(true);
        var randomnumber=Math.floor(Math.random()*1111);
        
       
        $('.elem-box').prepend(newDiv);
        newDiv.find('input').val('');
        
        $(newDiv).find("input").each(function(){
            
            if($(this).hasClass("hasDatepicker")){ // if the current input has the hasDatpicker class
                var this_id = $(this).attr("id"); // current inputs id
		var new_id = this_id +randomnumber; // a new id
		$(this).attr("id", new_id); // change to new id
		$(this).removeClass('hasDatepicker'); // remove hasDatepicker class
                $(this).val('');

		$(this).datepicker({
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat: 'MM yy',
                                    maxDate:'0',
                                    onClose: function(dateText, inst) { 
                                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                        $(this).datepicker('setDate', new Date(year, month, 1));
                                   },
                                   yearRange: '-70:-0'
		});
            }
	});	
        
        return false;
        
    });
    
    /* clonse secondary */
    $('#addsecon').click(function(){
        
        var curDiv = $(this).parents('div').attr('id');
        var lastDiv = $('#secondary').last();
        var newDiv = lastDiv.clone(true);
        var randomnumber=Math.floor(Math.random()*1111);
        
        $('.sec-box').prepend(newDiv);
        newDiv.find('input').val('');
        
        $(newDiv).find("input").each(function(){
            if($(this).hasClass("hasDatepicker")){ // if the current input has the hasDatpicker class
                var this_id = $(this).attr("id"); // current inputs id
		var new_id = this_id +randomnumber; // a new id
		$(this).attr("id", new_id); // change to new id
		$(this).removeClass('hasDatepicker'); // remove hasDatepicker class
                $(this).val('');
		$(this).datepicker({
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat: 'MM yy',
                                    maxDate:'0',
                                    onClose: function(dateText, inst) { 
                                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                        $(this).datepicker('setDate', new Date(year, month, 1));
                                    },
                                    yearRange: '-70:-0'
		});
            }
	});	
        
        return false;
    });
    
    
    /* Cloning Vocational */
    $('#addvocational').click(function(){
        
        var curDiv = $(this).parents('div').attr('id');
        var lastDiv = $('#vocational').last();
        var newDiv = lastDiv.clone(true);
        var randomnumber=Math.floor(Math.random()*1111);
        
       $('.voc-box').prepend(newDiv);
       newDiv.find('input').val('');
        
       $(newDiv).find("input").each(function(){
            if($(this).hasClass("hasDatepicker")){ // if the current input has the hasDatpicker class
                var this_id = $(this).attr("id"); // current inputs id
		var new_id = this_id +randomnumber; // a new id
		$(this).attr("id", new_id); // change to new id
		$(this).removeClass('hasDatepicker'); // remove hasDatepicker class
                $(this).val('');
		$(this).datepicker({
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat: 'MM yy',
                                    maxDate:'0',
                                    onClose: function(dateText, inst) { 
                                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                        $(this).datepicker('setDate', new Date(year, month, 1));
                                    },
                                    yearRange: '-70:-0'
		});
            }
	});	
        
        return false;
    });
    
    /* Cloning College */
    $('#addcollege').click(function(){
        
        var curDiv = $(this).parents('div').attr('id');
        var lastDiv = $('#college').last();
        var newDiv = lastDiv.clone(true);
        var randomnumber=Math.floor(Math.random()*1111);
        
        $('.col-box').prepend(newDiv);
        newDiv.find('input').val('');
        
        $(newDiv).find("input").each(function(){
            if($(this).hasClass("hasDatepicker")){ // if the current input has the hasDatpicker class
                var this_id = $(this).attr("id"); // current inputs id
		var new_id = this_id +randomnumber; // a new id
		$(this).attr("id", new_id); // change to new id
		$(this).removeClass('hasDatepicker'); // remove hasDatepicker class
                $(this).val('');
		$(this).datepicker({
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat: 'MM yy',
                                    maxDate:'0',
                                    onClose: function(dateText, inst) { 
                                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                        $(this).datepicker('setDate', new Date(year, month, 1));
                                    },
                                    yearRange: '-70:-0'
		});
            }
	});	
        
        return false;
    });
    
    /* Cloning Graduate Studies */
    $('#addgraduate').click(function(){
        
        var curDiv = $(this).parents('div').attr('id');
        var lastDiv = $('#graduate').last();
        var newDiv = lastDiv.clone(true);
        var randomnumber=Math.floor(Math.random()*1111);
        
        $('.gra-box').prepend(newDiv);
        newDiv.find('input').val('');
        
        $(newDiv).find("input").each(function(){
            if($(this).hasClass("hasDatepicker")){ // if the current input has the hasDatpicker class
                var this_id = $(this).attr("id"); // current inputs id
		var new_id = this_id +randomnumber; // a new id
		$(this).attr("id", new_id); // change to new id
		$(this).removeClass('hasDatepicker'); // remove hasDatepicker class
                $(this).val('');
		$(this).datepicker({
                                    changeMonth: true,
                                    changeYear: true,
                                    dateFormat: 'MM yy',
                                    maxDate:'0',
                                    onClose: function(dateText, inst) { 
                                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                        $(this).datepicker('setDate', new Date(year, month, 1));
                                    },
                                    yearRange: '-70:-0'
		});
            }
	});	
        
        return false;
    }); 
     $.backstretch("<?=base_url()?>img/bg.jpg"); 
});
</script>
</body>
</html>