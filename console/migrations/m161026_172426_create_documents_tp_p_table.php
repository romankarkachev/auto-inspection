<?php

use yii\db\Migration;

/**
 * Handles the creation of table `documents_tp_p`.
 */
class m161026_172426_create_documents_tp_p_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('documents_tp_p', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('documents_tp_p');
    }
}
