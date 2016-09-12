<?php if ( $table->getData()->count() ) : ?>

   <table class="table table-hover">
      <thead>
         <tr>
            <?php foreach($table->getColumns() as $column) : ?>
               <th><?= ucwords($column['name']) ?></th>
            <?php endforeach; ?>
            <?php if ($table->getActions()) : ?>
               <th width="<?= count($table->getActions())*50 ?>px"></th>
            <?php endif; ?>
         </tr>
      </thead>

      <tbody>
         <?php foreach($table->getData() as $data) : ?>
            <tr>
               <?php foreach($table->getColumns() as $column) : ?>
                  <td style="vertical-align: middle;">
                     <?php if ( is_callable($column['callback']) ) : ?>
                        <?php echo call_user_func_array($column['callback'], [$data]); ?>
                     <?php else : ?>
                        -
                     <?php endif; ?>
                  </td>
               <?php endforeach; ?>

               <?php if ($table->getActions()) : ?>
                  <td style="vertical-align: middle; text-align: right;">
                     <div class="btn-group">
                        <?php foreach($table->getActions() as $action) : ?>
                           <?php
                              $attrs = array_map(function($value, $attr) {
                                 return $value ? sprintf('%s="%s"', $attr, $value) : $attr;
                              }, $action['attrs'], array_keys($action['attrs']));
                           ?>
                           <a href="<?= is_callable($action['linkCallback']) ? call_user_func_array($action['linkCallback'], [$data]) : '#'; ?>" <?= implode(' ', $attrs) ?>>
                              <i class="fa fa-<?= $action['icon'] ?>"></i>
                           </a>
                        <?php endforeach; ?>
                     </div>
                  </td>
               <?php endif; ?>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>

<?php

$padding = 3;

$start = $table->getData()->currentPage()-$padding > 1 ? $table->getData()->currentPage()-$padding : 1;

$end = $table->getData()->currentPage()+$padding < $table->getData()->lastPage() ? $table->getData()->currentPage()+$padding : $table->getData()->lastPage();

?>

<?php if ( $table->getData()->lastPage() > 1 ) : ?>
<nav>
   <ul class="pagination">

      <?php if ( $table->getData()->currentPage() > 1 ) : ?>
         <li>
            <a href="<?= route(\Request::route()->getName(), ['page' => 1, 's' => Request::input('s')]) ?>">
               <i class="fa fa-angle-double-left"></i>
            </a>
         </li>

         <li>
            <a href="<?= route(\Request::route()->getName(), ['page' => $table->getData()->currentPage()-1, 's' => Request::input('s')]) ?>">
               <i class="fa fa-angle-left"></i>
            </a>
         </li>
      <?php endif; ?>


      <!--
      <li class="disabled">
         <span>
           <span aria-hidden="true">&laquo;</span>
         </span>
      </li>
   -->

      <?php foreach (range($start, $end) as $page) : ?>
         <li class="<?= $table->getData()->currentPage() == $page ? 'active' : null; ?>">
            <a href="<?= route(\Request::route()->getName(), ['page' => $page, 's' => Request::input('s')]) ?>"><?= $page ?></a>
         </li>
      <?php endforeach; ?>


      <?php if ( $table->getData()->currentPage() < $table->getData()->lastPage() ) : ?>
         <li>
            <a href="<?= route(\Request::route()->getName(), ['page' => $table->getData()->currentPage()+1, 's' => Request::input('s')]) ?>">
               <i class="fa fa-angle-right"></i>
            </a>
         </li>

         <li>
            <a href="<?= route(\Request::route()->getName(), ['page' => $table->getData()->lastPage(), 's' => Request::input('s')]) ?>">
               <i class="fa fa-angle-double-right"></i>
            </a>
         </li>
      <?php endif; ?>

      <!--
      <li class="active">
         <span>1 <span class="sr-only">(current)</span></span>
      </li>
   -->
   </ul>
</nav>
<?php endif; ?>

<?php else : ?>
   <div class="alert alert-warning">Ops, não conseguimos encontrar nenhum registro.</div>
<?php endif; ?>
