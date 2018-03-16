<?php

namespace app\controllers;

use Yii;
use app\models\Transaction;
use app\forms\TransactionForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\httpclient\Client;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
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
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id = Yii::$app->user->identity->id;
        $transaction = Transaction::find()
            ->where(['user_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $transaction,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGenPdf()
    {
        $id = Yii::$app->user->identity->id;
        $transaction = Transaction::find()
            ->where(['user_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $transaction,
        ]);

        $pdf_content = $this->render('index-pdf', [
            'dataProvider' => $dataProvider,
        ]);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($pdf_content);
        $mpdf->Output();
        exit;
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $db = Yii::$app->db->beginTransaction();
        $client = new Client();
        $model = new TransactionForm();
        $model->getAccount($id);
        $model->getBalance($id);
        
        try {
            if ($model->load(Yii::$app->request->post())) {
                $model->transaction();

                Yii::$app->getSession()->setFlash('success', 'Transaction Submmited Successfully');
                $db->commit();
                //send sms
                $response = $client->createRequest()
                    ->setMethod('GET')
                    ->setUrl('https://platform.clickatell.com/messages/http/send')
                    ->setData(['apiKey' => 'OUwdHQLiQfSz0EDHtqVGag==', 'to' => '60167907901', 'content' => 'Transaction Submmited Successfully.'])
                    ->send();
                return $this->redirect(['site/index']);
            }
        }catch(\Exception $e) {
            $db->rollback();
            Yii::$app->getSession()->setFlash('danger', $e->getMessage());
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSave($id)
    {
        $db = Yii::$app->db->beginTransaction();
        $model = new TransactionForm();
        $model->getAccount($id);
        $model->getBalance($id);
        
        try {
            if ($model->load(Yii::$app->request->post())) {
                $model->transaction();

                Yii::$app->getSession()->setFlash('success', 'Transaction Submmited Successfully');
                $db->commit();
                return $this->redirect(['save']);
            }
        }catch(\Exception $e) {
            $db->rollback();
            Yii::$app->getSession()->setFlash('danger', $e->getMessage());
        }
        return $this->render('save', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
