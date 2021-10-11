<?php
return array(
    'doctrine' => array(
        'driver' => array(
            'zfcuser_entity' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/MyUser/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'MyUser\Entity' => 'zfcuser_entity',
                )
            )
        ),
    ),

    'data-fixture' => array(
        'MyUser_fixture' => __DIR__ . '/../src/MyUser/Fixture',
    ),

    'zfcuser' => array(
        // telling ZfcUser to use our own class
        'user_entity_class'       => 'MyUser\Entity\User',
        // telling ZfcUserDoctrineORM to skip the entities it defines
        'enable_default_entities' => false,
        'new_user_default_role' => 'user',
    ),

    'bjyauthorize' => array(
        'guards' => array(
            \BjyAuthorize\Guard\Route::class => array(
                array('route' => 'zfcuser', 'roles' => array('guest', 'user')),
                array('route' => 'zfcuser/login', 'roles' => array('guest')),
                array('route' => 'zfcuser/authenticate', 'roles' => array('guest')),
                array('route' => 'zfcuser/logout', 'roles' => array('user')),
                array('route' => 'zfcuser/register', 'roles' => array('guest')),
            ),
        ),
        'default_role' => 'guest',
        'authenticated_role' => 'user',
        // Using the authentication identity provider, which basically reads the roles from the auth service's identity
        'identity_provider' => \BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider::class,

        'role_providers'        => array(
            // using an object repository (entity repository) to load all roles into our ACL
            \BjyAuthorize\Provider\Role\ObjectRepositoryProvider::class => array(
                'object_manager'    => \Doctrine\ORM\EntityManager::class,
                'role_entity_class' => \MyUser\Entity\Role::class,
            ),
        ),
    ),
);
