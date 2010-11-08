<?php
$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Events', 'url'=>array('index')),
	array('label'=>'Create a New Event', 'url'=>array('create')),
	array('label'=>'Update This Event', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete This Event', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Admin: Manage Events', 'url'=>array('admin'), 'visible'=>Yii::app()->user->isAdmin),
);
?>

<h1>Viewing <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'description',
		'creatorId', //FIXME: replace with link to user name
		'groupId', //FIXME: replace with link to group
		'starts',
		'ends',
		'location',
		'created',
		'modified',
	),
)); 

?>

<?php 
//RSVP buttons
$this->renderPartial('_rsvp', array(
	'eventuser'=>$eventuser,
)); 
?>

<!-- List of users in event -->
<div id="users">
	<h3>
		<?php echo $attendees->getTotalItemCount() . ' Attending'; ?>
	</h3>
	
	<?php 
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$attendees,
		'itemView'=>'_users',
		'cssFile'=> false
	)); 
	?>
</div>