<form class="form-horizontal" method="post" enctype="<?= $form->getEnctype() ?>" action="<?= $form->getAction() ?>">
   <?php if ( $form->isPUT() ) : ?>
   <?= method_field($form->getMethod()) ?>
   <?php endif; ?>

   {{ csrf_field() }}

   <?php foreach($form->getFields() as $field) : ?>
   <div class="<?= $errors->get($field->getName()) ? 'form-group has-error' : 'form-group'; ?>">

      <label for="field_<?= $field->getName() ?>" class="col-sm-2 control-label"><?= $field->getLabel() ?></label>

      <div class="col-sm-10">
         <?php echo $field->tag(); ?>

         <?php if ( $errors->has($field->getName()) ) : ?>
         <span class="help-block"><?= $errors->first($field->getName()) ?></span>
         <?php endif; ?>
      </div>

   </div><!-- .form-group -->
   <hr>
   <?php endforeach; ?>

   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <?php if ( $form->isBack() ) : ?>
         <a class="btn btn-default" href="<?= $form->getActionBAck() ?>"><span aria-hidden="true">&larr;</span> Voltar</a>
         <?php endif; ?>

         <button type="submit" class="btn btn-primary"><?= $form->isPUT() ? 'Atualizar' : 'Cadastrar'; ?></button>
      </div>
   </div>
</form>
