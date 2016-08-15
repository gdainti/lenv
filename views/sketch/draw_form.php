<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="sketch_form form">
    <?php $form = ActiveForm::begin([
        'id' => 'sketch-form'
    ]); ?>

    <div class="form-group"><?= $form->field($model, 'image')->hiddenInput()->label(false) ?></div>
    <div class="form-group"><?= $form->field($model, 'canvas')->hiddenInput()->label(false) ?></div>
    <div class="form-group"><?= $form->field($model, 'password')->passwordInput(['maxlength' => 50]) ?></div>

    <div class="form-group">
        <?= Html::a('Save', '#', ['class' => 'btn btn-primary', 'id' => 'js-create-sketch']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- sketch-form -->

<? $this->registerJs('Sketch.init();', yii\web\View::POS_READY); ?>
<? $this->registerJs('Sketch.setSketchActions('.json_encode($model->canvas).');', yii\web\View::POS_READY); ?>