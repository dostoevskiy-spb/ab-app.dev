<?php

/**
 * This is the model class for table "orders".
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property string  $name
 * @property string  $mail
 * @property string  $phone
 * @property string  $comment
 * @property integer $page
 * @property integer $type
 * @property integer $pay
 * @property integer $ticket
 */
class Orders extends CActiveRecord
{

    const PAT_TYPE_COURIER = 1;
    const PAY_TYPE_CARD    = 2;
    const PAY_TYPE_OFFICE  = 3;

    const TICKET_BALKON  = 0;
    const TICKET_STADARD = 1;
    const TICKET_GOLD    = 2;
    const TICKET_VIP     = 3;

    const TYPE_PHONE   = 0;
    const TYPE_REQUEST = 1;
    const TYPE_TICKET  = 2;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Orders the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function type()
    {
        return array(
            self::TYPE_PHONE   => 'Обратный звонок',
            self::TYPE_REQUEST => 'Заявка',
            self::TYPE_TICKET  => 'Билет'
        );
    }

//    public function defaultScope()
//    {
//        return array(
//            'group' => 'ip'
//        );
//    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{orders}}';
    }

    public function scopes()
    {
        return array(
            'unique' => array(
                'group' => 'ip'
            ),
        );
    }


    public function behaviors()
    {
        return array( //            'AutoTimeStamp' => array(
//                'class'           => 'zii.behaviors.CTimestampBehavior',
//                'createAttribute' => 'date',
//                'updateAttribute' => FALSE
//            ),
        );
    }

    public function page($page)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'page=:page',
            'params'    => array(':page' => $page),
        ));

        return $this;
    }

    public function source($source)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'source=:source',
            'params'    => array(':source' => $source),
        ));

        return $this;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('page, source, ticket, quantity, pay', 'numerical', 'integerOnly' => TRUE),
            array('name', 'length', 'min' => 3, 'max' => 250),
            array('mail', 'email'),
            array('phone', 'length', 'min' => 3, 'max' => 50),
            array('comment', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, mail, phone, comment, page, date', 'safe', 'on' => 'search'),
        );
    }

    public static function ticketName($ticket)
    {
        $tickets = array(
            self::TICKET_GOLD    => 'Голд',
            self::TICKET_STADARD => 'Стандарт',
            self::TICKET_VIP     => 'Вип',
            self::TICKET_BALKON  => 'Балкон',
        );

        return isset($tickets[$ticket]) ? $tickets[$ticket] : 'Не выбран';
    }

    public static function payType($type = NULL)
    {
        $types = array(
            self::PAT_TYPE_COURIER => 'Наличными курьеру',
            self::PAY_TYPE_CARD    => 'Карта и др. электронные способы',
            self::PAY_TYPE_OFFICE  => 'Наличными в офисе',
        );

        if ($type) {
            return isset($types[$type]) ? $types[$type] : 'Не выбран';
        }
    }

    public static function ticketType($type = NULL)
    {
        $types = array(
            self::TYPE_PHONE   => 0,
            self::TYPE_REQUEST => 1,
            self::TYPE_TICKET  => 2,
        );
        if ($type) {
            return isset($types[$type]) ? $types[$type] : 'Не выбран';
        } else {
            return $types;
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sourceName' => array(self::BELONGS_TO, 'Source', 'source'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'      => 'ID',
            'name'    => 'Имя',
            'mail'    => 'Mail',
            'phone'   => 'Телефон',
            'comment' => 'Комментарий',
            'page'    => 'Шаблон',
            'source'  => 'Источник',
            'date'    => 'Дата регистрации',
            'ticket'  => 'Вид билета',
            'type'    => 'Тип заявки',
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
        $criteria->compare('name', $this->name, TRUE);
        $criteria->compare('mail', $this->mail, TRUE);
        $criteria->compare('phone', $this->phone, TRUE);
        $criteria->compare('comment', $this->comment, TRUE);
        $criteria->compare('page', $this->page);
        $criteria->compare('source', $this->source);
        $criteria->order = 'date DESC';
        if ($this->date) {
            $criteria->compare('date', $this->date, TRUE);
        }

        return new CActiveDataProvider($this, array(
            'criteria'   => $criteria,
            'pagination' => array(
                'pageSize' => 10
            ),
        ));
    }
}