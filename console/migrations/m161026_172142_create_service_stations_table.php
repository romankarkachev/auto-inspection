<?php

use yii\db\Migration;

/**
 * Создается таблица Станции техобслуживания.
 */
class m161026_172142_create_service_stations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Станции техобслуживания"';
        }

        $this->createTable('service_stations', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull()->comment('Наименование'),
            'name_full' => $this->text()->comment('Полное наименование'),
            'address' => $this->string(150)->comment('Адрес'),
            'phones' => $this->string(50)->notNull()->comment('Телефоны'),
            'notes' => $this->text()->comment('Заметки'),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('service_stations');
    }
}