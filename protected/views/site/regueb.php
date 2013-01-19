<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name='Übersicht';
?>

<h1><i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php echo CHtml::encode(Yii::app()->user->name); ?>
<?php echo CHtml::encode(Yii::app()->user->groupName); ?>
<?php echo CHtml::encode(Yii::app()->user->level); ?>


