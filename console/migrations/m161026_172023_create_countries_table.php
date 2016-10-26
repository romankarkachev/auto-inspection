<?php

use yii\db\Migration;

/**
 * Создается таблица Страны.
 */
class m161026_172023_create_countries_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Страны"';
        }

        $this->createTable('countries', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull()->comment('Наименование'),
        ], $tableOptions);

        $this->insert('countries', ['name' => 'Россия']);
        $this->insert('countries', ['name' => 'Украина']);
        $this->insert('countries', ['name' => 'Южная Корея']);
        $this->insert('countries', ['name' => 'Китай']);
        $this->insert('countries', ['name' => 'Польша']);
        $this->insert('countries', ['name' => 'Германия']);
        $this->insert('countries', ['name' => 'Франция']);
        $this->insert('countries', ['name' => 'Великобритания']);
        $this->insert('countries', ['name' => 'Италия']);
        $this->insert('countries', ['name' => 'Испания']);
        $this->insert('countries', ['name' => 'Беларусь']);
        $this->insert('countries', ['name' => 'СГП']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('countries');
    }
}