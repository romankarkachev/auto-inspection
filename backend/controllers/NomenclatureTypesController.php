<?php

namespace backend\controllers;

use Yii;
use common\models\NomenclatureTypes;
use common\models\NomenclatureTypesSearch;
use common\models\Nomenclature;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * NomenclatureTypesController implements the CRUD actions for NomenclatureTypes model.
 */
class NomenclatureTypesController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['root', 'manager'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all NomenclatureTypes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NomenclatureTypesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new NomenclatureTypes model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NomenclatureTypes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/nomenclature-types']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing NomenclatureTypes model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/nomenclature-types']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing NomenclatureTypes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // проверим, не используется ли элемент в Номенклатуре
        $used_in = Nomenclature::find()->where(['type_id' => $id])->count();

        if ($used_in > 0) return $this->render('/default/error', [
            'name' => 'Элемент используется',
            'message' => Html::encode('Элемент, который Вы пытаетесь удалить, используется в одном или нескольких других элементах системы (&laquo;Номенклатура&raquo;).'),
        ]);

        $this->findModel($id)->delete();

        return $this->redirect(['/nomenclature-types']);
    }

    /**
     * Finds the NomenclatureTypes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NomenclatureTypes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NomenclatureTypes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрошенная страница не может быть найдена.');
        }
    }
}