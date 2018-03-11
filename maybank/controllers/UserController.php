<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\forms\SignupForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mPDF;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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

    public function actionGenPdf($id)
    {
        $pdf_content = $this->render('view-pdf', [
            'model' => $this->findModel($id),
        ]);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($pdf_content);
        $mpdf->Output();
        exit;
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSignup()
    {
        $db = Yii::$app->db->beginTransaction();
        $model = new SignupForm();
        
        try {
            if ($model->load(Yii::$app->request->post())) {
                // throw new \Exception(var_export(Yii::$app->request->post(),true)) ;
                $model->register();
                Yii::$app->getSession()->setFlash('success', 'Create Account Holder Submmited Successfully');
                
                //send email to user
                Yii::$app->mailer->compose('email',['model'=>$model])
                    ->setFrom('kahsengpooh@gmail.com')
                    ->setTO($model->email)
                    ->setSubject('Welcome to Maybank!')
                    ->send();

                $db->commit();
                return $this->redirect(['signup']);
            }
        }catch(\Exception $e) {
            $db->rollback();
            Yii::$app->getSession()->setFlash('danger', $e->getMessage());
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
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
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
