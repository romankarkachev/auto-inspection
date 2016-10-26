<?php

use yii\db\Migration;

/**
 * Создается таблица Производители.
 */
class m161026_172036_create_vendors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Производители"';
        }

        $this->createTable('vendors', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull()->comment('Наименование'),
            'country_id' => $this->integer()->comment('Страна'),
        ], $tableOptions);

        $this->createIndex('country_id', 'vendors', 'country_id');

        $this->addForeignKey('fk_vendors_country_id', 'vendors', 'country_id', 'countries', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_vendors_country_id', 'vendors');

        $this->dropIndex('country_id', 'vendors');

        $this->dropTable('vendors');
    }
}