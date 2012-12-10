<?
/**
* Partial view to display the easy feedback form for users
* @author Harrison Vuong
**/

$this->pageTitle = 'Feedback';
?>


<?= PHtml::beginContentHeader(array('class'=>'feedback-form' )); ?>
	<h1><?= PHtml::encode($this->pageTitle); ?></h1>
<?= PHtml::endContentHeader(); ?>

<section>
	<?php $form=$this->beginWidget('application.components.widgets.ActiveForm', array(
		'id'=>'feedback-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

	<p>Tell us what you think</p>

	<?= $form->errorSummary($model); ?>

		<div class="field">
			<?= $form->labelEx($model,'email'); ?>
			<?= $form->textField($model,'email'); ?>
			<?= $form->error($model,'email'); ?>
		</div>

		<div class="field">
			<?= $form->labelEx($model,'message'); ?>
			<?= $form->textArea($model,'message'); ?>
			<?= $form->error($model,'message'); ?>
		</div>

		<div class="field buttons">
			<?= CHtml::submitButton('Submit'); ?>
		</div>

	<?php $this->endWidget(); ?>
</section>