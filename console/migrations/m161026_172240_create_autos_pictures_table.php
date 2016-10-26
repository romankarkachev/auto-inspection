<?php

use yii\db\Migration;

/**
 * Создается таблица Изображения автомобилей.
 */
class m161026_172240_create_autos_pictures_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Изображения автомобилей"';
        }

        $this->createTable('autos_pictures', [
            'id' => $this->primaryKey(),
            'auto_id' => $this->integer()->notNull()->comment('Автомобиль'),
            'uploaded_at' => $this->integer()->notNull()->comment('Дата и время загрузки'),
            'ffp' => $this->string(255)->notNull()->comment('Полный путь к файлу'),
            'fn' => $this->string(255)->notNull()->comment('Имя файла'),
            'ofn' => $this->string(255)->notNull()->comment('Оригинальное имя файла'),
            'size' => $this->integer()->comment('Размер файла'),
        ], $tableOptions);

        $this->createIndex('avatar_id', 'autos', 'avatar_id');

        $this->addForeignKey('fk_autos_avatar_id', 'autos', 'avatar_id', 'autos_pictures', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_autos_avatar_id', 'autos');

        $this->dropIndex('avatar_id', 'autos');

        $this->dropTable('autos_pictures');
    }
}