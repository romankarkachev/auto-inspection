<?php

namespace backend\controllers;

use common\models\NomenclatureTypes;
use Yii;
use common\models\UsersNomenclature;
use common\models\UsersNomenclatureSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * NomenclaturePartsController implements the CRUD actions for UsersNomenclature model.
 */
class NomenclaturePartsController extends Controller
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
                        'roles' => ['@'],
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
     * Lists all UsersNomenclature models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersNomenclatureSearch();

        // дополняем запрос обязательным параметром отбора
        $params = Yii::$app->request->queryParams;
        $searchApplied = Yii::$app->request->get('UsersNomenclatureSearch') != null;

        $params['UsersNomenclatureSearch']['user_id'] = Yii::$app->user->id;
        $params['UsersNomenclatureSearch']['type_id'] = NomenclatureTypes::TYPE_PART;

        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchApplied' => $searchApplied,
        ]);
    }

    /**
     * Creates a new UsersNomenclature model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsersNomenclature();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/nomenclature-parts']);
        } else {
            $model->user_id = Yii::$app->user->id;

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UsersNomenclature model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/nomenclature-parts']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UsersNomenclature model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/nomenclature-parts']);
    }

    /**
     * Finds the UsersNomenclature model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsersNomenclature the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsersNomenclature::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрошенная страница не может быть найдена.');
        }
    }
}