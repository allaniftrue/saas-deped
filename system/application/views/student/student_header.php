<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DepEd SaaS</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">
        <link href="<?=base_url()?>css/bootstrap-responsive.css" rel="stylesheet">
        <link href="<?=base_url()?>css/docs.css" rel="stylesheet">
        <link href="<?=base_url()?>css/jquery.ui.all.css" rel="stylesheet">
        <link href="<?=base_url()?>css/global.css" rel="stylesheet">
        
        <script src="<?=base_url()?>js/jquery-1.7.2.min.js"></script>
        <!--[if lt IE 9]>
            <script src="<?=base_url()?>js/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?=base_url()?>js/jquery.backstretch.min.js"></script>

</head>
<body data-spy="scroll" data-target=".subnav" data-offset="50">
<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li><a href="<?=base_url()?>?mc=student_main<?='&s=1&sess='.random_string('alnum', 64).'&k='.random_string('alnum', 32)?>">Dashboard</a></li>
                   <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Resources<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                             <li><a href="#">E-books</a></li>
                             <li><a href="#">Education Games</a></li>
                        </ul>
                   </li>
                </ul>
                <form class="navbar-search pull-left" action="">
                 <input type="text" class="search-query span2" placeholder="Search">
                </form>
            </div>
             <div class="nav-collapse pull-right">
                <ul class="nav">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> <?=$uname?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=base_url()?>?mc=stdaccount&s=<?=rand(1,999999)?>&sess=<?=random_string('alnum', 64).'&r='.random_string('alnum', 32); ?>">Account Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="<?=base_url()?>?mc=logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container wrapper drop-shadow">