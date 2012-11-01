<?php $this->load->view('registrar/main_header_view'); ?>
<header class="jumbotron subhead" id="overview">
<div class="subnav">
    <ul class="nav nav-pills">
        <li><a href="<?=base_url()?>?mc=account<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Personal Info</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=family_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Family Background</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=educational_background<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Educational Background</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=civil_srv_elegibility<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Civil Service Eligibility</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=work_experience<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Work Experience</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=voluntary_work<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Voluntary Work</a></li>
        <li><a href="<?=base_url()?>?mc=account&m=training_programs<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Training Programs</a></li>
        <li class="active"><a href="<?=base_url()?>?mc=account&m=other_info<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Other Information</a></li>
        <li> <a href="<?=base_url()?>?mc=account&m=login<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Account</a></li>
    </ul>
</div>
</header>
<section id="expwrap">
<div class="span11" >
      <div class="page-header">
            <h1>Personal Data Sheet <small> &nbsp;{ Other Information }</small></h1>
      </div>
      <form id="otherinfo-form">
      <div id="wrap">
          <p><label for="skills">Special Skills / Hobbies  (separated with a comma)</label>
          <textarea id="skills" class="input-xxlarge" rows="5"><?=($teacher_info[0]->inf_skills) ? $teacher_info[0]->inf_skills : '';?></textarea>
          </p>
          <p>
            <label for="recognition">Non-Academic Distinctions / Recognition  (write in full separated with a comma)</label>
            <textarea id="recognition" class="input-xxlarge" rows="5"><?=($teacher_info[0]->inf_recognition) ? $teacher_info[0]->inf_recognition : '';?></textarea>
          </p>
          <p>
              <label for="association">Membership in association / organization (write in full separated with a comma)</label>
              <textarea id="association" class="input-xxlarge" rows="5"><?=($teacher_info[0]->inf_association) ? $teacher_info[0]->inf_association : '';?></textarea>
          </p>
         
          
          <p>
          <ul class="unstyled">
              <li><p>Are you related by sanguinity or affinity to any of the following:</p></li>
              <li>
                  <ol class="alphanum">
                      <li>
                          <p>Within the third degree (by National Government Employees): appointing authority, recommending authority, chief of office/bureau/department of person who has immediate supervision over you in the Office, Bureau or Department where you will be appointed?</p>
                          <ul class="unstyled">
                              <?php if($teacher_info[0]->inf_q1 == 'No' || $teacher_info[0]->inf_q1 == 'no'): ?>
                                    <li>
                                        <label class="radio">
                                        <input type="radio" name="q1" id="q1-no" value="No" checked /> &nbsp; No
                                        </label>
                                    </li>
                                    <li><label  class="radio">
                                        <input type="radio" name="q1" id="q1-yes" value="Yes" /> &nbsp; Yes
                                        </label>
                                        <ul  id="q1-details-wrap" class="hide unstyled">
                                            <li>
                                                    <label for="q1-details">if YES, give details:</label>
                                                    <input type="text" name="q1-details" id="q1-details" class="input-xxlarge" placeholder="Details..." />
                                            </li>
                                        </ul>
                                       
                                    </li>
                                    <?php else: ?>
                                    <li>
                                        <label  class="radio">
                                        <input type="radio" name="q1" id="q1-no" value="No" /> No
                                        </label>
                                    </li>
                                    <li>
                                        <label  class="radio">
                                        <input type="radio" name="q1" id="q1-yes" value="Yes" checked /> Yes
                                        </label>
                                        <ul  id="q1-details-wrap" class="unstyled">
                                            <li>
                                                    <label for="q1-details">if YES, give details:</label>
                                                    <input type="text" name="q1-details" id="q1-details" class="input-large" value="<?=$teacher_info[0]->inf_q1?>" />
                                            </li>
                                        </ul>
                                       
                                    </li>
                                    <?php endif;?>
                          </ul>
                      </li>
                      <li>
                          <p>Within the fourth degree (for Local Government Employees): appointing authority or recommending authority where you will be appointed?</p>
                          <ul class="unstyled">
                             <?php if($teacher_info[0]->inf_q2 == 'No' || $teacher_info[0]->inf_q2 == 'no'): ?>
                                    <li><label class="radio">
                                        <input type="radio" name="q2" id="q2-no" value="No" checked /> &nbsp; No
                                        </label>
                                    </li>
                                    <li><label class="radio">
                                        <input type="radio" name="q2" id="q2-yes" value="Yes" /> &nbsp; Yes
                                        </label>
                                        <ul  id="q2-details-wrap" class="hide unstyled">
                                            <li>
                                                    <label for="q2-details">if YES, give details:</label>
                                                    <input type="text" name="q2-details" id="q2-details" class="input-xxlarge" placeholder="Details..." />
                                            </li>
                                        </ul>
                                    </li>   
                                    <?php else: ?>
                                    <li><label class="radio">
                                        <input type="radio" name="q2" id="q2-no" value="No" /> &nbsp; No
                                        </label>
                                    </li>
                                    <li><label  class="radio">
                                        <input type="radio" name="q2" id="q2-yes" value="Yes" checked /> &nbsp; Yes
                                        </label>
                                        <ul  id="q2-details-wrap" class="unstyled">
                                            <li>
                                                    <label for="q2-details">if YES, give details:</label>
                                                    <input type="text" name="q2-details" id="q2-details" class="input-xxlarge" value="<?=$teacher_info[0]->inf_q2?>" />
                                            </li>
                                        </ul>
                                    </li>
                                    
                                    <?php endif; ?>
                          </ul>
                      </li>
                  </ol>
              </li>
              <li>
                   <p>Have you been formally charged?</p>
                   <ul class="unstyled indent">
                        <?php if($teacher_info[0]->inf_q3 == 'No' || $teacher_info[0]->inf_q3 == 'no'): ?>

                            <li><label class="radio">
                                <input type="radio" name="q3" id="q3-no" value="No" checked /> &nbsp; No
                                </label>
                            </li>
                            <li><label class="radio">
                                <input type="radio" name="q3" id="q3-yes" value="Yes"  /> &nbsp; Yes
                                </label>
                                <ul  id="q3-details-wrap" class="hide unstyled">
                                    <li>
                                            <label for="q3-details">if YES, give details:</label>
                                            <input type="text" name="q3-details" id="q3-details" class="input-xxlarge" placeholder="Details..." />
                                    </li>
                                </ul>

                            </li>
                            <?php else: ?>
                            <li><label class="radio">
                                <input type="radio" name="q3" id="q3-no" value="No"  /> &nbsp; No
                                </label>
                            </li>
                            <li><label class="radio">
                                <input type="radio" name="q3" id="q3-yes" value="Yes" checked /> &nbsp; Yes
                                </label>
                                <ul  id="q3-details-wrap" class="unstyled">
                                    <li>
                                            <label for="q3-details">if YES, give details:</label>
                                            <input type="text" name="q3-details" id="q3-details" class="input-xxlarge" value="<?=$teacher_info[0]->inf_q3?>" />
                                    </li>
                                </ul>

                            </li>
                            <?php endif; ?>
                    </ul>
              </li>
              <li>
                  <p>Have you been guilty of any administrative offense?</p>
                  <ul class="unstyled indent">
                   <?php if($teacher_info[0]->inf_q4 == 'No' || $teacher_info[0]->inf_q4 == 'no'): ?>
                    <li><label class="radio">
                        <input type="radio" name="q4" id="q4-no" value="No" checked /> &nbsp; No
                        </label>
                    </li>
                    <li><label class="radio">
                        <input type="radio" name="q4" id="q4-yes" value="Yes" /> &nbsp; Yes
                        </label>
                        <ul  id="q4-details-wrap" class="hide unstyled">
                            <li>
                                    <label for="q4-details">if YES, give details:</label>
                                    <input type="text" name="q4-details" id="q4-details" class="input-xxlarge" placeholder="Details..." />
                            </li>
                        </ul>

                    </li>
                    <?php else: ?>
                     <li><label class="radio">
                        <input type="radio" name="q4" id="q4-no" value="No"  /> &nbsp; No
                        </label>
                    </li>
                    <li><label class="radio">
                        <input type="radio" name="q4" id="q4-yes" value="Yes" checked /> &nbsp; Yes
                        </label>
                        <ul  id="q4-details-wrap" class="unstyled">
                            <li>
                                    <label for="q4-details">if YES, give details:</label>
                                    <input type="text" name="q4-details" id="q4-details" class="input-xxlarge" value="<?=$teacher_info[0]->inf_q4?>" />
                            </li>
                        </ul>

                    </li>
                    <?php endif;?>
                </ul>
              </li>
              <li>
                  <p>Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?</p>
                  <ul class="unstyled indent">
                   <?php if($teacher_info[0]->inf_q5 == 'No' || $teacher_info[0]->inf_q5 == 'no'): ?>
                    <li><label class="radio">
                        <input type="radio" name="q5" id="q5-no" value="No" checked /> &nbsp; No
                        </label>
                    </li>
                    <li><label class="radio">
                        <input type="radio" name="q5" id="q5-yes" value="Yes" /> &nbsp; Yes
                        </label>
                        <ul  id="q5-details-wrap" class="hide unstyled">
                            <li>
                                    <label for="q5-details">if YES, give details:</label>
                                    <input type="text" name="q5-details" id="q5-details" class="input-xxlarge" placeholder="Details..." />
                            </li>
                        </ul>
                    </li>
                    <?php else:?>
                    <li><label class="radio">
                        <input type="radio" name="q5" id="q5-no" value="No" /> &nbsp; No
                        </label>
                    </li>
                    <li><label class="radio">
                        <input type="radio" name="q5" id="q5-yes" value="Yes" checked /> &nbsp; Yes
                        </label>
                        <ul  id="q5-details-wrap" class="unstyled">
                            <li>
                                    <label for="q5-details">if YES, give details:</label>
                                    <input type="text" name="q5-details" id="q5-details" class="mid" value="<?=$teacher_info[0]->inf_q5?>" />
                            </li>
                        </ul>

                    </li>
                    <?php endif;?>
                 </ul>
              </li>
              <li>
                  <p>Have you ever been separated from the service in any of the following modes: resignation retirement, dropped from the rolls, dismissal, termination, end of term, finished contract, AWOL or phased out, in the public or private sector?</p>
                  <ul class="unstyled indent">
                   <?php if($teacher_info[0]->inf_q6 == 'No' || $teacher_info[0]->inf_q6 == 'no'): ?>
                    <li><label class="radio">
                        <input type="radio" name="q6" id="q6-no" value="No" checked /> &nbsp; No
                        </label>
                    </li>
                    <li><label class="radio">
                        <input type="radio" name="q6" id="q6-yes" value="Yes" /> &nbsp; Yes
                        </label>
                        <ul  id="q6-details-wrap" class="hide unstyled">
                            <li>
                                    <label for="q6-details">if YES, give details:</label>
                                    <input type="text" name="q6-details" id="q6-details" class="input-xxlarge" placeholder="Details..." />
                            </li>
                        </ul>

                    </li>
                    <?php else: ?>
                    <li><label class="radio">
                        <input type="radio" name="q6" id="q6-no" value="No" /> &nbsp; No
                        </label>
                    </li>
                    <li><label class="radio">
                        <input type="radio" name="q6" id="q6-yes" value="Yes" checked /> &nbsp; Yes
                        </label>
                        <ul  id="q6-details-wrap" class="unstyled">
                            <li>
                                    <label for="q6-details">if YES, give details:</label>
                                    <input type="text" name="q6-details" id="q6-details" class="input-xxlarge" value="<?=$teacher_info[0]->inf_q6?>" />
                            </li>
                        </ul>

                    </li>
                    <?php endif; ?>
                </ul>
              </li>
              <li>
                   <p>Have you ever been a candidate in a national or local election (except Barangay election)?</p>
                   <ul class="unstyled indent">
                   <?php if($teacher_info[0]->inf_q7 == 'No' || $teacher_info[0]->inf_q7 == 'no'): ?>
                    <li><label class="radio">
                        <input type="radio" name="q7" id="q7-no" value="No" checked /> &nbsp; No
                        </label>
                    </li>
                    <li><label class="radio">
                        <input type="radio" name="q7" id="q7-yes" value="Yes" /> &nbsp; Yes
                        </label>
                        <ul  id="q7-details-wrap" class="hide unstyled">
                            <li>
                                    <label for="q7-details">if YES, give details:</label>
                                    <input type="text" name="q7-details" id="q7-details" class="input-xxlarge" placeholder="Details" />
                            </li>
                        </ul>

                    </li>
                    <?php else: ?>
                    <li><label class="radio">
                        <input type="radio" name="q7" id="q7-no" value="No" /> &nbsp; No
                        </label>
                    </li>
                    <li><label class="radio">
                        <input type="radio" name="q7" id="q7-yes" value="Yes" checked /> &nbsp; Yes
                        </label>
                        <ul  id="q7-details-wrap" class="unstyled">
                            <li>
                                    <label for="q7-details">if YES, give details:</label><br />
                                    <input type="text" name="q7-details" id="q7-details" class="input-xxlarge" value="<?=$teacher_info[0]->inf_q7?>" />
                            </li>
                        </ul>

                    </li>
                    <?php endif;?>
                 </ul>
              </li>
              
              <li>
                    <p>Pursuant to (a) indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and &copy; Solo Parents Welfare Act of 2000 (RA 8972); please answer the following items:</p>
                    <ol class="alphanum">
                        <li>
                            <p>Are you a member of any indigenous group?</p>
                            <ul class="unstyled">
                                <?php if($teacher_info[0]->inf_q9 == 'No' || $teacher_info[0]->inf_q9 == 'no'): ?>
                                    <li><label class="radio">
                                        <input type="radio" name="q9" id="q9-no" value="No" checked /> &nbsp; No
                                        </label>
                                    </li>
                                    <li><label class="radio">
                                        <input type="radio" name="q9" id="q9-yes" value="Yes" /> &nbsp; Yes
                                        </label>
                                        <ul  id="q9-details-wrap" class="hide unstyled">
                                            <li>
                                                    <label for="q9-details">if YES, give details:</label>
                                                    <input type="text" name="q9-details" id="q9-details" class="input-xxlarge" placeholder="Details..." />
                                            </li>
                                        </ul>
                                    </li>
                                    <?php else: ?>
                                    <li><label class="radio">
                                        <input type="radio" name="q9" id="q9-no" value="No" /> &nbsp; No
                                        </label>
                                    </li>
                                    <li><label class="radio">
                                        <input type="radio" name="q9" id="q9-yes" value="Yes" checked /> &nbsp; Yes
                                        </label>
                                        <ul  id="q9-details-wrap" class="unstyled">
                                            <li>
                                                    <label for="q9-details">if YES, give details:</label>
                                                    <input type="text" name="q9-details" id="q9-details" class="mid" value="<?=$teacher_info[0]->inf_q9?>" />
                                            </li>
                                        </ul>
                                    </li>
                                    <?php endif; ?>
                            </ul>
                        </li>
                        <li>
                            <p>Are you differently abled?</p>
                            <ul class="unstyled">
                                 <?php if($teacher_info[0]->inf_q10 == 'No' || $teacher_info[0]->inf_q10 == 'no'): ?>
                                    <li><label class="radio">
                                        <input type="radio" name="q10" id="q10-no" value="No" checked /> &nbsp; No
                                        </label>
                                    </li>
                                    <li><label class="radio">
                                        <input type="radio" name="q10" id="q10-yes" value="Yes" /> &nbsp; Yes
                                        </label>
                                        <ul  id="q10-details-wrap" class="hide unstyled">
                                            <li>
                                                    <label for="q10-details">if YES, give details:</label>
                                                    <input type="text" name="q10-details" id="q10-details" class="input-xxlarge" placeholder="Details..." />
                                            </li>
                                        </ul>
                                       
                                    </li>  
                                    <?php else:?>
                                    <li><label class="radio">
                                        <input type="radio" name="q10" id="q10-no" value="No" /> &nbsp; No
                                        </label>
                                    </li>
                                    <li><label class="radio">
                                        <input type="radio" name="q10" id="q10-yes" value="Yes" checked /> &nbsp; Yes
                                        </label>
                                        <ul  id="q10-details-wrap" class="unstyled">
                                            <li>
                                                    <label for="q10-details">if YES, give details:</label>
                                                    <input type="text" name="q10-details" id="q10-details" class="input-xxlarge" value="<?=$teacher_info[0]->inf_q10?>" />
                                            </li>
                                        </ul>
                                       
                                    </li>  
                                    <?php endif; ?>
                             </ul>
                        </li>
                        
                        <li>
                            <p>Are you a solo parent?</p>
                            <ul class="unstyled">
                                 <?php if($teacher_info[0]->inf_q11 == 'No' || $teacher_info[0]->inf_q11 == 'no'): ?>
                                    <li><label class="radio">
                                        <input type="radio" name="q11" id="q11-no" value="No" checked /> &nbsp; No
                                        </label>
                                    </li>
                                    <li><label class="radio">
                                        <input type="radio" name="q11" id="q11-yes" value="Yes" /> &nbsp; Yes
                                        </label>
                                        <ul  id="q11-details-wrap" class="hide unstyled">
                                            <li>
                                                    <label for="q11-details">if YES, give details:</label>
                                                    <input type="text" name="q11-details" id="q11-details" class="input-xxlarge" placeholder="Details..." />
                                            </li>
                                        </ul>
                                       
                                    </li>   
                                    <?php else: ?>
                                    <li><label class="radio">
                                        <input type="radio" name="q11" id="q11-no" value="No" /> &nbsp; No
                                        </label>
                                    </li>
                                    <li><label class="radio">
                                        <input type="radio" name="q11" id="q11-yes" value="Yes" checked /> &nbsp; Yes
                                        </label>
                                        <ul  id="q11-details-wrap" class="unstyled">
                                            <li>
                                                 <p>
                                                    <label for="q11-details">if YES, give details:</label>
                                                    <input type="text" name="q11-details" id="q11-details" class="input-xxlarge" value="<?=$teacher_info[0]->inf_q11?>" />
                                                </p>
                                            </li>
                                        </ul>
                                       
                                    </li>   
                                    <?php endif; ?>
                             </ul>
                        </li>
                    </ol>
              </li>
          </ul>
          </p>
          
          <p>References (Person not related by consanguinity or affinity to applicant / appointee)
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="name[]" class="input-xlarge" id="name1" value="<?=($teacher_info[0]->inf_ref_name1) ? $teacher_info[0]->inf_ref_name1 : '';?>" placeholder="Name..." />
                        </td>
                        <td>
                            <input type="text" name="address[]" class="input-xlarge" id="address1" value="<?=($teacher_info[0]->inf_ref_address1) ? $teacher_info[0]->inf_ref_address1 : '';?>" placeholder="Address..." />
                        </td>
                        <td>
                            <input type="text" name="contact[]" class="input-xlarge" id="contact1" validate="digits:true" value="<?=($teacher_info[0]->inf_ref_contact1) ? $teacher_info[0]->inf_ref_contact1 : '';?>" placeholder="Contact..." />
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <input type="text" name="name[]" class="input-xlarge" id="name2" value="<?=($teacher_info[0]->inf_ref_name2) ? $teacher_info[0]->inf_ref_name2 : '';?>" placeholder="Name..." />
                        </td>
                        <td>
                            <input type="text" name="address[]" class="input-xlarge" id="address2" value="<?=($teacher_info[0]->inf_ref_address2) ? $teacher_info[0]->inf_ref_address2 : '';?>" placeholder="Address..." />
                        </td>
                        <td>
                            <input type="text" name="contact[]" class="input-xlarge" id="contact2" validate="digits:true" value="<?=($teacher_info[0]->inf_ref_contact2) ? $teacher_info[0]->inf_ref_contact2 : '';?>" placeholder="Contact..." />
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <input type="text" name="name[]" class="input-xlarge" id="name3" value="<?=($teacher_info[0]->inf_ref_name3) ? $teacher_info[0]->inf_ref_name3 : '';?>" placeholder="Name..." />
                        </td>
                        <td>
                            <input type="text" name="address[]" class="input-xlarge" id="address3" value="<?=($teacher_info[0]->inf_ref_address3) ? $teacher_info[0]->inf_ref_address3 : '';?>" placeholder="Address..." />
                        </td>
                        <td>
                            <input type="text" name="contact[]" class="input-xlarge" id="contact3" validate="digits:true" value="<?=($teacher_info[0]->inf_ref_contact3) ? $teacher_info[0]->inf_ref_contact3 : '';?>" placeholder="Contact..." />
                        </td>
                    </tr>
                </tbody>
            </table>
          </p>
          <p>
              <label for="cedula">Community Tax Certificate Number</label>
              <input type="text" name="cedula" id="cedula" class="input-xxlarge" validate="required:true,digits:true" value="<?=($teacher_info[0]->inf_cedula) ? $teacher_info[0]->inf_cedula : '';?>" placeholder="Cedula Number..." />
          </p>
          <p>
              <label for="cedula_issued_at">Issued At</label>
              <input type="text" name="cedula_issued_at" id="cedula_issued_at" class="input-xxlarge" validate="required:true" value="<?=($teacher_info[0]->inf_cedula_place) ? $teacher_info[0]->inf_cedula_place : '';?>" placeholder="Place where the Cedula was issued" />
          </p>
          <p>
          <label for="date_issued">Issued On</label>
          <input type="text" name="date_issued" class="input-large" id="datepicker" id="date_issued" validate="required:true,date:true" value="<?=($teacher_info[0]->inf_cedula_date) ? $teacher_info[0]->inf_cedula_date : '';?>" />
          </p>
        
      </div>
          <div style="margin-top: 30px;padding-top: 10px;" id="drop-shadow-top">
            <p align="justify">
                <label class="checkbox">
                <input type="checkbox" name="infoagree" id="infoagree" value="agree" validate="required:true" /> I declare under oath that this Personal Data Sheet has been accomplished by me, and is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the Philippines.  I also authorize the agency head / authorized representative to verify / validate the contents stated herein.  I trust that this information shall remain confidential.
                </label>
            </p>
            <p align="left">
                <input type="submit" id="save-btn-otherinfo" value="Save Information" class="btn btn-primary" />
                <img src="<?=base_url()?>img/ajax-loader.gif" style="display:none;" id="preloader" />
            </p>
      </div> 
      </form>
</div>
</section>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-tab.js"></script>
<script src="<?=base_url()?>js/jquery.masonry.min.js"></script>
<script src="<?=base_url()?>js/bootstrap-tooltip.js"></script>
<script src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/jquery.metadata.js"></script>
<script src="<?=base_url()?>js/modernizr-transitions.js"></script>
<script src="<?=base_url()?>js/jquery.ui.datepicker.validation.min.js"></script>
<script src="<?=base_url()?>js/jquery.formobserver.js"></script>
<script src="<?=base_url()?>js/jquery.maskedinput-1.3.min.js"></script>
<script src="<?=base_url()?>js/application.js"></script>
<script type="text/javascript">
$(document).ready(function(){
        $('#otherinfo-form').FormObserve();
        var q1Attr = $('#q1-yes').attr('checked');
        var q2Attr = $('#q2-yes').attr('checked');
        var q3Attr = $('#q3-yes').attr('checked');
        var q4Attr = $('#q4-yes').attr('checked');
        var q5Attr = $('#q5-yes').attr('checked');
        var q6Attr = $('#q6-yes').attr('checked');
        var q7Attr = $('#q7-yes').attr('checked');
//        var q8Attr = $('#q8-yes').attr('checked');
        var q9Attr = $('#q9-yes').attr('checked');
        var q10Attr = $('#q10-yes').attr('checked');
        var q11Attr = $('#q11-yes').attr('checked');
       
        if (typeof q1Attr !== 'undefined' && q1Attr !== false) { $('#q1-details').attr('validate','required:true'); }
        if (typeof q2Attr !== 'undefined' && q2Attr !== false) { $('#q2-details').attr('validate','required:true'); }
        if (typeof q3Attr !== 'undefined' && q3Attr !== false) { $('#q3-details').attr('validate','required:true'); }
        if (typeof q4Attr !== 'undefined' && q4Attr !== false) { $('#q4-details').attr('validate','required:true'); }
        if (typeof q5Attr !== 'undefined' && q5Attr !== false) { $('#q5-details').attr('validate','required:true'); }
        if (typeof q6Attr !== 'undefined' && q6Attr !== false) { $('#q6-details').attr('validate','required:true'); }
        if (typeof q7Attr !== 'undefined' && q7Attr !== false) { $('#q7-details').attr('validate','required:true'); }
//        if (typeof q8Attr !== 'undefined' && q8Attr !== false) { $('#q8-details').attr('validate','required:true'); }
        if (typeof q9Attr !== 'undefined' && q9Attr !== false) { $('#q9-details').attr('validate','required:true'); }
        if (typeof q10Attr !== 'undefined' && q10Attr !== false) { $('#q10-details').attr('validate','required:true'); }
        if (typeof q11Attr !== 'undefined' && q11Attr !== false) { $('#q11-details').attr('validate','required:true'); }

        $.validator.setDefaults({
                submitHandler: function() { 
                    $('#preloader').show();
                    var q1 = $('#q1-details').val();
                    var q2 = $('#q2-details').val();
                    var q3 = $('#q3-details').val();
                    var q4 = $('#q4-details').val();
                    var q5 = $('#q5-details').val();
                    var q6 = $('#q6-details').val();
                    var q7 = $('#q7-details').val();
//                    var q8 = $('#q8-details').val();
                    var q9 = $('#q9-details').val();
                    var q10 = $('#q10-details').val();
                    var q11 = $('#q11-details').val();
                    var skills = $('#skills').val();
                    var recognition = $('#recognition').val();
                    var association = $('#association').val();
                    var name1 = $('#name1').val();
                    var name2 = $('#name2').val();
                    var name3 = $('#name3').val();
                    var address1 = $('#address1').val();
                    var address2 = $('#address2').val();
                    var address3 = $('#address3').val();
                    var contact1 = $('#contact1').val();
                    var contact2 = $('#contact2').val();
                    var contact3 = $('#contact3').val();
                    var cedula = $('#cedula').val();
                    var cedulaIssuedAt = $('#cedula_issued_at').val();
                    var dateIssued = document.getElementsByName('date_issued')[0].value;  
                    var q1Attr = $('#q1-no').attr('checked');
                    var q2Attr = $('#q2-no').attr('checked');
                    var q3Attr = $('#q3-no').attr('checked');
                    var q4Attr = $('#q4-no').attr('checked');
                    var q5Attr = $('#q5-no').attr('checked');
                    var q6Attr = $('#q6-no').attr('checked');
                    var q7Attr = $('#q7-no').attr('checked');
                    var q8Attr = $('#q8-no').attr('checked');
                    var q9Attr = $('#q9-no').attr('checked');
                    var q10Attr = $('#q10-no').attr('checked');
                    var q11Attr = $('#q11-no').attr('checked');
                    
                    if (typeof q1Attr !== 'undefined' && q1Attr !== false) { q1 = 'No'; } 
                    if (typeof q2Attr !== 'undefined' && q2Attr !== false) { q2 = 'No'; }
                    if (typeof q3Attr !== 'undefined' && q3Attr !== false) { q3 = 'No'; }
                    if (typeof q4Attr !== 'undefined' && q4Attr !== false) { q4 = 'No'; }
                    if (typeof q5Attr !== 'undefined' && q5Attr !== false) { q5 = 'No'; }
                    if (typeof q6Attr !== 'undefined' && q6Attr !== false) { q6 = 'No'; }
                    if (typeof q7Attr !== 'undefined' && q7Attr !== false) { q7 = 'No'; }
//                    if (typeof q8Attr !== 'undefined' && q8Attr !== false) { q8 = 'No'; }
                    if (typeof q9Attr !== 'undefined' && q9Attr !== false) { q9 = 'No'; }
                    if (typeof q10Attr !== 'undefined' && q10Attr !== false) { q10 = 'No'; }
                    if (typeof q11Attr !== 'undefined' && q11Attr !== false) { q11 = 'No'; }

                    //alert(q1 + ' ' + q2+ ' ' +q3+ ' ' +q4+ ' ' +q5+ ' ' +q6+ ' ' +q7+ ' ' +q8+ ' ' +q9+ ' ' +q10+ ' ' +q11) ;

                    $.ajax({
                           type:'post',
                           url:'?mc=account&m=other_info_data',
                           data:{
                               skills_str: skills,recognition_str:recognition,association_str:association,q1_str:q1,q2_str:q2,q3_str:q3,q4_str:q4,q5_str:q5,q6_str:q6,q7_str:q7,q9_str:q9,q10_str:q10,q11_str:q11,name1_str:name1,name2_str:name2,name3_str:name3,address1_str:address1,address2_str:address2,address3_str:address3,contact1_str:contact1,contact2_str:contact2,contact3_str:contact3,cedula_str:cedula,cedula_address:cedulaIssuedAt,cedula_date:dateIssued
                           },
                           success: function(msg) {
                               $('#infoagree').removeAttr('checked');
                               var json = jQuery.parseJSON(msg);
                               $.alert(json.message,json.title);
                               $('#preloader').hide();
                               $('#otherinfo-form').FormObserve_save();
                               
                           },
                           error:function (xhr, ajaxOptions, thrownError){
                                $.alert('xhr status: '+xhr.status + '\n Error:'+ thrownError);
                                $('#infoagree').removeAttr('checked');
                                $('#preloader').hide();
                            } 
                    });
                }
         });
               
         /*form triggers*/
         $('#q1-yes').click(function(){$('#q1-details-wrap').show();});
         $('#q1-no').click(function(){$('#q1-details-wrap').hide();});
         $('#q2-yes').click(function(){$('#q2-details-wrap').show();});
         $('#q2-no').click(function(){$('#q2-details-wrap').hide();});
         $('#q3-yes').click(function(){$('#q3-details-wrap').show();});
         $('#q3-no').click(function(){$('#q3-details-wrap').hide();});
         $('#q4-yes').click(function(){$('#q4-details-wrap').show();});
         $('#q4-no').click(function(){$('#q4-details-wrap').hide();});
         $('#q5-yes').click(function(){$('#q5-details-wrap').show();});
         $('#q5-no').click(function(){$('#q5-details-wrap').hide();});
         $('#q6-yes').click(function(){$('#q6-details-wrap').show();});
         $('#q6-no').click(function(){$('#q6-details-wrap').hide();});
         $('#q7-yes').click(function(){$('#q7-details-wrap').show();});
         $('#q7-no').click(function(){$('#q7-details-wrap').hide();});
         $('#q8-yes').click(function(){$('#q8-details-wrap').show();});
         $('#q8-no').click(function(){$('#q8-details-wrap').hide();});
         $('#q9-yes').click(function(){$('#q9-details-wrap').show();});
         $('#q9-no').click(function(){$('#q9-details-wrap').hide();});
         $('#q10-yes').click(function(){$('#q10-details-wrap').show();});
         $('#q10-no').click(function(){$('#q10-details-wrap').hide();});
         $('#q11-yes').click(function(){$('#q11-details-wrap').show();});
         $('#q11-no').click(function(){$('#q11-details-wrap').hide();});
         
         $('#q1-yes').click(function(){ $('#q1-details').attr('validate','required:true'); });
         $('#q1-no').click(function(){ $('#q1-details').removeAttr('validate'); });
         $('#q2-yes').click(function(){ $('#q2-details').attr('validate','required:true'); });
         $('#q2-no').click(function(){ $('#q2-details').removeAttr('validate'); });
         $('#q3-yes').click(function(){ $('#q3-details').attr('validate','required:true'); });
         $('#q3-no').click(function(){ $('#q3-details').removeAttr('validate'); });
         $('#q4-yes').click(function(){ $('#q4-details').attr('validate','required:true'); });
         $('#q4-no').click(function(){ $('#q4-details').removeAttr('validate'); });
         $('#q5-yes').click(function(){ $('#q5-details').attr('validate','required:true'); });
         $('#q5-no').click(function(){ $('#q5-details').removeAttr('validate'); });
         $('#q6-yes').click(function(){ $('#q6-details').attr('validate','required:true'); });
         $('#q6-no').click(function(){ $('#q6-details').removeAttr('validate'); });
         $('#q7-yes').click(function(){ $('#q7-details').attr('validate','required:true'); });
         $('#q7-no').click(function(){ $('#q7-details').removeAttr('validate'); });
         $('#q8-yes').click(function(){ $('#q8-details').attr('validate','required:true'); });
         $('#q8-no').click(function(){ $('#q8-details').removeAttr('validate'); });
         $('#q9-yes').click(function(){ $('#q9-details').attr('validate','required:true'); });
         $('#q9-no').click(function(){ $('#q9-details').removeAttr('validate'); });
         $('#q10-yes').click(function(){ $('#q10-details').attr('validate','required:true'); });
         $('#q10-no').click(function(){ $('#q10-details').removeAttr('validate'); });
         $('#q11-yes').click(function(){ $('#q11-details').attr('validate','required:true'); });
         $('#q11-no').click(function(){ $('#q11-details').removeAttr('validate'); });
         
         $("#datepicker").datepicker({maxDate:0,dateFormat: "yy-mm-dd"});
         
         $.metadata.setType("attr", "validate");
         $("#otherinfo-form").validate({errorPlacement: function(error, element) {error.css('display','none');}});
});
</script>
<?php $this->load->view('registrar/footer_view'); ?>