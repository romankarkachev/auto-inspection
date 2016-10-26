<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Nomenclature;

/**
 * NomenclatureSearch represents the model behind the search form about `common\models\Nomenclature`.
 */
class NomenclatureSearch extends Nomenclature
{
    // для сортировки
    public $categoryName;
    public $typeName;
    public $unitName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'type_id', 'unit_id'], 'integer'],
            [['name', 'name_full'], 'safe'],
            // для сортировки
            [['categoryName', 'typeName', 'unitName'], 'safe'],
        ];
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
        $query = Nomenclature::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'name',
                'name_full',
                'categoryName' => [
                    'asc' => ['nomenclature_categories.name' => SORT_ASC],
                    'desc' => ['nomenclature_categories.name' => SORT_DESC],
                ],
                'typeName' => [
                    'asc' => ['nomenclature_types.name' => SORT_ASC],
                    'desc' => ['nomenclature_types.name' => SORT_DESC],
                ],
                'unitName' => [
                    'asc' => ['units.name' => SORT_ASC],
                    'desc' => ['units.name' => SORT_DESC],
                ],
            ]
        ]);

        $this->load($params);
        $query->joinWith(['category', 'type', 'unit']);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
            'unit_id' => $this->unit_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'name_full', $this->name_full]);

        return $dataProvider;
    }
}