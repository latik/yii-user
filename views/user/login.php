<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form TbActiveForm */

$this->layout = '//layouts/column1';

?>
<div class="row">
    <div class="span6 offset3">
        <h3 class="text-center"><?php echo Yii::t('app', 'Login'); ?></h3>
        <?php $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            array(
                'id' => 'login-form',
                'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'htmlOptions' => ['class' => 'well'],
            )
        ); ?>
        <?php //echo $form->errorSummary($model); ?>
        <?php echo $form->textFieldControlGroup(
            $model,
            'username',
            array(
                'class' => 'span3',
                'placeholder' => Yii::t('user', 'username or email')
            )
        ); ?>
        <?php echo $form->passwordFieldControlGroup(
            $model,
            'password',
            array(
                'class' => 'span3',
                'placeholder' => Yii::t('user', 'password')
            )
        ); ?>

        <?php echo TbHtml::formActions(
            array(
                TbHtml::submitButton(
                    Yii::t('user', 'Log In'),
                    array(
                        'color' => TbHtml::BUTTON_COLOR_PRIMARY
                    )
                ),
                TbHtml::btn(
                    TbHtml::BUTTON_TYPE_LINK,
                    Yii::t('user', 'Forgot password?'),
                    array(
                        'color' => TbHtml::BUTTON_COLOR_LINK,
                        'url' => '/user/passrecovery'
                    )
                )
            )
        );
        ?>

        <?php $this->endWidget(); ?>

        <div class='well'>
            <div class="span2"><?php echo Yii::t('user', 'New user?'); ?></div>
            <div class="span2">
                <?php echo TbHtml::btn(
                    TbHtml::BUTTON_TYPE_LINK,
                    Yii::t('user', 'Sign Up!'),
                    array(
                        'color' => TbHtml::BUTTON_COLOR_SUCCESS,
                        'url' => '/user/registration'
                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>
