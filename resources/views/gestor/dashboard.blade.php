<div class="row">

   <div class="col-sm-6">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title">
               <i class="fa fa-clock-o" aria-hidden="true"></i>
               <span>Últimos Artigos</span>
            </h3>
         </div>
         <div class="panel-body">

            <?php if  ($posts->count() ) : ?>
            <ul class="list-group">
               <?php foreach ($posts as $post) : ?>
               <a href="#" class="list-group-item">
                  <time style="color: #666666;"><?= date_format(date_create($post->created_at), 'd/m/Y H:i:s') ?></time>
                  <p style="font-size: 19px;"><?= $post->post_title ?></p>
                  <span style="font-style: italic; font-weight: bold;">[<?= $post->user->name ?>]</span>
               </a>
               <?php endforeach; ?>
            </ul>
            <?php else : ?>
            <div class="alert alert-warning">Nenhum artigo cadastrado.</div>
            <?php endif; ?>
         </div>
      </div>
   </div><!-- .col-sm-6 -->

   <div class="col-sm-6">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title">
               <i class="fa fa-database" aria-hidden="true"></i>
               <span>Api</span>
            </h3>
         </div>
         <div class="panel-body">
            <div class="form-group">
               <input type="text" class="form-control" disabled value="<?= config('app.url') ?>/v1/posts">
            </div>
            
            <div class="form-group">
               <input type="text" class="form-control" disabled value="<?= config('app.url') ?>/v1/posts/{s?}">
            </div>

            <div class="form-group">
               <input type="text" class="form-control" disabled value="<?= config('app.url') ?>/v1/post/{id}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" disabled value="<?= config('app.url') ?>/v1/categorias/{categorias_id}/posts/{s?}">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" disabled value="<?= config('app.url') ?>/v1/categorias">
            </div>            
            <div class="form-group">
               <input type="text" class="form-control" disabled value="<?= config('app.url') ?>/v1/tags">
            </div>
         </div>
      </div>
   </div><!-- .col-sm-6 -->

</div><!-- .row -->
