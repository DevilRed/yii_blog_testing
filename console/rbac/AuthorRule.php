<?php

namespace console\rbac;

use yii\rbac\Rule;

/**
 * Checks if authorID matches user passed via params
 * A rule is a class extending from yii\rbac\Rule. It must implement the execute() method
 */
class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        // The rule checks if the post is created by $user.
        return isset($params['model']) ? $params['model']->createdBy->id == $user : false;
    }
}