<?php if ( $table->getData() ) : ?>

   <table class="table table-hover">
      <thead>
         <tr>
            <?php foreach($table->getColumns() as $column) : ?>
               <th><?= $column['name'] ?></th>
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
                  <td>
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

   <?= $table->getData()->links() ?>

<?php else : ?>
   <p>Ops, nenhum data cadastrado.</p>
<?php endif; ?>
