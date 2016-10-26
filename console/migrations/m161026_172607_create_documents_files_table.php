<?php

use yii\db\Migration;

/**
 * Handles the creation of table `documents_files`.
 */
class m161026_172607_create_documents_files_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('documents_files', [
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
        $this->dropTable('documents_files');
    }
}
