<?php

namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;
use backend\models\Attachments;
use backend\models\AttachmentColors;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\data\ActiveDataProvider;

/**
 * AttachmentsController implements the CRUD actions for Attachments model.
 */
class AttachmentsController extends ActiveController {

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'except' => ['upload'],
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['delete', 'update', 'upload', 'index', 'create'],
            'rules' => [
                [
                    'actions' => ['delete', 'update', 'upload', 'index', 'create'],
                    'allow' => TRUE,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function actions() {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider() {

        $query = Attachments::find()->where(['user_id' => Yii::$app->user->id]);
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
    }

    public function actionUpload() {
        $path = Yii::getAlias('@approot') . '/uploads';

        if (!is_dir($path))
            mkdir($path);

        if (isset($_POST['file_name']) && $_POST['file_name'] != '' && !empty($_FILES)) {
            $attachments = new Attachments();
            $attachments->file_encrypt_name = $_POST['file_encrypt_name'];
            $attachments->file_name = $_POST['file_name'];
            $attachments->model_name = $_POST['file_name'];
            $attachments->user_id = $_POST['user_id'];
            $attachments->save();

            $tempPath = $_FILES['file']['tmp_name'];
            $uploadPath = $path . "/" . $attachments->file_encrypt_name;
            move_uploaded_file($tempPath, $uploadPath);

            $ex = \Yii::$app->GetColors;
            $delta = 24;
            $reduce_brightness = true;
            $reduce_gradients = true;
            $num_results = 20;
            $path . "/" . $attachments->file_encrypt_name;
            $colors = $ex->Get_Color($path . "/" . $attachments->file_encrypt_name, $num_results, $reduce_brightness, $reduce_gradients, $delta);

            if (is_array($colors)) {
                foreach ($colors as $hex => $count) {
                    $colorModel = new AttachmentColors;
                    $colorModel->attachment_id = $attachments->id;
                    $colorModel->color_code = "#" . $hex;
                    $colorModel->color_percentage = $count ;
                    $colorModel->save();
                }
            }
            $imageURL = \yii\helpers\Url::base(true) . '/../../../uploads/' . $attachments->file_encrypt_name;
/*            $ex_tags = \Yii::$app->GetTags;
            $tags = $ex_tags->Get_Tag($imageURL);
          
            if (is_array($tags)) {
                foreach ($tags as $tag) {
                    $tagModel = new \backend\models\AttachmentTags;
                    $tagModel->attachment_id = $attachments->id;
                    $tagModel->tag_code = $tag;
                    $tagModel->save();
                }
            }*/
            $img_data = array("id"=>$attachments->id, "url"=> $imageURL);
            return $img_data;
        }
    }

    public function actionTags(){

        $data = \Yii::$app->request->post();
        $tag_id=$data["id"];
        /*print_r($data["tags"]);*/
/*        foreach($data["tags"] as $x ) {
            echo  $x["name"]."and ".$x["value"];
            echo "<br>";
            }*/
        if (is_array($data["tags"])) {
            foreach ($data["tags"] as $x) {
                $tagModel = new \backend\models\AttachmentTags;
                $tagModel->attachment_id =  $tag_id;
                $tagModel->tag_code = $x["name"];
                $tagModel->tag_percentage = $x["value"];
                $tagModel->save();
            }
        }
}

public function actionGetimage(){
   $im_id= \Yii::$app->request->get();
    $query = Attachments::find()->where(['id' =>$im_id]);
            return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
}

    public $modelClass = 'backend\models\Attachments';

}
