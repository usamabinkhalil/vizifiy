<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'type')->dropDownList(['admin' => 'Admin', 'author' => 'Author']) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'status')->dropDownList([10 => 'Active', 20 => 'Inactive', 0 => 'Deleted']) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
