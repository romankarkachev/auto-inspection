<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UsersNomenclature;

/**
 * UsersNomenclatureSearch represents the model behind the search form about `common\models\UsersNomenclature`.
 */
class UsersNomenclatureSearch extends UsersNomenclature
{
    // для сортировки
    public $nomenclatureName;
    public $nomenclatureType;

    // для отбора
    public $searchNomenclatureName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'nomenclature_id', 'created_at'], 'integer'],
            [['notes'], 'safe'],
            // для сортировки
            [['nomenclatureName', 'nomenclatureType'], 'safe'],
            // для отбора
            [['searchNomenclatureName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $result = parent::attributeLabels();
        $result['searchNomenclatureName'] = 'Наименование';

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UsersNomenclature::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'nomenclatureName' => [
                    'asc' => ['nomenclature.name' => SORT_ASC],
                    'desc' => ['nomenclature.name' => SORT_DESC],
                ],
                'nomenclatureType' => [
                    'asc' => ['nomenclature_types.name' => SORT_ASC],
                    'desc' => ['nomenclature_types.name' => SORT_DESC],
                ],
                'notes',
            ]
        ]);

        $this->load($params);
        $query->joinWith(['nomenclature']);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'nomenclature_id' => $this->nomenclature_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'notes', $this->notes]);
        $query->andFilterWhere(['like', 'nomenclature.name', $this->searchNomenclatureName]);

        return $dataProvider;
    }
}