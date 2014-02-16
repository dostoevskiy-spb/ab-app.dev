<?
$this->menu = array(
    array('label' => 'Удалить заявки', 'url' => array('deleteAll'), 'linkOptions' => array('submit' => array('deleteAll'), 'confirm' => 'Вы действительно хотите очистить список заявок?')),
);
?>
<h1>Заявки</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'              => 'orders-grid',
        'dataProvider'    => $model->search(),
        'filter'          => $model,
        'itemsCssClass'   => 'default',
        'afterAjaxUpdate' => "function() {
                 jQuery('#Orders_date').datepicker(jQuery.extend(jQuery.datepicker.regional['ru'],{
                 'showAnim':'fold',
                 'dateFormat':'yy-mm-dd',
                 'changeMonth':'true',
                 'showButtonPanel':'true',
                 'changeYear':'true'
                 }
                 ));
            }",
        'columns'         => array(
            array(
                'name'        => 'id',
                'htmlOptions' => array('width' => '10px'),
            ),
            array(
                'name'        => 'name',
                'htmlOptions' => array('width' => '10px'),
            ),
            array(
                'name'        => 'phone',
                'htmlOptions' => array('width' => '130px'),
            ),
//		'mail',

//		'comment',
            array(
                'name'        => 'page',
                'htmlOptions' => array('width' => '10px'),
            ),
            array(
                'name'   => 'source',
                'value'  => function ($data) {
                        return is_null($data->sourceName) ? 'Неизвестный источник' : $data->sourceName->title;
                    },
                'filter' => array(0 => 'Напрямую с сайта', 2 => 'Рассылка', 1 => 'Яндекс', 3 => 'Google')

            ),
            array(
                'name'   => 'type',
                'value'  => function ($data) {
                        $types = Orders::type();

                        return isset($types[$data->type]) ? $types[$data->type] : 'Не выбран';
                    },
                'filter' => Orders::type(),
            ),
            array(
                'name'  => 'ticket',
                'value' => function ($data) {
                        return Orders::ticketName($data->ticket);
                    }
            ),
            'quantity',
            array(
                'name'   => 'date',
                'value'  => function ($data) {
                        return Yii::app()->dateFormatter->formatDateTime($data->date, 'long', 'short');
                    },
                'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'     => $model,
                        'attribute' => 'date',
                        'language'  => 'ru',
                        'options'   => array(
                            'showAnim'        => 'fold',
                            'dateFormat'      => 'yy-mm-dd',
                            'changeMonth'     => 'true',
                            'showButtonPanel' => 'true',
                            'changeYear'      => 'true',
                        ),
                    ), TRUE)
            ),
            array(
                'class'    => 'CButtonColumn',
                'template' => '{update} {delete}'
            ),
        ),
    )
); ?>
