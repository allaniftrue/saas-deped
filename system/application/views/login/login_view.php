<?php $this->load->view('shared/header_login_view'); ?> 
<div class="span8">
    <p align="justify">
        Parturient augue parturient dolor lectus adipiscing magna velit non, sit rhoncus vel adipiscing sagittis montes ultrices augue, ut cum lundium massa porta integer sit mattis, porttitor amet! Ac vut aliquet, scelerisque et, dictumst, ut urna nisi. Tristique porta auctor enim tincidunt natoque, platea et tristique vut etiam magnis pulvinar amet nisi natoque, augue dolor, in, dignissim! Tortor. Tortor magnis diam, tempor lundium eu! Magnis, etiam, massa porttitor nec ac porttitor? Placerat cursus urna urna sed eros quis, facilisis? Urna adipiscing et dis sed sed magna etiam elit turpis a adipiscing aliquet natoque? Eros sed hac cursus hac magna lacus, a, in non adipiscing et ut dignissim elit amet eros dolor odio et, pulvinar sit, aliquam porttitor, elit vut sit natoque.
    </p>    
    <p align="justify">
    Ultricies! Ut est non nunc. Nunc magnis, rhoncus elit, ultricies aliquet! Eu integer, dis magnis mus nisi pellentesque urna. Porttitor phasellus, ultrices adipiscing! Montes pulvinar auctor rhoncus placerat nec, turpis elementum, et dapibus sociis pulvinar! Adipiscing pellentesque pulvinar a. Integer pellentesque, urna porta turpis, eu pellentesque risus elit ultricies. Rhoncus dis amet aenean urna vel vut integer porta nec? Arcu ut a! Urna sociis nec porta nunc habitasse mid! Purus a integer ultrices, vel placerat dapibus placerat, tristique arcu placerat sit, dolor magna, platea, facilisis augue et mauris amet aenean habitasse lacus ridiculus tincidunt in. Et, lorem? Augue augue pid porta nunc ultricies! Pulvinar vel dignissim magna, ultrices penatibus! Egestas! Cras? Placerat. Amet augue, purus? Facilisis sed mauris adipiscing.
    </p>
</div>
<div class="span3">
    <form action="index.php?mc=login&m=auth" method="post" class="well well-large">
        <p>
            <input type="text" name="username" placeholder="username" />
        </p>
        <p>
            <input type="password" name="password" placeholder="password" />
        </p>
        <p>
            <button class="btn btn-primary">Login</button> &nbsp; or &nbsp; <a href="#">Forgot Password?</a>
        </p>
    </form>
    <?php
    if(! empty($message)) {
    ?>
    <div class="alert alert-error"><?=$message?><button class="close" data-dismiss="alert">×</button></div>
    <?php
    }
    ?>
</div>
<?php $this->load->view('shared/footer_view'); ?>