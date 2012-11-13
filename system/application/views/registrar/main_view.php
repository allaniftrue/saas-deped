<?php $this->load->view('registrar/main_header_view'); ?>
<section id="avApps" class="span11">
    <h2>Applications</h2>
    <div class="span10 show-grid">
        <div class="span1" rel="tooltip" title="Personal Data Sheet (CS Form 212)" id="pds">
            <a href="<?=base_url()?>?mc=account<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">
                <img src="<?=base_url()?>img/user_info_dashboard.png" />
            </a>
        </div>
        <div class="span1" rel="tooltip" title="School Year" id="sy"><a href="<?=base_url()?>?mc=regtools&m=sy<?='&t=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>"><img src="<?=base_url()?>img/calendar.png" /></a></div>
        <div class="span1"></div>
        <div class="span1"></div>
        <div class="span1"></div>
        <div class="span1"></div>
        <div class="span1"></div>
        <div class="span1"></div>
    </div>
    <div class="span10 show-grid">
        <div class="span1"></div>
        <div class="span1"></div>
        <div class="span1"></div>
        <div class="span1"></div>
        <div class="span1"></div>
        <div class="span1"></div>
        <div class="span1"></div>
        <div class="span1"></div>
    </div>
</section>
<script src="<?=base_url()?>js/bootstrap-tooltip.js"></script>
<script src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script>
$(document).ready(function(){
   $('#pds,#sy').tooltip();
   $.backstretch("<?=base_url()?>img/bg.jpg"); 
});
</script>
</body>
</html>