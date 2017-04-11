<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "attachments".
 *
 * @property integer $tagid
 * @property integer $attachment_id
 * @property integer $model_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class AttachmentTags extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'attachment_tags';
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
            [['id', 'tag_code','tag_percentage'], 'safe'],
            [['id', 'attachment_id','tag_percentage', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'attachment_id' => Yii::t('app', 'User ID'),
            'tag_code' => Yii::t('app', 'Model ID'),
            'tag_percentage' => Yii::t('app', 'Tag Percent'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getAttachments() {
        return $this->hasOne(Attachments::className(), ['id' => 'attachment_id']);
    }

}
