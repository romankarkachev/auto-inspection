<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::setAlias('webroot', $_SERVER['DOCUMENT_ROOT']);
Yii::setAlias('@uploads-pfs', '@webroot/uploads/profiles'); // изображения к профилям, полный путь
Yii::setAlias('@uploads-afs', '@webroot/uploads/auto-files'); // изображения автомобилей, полный путь
Yii::setAlias('@uploads-dfs', '@webroot/uploads/doc-files'); // файлы к документам, полный путь
Yii::setAlias('@uploads-dtpfs', '@webroot/uploads/dtp-files'); // файлы к строкам табличных частей документов, полный путь

Yii::setAlias('uploads-profiles', '/uploads/profiles/'); // изображения к профилям, относительный путь
Yii::setAlias('uploads-as', '/uploads/auto-files/'); // изображения автомобилей, относительный путь
Yii::setAlias('uploads-df', '/uploads/doc-files/'); // файлы к документам, относительный путь
Yii::setAlias('uploads-dtpf', '/uploads/dtp-files'); // файлы к строкам табличных частей документов, относительный путь
