<?php

return [
    //MainController
    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],
    'about' => [
        'controller' => 'main',
        'action' => 'about'
        ],
    'contact' => [
        'controller' => 'main',
        'action' => 'contact'
        ],
    'contacts{id:\d+}' => [
        'controller' => 'main',
        'action' => 'show'
    ],
    //AdminCoontroller
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login'
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout'
    ],
    'admin/contacts/create' => [
        'controller' => 'admin',
        'action' => 'create'
    ],
    'admin/contacts/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'edit'
    ],
    'admin/contacts/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'delete'
    ],
    'admin/contacts/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'contacts',
    ],
    'admin/contacts' => [
        'controller' => 'admin',
        'action' => 'contacts'
    ],
    //UserController
    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],
    'user/login' => [
        'controller' => 'user',
        'action' => 'login'
    ],
    'user/register' => [
        'controller' => 'user',
        'action' => 'register'
    ],
    'user/logout' => [
        'controller' => 'user',
        'action' => 'logout'
    ],
    'user/contacts' => [
        'controller' => 'user',
        'action' => 'contacts'
    ],
    'user/contacts/{page:\d+}' => [
        'controller' => 'user',
        'action' => 'contacts',
    ],
    'user/favourites' => [
        'controller' => 'user',
        'action' => 'favourites'
    ],
    'user/save-contact-to-favourites' => [
        'controller' => 'user',
        'action' => 'saveContactToFavourites'
    ],
    'user/delete-contact-from-favourites' => [
        'controller' => 'user',
        'action' => 'deleteContactFromFavourites'
    ],
];