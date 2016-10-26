<?php

use yii\db\Migration;

/**
 * Создается таблица Категории номенклатуры.
 */
class m161026_171959_create_nomenclature_categories_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Категории номенклатуры"';
        }

        $this->createTable('nomenclature_categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull()->comment('Наименование'),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('nomenclature_categories');
    }
}