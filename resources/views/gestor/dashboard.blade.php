<div class="row">

   <div class="col-sm-6">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title">
               <i class="fa fa-clock-o" aria-hidden="true"></i>
               <span>Últimos Posts</span>
            </h3>
         </div>
         <div class="panel-body">
            <ul class="list-group">
               <?php foreach ($posts as $post) : ?>
               <a href="#" class="list-group-item">
                  <time style="color: #666666;"><?= date_format(date_create($post->created_at), 'd/m/Y H:i:s') ?></time>
                  <p style="font-size: 19px;"><?= $post->post_title ?></p>
                  <span style="font-style: italic; font-weight: bold;">[<?= $post->user->name ?>]</span>
               </a>
               <?php endforeach; ?>
            </ul>
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
               <input type="text" class="form-control" disabled value="<?= route('v1.posts') ?>">
            </div>
            <div class="form-group">
               <input type="text" class="form-control" disabled value="<?= route('v1.tags') ?>">
            </div>
         </div>
      </div>
   </div><!-- .col-sm-6 -->

</div><!-- .row -->
