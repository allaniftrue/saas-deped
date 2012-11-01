<?php $this->load->view('./shared/header_login_view'); ?> 
<div class="span10">
     <div class="page-header">
            <h1>Login</h1>
      </div>
    <div class="row">
        <div class="span4 offset3">
            <form action="index.php?mc=login&m=auth" method="post" class="well well-large">
                <p>
                    <input type="text" name="username" placeholder="username" class="input-xlarge" />
                </p>
                <p>
                    <input type="password" name="password" placeholder="password" class="input-xlarge" />
                </p>
                <p>
                    <button class="btn btn-primary">Login</button> &nbsp; or &nbsp; <a href="#">Forgot Password?</a>
                </p>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="span4 offset3">
        <?php
        
        if(! empty($msg_stat['stat']) && $msg_stat['stat'] == 0) {
        ?>
            <div class="alert alert-error"><?=$msg_stat['msg']?><button class="close" data-dismiss="alert">×</button></div>
        <?php
        } elseif(! empty($msg_stat['stat']) && $msg_stat['stat'] == 1) {
        ?>
            <div class="alert alert-success"><?=$msg_stat['msg']?><button class="close" data-dismiss="alert">×</button></div>
        <?php
        } else {
            if(! empty($msg_stat['msg'])) {
                ?>
                <div class="alert alert-block"><?=$msg_stat['msg']?><button class="close" data-dismiss="alert">×</button></div>
            <?php
            }
        }
        ?>
        </div>
    </div>
</div>
<?php $this->load->view('./shared/footer_view'); ?>