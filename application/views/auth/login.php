<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYM Control Center</title>
    <link rel="icon" type="image/x-icon" href="images/fav.png" />
    <!-- Css Files -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/color.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/gym.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="align">
    
    <div class="grid">
    <?php echo form_open('iniciar_sesion','class="form login"'); ?>
    <header class="login__header">
        <h3 class="login__title">Iniciar Sesion</h3>
    </header>
    <?php echo $message; ?>
    <div class="login__body">
        <div class="form_field">
            <?php echo form_input($usuario); ?>
        </div>
        <div class="form__field">
            <?php echo form_input($password); ?>
        </div>
    </div>
    <footer class="login__footer">
    <?php echo form_submit('submit','Iniciar Sesion','class=""'); ?>
    </footer>
    <?php echo form_close(); ?>
    </div>
    
        <!-- <img src="images/logo_login.jpg" alt="" class="mb-4">
        <h2 class="section-title">
            
        </h2>
        
        <label for="inputUsuario" class="sr-only">Nombre de usuario</label>
        
        <label for="inputPassword" class="sr-only">Contraseña</label>
         -->

       
    
</body>


 <!--Js Files Start-->
 <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-1.4.1.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.ticker.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>