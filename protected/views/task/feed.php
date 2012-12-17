<?
/**
 * @uses $model 
 * @uses $feedDataProvider
 */
$this->pageTitle = 'Timeline for ' . $model->name;
?>

<header class="content-header">
	<nav class="content-header-nav">
		<ul>
			<li>
				<?= PHtml::link(
					PHtml::encode($model->name), 
					array('task/view', 'id'=>$model->id),
					array(
						'id'=>'task-view-menu-item',
						'class'=>'neutral task-view-menu-item',
						'title'=>'View ' . PHtml::encode($model->name),
					)
				); ?>
			</li>
		</ul>
	</nav>
</header>

<section id="task-log" class="content">		
	<? 
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$feedDataProvider,
		'itemView'=>'/feed/_view',
	));?>
</section>	