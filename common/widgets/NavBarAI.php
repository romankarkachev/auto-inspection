<?php

namespace common\widgets;

use Yii;
use yii\helpers\Html;

/**
 * Перекрыт защищенный метод. Все.
 * @author Roman Karkachev <post@romankarkachev.ru, roman@karkachev.ru>
 */
class NavBarAI extends \yii\bootstrap\NavBar
{
    /**
     * Renders collapsible toggle button.
     * @return string the rendering toggle button.
     */
    protected function renderToggleButton()
    {
        $bar = Html::tag('i', '', ['class' => 'fa fa-bars']);
        $screenReader = "<span class=\"sr-only\">{$this->screenReaderToggleText}</span>";

        return Html::button("{$screenReader}\n{$bar}", [
            'class' => 'navbar-toggle',
            'data-toggle' => 'collapse',
            'data-target' => "#{$this->containerOptions['id']}",
        ]);
    }
}
