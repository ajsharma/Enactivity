<!doctype html> 
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1; user-scalable=no"/>  
	<!-- Add "maximum-scale=1" to fix the weird iOS auto-zoom bug on orientation changes. -->

	<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->


	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/reset.css"); ?>
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/screen.css"); ?>
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . "/css/jquery-ui.css"); ?>

	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/main.js"); ?>

	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico"/>
	<link rel="apple-touch-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon-114x114.png"> 

	<title><?php echo CHtml::encode($this->pageTitle) . ' - ' . Yii::app()->name; ?></title>
	
<?php 
// Include Google Analytics widget
$this->widget('ext.analytics.AnalyticsWidget', array()); 
?>
		
</head>
<body class="<?php echo $this->id . '-' . $this->action->id; ?>">

<div class="everything">
	<header class="global-header">
		<nav class="global-navigation">
		<?php 
		$this->widget('zii.widgets.CMenu', array(
			'items'=>MenuDefinitions::globalMenu()
		)); 
		?>
		</nav><!-- end of primaryNavigation -->
	</header>
	
	<!-- flash notices -->
	<?php if(Yii::app()->user->hasFlash('error')):?>
	<aside class="flash flash-error">
		<span><?php echo Yii::app()->user->getFlash('error'); ?></span>
	</aside>
	<?php endif; ?>
	<?php if(Yii::app()->user->hasFlash('notice')):?>
	<aside class="flash flash-notice">
		<span><?php echo Yii::app()->user->getFlash('notice'); ?></span>
	</aside>
	<?php endif; ?>
	<?php if(Yii::app()->user->hasFlash('success')):?>
	<aside class="flash flash-success">
		<span><?php echo Yii::app()->user->getFlash('success'); ?></span>
	</aside>
	<?php endif; ?>

	
	<?php echo $content; ?>
	
	<div class="footer-push"></div>
</div>

<footer class="global-footer">
	<span class="copyright"><?php echo PHtml::link("Poncla", "http://twitter.com/#!/poncla"); ?> &copy; <?php echo date('Y'); ?> 
		All Rights Reserved.
	</span>
	<span class="credits">Created by 
		<?php echo PHtml::link("Reed Musselman", "http://twitter.com/#!/blue21japan"); ?>, 
		<?php echo PHtml::link("Andy Fong", "http://twitter.com/#!/andysfong"); ?>, 
		<?php echo PHtml::link("Harrison Vuong", "http://twitter.com/#!/harrisonvuong"); ?>, and 
		<?php echo PHtml::link("Ajay Sharma", "http://twitter.com/#!/ajsharma"); ?>.
		<!-- Also, chicken wings and beer, lots of beer. --> 
	</span>
</footer>

</body>
</html>