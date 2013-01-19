<?php

class UGDefaultController extends Controller
{	
	/**
	 * @var mixed no permission rules for this controller
	 */
	public static $_permissionControl = false;
	/**
	 * Displays the module home page content according to the user status
	 */
	public function actionIndex()
	{
		if (isset($_GET['u']))
			$this->forward('/userGroups/user/view');
		else if (Yii::app()->user->isGuest)
			$this->forward('/userGroups/user/login');
//                else if (Yii::app()->user->groupName==='Registration')
//                        $this->forward('/site/regueb');
		else
			$this->forward('/userGroups/user/view');
	}
}