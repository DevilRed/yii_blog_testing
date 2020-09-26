<?php

namespace common\tests\unit\models;

use Yii;
use common\models\LoginForm;
use common\fixtures\UserFixture as UserFixture;

/**
 * Login form test
 */
class LoginFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testLoginNoUser()
    {
        $model = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        // to use expect - specify need to be in composer.json
        //expect('model should not login user', $model->login())->false();
        $this->assertEquals(false, $model->login());
        //expect('user should not be logged in', Yii::$app->user->isGuest)->true();
        $this->assertTrue(Yii::$app->user->isGuest);
    }

    public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'wrong_password',
        ]);

        //expect('model should not login user', $model->login())->false();
        $this->assertEquals(false, $model->login());
        //expect('error message should be set', $model->errors)->hasKey('password');
        $this->assertTrue(array_key_exists('password', $model->errors));
        //expect('user should not be logged in', Yii::$app->user->isGuest)->true();
        $this->assertTrue(Yii::$app->user->isGuest);
    }

    public function testLoginCorrect()
    {
        /*
        to get login working, cookieValidationKey needs to be set in components in common/config/test-local.php
        'components' => [
            'request' => [
                'cookieValidationKey' => 'test',
            ],
        ],

        to get the config on the file above working, the common/codeception.yml need to be configured with that file
        .....
        modules:
            config:
                Yii2:
                    configFile: 'config/test-local.php'
         */
        $model = new LoginForm([
            'username' => 'bayer.hudson',
            'password' => 'password_0',
        ]);

        //expect('model should login user', $model->login())->true();
        $this->assertTrue($model->login());
        //expect('error message should not be set', $model->errors)->hasntKey('password');
        $this->assertFalse(array_key_exists('password', $model->errors));
        //expect('user should be logged in', Yii::$app->user->isGuest)->false();
        $this->assertFalse(Yii::$app->user->isGuest);
    }
}
