<?php

/**
 * Class WebUser
 */
class WebUser extends CWebUser
{

    /**
     * @var null
     */
    private $_model = null;

    // получаем с базы роль(айди группы)
    /**
     * @return mixed
     */
    protected function getRole()
    {
        if ($user = $this->getModel()) {
            return $user->group->name;
        }

        return false;
    }

    /**
     * @return CActiveRecord
     */
    protected function getModel()
    {
        if (!$this->isGuest && $this->_model === null) {
            $this->_model = User::model()->findByPk($this->id);
        }

        return $this->_model;
    }
}
