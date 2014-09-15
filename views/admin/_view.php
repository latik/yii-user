<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
    <?php echo CHtml::encode($data->username); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
    <?php echo CHtml::encode($data->password); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
    <?php echo CHtml::encode($data->email); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('profile')); ?>:</b>
    <?php echo CHtml::encode($data->profile); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('group_id')); ?>:</b>
    <?php echo CHtml::encode($data->group_id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
    <?php echo CHtml::encode($data->status); ?>
    <br/>

    <?php /*
    <b><?php echo CHtml::encode($data->getAttributeLabel('salt')); ?>:</b>
    <?php echo CHtml::encode($data->salt); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
    <?php echo CHtml::encode($data->created); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
    <?php echo CHtml::encode($data->gender); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
    <?php echo CHtml::encode($data->language); ?>
    <br />

    */
    ?>

</div>
