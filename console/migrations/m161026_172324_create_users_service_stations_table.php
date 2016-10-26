<?php

use yii\db\Migration;

/**
 * Создается таблица Станции техобслуживания пользователей.
 */
class m161026_172324_create_users_service_stations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Станции техобслуживания пользователей"';
        }

        $this->createTable('users_service_stations', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'ss_id' => $this->integer()->notNull()->comment('Станция техобслуживания'),
            'created_at' => $this->integer()->notNull()->comment('Дата и время добавления'),
            'notes' => $this->text()->comment('Заметки'),
        ], $tableOptions);

        $this->createIndex('user_id', 'users_service_stations', 'user_id');
        $this->createIndex('ss_id', 'users_service_stations', 'ss_id');

        $this->addForeignKey('fk_users_service_stations_user_id', 'users_service_stations', 'user_id', 'user', 'id');
        $this->addForeignKey('fk_users_service_stations_ss_id', 'users_service_stations', 'ss_id', 'service_stations', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_users_service_stations_ss_id', 'users_service_stations');
        $this->dropForeignKey('fk_users_service_stations_user_id', 'users_service_stations');

        $this->dropIndex('ss_id', 'users_service_stations');
        $this->dropIndex('user_id', 'users_service_stations');

        $this->dropTable('users_service_stations');
    }
}