<div class="container-fluid">
    <?php $show = $this->input->get('shw') ; ?>
    <ul class="nav nav-pills profile-submenu">
        <li>
            <a href="<?=base_url()?>?mc=deped&m=tlist">Teachers</a>
        </li>
        <li class="<?=($show === 'personal') ? 'active' : ''?>">
          <a href="<?=base_url()?>?mc=deped&m=tprofile&id=<?=$id?>&shw=personal">Personal</a>
        </li>
        <li class="<?=($show === 'family') ? 'active' : ''?>">
          <a href="<?=base_url()?>?mc=deped&m=tprofile&id=<?=$id?>&shw=family">Family Info</a>
        </li>
        <li class="<?=($show === 'education') ? 'active' : ''?>">
          <a href="<?=base_url()?>?mc=deped&m=tprofile&id=<?=$id?>&shw=education">Education</a>
        </li>
        <li class="<?=($show === 'civil-service') ? 'active' : ''?>">
          <a href="<?=base_url()?>?mc=deped&m=tprofile&id=<?=$id?>&shw=civil-service">Civil Service</a>
        </li>
        <li class="<?=($show === 'work-experience') ? 'active' : ''?>">
          <a href="<?=base_url()?>?mc=deped&m=tprofile&id=<?=$id?>&shw=work-experience">Work Experience</a>
        </li>
        <li class="<?=($show === 'voluntary-work') ? 'active' : ''?>">
          <a href="<?=base_url()?>?mc=deped&m=tprofile&id=<?=$id?>&shw=voluntary-work">Voluntary Work</a>
        </li>
        <li class="<?=($show === 'training-programs') ? 'active' : ''?>">
          <a href="<?=base_url()?>?mc=deped&m=tprofile&id=<?=$id?>&shw=training-programs">Training Programs</a>
        </li>
        <li class="<?=($show === 'other-info') ? 'active' : ''?>">
          <a href="<?=base_url()?>?mc=deped&m=tprofile&id=<?=$id?>&shw=other-info">Other Info</a>
        </li>
    </ul>
</div>