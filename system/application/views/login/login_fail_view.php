<?php $this->load->view('./shared/header_login_view'); ?>
<style type="text/css">
.success { border-top: 1px solid #0E830A; border-bottom: 1px solid #0E830A; background-color: #CFF8D1; padding: 5px 10px; color: #0E830A; margin: 5% auto; }
</style>

<script type="text/javascript">
require(["jquery", "jqueryui", "validate", "general"], function() {
   $(function($) {
        $.alert('<?=$message?>', 'Fail', function(){ location.href="<?=base_url()?>"; });
    });
});
</script>
<?php $this->load->view('./shared/noscript_footer_view'); ?>