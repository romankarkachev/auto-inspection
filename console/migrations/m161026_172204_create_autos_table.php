<?php

use yii\db\Migration;

/**
 * Создается таблица Автомобили.
 */
class m161026_172204_create_autos_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Автомобили"';
        }

        $this->createTable('autos', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull()->comment('Наименование'),
            'vin' => $this->string(17)->comment('VIN-код'),
            'license_plate' => $this->string(20)->comment('Госномер'),
            'user_id' => $this->integer()->notNull()->comment('Пользователь-собственник'),
            'avatar_id' => $this->integer()->comment('Основное изображение автомобиля'),
            'notes' => $this->text()->comment('Примечание'),
        ], $tableOptions);

        // индекс и внешний ключ к аватару создаются в следующей миграции (autos_pictures)
        $this->createIndex('user_id', 'autos', 'user_id');

        $this->addForeignKey('fk_autos_user_id', 'autos', 'user_id', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_autos_user_id', 'autos');

        $this->dropIndex('user_id', 'autos');

        $this->dropTable('autos');
    }
}