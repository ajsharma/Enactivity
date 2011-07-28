<?php
$this->pageTitle = 'Tasks';
?>

<header>
	<h1><?php echo PHtml::encode($this->pageTitle);?></h1>
</header>

<?php
// "what would you want to do input" box
echo $this->renderPartial('_form', array('model'=>$newTask));

if($datedTasksProvider->itemCount > 0
|| $datelessTaskProvider->itemCount > 0) {
	echo $this->renderPartial('_agenda', array(
		'datedTasks'=>$datedTasksProvider->data,
		'datelessTasks'=>$datelessTasksProvider->data,
	));
}
else {
	//TODO: make more user-friendly
	echo PHtml::openTag('p');
	echo 'You haven\'t signed up for any tasks.  Why not check out the ';
	echo PHtml::link('calendar', array('task/calendar'));
	echo ' to see what is listed or start a new task?'; 
	echo PHtml::closeTag('p');
}