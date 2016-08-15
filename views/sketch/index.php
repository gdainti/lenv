<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Draw&Save - saved images';
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="sketch-index">
    <div class="sketch row"><!--
        <? foreach ($sketches as $item) : ?>
        --><div class="sketch__item col-xl-2 col-lg-2 col-md-3 col-sm-4 col-sx-12">
            <?= Html::a('',['view', 'id' => $item->sketch_id], [
                'class' => 'sketch__image',
                'style' => "background-image: url(/uploads/user/$item->image)"
            ]); ?>
        </div><!--
        <? endforeach ?>
    --></div>
        <? echo LinkPager::widget([
            'pagination' => $pagination,
        ]); ?>
</div>
