<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Eventos</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|PT+Sans" rel="stylesheet">
  <link rel="stylesheet" href="css/normalize.css">
  

  <?php
    /** Agregamos una condicion para cargar los archivos **/

    //basename(): Devuelve el nombre del final de la ruta.
    // $_SERVER: Información del servidor y del entorno de ejecución.
    // PHP_SELF: El nombre de archivo del script que se está ejecutando actualmente, relativo a la raíz del documento. Por ejemplo, "$ _SERVER ['PHP_SELF']" en un script en la dirección http://example.com/foo/bar.php sería /foo/bar.php .
    $archivo = basename($_SERVER['PHP_SELF']);

    // str_replace: Reemplaza una cadena de texto o parte de ella, por una otra que le pasemos.
    // Simtaxis: str_replace(["Parte de la cadena que vamos a reemplazar"[, ["Cadena nueva que reemplazara la anterior"], [fuente que contiene la cadena a reemplazar]).
    $pagina = str_replace(".php","",$archivo);

    if($pagina == 'index' || $pagina == ''){
      echo '
      <link rel="stylesheet" href="css/colorbox.css">
      <link rel="stylesheet" href="js/leaflet/leaflet.css ">
      ';
    } else if($pagina == 'invitados'){
      echo '<link rel="stylesheet" href="css/colorbox.css">';
    }else if($pagina == 'conferencia'){
      echo '<link rel="stylesheet" href="css/lightbox.css">';
    }

  ?>
  
  
  <link rel="stylesheet" href="css/main.css">
</head>

<!--  Con PHP le agregamos una clase al body, con el nombre del archivo que pertenece -->
<body class="<?php echo $pagina ?>">
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->


<!-- ENCABEZADO -->

  <header class="site-header">

    <div class="hero">

      <div class="contenido-header">

        <nav class="redes-sociales">
          <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </nav>

        <div class="informacion-evento">

          <div class="clearfix">
            <p class="fecha"><i class="fa fa-calendar" aria-hidden="true"></i>26/05/18</p>
            <p class="ciudad"><i class="fa fa-map-marker" aria-hidden="true"></i>Candelaria</p>
          </div>

          <h1 class="nombre-sitio">GdlWebCamp</h1>
          <p class="slogan">La mejor conferencia de <span>diseño web</span></p>
          
        </div><!-- informacion-evento -->

        

      </div><!-- contenido-header -->

    </div><!-- hero -->

  </header>

<!-- BARRA DE MENU -->

  <div class="barra">

    <div class="contenedor clearfix">

        <div class="logo">
            <a href="index.php">
              <img src="img/logo.svg" alt="logo GdlWebCamp">
            </a>
        </div>

      <div class="menu-movil">
        <span></span>
        <span></span>
        <span></span>
      </div>
 
      <nav class="navegacion-principal clearfix">
        <a href="conferencia.php">Conferencia</a>
        <a href="calendario.php">Calendario</a>
        <a href="invitados.php">Invitados</a>
        <a href="registro.php" >Reservaciones</a>
      </nav>

    </div><!-- contenedor -->

  </div><!-- barra -->