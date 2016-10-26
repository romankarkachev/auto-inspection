<?php

use yii\db\Migration;

/**
 * Создается таблица Документы.
 */
class m161026_172352_create_documents_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('documents', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('documents');
    }
}