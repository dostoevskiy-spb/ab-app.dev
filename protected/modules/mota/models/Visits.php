<?php

/**
 * This is the model class for table "visits".
 *
 * The followings are the available columns in table 'visits':
 * @property integer $id
 * @property string $ip
 * @property string $source
 * @property string $page
 * @property string $date
 * @method unique()
 */
class Visits extends CActiveRecord
{

    const SIMPLE = 1;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Visits the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function scopes()
    {
        return array(
            'unique' => array(
                'group' => 'ip'
            ),
        );
    }


    public function withActive(array $active)
    {
        $active = implode(',', $active);
        $this->getDbCriteria()->mergeWith(array(
            "condition" => "page IN($active)"
        ));

        return $this;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{visits}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ip, source, page', 'length', 'max' => 255),
            array('date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, ip, source, page, date', 'safe', 'on' => 'search'),
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
            'id'     => 'ID',
            'ip'     => 'IP',
            'source' => 'Источник',
            'page'   => 'Land',
            'date'   => 'Дата посещения',
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
        $criteria->distinct = true;
        $criteria->select = "t.ip, source, page, date";
        $criteria->compare('id', $this->id);
        $criteria->compare('ip', $this->ip, TRUE);
        $criteria->compare('source', $this->source, TRUE);
        $criteria->compare('page', $this->page, TRUE);
        if ($this->date) {
            $criteria->compare('date', $this->date, TRUE);
        }
        $criteria->order = 'date DESC';

        return new CActiveDataProvider($this, array(
            'criteria'   => $criteria,
            'pagination' => array(
                'pageSize' => 10
            ),
        ));
    }

    public function getMin($source)
    {
        $this->getDbCriteria()->mergeWith(array(
                'condition' => 'source=:source',
                'params'    => array(
                    ':source' => $source
                )
            )
        );

        $active = CHtml::listData(Page::model()->active()->findAll(), 'id', 'id');
		if(count($active)==1){
            return array_pop($active);
        }
        $result = $this->withActive($active)->findAll();
        $aggr   = array();
        foreach ($active as $one) {
            $aggr[$one] = 0;
        }
        $ips = array();
        foreach ($result as $one) {
            if (!in_array($one->ip, $ips)) {
                $aggr[$one->page]++;
                $ips[] = $one->ip;
            }
        }
        $min = array_search(min($aggr), $aggr);

        return $min;
    }
}