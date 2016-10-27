<?php

namespace common\models;

use Yii;
use dektrium\user\models\User;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users_nomenclature".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $nomenclature_id
 * @property integer $created_at
 * @property string $notes
 *
 * @property Nomenclature $nomenclature
 * @property User $user
 */
class UsersNomenclature extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_nomenclature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'nomenclature_id'], 'required'],
            [['user_id', 'nomenclature_id', 'created_at'], 'integer'],
            [['notes'], 'string'],
            [['nomenclature_id'], 'exist', 'skipOnError' => true, 'targetClass' => Nomenclature::className(), 'targetAttribute' => ['nomenclature_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'nomenclature_id' => 'Номенклатура',
            'created_at' => 'Дата и время добавления',
            'notes' => 'Заметки',
            // для сортировки
            'nomenclatureName' => 'Номенклатура',
            'nomenclatureType' => 'Тип',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNomenclature()
    {
        return $this->hasOne(Nomenclature::className(), ['id' => 'nomenclature_id']);
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function getNomenclatureName()
    {
        if ($this->nomenclature != null) return $this->nomenclature->name; else return null;
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function getNomenclatureType()
    {
        return $this->nomenclature->type->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}