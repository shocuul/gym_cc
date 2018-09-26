<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYM Control Center</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>images/fav.png" />
    <!-- Css Files -->
    <link href="<?= base_url(); ?>css/custom.css" rel="stylesheet">
    <link href="<?= base_url(); ?>css/color.css" rel="stylesheet">
    <link href="<?= base_url(); ?>css/responsive.css" rel="stylesheet">
    <link href="<?= base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>css/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>css/prettyPhoto.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!--Wrapper Start-->
    <div class="wrapper color-option-2">
       <!--Header Start-->
        <header class="header color-2" id="header">
            <div class="logo-nav">
                <div class="container-fluid">
                    <div class="row">
                        <!--Logo Start-->
                        <div class="col-md-3 nop">
                            <div class="logo">
                                <a href="index.html"> <img src="<?= base_url(); ?>images/logo.png" alt=""></a>
                            </div>
                        </div>
                        <!--Logo End-->

                        <!--Nav Start-->
                        <div class="col-md-9">
                            <div class="header-navbar">
                                <nav>
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Cambiar navegación</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                    </div>

                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                        <ul class="nav navbar-nav">
                                            <li> <a href="#">Inicio</span></a>
                                            </li>
                                            <li> <a href="#">Usuarios <span class="caret"></span></a>
                                                <ul class="sub-menu">
                                                    <li><a href="events.html">Ver Usuarios</a></li>
                                                    <li><a href="single-event.html">Añadir Usuario</a></li>
                                                </ul>
                                            </li>
                                            <li> <a href="#">Socios <span class="caret"></span></a>
                                                <ul class="sub-menu">
                                                    <li><a href="events.html">Ver Miembros</a></li>
                                                    <li><a href="single-event.html">Añadir Miembro</a></li>
                                                </ul>
                                            </li>
                                            <li> <a href="#">Estadisticas <span class="caret"></span></a>
                                                <ul class="sub-menu">
                                                    <li><a href="blog-full.html">Blog Full</a></li>
                                                    <li><a href="blog-grid.html">Blog Grid</a></li>
                                                    <li><a href="blog-list.html">Blog List</a></li>
                                                    <li><a href="blog-sidebar.html">Blog With Sidebar</a></li>
                                                    <li><a href="single.html">Single</a></li>
                                                </ul>
                                            </li>
                                            <li> <a href="#">Configuracion <span class="caret"></span></a>
                                                <ul class="sub-menu">
                                                    <li><a href="shop.html">Planes y Propositos</a></li>
                                                    <li><a href="shop-list.html">Shop List</a></li>
                                                    <li><a href="pro-details.html">Shop Details</a></li>
                                                </ul>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    <!-- /.navbar-collapse -->
                                    <!--Nav End-->
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-action-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="newsticker" id="newsticker">
                                <div class="bn-title"><strong>Comunicados:</strong><span></span></div>
                                <ul>
                                    <li><a href="#">Horario del Gym: 8:00 am. a 9:00pm.</a></li>
                                    <li><a href="#">Se les comunica que el sabado abra mantenimiento a las maquinas de cardio por lo cual no podran ser utilizadas</a></li>
                                    <li><a href="#">Ofrescan los nuevos paquetes mensuales que incluyen tonificacion de torso y gluteos </a></li>
                                    <li><a href="#">El dia 16 de Septiembre no se laborara en el gym</a></li>
                                    <li><a href="#">Favor de limpiar su area de trabajo</a></li>
                                    <li><a href="#">Mensaje Independiente 3 </a></li>
                                </ul>
                                <div class="bn-navi"> <span></span> <span></span> </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </header>
        <!--Header End-->