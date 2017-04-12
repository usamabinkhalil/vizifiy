<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['logout'],
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
	public function actionLogin()
	{
		$serviceName = Yii::$app->getRequest()->getQueryParam('service');
		if (isset($serviceName)) {
			/** @var $eauth \nodge\eauth\ServiceBase */
			$eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
			$eauth->setRedirectUrl('http://localhost/vizifiy/server/app/backend/web/index.php?r=attachments/redirect');
//                                                            
			$eauth->setCancelUrl(Yii::$app->getUrlManager()->createAbsoluteUrl('site/login'));

			try {
				if ($eauth->authenticate()) {

                   
					var_dump($eauth->getIsAuthenticated(), $eauth->getAttributes()); exit;

					$identity = User::findByEAuth($eauth);
					Yii::$app->getUser()->login($identity);

					// special redirect with closing popup window
					$eauth->redirect();
				}
				else {
					// close popup window and redirect to cancelUrl
					$eauth->cancel();
				}
			}
			catch (\nodge\eauth\ErrorException $e) {
                /*print_r($eauth);die;*/
				// save error to show it later
				Yii::$app->getSession()->setFlash('error', 'EAuthException: '.$e->getMessage());

				// close popup window and redirect to cancelUrl
//				$eauth->cancel();
				$eauth->redirect($eauth->getCancelUrl());
			}
		}

		$model = new LoginForm();
		if ($model->load($_POST) && $model->login()) {
			return $this->goBack();
		}
		else {
			return $this->render('login', array(
				'model' => $model,
			));
		}
	}

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
