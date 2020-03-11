<?php

use yii\db\Migration;

/**
 * Class m200311_173224_init_rbac
 */
class m200311_173224_init_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "manageProfile" permission
        $manageProfile = $auth->createPermission('manageProfile');
        $manageProfile->description = 'Manage my profile';
        $auth->add($manageProfile);

        // add "cart" permission
        $cart = $auth->createPermission('cart');
        $cart->description = 'Cart(Reserve)';
        $auth->add($cart);

        // add "pos" permission
        $pos = $auth->createPermission('pos');
        $pos->description = 'pos(Reserve for administrator)';
        $auth->add($pos);

        // add "author" role and give this role the "manageProfile" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $manageProfile);

        // add "admin" role and give this role the "cart" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $cart);
        $auth->addChild($admin, $author);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
