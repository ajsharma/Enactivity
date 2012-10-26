<?
/**
 * Lists user's upcoming tasks
 * @uses calendar
 * @uses newTask
 */

$this->pageTitle = 'Next';
?>

<?= PHtml::beginContentHeader(); ?>
	<h1><?= PHtml::encode($this->pageTitle);?></h1>
	<div class="menu toolbox">
		<ul>
			<li>
				<?
				echo PHtml::link(
					PHtml::encode('Timeline'), 
					array('feed/index'),
					array(
						'id'=>'feed-index-menu-item',
						'class'=>'neutral feed-index-menu-item',
						'title'=>'View recent history in your group',
					)
				);
				?>
			</li>
		</ul>
	</div>
<?= PHtml::endContentHeader(); ?>

<section class="tasks">
	<?
	if($calendar->itemCount > 0) {
		echo $this->renderPartial('_agenda', array(
			'calendar'=>$calendar,
			'showParent'=>true,
		));
	}
	else {
		//TODO: make more user-friendly
		echo PHtml::openTag('p', array('class'=>'no-results-message blurb'));
		echo 'You haven\'t signed up for any tasks.  Why not check out the ';
		echo PHtml::link('calendar', array('task/calendar'));
		echo ' to see what is listed or ';
		echo PHtml::link('create a new task', array('task/create'));
		echo '?'; 
		echo PHtml::closeTag('p');
	}
	?>		
</section>