<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $email
 * @property string $profile
 * @property integer $group_id
 * @property integer $status
 * @property string $created
 * @property string $gender
 * @property integer $language
 *
 * The followings are the available model relations:
 * @property Group $group
 */
class User extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param  string $className active record class name.
     * @return User   the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password', 'required'),
            array('email', 'required', 'on' => 'register', 'except' => 'migrate'),
            array('username, email', 'unique', 'except' => 'login'),
            array('group_id, status, language', 'numerical', 'integerOnly' => true),
            array('email', 'email','allowEmpty' => true),
            array('username, password, email', 'length', 'max' => 128),
            array('gender', 'length', 'max' => 6),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, username, password, email, profile, group_id, status, created, gender, language',
                'safe',
                'on' => 'search'
            ),
            // в сценарии регистрации значения полей «password» и «verifyPassword» должны быть равны
            //array('password', 'compare', 'compareAttribute'=>'verifyPassword', 'on'=>'register', 'message' => "Retype password is incorrect."),
            array(
                'username',
                'match',
                'pattern' => '/^[\w\s\.\-,]+$/u',
                'message' => 'Логин содержит недопустимые символы.',
                'on' => 'register'
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
        );
    }

    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'created',
                'setUpdateOnCreate' => true,
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => Yii::t('app', 'username'),
            'password' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'email'),
            'group_id' => Yii::t('app', 'group'),
            'status' => Yii::t('app', 'status'),
            'created' => Yii::t('app', 'Created'),
            'gender' => Yii::t('app', 'gender'),
            'language' => Yii::t('app', 'language'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('group_id', $this->group_id);
        $criteria->compare('status', $this->status);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('gender', $this->gender, true);
        $criteria->compare('language', $this->language);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        return $this->password === $this->hashPassword($password, $this->password);
    }

    /**
     * Generates the password hash.
     * @param string password
     * @param string salt
     * @return string hash
     */
    public static function hashPassword($password, $salt = null)
    {
        return crypt($password, $salt);
    }

    /**
     * Finds a user by recoverycode.
     * @param string recoverycode
     * @return User
     */
    public static function findByRecoveryCode($code)
    {
        return User::model()->find('MD5(password)=:CODE', array(':CODE' => $code));
    }

    /**
     * Finds a user by email
     * @param  string $email
     * @return User
     */
    public static function findByEmail($email)
    {
        return User::model()->find('email=:email', array('email' => $email));
    }

    /**
     * Finds a user by username
     * @param  string $username
     * @return User
     */
    public static function findByUsername($username)
    {
        return User::model()->find('username=:username', array('username' => $username));
    }

    /**
     * Finds a user either by email, or username
     * @param  string $usernameOrEmail
     * @return User
     */
    public static function findByUsernameOrEmail($usernameOrEmail)
    {
        if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
            return self::findByEmail($usernameOrEmail);
        }

        return self::findByUsername($usernameOrEmail);
    }
}
