<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "attachments".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $model_id
 * @property integer $model_name
 * @property integer $sort_order
 * @property string $file_name
 * @property string $file_encrypt_name
 * @property integer $created_at
 * @property integer $updated_at
 */
class Attachments extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'attachments';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'model_id', 'model_name', 'sort_order', 'file_name', 'file_encrypt_name'], 'safe'],
            [['user_id', 'model_id', 'sort_order', 'created_at', 'updated_at'], 'integer'],
            [['file_name', 'file_encrypt_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'attachment_id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'model_id' => Yii::t('app', 'Model ID'),
            'model_name' => Yii::t('app', 'Model Name'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'file_name' => Yii::t('app', 'File Name'),
            'file_encrypt_name' => Yii::t('app', 'File Encrypt Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function extraFields() {
        return ['colors','tags'];
    }

    public function getColors() {
        return $this->hasMany(AttachmentColors::className(), ['attachment_id' => 'id']);
    }

    public function getColorsDataProvider() {
        $dataProvider = new ActiveDataProvider([
            'query' => AttachmentColors::find()->where(['=', 'attachment_id', $this->id]),
        ]);
        return $dataProvider;
    }

    public function getTags() {
        return $this->hasMany(AttachmentTags::className(), ['attachment_id' => 'id']);
    }

    public function getTagsDataProvider() {
        $dataProvider = new ActiveDataProvider([
            'query' => AttachmentTags::find()->where(['=', 'attachment_id', $this->id]),
        ]);
        return $dataProvider;
    }

}
