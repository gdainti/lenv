<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Draw your sketch';
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="sketch-draw row">
    <canvas id="js-sketch" class="sketch__canvas" width="640" height="480"></canvas>
    <?=Yii::$app->controller->renderPartial('draw_form', ['model' => $model]);?>
</div>