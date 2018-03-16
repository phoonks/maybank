<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\caching\Cache;
use app\models\LoginForm;
use app\models\ContactForm;
use app\forms\ResetpasswordForm;
use app\forms\FindnameForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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

    public function actionFindname()
    {
        $db = Yii::$app->db->beginTransaction();
        $model = new FindnameForm();
        try {
            if ($model->load(Yii::$app->request->post())) {
                $user = $model->findname();

                Yii::$app->getSession()->setFlash('success', 'Finded User');
                $db->commit();

                //send email to user
                // $code = rand(10000,99999);
                // Yii::$app->mailer->compose('resetpassword',['model'=> $code])
                //     ->setFrom('kahsengpooh@gmail.com')
                //     ->setTo($user->email)
                //     ->setSubject('This is the validate code!')
                //     ->send();
                Yii::$app->cache->set('resetpassword', $user->id);
                return $this->redirect(['resetpassword']);
            }
        }catch(\Exception $e) {
            $db->rollback();
            Yii::$app->getSession()->setFlash('danger', $e->getMessage());
        }
        return $this->render('findname', [
            'model' => $model,
        ]);
    }

    public function actionResetpassword()
    {
        $id = Yii::$app->cache->get('resetpassword');
        $db = Yii::$app->db->beginTransaction();
        $model = new ResetpasswordForm();
        try {
            if ($model->load(Yii::$app->request->post())) {
                switch (\Yii::$app->request->post()) {
                    case '':
                    case '':
                }
                $wrong = $model->reset($id);
                if($wrong === false) {
                    Yii::$app->getSession()->setFlash('danger', 'Wrong Sucurity Code, Please try again!!');    
                }else {
                    Yii::$app->getSession()->setFlash('success', 'Update Password Successfully');
                    $db->commit();
                }
                return $this->redirect(['login']);
            }
        }catch(\Exception $e) {
            $db->rollback();
            Yii::$app->getSession()->setFlash('danger', $e->getMessage());
        }
        return $this->render('resetpassword', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function sms()
    {
        $to = "0167907901@vtext.com";
        $from = "kahsengpooh@gmail.com";
        $message = "This is a text message\nNew line...";
        $headers = "From: $from\n";
        mail($to, '', $message, $headers);
    }
}
