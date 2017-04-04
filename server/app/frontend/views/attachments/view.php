<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Attachments */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attachments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attachments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'file_name',
            [
                'label' => 'Created At',
                'value' => gmdate("Y-m-d H:i:s", $model->created_at),
            ],
            [
                'label' => 'Updated At',
                'value' => gmdate("Y-m-d H:i:s", $model->updated_at),
            ],
        ],
    ]);
    ?>
    <?= Html::a(Yii::t('app', 'Create Attachment Colors'), ['attachment-colors/create', 'attachment_id' => $model->id], ['class' => 'btn btn-success']) ?>
    <?=
    GridView::widget([
        'dataProvider' => $model->colorsDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'color_code',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'controller' => 'attachment-colors',
            ],
        ],
    ]);
    ?>
    <?= Html::a(Yii::t('app', 'Create Attachment Tags'), ['attachment-tags/create', 'attachment_id' => $model->id], ['class' => 'btn btn-success']) ?>
    <?=
    GridView::widget([
        'dataProvider' => $model->tagsDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'tag_code',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'controller' => 'attachment-tags',
            ],
        ],
    ]);
    ?>
</div>
