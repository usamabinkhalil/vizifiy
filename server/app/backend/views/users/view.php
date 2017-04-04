<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
    <?php $statuses = [20 => 'Inactive', 10 => 'Active', 0 => 'Deleted'] ?>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'type',
            'phone',
            'firstname',
            'lastname',
            'username',
            'email:email',
            [
                'label' => 'Status',
                'value' => $statuses[$model->status],
            ],
            [
                'label' => 'Created At',
                'value' => gmdate("Y-m-d H:i:s", $model->created_at),
            ],
            [
                'label' => 'Updated At',
                'value' => gmdate("Y-m-d H:i:s", $model->updated_at),
            ],
        ],
    ])
    ?>

</div>
