<h1><?php echo $model->username; ?></h1>

<?php $this->widget(
    'bootstrap.widgets.TbDetailView',
    array(
        'data' => $model,
        'attributes' => array(
            'username',
            'email',
            'profile',
            'created',
            'gender',
            'language',
            array(
                'label' => 'Role',
                'value' => Yii::app()->user->role,
            )
        ),
    )
); ?>

<!--hr>
Профиль
Аватар(с кнопкой изменить)
Имя Фамилия
емайл,ник,пол,дата рождения
вкладка смена пароля
вкладка уведомления
вкладка приватность
<hr-->
<ul>
    <li>createUser - <?php echo (Yii::app()->user->checkAccess('createUser')) ? 'true' : 'false'; ?>
    <li>readUser - <?php echo (Yii::app()->user->checkAccess('readUser')) ? 'true' : 'false';; ?>
    <li>updateUser - <?php echo (Yii::app()->user->checkAccess('updateUser')) ? 'true' : 'false';; ?>
    <li>deleteUser - <?php echo (Yii::app()->user->checkAccess('deleteUser')) ? 'true' : 'false';; ?>

        <?php $params = array('user' => $model); ?>
    <li>readOwnProfile - <?php echo (Yii::app()->user->checkAccess('readOwnProfile', $params)) ? 'true' : 'false';; ?>

    <li>guest - <?php echo (Yii::app()->user->checkAccess('guest')) ? 'true' : 'false';; ?>
    <li>user - <?php echo (Yii::app()->user->checkAccess('user')) ? 'true' : 'false';; ?>
    <li>administrator - <?php echo (Yii::app()->user->checkAccess('administrator')) ? 'true' : 'false';; ?>
</ul>
