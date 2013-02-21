<?php
 
return array(
    'guest' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'Могут просматривать раздачи и главную',
        'bizRule'=>'',
        'data'=>''
   ),
 
    'user' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'Могут создавать раздачи, оставлять комментарии',
        'bizRule'=>'',
        'data'=>''
    ),
 
    'admin' => array (
        'type'=>CAuthItem::TYPE_ROLE,
        'description'=>'Полные права',
        'children'=>array(
            'guest','user'
        ),
        'bizRule'=>'',
        'data'=>''
   )
);