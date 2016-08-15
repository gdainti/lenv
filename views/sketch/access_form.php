<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $accessForm yii\base\Model */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="sketch_form form">
    <?php $form = ActiveForm::begin([
        'id' => 'sketch-access-form',
        'enableClientValidation'=> false
    ]); ?>

    <?= $form->field($accessForm, 'sketch_id')->hiddenInput()->label(false) ?>
    <?= $form->field($accessForm, 'password')->passwordInput(['maxlength' => 50])->label('Enter password to edit image') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'sketch-access-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- sketch_form -->