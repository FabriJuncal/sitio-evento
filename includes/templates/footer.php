<footer class="site-footer">
  <div class="contenedor clearfix">
    <div class="footer-informacion">
      <h3>sobre <span>gdlwebcam</span></h3>
      <p>Praesent rutrum efficitur pharetra. Vivamus scelerisque pretium velit, id tempor turpis pulvinar et. Ut bibendum finibus massa non molestie. Curabitur urna metus, placerat gravida lacus ut, lacinia congue orci. Maecenas luctus mi at ex blandit vehicula. Morbi porttitor tempus euismod.</p>
    </div>
    <div class="ultimos-tweets">
      <h3>Últimos <span>tweets</span></h3>
      <ul>
        <li> Integer ultricies justo nec ipsum finibus, eu interdum quam vulputate. <span>#Pellentesque</span> nec justo non est eleifend pulvinar.</li>

        <li>Integer ultricies <span>#justo</span> nec ipsum finibus, eu interdum quam vulputate. Pellentesque nec justo non est eleifend pulvinar.</li>

        <li> Integer ultricies justo nec ipsum finibus, eu interdum quam vulputate. #Pellentesque nec <span>@justo</span> non est eleifend pulvinar.</li>
      </ul>
    </div>
    <div class="menu">
      <h3>Redes <span>sociales</span></h3>

      <nav class="redes-sociales">
        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
      </nav>

    </div>
  </div>

  <p class="copyright">
    Todos los derechos Reservados GDLWEBCAMP 2018.
  </p>

  <!-- Begin Mailchimp Signup Form -->
  <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    #mc_embed_signup {
      background: #fff;
      clear: left;
      font: 14px Helvetica, Arial, sans-serif;
    }

    /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
      We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
  </style>


  <!-- Mailchimp - Formulario Emergente al hacer click en el boton de registrarse del Newslleter  -->
  <div style="display:none;">

    <div id="mc_embed_signup">

      <form action="https://Juncal.us20.list-manage.com/subscribe/post?u=a47758ec691be5054ad98003e&amp;id=c4f9542beb" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <div id="mc_embed_signup_scroll">
          <h2>Suscribete al Newslleter y no te pierdas nada de este evento</h2>
          <div class="indicates-required"><span class="asterisk">*</span> Es obligatorio</div>
          <div class="mc-field-group">
            <label for="mce-EMAIL">Correo Electrónico <span class="asterisk">*</span>
            </label>
            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
          </div>
          <div id="mce-responses" class="clear">
            <div class="response" id="mce-error-response" style="display:none"></div>
            <div class="response" id="mce-success-response" style="display:none"></div>
          </div> <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
          <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_a47758ec691be5054ad98003e_c4f9542beb" tabindex="-1" value=""></div>
          <div class="clear"><input type="submit" value="Suscribirse" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
        </div>
      </form>

    </div>
    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
    <script type='text/javascript'>
      (function($) {
        window.fnames = new Array();
        window.ftypes = new Array();
        fnames[0] = 'EMAIL';
        ftypes[0] = 'email';
        fnames[1] = 'FNAME';
        ftypes[1] = 'text';
        fnames[2] = 'LNAME';
        ftypes[2] = 'text';
        fnames[3] = 'ADDRESS';
        ftypes[3] = 'address';
        fnames[4] = 'PHONE';
        ftypes[4] = 'phone';
        fnames[5] = 'BIRTHDAY';
        ftypes[5] = 'birthday';
      }(jQuery));
      var $mcj = jQuery.noConflict(true);
    </script>
    <!--End mc_embed_signup-->

  </div>
</footer>

<script src="js/vendor/modernizr-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
  window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')
</script>
<script src="js/plugins.js"></script>
<script src="js/jquery.lettering.js"></script>


<?php
/** Agregamos una condicion para cargar los archivos **/

//basename(): Devuelve el nombre del final de la ruta.
// $_SERVER: Información del servidor y del entorno de ejecución.
// PHP_SELF: El nombre de archivo del script que se está ejecutando actualmente, relativo a la raíz del documento. Por ejemplo, "$ _SERVER ['PHP_SELF']" en un script en la dirección http://example.com/foo/bar.php sería /foo/bar.php .
$archivo = basename($_SERVER['PHP_SELF']);

// str_replace: Reemplaza una cadena de texto o parte de ella, por una otra que le pasemos.
// Simtaxis: str_replace(["Parte de la cadena que vamos a reemplazar"[, ["Cadena nueva que reemplazara la anterior"], [fuente que contiene la cadena a reemplazar]).
$pagina = str_replace(".php", "", $archivo);

if ($pagina == 'index' || $pagina == '') {
  echo '
      <script src="js/jquery.animateNumber.min.js"></script>
      <script src="js/jquery.countdown.min.js"></script>
      <script src="js/jquery.colorbox-min.js"></script>
      <script src="js/leaflet/leaflet.js"></script>
      ';
} else if ($pagina == 'invitados') {
  echo '<script src="js/jquery.colorbox-min.js"></script>';
} else if ($pagina == 'conferencia') {
  echo '<script src="js/lightbox.js"></script>';
}

?>

<script src="js/cotizador.js"></script>
<script src="js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
  window.ga = function() {
    ga.q.push(arguments)
  };
  ga.q = [];
  ga.l = +new Date;
  ga('create', 'UA-XXXXX-Y', 'auto');
  ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>

<!-- Mailchimp - Formulario Emergente -->
<!-- Carga una sola vez por usuario despues de permanecer 5 segundos en el sitio, por lo que si se quiere volver a ver la ventana emergente se tendria que eliminar los datos de navegacion del navegador -->
<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script>
<script type="text/javascript">
  window.dojoRequire(["mojo/signup-forms/Loader"], function(L) {
    L.start({
      "baseUrl": "mc.us20.list-manage.com",
      "uuid": "a47758ec691be5054ad98003e",
      "lid": "c4f9542beb",
      "uniqueMethods": true
    })
  })
</script>

<!-- SISTEMA DE CACHEO -->
<?php
	// Guarda todo el contenido a un archivo
	$fp = fopen($archivoCache, 'w');
	fwrite($fp, ob_get_contents());
	fclose($fp);
	// Enviar al navegador
	ob_end_flush();
?>


</body>
</html>