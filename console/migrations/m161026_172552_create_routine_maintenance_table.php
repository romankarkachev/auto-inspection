<?php

use yii\db\Migration;

/**
 * Handles the creation of table `routine_maintenance`.
 */
class m161026_172552_create_routine_maintenance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('routine_maintenance', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('routine_maintenance');
    }
}
