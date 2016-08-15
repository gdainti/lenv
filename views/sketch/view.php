<?php

/* @var $this yii\web\View */
/* @var $accessForm yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Draw&Save - saved image';
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="sketch-view row">
    <div class="col-md-6 sketch__view">
        <?=Html::img('/uploads/user/'.$model->image, ['class' => 'sketch__view-image']);?>
    </div>
    <div class="col-md-6 sketch__password-form">
       <?= Yii::$app->controller->renderPartial('access_form', [
           'model' => $model,
           'accessForm' => $accessForm,
       ]); ?>
    </div>
</div>
