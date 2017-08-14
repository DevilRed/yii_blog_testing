<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        /**
         * Permissions
         */

        // create and add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'User can create a post';
        $auth->add($createPost);

        // create and add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'User can update post';
        $auth->add($updatePost);

        /**
         * Roles
         * We want to have 3 roles: user, author and admin. The “user” role is the default User role after registration. “Author” is the privileged User role which can add new Posts or edit own Posts. And “admin” is the User role which can do everything what “author” can but also can update ALL Posts.
         */

        // create and add "user" role
        $user = $auth->createRole('user');
        $auth->add($user);

        // create and add "author" role
        $author = $auth->createRole('author');
        $auth->add($author);

        // create and add "admin" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        /**
         * Mutual connections
         */

        // "author" can create new Post
        $auth->addChild($author, $createPost);

        // "admin" can do everything what "author" can
        $auth->addChild($admin, $author);
        // ... and ...
        // "admin" can update ALL Posts
        $auth->addChild($admin, $updatePost);
    }
}