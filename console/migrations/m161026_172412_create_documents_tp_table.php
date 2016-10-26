<?php

use yii\db\Migration;

/**
 * Handles the creation of table `documents_tp`.
 */
class m161026_172412_create_documents_tp_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('documents_tp', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('documents_tp');
    }
}
