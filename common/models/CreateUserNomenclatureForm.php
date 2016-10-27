<?php

namespace common\models;

use Yii;
use yii\base\Model;

class CreateUserNomenclatureForm extends Model
{
    public $name;
    public $name_full;
    public $category_id;
    public $type_id;
    public $unit_id;
    public $user_id;
    public $notes;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'name_full', 'type_id'], 'required'],
            [['name_full'], 'string'],
            [['category_id', 'type_id', 'unit_id'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Units::className(), 'targetAttribute' => ['unit_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => NomenclatureCategories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => NomenclatureTypes::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'name_full' => 'Полное наименование',
            'category_id' => 'Категория',
            'type_id' => 'Тип',
            'unit_id' => 'Единица измерения',
            'user_id' => 'Пользователь',
            'notes' => 'Заметки',
        ];
    }


}