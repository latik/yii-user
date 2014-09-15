<?php

return array(

// Список операций

    // пользователи
    'createUser' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'bizRule' => null,
        'data' => null,
        'description' => 'создание пользователя',
    ),
    'readUser' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'bizRule' => null,
        'data' => null,
        'description' => 'просмотр пользователя',
    ),
    'updateUser' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'bizRule' => null,
        'data' => null,
        'description' => 'редактирование пользователя',
    ),
    'deleteUser' => array(
        'type' => CAuthItem::TYPE_OPERATION,
        'bizRule' => null,
        'data' => null,
        'description' => 'удаление пользователя',
    ),
///////////////////////////////////////////////

// специфика - таска, позволяющея юзеру смотреть свой профиль
    'readOwnProfile' => array(
        'type' => CAuthItem::TYPE_TASK,
        'description' => 'редактирование своего профиля',
        'bizRule' => 'return Yii::app()->user->id==$params["user"]->id;',
        'data' => null,
        'children' => array(
            0 => 'readUser',
        ),
    ),
///////////////////////////////////////////////

    // иерархия ролей
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'bizRule' => null,
        'data' => null,
        'description' => 'Guest',
        'children' => array(
            // гостю можно регистрироваться
            'createUser',
        ),
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'bizRule' => null,
        'data' => null,
        'description' => 'User',
        'children' => array(
            // унаследуемся от гостя и разрешим просматривать свой профиль
            'guest',
            'readUser',
            'readOwnProfile'
        ),
    ),
    'administrator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'bizRule' => null,
        'data' => null,
        'description' => 'Administrator',
        'children' => array(
            // позволим админу всё
            'user',
            'createUser',
            'readUser',
            'updateUser',
            'deleteUser',
        ),
    ),
);
