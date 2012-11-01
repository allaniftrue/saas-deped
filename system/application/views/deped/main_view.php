<?php $this->load->view('deped/header_view'); ?>
<!-- main -->
<div class="span11 show-grid">
    <div class="span1" rel="tooltip" id="tips" title="Teacher's List">
        <a href="<?=base_url()?>?mc=deped&m=tlist"><img src="<?=base_url()?>img/user_info_dashboard.png" /></a>
    </div>
</div>
<!-- End of main -->
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.tipsy.js"></script>
<script type="text/javascript">
$(function(){
    $('#tips').tipsy({live:true,gravity: 's',opacity:1});
});
</script>
<?php $this->load->view('deped/footer_view'); ?>