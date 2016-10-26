<?php

use yii\db\Migration;

/**
 * Создается таблица Номенклатура пользователей.
 */
class m161026_172306_create_users_nomenclature_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Номенклатура пользователей"';
        }

        $this->createTable('users_nomenclature', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'nomenclature_id' => $this->integer()->notNull()->comment('Номенклатура'),
            'created_at' => $this->integer()->notNull()->comment('Дата и время добавления'),
            'notes' => $this->text()->comment('Заметки'),
        ], $tableOptions);

        $this->createIndex('user_id', 'users_nomenclature', 'user_id');
        $this->createIndex('nomenclature_id', 'users_nomenclature', 'nomenclature_id');

        $this->addForeignKey('fk_users_nomenclature_user_id', 'users_nomenclature', 'user_id', 'user', 'id');
        $this->addForeignKey('fk_users_nomenclature_nomenclature_id', 'users_nomenclature', 'nomenclature_id', 'nomenclature', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_users_nomenclature_nomenclature_id', 'users_nomenclature');
        $this->dropForeignKey('fk_users_nomenclature_user_id', 'users_nomenclature');

        $this->dropIndex('nomenclature_id', 'users_nomenclature');
        $this->dropIndex('user_id', 'users_nomenclature');

        $this->dropTable('users_nomenclature');
    }
}