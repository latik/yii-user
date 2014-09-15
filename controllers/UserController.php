<?php

/**
 * Class UserController
 */
class UserController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('login', 'registration', 'passrecovery', 'passchange'),
                'users' => array('?'), //аноним
            ),
            array(
                'allow',
                'actions' => array('logout', 'profile'),
                'users' => array('@'), //аутентифицированный
            ),
            // deny all users
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param $id
     * @throws CHttpException
     * @return array|\CActiveRecord|mixed|null
     * @internal param \the $integer ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /////////////////////////////////////////////////////////////////////////////
    /**
     * Displays a particular model.
     */
    public function actionProfile()
    {
        $this->render(
            'profile',
            array(
                'model' => $this->loadModel(Yii::app()->user->id),
            )
        );
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if (Yii::app()->user->isGuest) {
        
            $model = new User('login');

            if (isset($_POST['User'])) {
                $model->attributes = $_POST['User'];

                if ($model->validate()) {
                    $identity = new UserIdentity($model->username, $model->password);

                    if ($identity->authenticate()) {
                        $duration = Yii::app()->params['loginDuration'];
                        Yii::app()->user->login($identity, $duration);

                        $this->redirect(Yii::app()->user->returnUrl);
                    } else {
                        $model->addError('password', Yii::t('app', 'Incorrect username or password...'));
                    }
                }
            }
            // display the login form
            $this->render(
                'login',
                array(
                    'model' => $model
                )
            );
        } else {
            $this->redirect(Yii::app()->homeUrl);
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * registration
     */
    public function actionRegistration()
    {
        $model = new User('register');

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

            // @todo make configureble new user group
            $model->group_id = 1;

            if ($model->validate()) {
                $orig_password = $model->password;
                $model->password = $model->hashPassword($model->password);

                if ($model->save(false)) {
                    $identity = new UserIdentity($model->username, $orig_password);
                    if ($identity->authenticate()) {
                        $duration = Yii::app()->params['loginDuration'];
                        Yii::app()->user->login($identity, $duration);
                        Yii::app()->user->setFlash('registration', Yii::t('app', "Thank you for your registration.."));

                        if (isset(Yii::app()->user->returnUrl)) {
                            $this->redirect(Yii::app()->user->returnUrl);
                        } else {
                            $this->redirect(Yii::app()->homeUrl);
                        }
                    }
                }
            }
        }
        // display the registration form
        $this->render(
            'register',
            array(
                'model' => $model
            )
        );
    }

    /**
     * password recovery
     */
    public function actionPassrecovery()
    {
        $model = new User('passrecovery');

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $user = User::model()->findByAttributes(array('email' => $model->email));

            if ($user === null) {
                $model->addError('password', Yii::t('app', 'No such user with this email.'));
            } else {
                $passchange_url = Yii::app()->createAbsoluteUrl('user/passchange', ['code'=>md5($user->password)]);               
                $message = new YiiMailMessage;
                $message->view = 'passrecovery';
                $message->setBody(['passchange_url'=>$passchange_url], 'text/html');
                $message->subject = Yii::t('mail', 'Password recovery');
                $message->addTo($user->email);
                $message->setFrom(['not_reply@example.com' => Yii::app()->name . ' Notification']);

                if (Yii::app()->mail->send($message)) {
                    Yii::app()->user->setFlash('info',
                        Yii::t('app', "На ваш почтовый ящик отправлено письмо с дальнейшими инструкциями.")
                    );
                    $this->redirect(Yii::app()->homeUrl);
                }
            }
        }
        // display the passrecovery form
        $this->render(
            'passrecovery',
            array(
                'model' => $model
            )
        );
    }

    /**
     * password change
     */
    public function actionPasschange($code)
    {
        $model = User::findByRecoveryCode($code);

        if ($model === null) {
            $model = new User('passrecovery');
            $model->addError('passrecovery_code', Yii::t('app', 'correct code required.'));
        } else {
            if (isset($_POST['User'])) {
                $password = $_POST['User']['password'];
                $model->password = $model->hashPassword($password);
                if ($model->save()) {
                    Yii::app()->user->setFlash('info', Yii::t('app', "You successfully changed password."));
                    $this->redirect(Yii::app()->user->loginUrl);
                }
            }
            $model->password = null;
        }
        // display the passrecovery form
        $this->render(
            'passchange',
            array(
                'model' => $model
            )
        );
    }

}
