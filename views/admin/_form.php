<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'user-form',
        'enableAjaxValidation' => false,
    )
); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 128)); ?>

<?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span5', 'maxlength' => 128)); ?>

<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 128)); ?>

<?php echo $form->textFieldRow($model, 'group_id', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'status', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'created', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'gender', array('class' => 'span5', 'maxlength' => 6)); ?>

<?php echo $form->textFieldRow($model, 'language', array('class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        )
    ); ?>
</div>

<?php $this->endWidget(); ?>
