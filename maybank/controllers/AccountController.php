<?php

namespace app\controllers;

use Yii;
use app\models\Account;
use app\models\AccountSearch;
use app\models\User;
use app\forms\SignupForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest){
            $id = Yii::$app->user->identity->id;

            $searchModel = new AccountSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]);
        } else {
            Yii::$app->getSession()->setFlash('danger', 'You do not have permission to access this page.');
            return $this->goHome();
        }
    }

    public function actionUseraccount()
    {
        if (!Yii::$app->user->isGuest){
            $id = Yii::$app->user->identity->id;
            $account = Account::find()
                ->where(['user_id' => $id]);

            $dataProvider = new ActiveDataProvider([
                'query' => $account,
            ]);

            return $this->render('useraccount', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->getSession()->setFlash('danger', 'You do not have permission to access this page.');
            return $this->goHome();
        }
    }

    public function actionViewaccount($id)
    {
        if (!Yii::$app->user->isGuest){
            $account = Account::find()
                ->where(['user_id' => $id]);

            $dataProvider = new ActiveDataProvider([
                'query' => $account,
            ]);

            return $this->render('viewaccount', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->getSession()->setFlash('danger', 'You do not have permission to access this page.');
            return $this->goHome();
        }
    }

    public function actionAccount()
    {
        if (!Yii::$app->user->isGuest){

            if (Yii::$app->user->identity->position === 'Admin') {
                $db = Yii::$app->db->beginTransaction();
                $model = new SignupForm();
                $model->account_number();
                $query = User::find()->where(['status' => 'Inactivate'])->all();
                $listData = ArrayHelper::map($query, 'id', 'user_name');
                
                try {
                    if ($model->load(Yii::$app->request->post())) {
                        $model->create_account();

                        Yii::$app->getSession()->setFlash('success', 'Create Account Holder Submmited Successfully');
                        $db->commit();
                        return $this->redirect(['account']);
                    }
                }catch(\Exception $e) {
                    $db->rollback();
                    Yii::$app->getSession()->setFlash('danger', $e->getMessage());
                }
                return $this->render('account', [
                    'model' => $model, 'listData' => $listData,
                ]);
            }else {
                Yii::$app->getSession()->setFlash('danger', 'You do not have permission to access this page.');
                return $this->goHome();
            }
        }else {
            Yii::$app->getSession()->setFlash('danger', 'You do not have permission to access this page.');
                return $this->goHome();
        }
        
    }

    public function actionTestmail()
    {
        $this->layout = '@app/mail/layouts/html';

        $recipient = [
            [
                'email' => 'kahsengpooh@gmail.com',
                'name' => 'Phoon Kah Seng',
                'type' => 'to'
            ]
        ];

        $subject = "TESTING EMAIL";
        $message = "testing 123";

        $content = $this->render('@app/mail/daily_report', []);

        $mandrill = Yii::$app->mandrill->instance;
        $message = Yii::$app->mandrill->message;
        $message['to'] = $recipient;
        $message['html'] = $content;
        $message['subject'] = $subject;

        $status = $mandrill->messages->send($message, false, "phoonkahseng@gmail.com", null);
        echo var_export($status,true) . "\n";
    }

    /**
     * Displays a single Account model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->getSession()->setFlash('danger', 'You do not have permission to access this page.');
            return $this->goHome();
        }
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest){
            $model = new SignupForm();
            $model->account_number();

            $db = Yii::$app->db->beginTransaction();
            try {
                if ($model->load(Yii::$app->request->post())) {
                    $model->add_account();
                    Yii::$app->getSession()->setFlash('success', 'Create Account Holder Submmited Successfully');
                    $db->commit();
                    return $this->redirect(['create']);
                }
        
            }catch(\Exception $e) {
                    $db->rollback();
                    Yii::$app->getSession()->setFlash('danger', $e->getMessage());
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->getSession()->setFlash('danger', 'You do not have permission to access this page.');
            return $this->goHome();
        }
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->isGuest){
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->getSession()->setFlash('danger', 'You do not have permission to access this page.');
            return $this->goHome();
        }
    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->isGuest){
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } else {
            Yii::$app->getSession()->setFlash('danger', 'You do not have permission to access this page.');
            return $this->goHome();
        }
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
