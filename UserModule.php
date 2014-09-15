<?php

/**
 * Class UserModule
 */
class UserModule extends CWebModule
{
    /**
     * @var array
     */
    public $urlRules = [
        'user/login' => '/user/user/login',
        'user/profile' => '/user/user/profile',
        'user/logout' => '/user/user/logout',
        'user/registration' => '/user/user/registration',
        'user/passrecovery' => '/user/user/passrecovery',
        'user/passchange/code/<code:\w+>' => '/user/user/passchange',
        'user/admin/index' => 'user/admin/index',
    ];

    /**
     *
     */
    public function init()
    {
        parent::init();
        $this->setImport([
            'user.models.*',
            'user.components.*',
        ]);
    }
}
