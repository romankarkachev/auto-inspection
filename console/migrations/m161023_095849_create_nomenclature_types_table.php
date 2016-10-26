<?php

use yii\db\Migration;

/**
 * Создается таблица Типы номенклатуры.
 */
class m161023_095849_create_nomenclature_types_table extends Migration
{

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Типы номенклатуры"';
        }

        $this->createTable('nomenclature_types', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull()->comment('Наименование'),
            'name_plural_nominative_case' => $this->string(30)->comment('Во множественном числе'),
            'name_plural_genitive_case' => $this->string(30)->comment('Родительный падеж (кого? чего?)'),
            'name_plural_dative_case' => $this->string(30)->comment('Дательный падеж (кому? чему?)'),
        ], $tableOptions);

        $this->insert('nomenclature_types', [
            'name' => 'Запчасть',
            'name_plural_nominative_case' => 'Запчасти',
            'name_plural_genitive_case' => 'Запчастей',
            'name_plural_dative_case' => 'Запчастям',
        ]);

        $this->insert('nomenclature_types', [
            'name' => 'Услуга',
            'name_plural_nominative_case' => 'Услуги',
            'name_plural_genitive_case' => 'Услуг',
            'name_plural_dative_case' => 'Услугам',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('nomenclature_types');
    }
}