<!DOCTYPE HTML>
<html class="no-js" ng-app="appEmpreende" ng-controller="parametrosCtrl">
<head>
  <!-- Basic Page Needs
  ================================================== -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>@{{config.title}}</title>
  <meta name="description" content="@{{config.description}}">
  <meta name="author" content="@{{config.author}}">
  <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <!-- CSS
  ================================================== -->
  <link href="<?= asset('app/public/css/bootstrap.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= asset('app/public/css/style.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= asset('app/public/plugins/prettyphoto/css/prettyPhoto.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= asset('app/public/plugins/owl-carousel/css/owl.carousel.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= asset('app/public/plugins/owl-carousel/css/owl.theme.css') ?>" rel="stylesheet" type="text/css">
  <!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
  <!-- Color Style -->
  <link href="<?= asset('app/public/colors/color1.css') ?>" rel="stylesheet" type="text/css">

  <!-- SCRIPTS
  ================================================== -->
  <script src="<?= asset('app/public/js/modernizr.js') ?>"></script><!-- Modernizr -->
  <style>
  .contact-info-blocks > div, .contact-info-blocks > div > span {
    color: #fff;
  }
  </style>
</head>
<body>
  <!--[if lt IE 7]>
  <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
  <![endif]-->
  <div class="body">
    <!-- Start Site Header -->
    <header class="site-header" style="background-color:#005da9;">
      <div class="middle-header">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-sm-8 col-xs-8">
              <h1 class="logo"> <a href="<?= route('home') ?>"><img src="<?= asset('app/public/images/elaboraWhite_p.png') ?>" style="width: 190px;" alt="Logo"></a> </h1>
            </div>
            <div class="col-md-8 col-sm-4 col-xs-4">
              <div class="contact-info-blocks hidden-sm hidden-xs">
                <div>
                  <i class="fa fa-phone"></i> Fale Conosco
                  <span>84 3216.8609</span>
                </div>
                <div>
                  <i class="fa fa-envelope"></i> Nosso E-mail
                  <span>empreende@unp.br</span>
                </div>
                <div>
                  <i class="fa fa-clock-o"></i> Nosso Horário
                  <span>08:00 to 22:00</span>
                </div>
              </div>
              <a href="#" class="visible-sm visible-xs menu-toggle"><i class="fa fa-bars"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="main-menu-wrapper">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <nav class="navigation">
                <ul class="sf-menu">
                  <li><a href="#/home">e-labora</a>
                    <ul class="dropdown">
                      <li><a href="#">Quem somos</a></li>
                      <li><a href="#">Escritório modelo</a></li>
                      <li><a href="#">Laboratórios</a></li>
                    </ul>
                  </li>
                  <li><a href="index.html">Pesquisa</a>
                    <ul class="dropdown">
                      <li><a href="#">Publicações</a></li>
                      <li><a href="#">Linhas de Pesquisa</a></li>
                      <li><a href="#">Prêmios</a></li>
                    </ul>
                  </li>
                  <li><a href="index.html">Projetos</a>
                    <ul class="dropdown">
                      <li><a href="#">Pró-Indústria</a></li>
                      <li><a href="#">EdificAÇÃO</a></li>
                      <li><a href="#">Inovação Acessível</a></li>
                      <li><a href="#">Realidade Aumentada</a></li>
                    </ul>
                  </li>
                  <li><a href="index.html">Parceria</a>
                    <ul class="dropdown">
                      <li><a href="#">Empresas parceras</a></li>
                    </ul>
                  </li>
                  <li><a href="index.html">Cursos</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- End Site Header -->
    <!-- Site Showcase -->
    <div class="site-showcase">
      <!-- Start Page Header -->
      <!-- <div class="parallax page-header" style="background-image:url(http://placehold.it/1200x260&amp;text=IMAGE+PLACEHOLDER);">
      <div class="container">
      <div class="row">
      <div class="col-md-12">
      <h1>404 Error</h1>
    </div>
  </div>
</div>
</div> -->
<!-- End Page Header -->
</div>
<!-- Start Content -->
<div class="main" role="main">
  <div id="content" class="content full">
    <div class="container" ng-view>
    </div>
  </div>
</div>
<footer class="footer site-footer-bottom navbar-fixed-bottom">
  <div class="container">
    <div class="row">
      <div class="copyrights-col-left col-md-6 col-sm-6">
        <p>&copy; 2016 Unp Todos os Direitos Reservados</p>
      </div>
    </div>
  </div>
</footer>
<!-- End Site Footer -->
<a id="back-to-top"><i class="fa fa-angle-double-up"></i></a>
</div>
<script src="<?= asset('app/public/js/jquery-2.0.0.min.js') ?>"></script> <!-- Jquery Library Call -->
<script src="<?= asset('app/public/plugins/prettyphoto/js/prettyphoto.js') ?>"></script> <!-- PrettyPhoto Plugin -->
<script src="<?= asset('app/public/plugins/owl-carousel/js/owl.carousel.min.js') ?>"></script> <!-- Owl Carousel -->
<script src="<?= asset('app/public/plugins/flexslider/js/jquery.flexslider.js') ?>"></script> <!-- FlexSlider -->
<script src="<?= asset('app/public/js/helper-plugins.js') ?>"></script> <!-- Plugins -->
<script src="<?= asset('app/public/js/bootstrap.js') ?>"></script> <!-- UI -->
<script src="<?= asset('app/public/js/waypoints.js') ?>"></script> <!-- Waypoints -->
<script src="<?= asset('app/public/js/init.js') ?>"></script> <!-- All Scripts -->
<!--[if lte IE 9]><script src="app/public/js/script_ie.js"></script><![endif]-->

<!-- Angular JS   -->
<script src="<?= asset('app/public/angular.min.js') ?>"></script>
<script src="<?= asset('app/public/angular-sanitize.js') ?>"></script>
<script src="<?= asset('app/public/angular-route.min.js') ?>"></script>
<script src="<?= asset('app/controllers/controllers.js') ?>"></script>
<script src="<?= asset('app/controllers/parametros.js') ?>"></script>
<script src="<?= asset('app/public/js/ui-bootstrap-tpls-2.1.4.min.js') ?>"></script>
</body>
</html>