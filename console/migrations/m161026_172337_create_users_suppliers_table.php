<?php

use yii\db\Migration;

/**
 * Создается таблица Поставщики запчастей пользователей.
 */
class m161026_172337_create_users_suppliers_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Поставщики запчастей пользователей"';
        }

        $this->createTable('users_suppliers', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'supplier_id' => $this->integer()->notNull()->comment('Пользователь'),
            'created_at' => $this->integer()->notNull()->comment('Дата и время добавления'),
            'notes' => $this->text()->comment('Заметки'),
        ], $tableOptions);

        $this->createIndex('user_id', 'users_suppliers', 'user_id');
        $this->createIndex('supplier_id', 'users_suppliers', 'supplier_id');

        $this->addForeignKey('fk_users_suppliers_user_id', 'users_suppliers', 'user_id', 'user', 'id');
        $this->addForeignKey('fk_users_suppliers_supplier_id', 'users_suppliers', 'supplier_id', 'suppliers', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_users_suppliers_supplier_id', 'users_suppliers');
        $this->dropForeignKey('fk_users_suppliers_user_id', 'users_suppliers');

        $this->dropIndex('supplier_id', 'users_suppliers');
        $this->dropIndex('user_id', 'users_suppliers');

        $this->dropTable('users_suppliers');
    }
}