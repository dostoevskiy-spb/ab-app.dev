<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mota-systems
 * Date: 12.02.13
 * Time: 12:14
 * To change this template use File | Settings | File Templates.
 */

Yii::import('zii.widgets.CBaseListView');
Yii::import('zii.widgets.grid.CDataColumn');
Yii::import('zii.widgets.grid.CLinkColumn');
Yii::import('zii.widgets.grid.CButtonColumn');
Yii::import('zii.widgets.grid.CCheckBoxColumn');
Yii::import('zii.widgets.grid.CGridView');
class CustomGridView extends CGridView
{

    public $summaryTranslate;

    /**
     * Renders the summary text.
     */
    public function renderSummary()
    {
        if (($count = $this->dataProvider->getItemCount()) <= 0)
            return;

        echo '<div class="' . $this->summaryCssClass . '">';
        if ($this->enablePagination) {
            $pagination = $this->dataProvider->getPagination();
            $total = $this->dataProvider->getTotalItemCount();
            $start = $pagination->currentPage * $pagination->pageSize + 1;
            $end = $start + $count - 1;
            if ($end > $total) {
                $end = $total;
                $start = $end - $count + 1;
            }
            if (($summaryText = $this->summaryText) === NULL) {
                if ($this->summaryTranslate) {
                    $summaryText = 'Найдено {count} ' . Yii::t("ipoteka", $this->summaryTranslate, $total) . ', удовлетворяющих критериям поиска.';
                } else {
                    $summaryText = Yii::t('zii', 'Displaying {start}-{end} of 1 result.|Displaying {start}-{end} of {count} results.', $total);
                }
            }
            echo strtr($summaryText, array(
                '{start}' => $start,
                '{end}' => $end,
                '{count}' => $total,
                '{page}' => $pagination->currentPage + 1,
                '{pages}' => $pagination->pageCount,
            ));
        } else {
            if (($summaryText = $this->summaryText) === NULL)
                $summaryText = Yii::t('zii', 'Total 1 result.|Total {count} results.', $count);
            echo strtr($summaryText, array(
                '{count}' => $count,
                '{start}' => 1,
                '{end}' => $count,
                '{page}' => 1,
                '{pages}' => 1,
            ));
        }
        echo '</div>';
    }
}
