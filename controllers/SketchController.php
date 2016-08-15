<?php

namespace app\controllers;

use app\models\AccessForm;
use app\models\Sketch;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\data\Pagination;
use yii\helpers\Url;

class SketchController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Sketch::find()->orderBy('sketch_id DESC');
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $sketches = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'sketches' => $sketches,
            'pagination' => $pagination,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $accessForm = new AccessForm();
        $accessForm->sketch_id = $model->sketch_id;

        if ($accessForm->load(Yii::$app->request->post())) {

            Yii::$app->session->set('hasAccess',false);
            if ($accessForm->validate()) {
                Yii::$app->session->set('hasAccess',true);
                return $this->redirect(['/sketch/update/', 'id' => $model->sketch_id]);
            }
        }

        return $this->render('view', [
            'model' => $model,
            'accessForm' => $accessForm,
        ]);
    }

    public function actionDraw() {
        $model = new Sketch();

        if ($model->load(Yii::$app->request->post())) {

            if (!$model->save()) {
                throw new Exception('Unable to save image');
            }
            return $this->redirect(['/sketch/view', 'id' => $model->getPrimaryKey()]);

        } else {
            return $this->render('draw', [
                'model' => $model
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImage = $model->image;

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                $fullpath = Yii::getAlias('@app') .'/web/uploads/user/'.$oldImage;
                @unlink($fullpath);

            } else {
                throw new Exception('Unable to save image');
            }

            return $this->redirect(['/sketch/view', 'id' => $id]);

        } else {

            if (Yii::$app->session->get('hasAccess')) {

                Yii::$app->session->set('hasAccess', false);
                $model->password = '';
                return $this->render('draw', [
                    'model' => $model,
                ]);

            } else {
                return $this->redirect(['/sketch/view', 'id' => $id]);
            }
        }
    }

    /**
     * Finds the Sketch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sketch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sketch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
