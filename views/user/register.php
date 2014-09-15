<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form TbActiveForm */

$this->layout = '//layouts/column1';

?>
<div class="row">
    <div class="span6 offset3">
        <h3 class="text-center"><?php echo Yii::t('app', 'Registration'); ?></h3>
        <?php $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            array(
                'id' => 'user-register-form',
                'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'htmlOptions' => array('class' => 'well'),
            )
        ); ?>
        <?php echo $form->errorSummary($model); ?>

        <?php echo $form->textFieldControlGroup(
            $model,
            'username',
            array('placeholder' => Yii::t('app', 'username'))
        ); ?>
        <?php echo $form->textFieldControlGroup($model, 'email', array('placeholder' => Yii::t('app', 'email'))); ?>
        <?php echo $form->passwordFieldControlGroup(
            $model,
            'password',
            array('placeholder' => Yii::t('app', 'password'))
        ); ?>

        <?php echo TbHtml::formActions(
            array(
                TbHtml::submitButton(
                    Yii::t('user', 'Sign Up!'),
                    array(
                        'color' => TbHtml::BUTTON_COLOR_SUCCESS
                    )
                )
            )
        );
        ?>
        <?php $this->endWidget(); ?>

        <div class="well">
            <div class="span3 offset1">
                <?php echo TbHtml::btn(
                    TbHtml::BUTTON_TYPE_LINK,
                    Yii::t('user', 'Already registered?'),
                    array(
                        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                        'url' => '/user/login'
                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>
