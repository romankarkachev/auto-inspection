<?php

namespace backend\controllers;

use Yii;
use common\models\UsersNomenclature;
use common\models\CreateUserNomenclatureForm;
use common\models\Nomenclature;
use common\models\NomenclatureSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * NomenclatureController implements the CRUD actions for Nomenclature model.
 */
class NomenclatureController extends Controller
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
                        'actions' => ['index', 'new', 'create', 'update', 'delete', 'list-nf'],
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
     * Lists all Nomenclature models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NomenclatureSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Отображает страницу добавления новой номенклатуры.
     * Добавление происходит через создание новой или через добавление из списка существующих.
     * Через значение в параметрах можно перенаправить пользователя в соответствующий раздел номенклатуры,
     * например, запчасти (если он оттуда пришел).
     * @param $action string
     * @param $return string
     * @return mixed
     */
    public function actionNew($action = null, $return = null)
    {
        $model = new UsersNomenclature();
        $model->user_id = Yii::$app->user->id;

        $nomenclature = new CreateUserNomenclatureForm();

        if ($action == null && $return == null) {
            return $this->render('create', [
                'model' => $model,
                'nomenclature' => $nomenclature,
                'return' => $return,
            ]);
        }

        switch ($action) {
            case 'add':
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['/nomenclature'.($return == null ? '' : '-' . $return)]);
                }
                break;
            case 'create':
                if ($nomenclature->load(Yii::$app->request->post()) && $nomenclature->save()) {
                    return $this->redirect(['/nomenclature' . ($return == null ? '' : '-' . $return)]);
                }
                break;
        }
    }

    /**
     * Updates an existing Nomenclature model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/nomenclature-common']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Nomenclature model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/nomenclature-common']);
    }

    /**
     * Finds the Nomenclature model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nomenclature the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nomenclature::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрошенная страница не может быть найдена.');
        }
    }

    /**
     * Функция выполняет поиск номенклатуры по наименованию, переданному в параметрах.
     * @param string $q
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionListNf($q)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $query = Nomenclature::find()->select([
            'id' => 'nomenclature.id',
            'text' => 'nomenclature.name',
            'nomenclature.name_full',
            'category_id',
            'type_id',
            'unit_id',
            'IFNULL(nomenclature_categories.name, "-") AS `ncat`',
            'ntype' => 'nomenclature_types.name',
            'IFNULL(units.name, "-") AS `nunit`',
        ])
            ->joinWith(['category', 'type', 'unit'], false)
            ->andFilterWhere(['like', 'nomenclature.name', $q]);

        return ['results' => $query->asArray()->all()];
    }
}