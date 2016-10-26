<?php

use yii\db\Migration;

/**
 * Handles the creation of table `documents_tp_s`.
 */
class m161026_172430_create_documents_tp_s_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('documents_tp_s', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('documents_tp_s');
    }
}
