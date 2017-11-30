<?php   include_once ROOT. '/components/Cart.php'; // підключення моделі ?>

<!DOCTYPE html>
<html lang="en">
     <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Site courses</title>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/css/main.css?4" rel="stylesheet">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

    </head>

    <body>
        <header id="header"><!--header-->
            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="/"><img src="/assets/images/home/logo.png" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                   <li><a href="/cart/">Cart(<span id="cart-count"><?php  echo Cart:: CountCoursestByUser($_SESSION['user']);?></span>)</a>
                                    </li> 
                                    <?php if( $_SESSION['user']) { ?>
                                        <li><a href="/cabinet/"><i class="fa fa-user"></i> Account</a></li>
                                        <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Exit</a></li>
                                    <?php }  else{ ?>
                                        <li><a href="/user/register/"><i class="fa fa-lock"></i> Registration</a></li>
                                        <li><a href="/user/login/"><i class="fa fa-lock"></i> Log in</a></li>
                                    <?php    }  ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="/">Main</a></li>
                                    <li><a href="/courses/">Video-courses</a></li>
                                    <li><a href="/teachers/">Teachers</a></li>
                                    <li><a href="/contact/">Contact</a></li>
                                    <li><a href="/chat/">Chat</a></li>
                                    <?php if( User::isAdmin($_SESSION['user'])==1){?>
                                    <li><a href="/admin/orders">Admin orders</a></li>
                                    <?php } ?>
                                    <?php if( $_SESSION['user']) { ?>
                                    <li class="dropdown"><a href="#">My Orders<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="/cart/bought/">Bought orders</a></li>
                                            <li><a href="/cart/processing/">Processing orders</a></li>
                                            <li><a href="/cart/">Cart</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="/my-courses/">My courses</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-bottom-->

        </header><!--/header-->
  
