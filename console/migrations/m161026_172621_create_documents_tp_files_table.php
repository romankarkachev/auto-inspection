<?php

use yii\db\Migration;

/**
 * Handles the creation of table `documents_tp_files`.
 */
class m161026_172621_create_documents_tp_files_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('documents_tp_files', [
            'id' => $this->primaryKey(),

            'uploaded_at' => $this->integer()->notNull()->comment('Дата и время загрузки'),
            'ffp' => $this->string(255)->notNull()->comment('Полный путь к файлу'),
            'fn' => $this->string(255)->notNull()->comment('Имя файла'),
            'ofn' => $this->string(255)->notNull()->comment('Оригинальное имя файла'),
            'size' => $this->integer()->comment('Размер файла'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('documents_tp_files');
    }
}
