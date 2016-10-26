<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_stations".
 *
 * @property integer $id
 * @property string $name
 * @property string $name_full
 * @property string $address
 * @property string $phones
 * @property string $notes
 *
 * @property UsersServiceStations[] $usersServiceStations
 */
class ServiceStations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_stations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phones'], 'required'],
            [['name_full', 'notes'], 'string'],
            [['name', 'address'], 'string', 'max' => 150],
            [['phones'], 'string', 'max' => 50],
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
            'address' => 'Адрес',
            'phones' => 'Телефоны',
            'notes' => 'Заметки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersServiceStations()
    {
        return $this->hasMany(UsersServiceStations::className(), ['ss_id' => 'id']);
    }
}