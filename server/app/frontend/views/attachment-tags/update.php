<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AttachmentTags */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Attachment Tags',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attachment # '.$model->attachment_id), 'url' => ['attachments/view', 'id' => $model->attachment_id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="attachment-tags-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
