<?php $this->load->view('./shared/header_login_view'); ?>
<style type="text/css">
.success { border-top: 1px solid #0E830A; border-bottom: 1px solid #0E830A; background-color: #CFF8D1; padding: 5px 10px; color: #0E830A; margin: 5% auto; }
.box-gray, #loginform { width: 500px; margin: 3% auto; }
</style>


<div class="box-gray">
    <form method="post" action="index.php?mc=login&m=auth" >
        <p>
            <label class="required" for="acct">Account</label><br/>
            <input type="text" id="acct" value="" name="acct"/>
        </p>
        
        <p>
            <label class="required" for="acct">Password</label><br/>
            <input type="password" id="password" value="" name="password"/>
        </p>
        
        <p>
            <input type="submit" class="bluebutton bluesubmit" value="Login" /> &nbsp;or &nbsp;<a href="#" id="forgot">You forgot your password?</a>
        </p>
        
    </form>
</div>
<script type="text/javascript">
require(["jquery", "jqueryui", "validate", "general"], function() {
   $(function($) {
        $.alert('<?=$message?>', '<?=$title?>', function(){ jQuery('.box-gray').show(); });
   });
});
    
</script>
<?php $this->load->view('./shared/noscript_footer_view'); ?>