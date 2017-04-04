<?php

namespace frontend\controllers;

use Yii;
use backend\models\Attachments;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\AttachmentColors;
use backend\models\AttachmentTags;

/**
 * AttachmentsController implements the CRUD actions for Attachments model.
 */
class AttachmentsController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['delete', 'update', 'index', 'create', 'view'],
                'rules' => [
                    [
                        'actions' => ['signup', 'login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['delete', 'update', 'index', 'create', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Attachments models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Attachments::find()->where(['user_id' => Yii::$app->user->id]),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Attachments model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Attachments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $path = Yii::getAlias('@approot') . '/uploads';
        if (!is_dir($path)) {
            mkdir($path);
        }
        $model = new Attachments;
        if ($model->load(Yii::$app->request->post()) && !empty($_FILES)) {
            $model->file_name = $_FILES['Attachments']['name']['file_name'];
            $model->file_encrypt_name = time() . $model->file_name;

            $model->model_name = $model->file_name;
            $model->user_id = \Yii::$app->user->id;
            $model->save();
            $tempPath = $_FILES['Attachments']['tmp_name']['file_name'];
            $uploadPath = $path . "/" . $model->file_encrypt_name;
            move_uploaded_file($tempPath, $uploadPath);

            $ex = \Yii::$app->GetColors;
            $delta = 24;
            $reduce_brightness = true;
            $reduce_gradients = true;
            $num_results = 20;
            $imagePath = $path . "/" . $model->file_encrypt_name;
            $imageURL = \yii\helpers\Url::base(true) . '/../../../uploads/' . $model->file_encrypt_name;
            $colors = $ex->Get_Color($imagePath, $num_results, $reduce_brightness, $reduce_gradients, $delta);
            if (is_array($colors)) {
                foreach ($colors as $hex => $count) {
                    $colorModel = new AttachmentColors;
                    $colorModel->attachment_id = $model->id;
                    $colorModel->color_code = "#" . $hex;
                    $colorModel->save();
                }
            }
            $ex_tags = \Yii::$app->GetTags;
            $tags = $ex_tags->Get_Tag($imageURL);
            if (is_array($tags)) {
                foreach ($tags as $tag) {
                    $tagModel = new AttachmentTags;
                    $tagModel->attachment_id = $model->id;
                    $tagModel->tag_code = $tag;
                    $tagModel->save();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Attachments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Attachments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Attachments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attachments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Attachments::findOne(['id' => $id, 'user_id' => Yii::$app->user->id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTest() {
        $curl = curl_init();
        $path = 'https://www.google.com.pk//images/branding/googlelogo/1x/googlelogo_color_272x92dp.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://www.googleapis.com/upload/storage/v1/b/vision_og/o?uploadType=media&name=myObject',
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => array(
                'Content-Type' => 'image/jpeg',
                'Content-Length' => '500000000000',
                'Authorization' => 'Bearer ya29.Ci9QA9PaZR9vHHy5F7wJm17jACReD_Ky6esBdCB0jRpCmh9IbvAp8uxE5Yg3vvU6AA'
            ),
            CURLOPT_POSTFIELDS => array($base64,
            )
        ));
        $resp = curl_exec($curl);
        curl_close($curl);
        print_r($resp);
        die;
    }

}
