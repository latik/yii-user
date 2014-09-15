<div class="row">
    <div class="span6 offset3">
        <h3 class="text-center"><?php echo Yii::t('app', 'Change password'); ?></h3>

        <?php $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            array(
                'id' => 'recovery-password-form',
                'enableClientValidation' => true,
            )
        ); ?>

        <?php if (array_key_exists('passrecovery_code', $model->getErrors())) : ?>
            <?php echo $form->errorSummary($model); ?>
        <?php else: ?>

            <div class="well">

                <p class="text-center"><?php echo Yii::t('app', 'Please input new password for '); ?>
                    <strong><?php echo $model->username; ?></strong>

                    <?php echo $form->errorSummary($model); ?>
                    <?php echo $form->textFieldControlGroup(
                        $model,
                        'password',
                        array('class' => 'span4', 'placeholder' => Yii::t('app', 'new password'))
                    ); ?>

            </div>
            
            <?php echo TbHtml::formActions([
                    TbHtml::submitButton(
                        Yii::t('app', 'Change password'),
                        [
                            'color' => TbHtml::BUTTON_COLOR_PRIMARY
                        ]
                    )
                ]);
            ?>

        <?php endif; ?>

        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->
