<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1><i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p style="text-align: left;">Sie haben folgende Funktionen in dieser Webapp:</p>
<ul>
<li style="text-align: left;">anlegen neuer Benutzer</li>
<li style="text-align: left;">ändern bereits bestehender Benutzer</li>
<li style="text-align: left;">löschen eines Benutzers</li>
<li style="text-align: left;">filtern nach allen möglichen Attributen</li>
</ul>

