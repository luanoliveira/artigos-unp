<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title><?= $Ui->getTitlePage() ?></title>

      <link rel="stylesheet" href="<?= asset('libs/bootstrap-3.3.7/css/bootstrap.min.css') ?>">
      <link rel="stylesheet" href="<?= asset('libs/bootstrap-3.3.7/css/bootstrap-theme.min.css') ?>">
      <link rel="stylesheet" href="<?= asset('libs/font-awesome-4.6.3/css/font-awesome.min.css') ?>">

      <style>
      body {
         padding-top: 20px;
         padding-bottom: 20px;
      }
      </style>
   </head>

   <body>
      <div class="container">
         <nav class="navbar navbar-default">
            <div class="container-fluid">
               <!-- Brand and toggle get grouped for better mobile display -->
               <div class="navbar-header">
                  <a class="navbar-brand" href="<?= route('gestor.dashboard') ?>">
                     <img src="<?= asset('images/logo.png') ?>" style="margin-top: -7px;">
                  </a>
               </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <?php if ( $Ui->isMenu() ) : ?>
      <ul class="nav navbar-nav">
         <?php foreach($Ui->getMenu() as $id => $menu) : ?>
         <li class="<?= $Ui->getMenuActive() == $id ? 'active' : null; ?>">
            <a href="<?= $menu['link'] ?>"><?= $menu['name'] ?></a>
         </li>
         <?php endforeach; ?>
      </ul>
      <?php endif; ?>

      <form class="navbar-form navbar-left" action="<?= $Ui->getBuscaAction() ?>">
         <div class="form-group">
            <input type="text" name="s" value="<?= Request::input('s') ?>" class="form-control" placeholder="<?= $Ui->getBuscaTitle() ?>">
         </div>
         <?php if ( Request::input('s') ) : ?>
            <a href="<?= $Ui->getBuscaAction() ?>" class="btn btn-danger">
               <i class="fa fa-eraser"></i>
            </a>
         <?php endif; ?>
         <button type="submit" class="btn btn-default">
            <i class="fa fa-search" aria-hidden="true"></i>
         </button>
      </form>

      <ul class="nav navbar-nav navbar-right">
         <li>
            <img src="<?= \App\User::getAvatar() ?>" style="width: 50px;">
         </li>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= Auth::user()->name ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
               <li>
                  <a href="<?= route('gestor.users.edit', ['id' => Auth::user()->id]) ?>">Editar Perfil</a>
               </li>
               <li role="separator" class="divider"></li>
               <li>
                  <a href="<?= route('gestor.logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
               </li>
            </ul>
         </li>
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
      </div><!-- .container -->

      @yield('content')

      <script src="<?= asset('js/jquery-2.2.4.min.js') ?>"></script>
      <script src="<?= asset('libs/bootstrap-3.3.7/js/bootstrap.min.js') ?>"></script>
      <script src="<?= asset('libs/ckeditor/ckeditor.js') ?>"></script>
      <script src="<?= asset('libs/jquery.confirm/jquery.confirm.min.js') ?>"></script>

      <script>
         $("textarea.ckeditor").each(function(i, e) {
            CKEDITOR.replace($(this).attr("id"), {
               language: 'pt',
               uiColor: '#9AB8F3'
            });
         });

         $(".confirm").confirm({
            title: "Confirmation required",
            confirmButton: "Continuar",
            cancelButton: "Cancelar",
         });
      </script>
   </body>
</html>
