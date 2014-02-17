<?php
/* @var $this StatisticsController */
/* @var $orders Orders */
?>
<h1>Статистика</h1>
<div class="clear"/></div>
<? $ordersCount = $orders->count()?>
<table class="default">
    <thead>
    <th colspan="2">Общая конверсия:</th>
    </thead>
    <tr>
        <td>Всего посещений:</td>
        <td><?= $all ?></td>
    </tr>
    <tr>
        <td>Уникальных посещений:</td>
        <td><?= $uniq ?></td>
    </tr>
    <tr>
        <td>Заказов:</td>
        <td><?= $ordersCount ?></td>
    </tr>
    <tr>
        <td>Конверсия:</td>
        <td><?= $uniq ? number_format(100*$ordersCount / $uniq, 2) . '%' : '0%' ?></td>
    </tr>
</table>
<div class="clear"/></div>
<? $pages = Page::model()->findAll() ?>
<table class="default">
    <thead>
    <th>Конверсия по шаблонам:</th>
    <? foreach ($pages as $page) { ?>
        <th><?= $page->id ?></th>
    <? } ?>
    </thead>
    <tr>
        <td>Всего посещений:</td>
        <? foreach ($pages as $page) { ?>
            <td><?= count($page->visits) ?></td>
        <? } ?>
    </tr>
    <tr>
        <td>Уникальных посещений:</td>
        <? foreach ($pages as $page) { ?>
            <td><?= count($page->uniq_visits) ?></td>
        <? } ?>
    </tr>
    <tr>
        <td>Заказов:</td>
        <? foreach ($pages as $page) { ?>
            <td><?= count($page->orders) ?></td>
        <? } ?>
    </tr>
    <tr>
        <td>Конверсия:</td>
        <? foreach ($pages as $page) { ?>
            <td><?= count($page->uniq_visits) ? number_format(100*count($page->orders) / count($page->uniq_visits),2) . '%' : '0%' ?></td>
        <? } ?>

    </tr>
</table>
<div class="clear"/></div>
<? $sources = Source::model()->findAll() ?>
<table class="default">
    <thead>
    <th>Конверсия по источникам:</th>
    <? foreach ($sources as $source) { ?>
        <th><?= $source->title ?></th>
    <? } ?>
    </thead>
    <tr>
        <td>Всего посещений:</td>
        <? foreach ($sources as $source) { ?>
            <td><?= count($source->visits) ?></td>
        <? } ?>
    </tr>
    <tr>
        <td>Уникальных посещений:</td>
        <? foreach ($sources as $source) { ?>
            <td><?= count($source->uniq_visits) ?></td>
        <? } ?>
    </tr>
    <tr>
        <td>Заказов:</td>
        <? foreach ($sources as $source) { ?>
            <td><?= count($source->orders) ?></td>
        <? } ?>
    </tr>
    <tr>
        <td>Конверсия:</td>
        <? foreach ($sources as $source) { ?>
            <td><?= count($source->uniq_visits) ? number_format(100*count($source->orders) / count($source->uniq_visits), 2) . '%' : '0%' ?></td>
        <? } ?>

    </tr>
</table>

<div class="clear"/></div>
<? $sources = Source::model()->findAll() ?>
<table class="default">
    <thead>
    <th>Лучшие шаблоны по источникам:</th>
    <? foreach ($sources as $source) { ?>
        <th><?= $source->title ?></th>
    <? } ?>
    </thead>
    <tr>
        <td>Шаблон(конверсия):</td>
        <?
        foreach ($sources as $source) {
            $temp = array();
            foreach ($pages as $page) {
                $uniqVisits      = Visits::model()->page($page->id)->source($source->id)->unique()->findAll();
                $orders          = Orders::model()->page($page->id)->source($source->id)->unique()->findAll();
                $temp[$page->id] = count($uniqVisits) ? number_format(100*count($orders) / count($uniqVisits), 2) : 0;
            }
            $maxConversion = max($temp);
            $bestPage      = array_search($maxConversion, $temp);?>
            <td><?= CHtml::link("$bestPage($maxConversion%)", Yii::app()->createUrl('/backend/page/view', array('id'=>$bestPage)), array('target'=>'_blank')) ?></td>
        <? } ?>
    </tr>
</table>
