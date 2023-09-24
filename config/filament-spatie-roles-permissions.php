<?php

return [

    'preload_roles' => true,

    'preload_permissions' => true,

    'navigation_section_group' => 'Security & Control', // Default uses language constant

    'team_model' => \App\Models\Team::class,

    /*
     * Set to false to remove from navigation
     */
    'should_register_on_navigation' => [
        'permissions' => false,
        'roles' => true,
    ],

    'guard_names' => [
        'web' => 'web',
        'api' => 'api',
        'candidate_web',
    ],

    'toggleable_guard_names' => [
        'roles' => [
            'isToggledHiddenByDefault' => true,
        ],
        'permissions' => [
            'isToggledHiddenByDefault' => true,
        ],
    ],

    'default_guard_name' => 'web',

    'model_filter_key' => 'return \'%\'.$key;', // Eg: 'return \'%\'.$key.'\%\';'

    'generator' => [

        'guard_names' => [
            'web',
        ],

        'permission_affixes' => [

            /*
             * Permissions Aligned with Policies.
             * DO NOT change the keys unless the genericPolicy.stub is published and altered accordingly
             */
            'viewAnyPermission' => 'view-any',
            'viewPermission' => 'view',
            'createPermission' => 'create',
            'updatePermission' => 'update',
            'deletePermission' => 'delete',
            'restorePermission' => 'restore',
            'forceDeletePermission' => 'force-delete',

            /*
             * Additional Resource Permissions
             */
            'replicate',
            'reorder',
        ],

        /*
         * returns the "name" for the permission.
         *
         * $permission which is an iteration of [permission_affixes] ,
         * $model The model to which the $permission will be concatenated
         *
         * Eg: 'permission_name' => 'return $permissionAffix . ' ' . Str::kebab($modelName),
         *
         * Note: If you are changing the "permission_name" , It's recommended to run with --clean to avoid duplications
         */
        'permission_name' => 'return  $modelName.\'.\'.$permissionAffix;',

        /*
         * Permissions will be generated for the models associated with the respective Filament Resources
         */
        'discover_models_through_filament_resources' => false,

        /*
         * Include directories which consists of models.
         */
        'model_directories' => [
            app_path('Models'),
            //app_path('Domains/Forum')
        ],

        /*
         * Define custom_models in snake-case
         */
        'custom_models' => [
            //
        ],

        /*
         * Define excluded_models in snake-case
         */
        'excluded_models' => [
            //
        ],

        'excluded_policy_models' => [
        ],

        /*
         * Define any other permission here
         */
        'custom_permissions' => [
            //'view-log'
            'User.impersonate',
        ],

        'user_model' => \App\Models\User::class,

        'policies_namespace' => 'App\Policies',
    ],
];
