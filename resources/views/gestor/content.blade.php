@extends('layouts.gestor')

@section('content')
<div class="container">

    <?php if (Session::has('alert.success')) : ?>
    <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        <?= Session::get('alert.success') ?>
    </div><!-- .aert -->
    <?php endif; ?>

    <?php if (Session::has('alert.danger')) : ?>
    <div class="alert alert-danger alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        <?= Session::get('alert.danger') ?>
    </div><!-- .aert -->
    <?php endif; ?>

    <?php if ( $Ui->getTitle() ) : ?>
    <div class="page-header">
        <h1>
            <?= $Ui->getTitle() ?>
            <?php if ( $Ui->getSubTitle() ) : ?>
            <small><?= $Ui->getSubTitle() ?></small>
            <?php endif; ?>
        </h1>
    </div><!-- .page-header -->
    <?php endif; ?>

    <?php if ( $Ui->getPageActions() ) : ?>
    <div class="text-right" style="margin-bottom: 20px;">
        <?php foreach($Ui->getPageActions() as $action) : ?>

        <?php
            $attrs = array_map(function($value, $key) {
                return sprintf("%s=\"%s\"", $key, $value);
            }, $action['attrs'], array_keys($action['attrs']));
        ?>

        <a href="<?= $action['link'] ?>" <?= implode(' ', $attrs) ?>><?= $action['name'] ?></a>
        <?php endforeach; ?>
    </div><!-- .text-right -->
    <?php endif; ?>

    @include($view, $data)

</div><!-- .container -->
@endsection
