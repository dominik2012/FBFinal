<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
								array(  'label'=>'Home', 
                                        'url'=>array('/site/index')
                                ),
                                array(  'label'=>'Filter', 
                                        'url'=>array('/site/filter'),
					'visible'=>Yii::app()->user->level>=5,
                                ),
				array(  'label'=>'Benutzerverwaltung', 
                                        'url'=>array('/userGroups/admin'), 
                                        'visible'=>Yii::app()->user->level>99,
                                ),/*
                                array(  'label'=>'Übersicht', 
                                        'url'=>array('/userGroups/user/view'), 
                                        'visible'=>Yii::app()->user->groupName==='Registration',
                                ),*/
                                array(  'label'=>'Kontakt', 
                                        'url'=>array('/site/contact')
                                ),
                                array(  'label'=>'About', 
                                        'url'=>array('/site/page', 'view'=>'about')
                                ),
                                array(  'label'=>'Logout ('.Yii::app()->user->name.')', 
                                        'url'=>array('/userGroups/user/logout'), 
                                        'visible'=>!Yii::app()->user->isGuest,
                                ),
                                array(  'label'=>'Login', 
                                        'url'=>array('/userGroups'), 
                                        'visible'=>Yii::app()->user->isGuest
                                ),/*
                                array(  'label'=>'Details', 
                                        'url'=>array('/site/details'),
					'visible'=>Yii::app()->user->level>=5,
										
                                ),*/
                        ),
                    )); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
