<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nomenclature".
 *
 * @property integer $id
 * @property string $name
 * @property string $name_full
 * @property integer $category_id
 * @property integer $type_id
 * @property integer $unit_id
 *
 * @property Units $unit
 * @property NomenclatureCategories $category
 * @property NomenclatureTypes $type
 * @property UsersNomenclature[] $usersNomenclatures
 */
class Nomenclature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nomenclature';
    }

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
            // для сортировки
            'categoryName' => 'Категория',
            'typeName' => 'Тип',
            'unitName' => 'Единица измерения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(NomenclatureCategories::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function getCategoryName()
    {
        if ($this->category != null) return $this->category->name; else return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(NomenclatureTypes::className(), ['id' => 'type_id']);
    }
    /**
     * @inheritdoc
     * @return string
     */
    public function getTypeName()
    {
        return $this->type->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Units::className(), ['id' => 'unit_id']);
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function getUnitName()
    {
        if ($this->unit != null) return $this->unit->name; else return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersNomenclatures()
    {
        return $this->hasMany(UsersNomenclature::className(), ['nomenclature_id' => 'id']);
    }
}