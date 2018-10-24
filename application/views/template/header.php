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
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="<?= base_url(); ?>css/prettyPhoto.css" rel="stylesheet">
    <link href="<?= base_url(); ?>css/gym.css" rel="stylesheet">
    <link href="<?= base_url(); ?>css/dropzone.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?= base_url(); ?>js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>js/dropzone.min.js"></script>
    <script src="<?= base_url(); ?>js/jquery-migrate-1.4.1.min.js"></script>
    <script src="<?= base_url(); ?>js/jquery.prettyPhoto.js"></script>
</head>
<script type="text/javascript">
    Dropzone.prototype.defaultOptions.dictDefaultMessage = "Arrastra las imagenes aqui.;
    Dropzone.prototype.defaultOptions.dictFallbackMessage = "Your browser does not support drag'n'drop file uploads.";
    Dropzone.prototype.defaultOptions.dictFallbackText = "Please use the fallback form below to upload your files like in the olden days.";
    Dropzone.prototype.defaultOptions.dictFileTooBig = "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.";
    Dropzone.prototype.defaultOptions.dictInvalidFileType = "No puedes subir archivos de este tipo.";
    Dropzone.prototype.defaultOptions.dictResponseError = "Server responded with {{statusCode}} code.";
    Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancel upload";
    Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "Are you sure you want to cancel this upload?";
    Dropzone.prototype.defaultOptions.dictRemoveFile = "Remove file";
    Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "No puedes subir mas archivos.";
</script>
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
                                <a href="<?php echo base_url(); ?>"> <img src="<?= base_url(); ?>images/logo.png" alt=""></a>
                            <div class="gy_icon visible-sm visible-xs">
                                <?php if(!$this->CI->auth_model->logged_in()): ?>
                                        <?php echo anchor('iniciar_sesion','<i class="fa fa-user"></i>','class="login-btn"'); ?>
                                    <?php else: ?>
                                        <?php echo anchor('cerrar_sesion','<i class="fas fa-sign-in-alt"></i>','class="login-btn"'); ?>
                                    <?php endif ?>
                            </div>
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
                                            <li> <a href="<?php echo base_url(); ?>">Inicio</span></a>
                                            </li>
                                            <?php if($this->CI->has_permissions('profile')): ?>
                                                <li>
                                                    <?php echo anchor('perfil','Ver mi perfil'); ?>
                                                </li>
                                                <li>
                                                    <?php echo anchor('menus','Menus de Alimentacion'); ?>
                                                </li>
                                            <?php endif ?>
                                            <?php if($this->CI->has_permissions('users')): ?>
                                            <li> <a href="#">Usuarios <span class="caret"></span></a>
                                                <ul class="sub-menu">
                                                    <li>
                                                        <?php echo anchor('usuarios', 'Ver Usuarios'); ?>
                                                    </li>
                                                    <li>
                                                        <?php echo anchor('auth/create_user', 'Añadir Usuario'); ?>
                                                    </li>
                                                </ul>
                                            </li>
                                            <?php endif ?>
                                            <?php if($this->CI->has_permissions('members')): ?>
                                            <li> <a href="#">Socios <span class="caret"></span></a>
                                                <ul class="sub-menu">
                                                    <li>
                                                    <?php echo anchor('socios', 'Ver Socios'); ?>
                                                    </li>
                                                    <li>
                                                    <?php echo anchor('socios/nuevo', 'Añadir Socio'); ?> 
                                                    </li>
                                                </ul>
                                            </li>
                                            <?php endif ?>
                                            <?php if($this->CI->has_permissions('stats')): ?>
                                            <li> <a href="#">Estadisticas <span class="caret"></span></a>
                                                <ul class="sub-menu">
                                                    <li><?php echo anchor('estadisticas','Asistencias de Socios') ?></li>
                                                   
                                                </ul>
                                            </li>
                                            <?php endif ?>
                                            <?php if($this->CI->has_permissions('config') || $this->CI->has_permissions('plans')): ?>
                                            <li> <a href="#">Configuracion <span class="caret"></span></a>
                                                <ul class="sub-menu">
                                                    <?php if($this->CI->has_permissions('plans')): ?>
                                                    <li>
                                                    <?php echo anchor('configuracion/planes','Planes y Propositos') ?></li>
                                                    <?php endif ?>
                                                    <?php if($this->CI->has_permissions('config')): ?>
                                                    <li><?php echo anchor('configuracion/permisos','Permisos') ?></li>
                                                    <li><?php echo anchor('configuracion/imagenes','Imagenes') ?></li>
                                                    <li>
                                                        <?php echo anchor('configuracion/comunicados','Comunicados'); ?>
                                                    </li>
                                                    <?php endif ?>
                                                </ul>
                                            </li>
                                            <?php endif ?>
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
                        <?php if(!empty($notices)): ?>
                        <div class="col-md-10 col-sm-10">
                            <div class="newsticker" id="newsticker">
                                <div class="bn-title"><strong>Comunicados:</strong><span></span></div>
                                <ul>
                                    <?php foreach ($notices as $notice) : ?>
                                    <li><a href="#"><?php echo $notice->comunicado?></a></li>
                                    <?php endforeach ?>
                                </ul>
                                <div class="bn-navi"> <span></span> <span></span> </div>
                            </div>
                        </div>
                        <?php endif ?>
                        <div class="col-md-2 col-sm-2 pull-right">
                            <ul class="acbar-right">
                                <li>
                                    <?php if(!$this->CI->auth_model->logged_in()): ?>
                                        <?php echo anchor('iniciar_sesion','<i class="fa fa-user"></i> Iniciar Sesion','class="login-btn"'); ?>
                                    <?php else: ?>
                                        <?php echo anchor('cerrar_sesion','<i class="fas fa-sign-in-alt"></i> Cerrar Sesion','class="login-btn"'); ?>
                                    <?php endif ?>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </header>
        <!--Header End-->