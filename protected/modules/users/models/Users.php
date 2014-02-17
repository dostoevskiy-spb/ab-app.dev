<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property integer $username
 * @property integer $password
 *
 */
class Users extends CActiveRecord
{
    public $password_repeat;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Users the static model class
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
        return '{{users}}';
    }


    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username', 'unique', 'allowEmpty' => FALSE, 'caseSensitive' => FALSE, 'className' => 'Users', 'attributeName' => 'username', 'message' => 'Пользователь {value} уже существует', 'on' => 'register'),
            array('username', 'length', 'max' => 20, 'min' => 5, 'on' => 'register'),
            array('username', 'FullAlphaValidator', 'on' => 'register'),
            array('password', 'required'),
            array('password', 'FullAlphaValidator'),
            array('password', 'length', 'min' => 4, 'max' => 10),
            array('password_repeat', 'compare', 'compareAttribute' => 'password'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('username', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'              => 'ID',
            'username'        => 'Имя пользователя',
            'password'        => 'Пароль',
            'password_repeat' => 'Повторите пароль',
        );
    }

    public function afterValidate()
    {
//        Yii::app()->end();
        $ui             = new MUserIdentity('asd', 'asd');
        $this->password = crypt($this->password, $ui->getSalt());
        parent::afterValidate();
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
        $criteria->compare('username', $this->username);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}