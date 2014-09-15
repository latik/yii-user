<div class="row">
    <div class="span6 offset3 well">
        <h3 class="text-center"><?php echo Yii::t('app', 'Recovery user password'); ?></h3>
        <?php $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            array(
                'id' => 'recovery-password-form',
                'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
                //'enableClientValidation' => true,
            )
        ); ?>
        <p class="muted text-center">
            <?php echo Yii::t(
                'app',
                'Please input your email address below, you will be sent a link to reset your password.'
            ); ?>

            <?php echo $form->errorSummary($model); ?>
            <?php echo $form->textFieldControlGroup(
                $model,
                'email',
                array('class' => 'span4', 'placeholder' => Yii::t('app', 'email'))
            ); ?>

            <?php echo TbHtml::formActions(
                array(
                    TbHtml::submitButton(
                        Yii::t('user', 'Recovery password'),
                        array(
                            'color' => TbHtml::BUTTON_COLOR_SUCCESS
                        )
                    ),
                    TbHtml::btn(
                        TbHtml::BUTTON_TYPE_LINK,
                        Yii::t('user', 'Remember password?'),
                        array(
                            'color' => TbHtml::BUTTON_COLOR_LINK,
                            'url' => '/user/login'
                        )
                    )
                )
            );
            ?>

            <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->
