<?php

use yii\db\Migration;

/**
 * Создается таблица Номенклатура.
 */
class m161026_172006_create_nomenclature_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Номенклатура"';
        }

        $this->createTable('nomenclature', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull()->comment('Наименование'),
            'name_full' => $this->text()->notNull()->comment('Полное наименование'),
            'category_id' => $this->integer()->comment('Категория'),
            'type_id' => $this->integer()->notNull()->comment('Тип'),
            'unit_id' => $this->integer()->comment('Единица измерения'),
        ], $tableOptions);

        $this->createIndex('category_id', 'nomenclature', 'category_id');
        $this->createIndex('type_id', 'nomenclature', 'type_id');
        $this->createIndex('unit_id', 'nomenclature', 'unit_id');

        $this->addForeignKey('fk_nomenclature_category_id', 'nomenclature', 'category_id', 'nomenclature_categories', 'id');
        $this->addForeignKey('fk_nomenclature_type_id', 'nomenclature', 'type_id', 'nomenclature_types', 'id');
        $this->addForeignKey('fk_nomenclature_unit_id', 'nomenclature', 'unit_id', 'units', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_nomenclature_unit_id', 'nomenclature');
        $this->dropForeignKey('fk_nomenclature_type_id', 'nomenclature');
        $this->dropForeignKey('fk_nomenclature_category_id', 'nomenclature');

        $this->dropIndex('unit_id', 'nomenclature');
        $this->dropIndex('type_id', 'nomenclature');
        $this->dropIndex('category_id', 'nomenclature');

        $this->dropTable('nomenclature');
    }
}