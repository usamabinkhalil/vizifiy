<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AttachmentTags */

$this->title = Yii::t('app', 'Create Attachment Tags');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attachment # '.$model->attachment_id), 'url' => ['attachments/view', 'id' => $model->attachment_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attachment-tags-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
