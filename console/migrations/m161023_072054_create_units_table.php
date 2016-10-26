<?php

use yii\db\Migration;

/**
 * Создается таблица Единицы измерения.
 */
class m161023_072054_create_units_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Единицы измерения"';
        }

        $this->createTable('units', [
            'id' => $this->primaryKey(),
            'name' => $this->string(10)->notNull()->comment('Наименование'),
            'name_full' => $this->string(50)->notNull()->comment('Полное наименование'),
        ], $tableOptions);

        $this->insert('units', ['name' => 'шт.', 'name_full' => 'Штука']);
        $this->insert('units', ['name' => 'уп.', 'name_full' => 'Упаковка']);
        $this->insert('units', ['name' => 'кг', 'name_full' => 'Килограмм']);
        $this->insert('units', ['name' => 'л', 'name_full' => 'Литр']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('units');
    }
}