<div class="row">

   <div class="col-sm-6">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3 class="panel-title">
               <i class="fa fa-clock-o" aria-hidden="true"></i>
               <span>Últimos posts</span>
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

</div><!-- .row -->
