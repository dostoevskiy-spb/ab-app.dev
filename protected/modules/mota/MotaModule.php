<?php

class MotaModule extends CWebModule
{

	public function beforeControllerAction($controller, $action)
	{
        Yii::app()->getModule('users');
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
