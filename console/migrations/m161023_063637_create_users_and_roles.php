<?php

use yii\db\Migration;

/**
 * Создаются роли и пользователи системы.
 */
class m161023_063637_create_users_and_roles extends Migration
{
    public function up()
    {
        $role_adm = Yii::$app->authManager->createRole('root');
        $role_adm->description = 'Полные права';
        Yii::$app->authManager->add($role_adm);

        $role_user = Yii::$app->authManager->createRole('user');
        $role_user->description = 'Пользователь';
        Yii::$app->authManager->add($role_user);

        $user_adm = new \dektrium\user\models\User();
        $user_adm->username = 'root';
        $user_adm->email = 'root@gmail.com';
        $user_adm->password = '1Qazxsw2';
        $user_adm->confirmed_at = mktime();
        $user_adm->save();
        Yii::$app->authManager->assign($role_adm, $user_adm->id);

        $user_1 = new \dektrium\user\models\User();
        $user_1->username = 'roman';
        $user_1->email = 'roman@karkachev.ru';
        $user_1->password = '123456';
        $user_1->confirmed_at = mktime();
        $user_1->save();
        Yii::$app->authManager->assign($role_user, $user_1->id);
        $user_1->profile->name = 'Роман Каркачев';
        $user_1->profile->save();

        $user_2 = new \dektrium\user\models\User();
        $user_2->username = 'yaroslav';
        $user_2->email = 'yaroslav@karkachev.ru';
        $user_2->password = '123456';
        $user_2->confirmed_at = mktime();
        $user_2->save();
        Yii::$app->authManager->assign($role_user, $user_2->id);
        $user_2->profile->name = 'Ярослав Каркачев';
        $user_2->profile->save();
    }

    public function down()
    {
        // связи само удаляет, проверено
        $user = \dektrium\user\models\User::findOne(['username' => 'root'])->delete();
        $user = \dektrium\user\models\User::findOne(['username' => 'roman'])->delete();
        $user = \dektrium\user\models\User::findOne(['username' => 'yaroslav'])->delete();

        $role = Yii::$app->authManager->getRole('root');
        Yii::$app->authManager->remove($role);

        $role = Yii::$app->authManager->getRole('user');
        Yii::$app->authManager->remove($role);
    }
}