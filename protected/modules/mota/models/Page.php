<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property integer $id
 * @property string $html
 * @property integer $active
 * @method active() @return $this
 */
class Page extends CActiveRecord
{

    const INACTIVE = 0;
    const ACTIVE   = 1;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Page the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function getStateProperties($state = NULL)
    {
        $states = array(self::INACTIVE => 'Неактивный', self::ACTIVE => 'Активный');
        if (!is_null($state)) {
            return isset($states[$state]) ? $states[$state] : 'Ошибка';
        } else {
            return $states;
        }
    }

    public function scopes()
    {
        return array(
            'active' => array(
                'condition' => 'active=' . self::ACTIVE,
            )
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'page';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('active', 'in', 'range' => array(self::INACTIVE, self::ACTIVE)),
            array('html', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, active', 'safe', 'on' => 'search'),
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
            'visits'      => array(self::HAS_MANY, 'Visits', 'page'),
            'uniq_visits' => array(self::HAS_MANY, 'Visits', 'page', 'select' => 'uniq_visits.ip', 'group'=>'ip'),
            'orders' => array(self::HAS_MANY, 'Orders', 'page', 'select' => 'uniq_visits.ip', 'group'=>'ip'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'     => 'ID',
            'html'   => 'HTML',
            'active' => 'Состояние',
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
        $criteria->compare('html', $this->html, TRUE);
        $criteria->compare('active', $this->active);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}