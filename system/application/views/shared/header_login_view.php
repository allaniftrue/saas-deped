<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">
        <link href="<?=base_url()?>css/bootstrap-responsive.css" rel="stylesheet">
        <link href="<?=base_url()?>css/global.css" rel="stylesheet">
        
        <script type="text/javascript" src="<?=base_url()?>js/jquery-1.7.2.min.js"></script>
        <!--[if lt IE 9]>
            <script src="<?=base_url()?>js/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?=base_url()?>js/jquery.backstretch.min.js"></script>
</head>
<body>
<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?=base_url()?>"></a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active"><a href="<?=base_url()?>">Home</a></li>
                    <li><a href="<?=base_url()?>about">About</a></li>
                    <li><a href="<?=base_url()?>contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container wrapper drop-shadow">
    
    
    
<!--    <div class="header">      
            <div id="divcontent">
                <div id="divlink">
                    <span class="spLeft">Have an account?</span>
                    <span class="spUnclicked" id="spLink">
                        <a href="" id="textSignin" class="text_link" onclick="showHideLogin(); return false;">
                            Sign In
                        </a>
                    </span>
                </div>

                <div style="clear:both;"></div>

                <div id="divlogin">
                    <form action="index.php?mc=login&m=auth" method="post">
                        <label for="acct" class="formLabel">Account</label>
                        <input type="email" name="acct" class="field" />
                        <label for="password" class="formLabel">Password</label>
                        <input type="password" name="password" class="field"/>
                        <div class="submit">
                            <input type="submit" value="Sign In" class="bluebutton bluesubmit"/> &nbsp;or &nbsp;
                            <a href="javascript:void(0)" class="link_bottom" id="create_account">Create an Account</a> <br />
                        </div>
                        <div class="forgot">
                            <a href="javascript:void(0)" class="link_bottom">Forgot Password?</a>
                            &nbsp;
                            <a href="javascript:void(0)" class="link_bottom">Forgot Username?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>-->