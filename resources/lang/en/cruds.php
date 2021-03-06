<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'phone_number'             => 'Phone Number',
            'phone_number_helper'      => ' ',
            'status'                   => 'Status',
            'status_helper'            => ' ',
        ],
    ],
    'bike'           => [
        'title'          => 'Bikes',
        'title_singular' => 'Bike',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'owner'                => 'Owner',
            'owner_helper'         => ' ',
            'price_per_day'        => 'Price Per Day',
            'price_per_day_helper' => ' ',
            'height'               => 'Height in CM',
            'height_helper'        => ' ',
            'front_light'          => 'Front Light',
            'front_light_helper'   => ' ',
            'rear_light'           => 'Rear Light',
            'rear_light_helper'    => ' ',
            'speed_sensor'         => 'Speed Sensor',
            'speed_sensor_helper'  => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'quantity'             => 'Quantity',
            'quantity_helper'      => ' ',
            'photos'               => 'Photos',
            'photos_helper'        => ' ',
            'description'          => 'Description',
            'description_helper'   => ' ',
            'brand'                => 'Brand',
            'brand_helper'         => ' ',
            'status'               => 'Status',
            'status_helper'        => ' ',
            'latitude'             => 'Latitude',
            'latitude_helper'      => ' ',
            'longitude'            => 'Longitude',
            'longitude_helper'     => ' ',
        ],
    ],
    'rental'         => [
        'title'          => 'Rentals',
        'title_singular' => 'Rental',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'bike'                  => 'Bike',
            'bike_helper'           => ' ',
            'client'                => 'Client',
            'client_helper'         => ' ',
            'quantity'              => 'Quantity',
            'quantity_helper'       => ' ',
            'period_in_days'        => 'Period In Days',
            'period_in_days_helper' => ' ',
            'amount'                => 'Amount',
            'amount_helper'         => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'status'                => 'Status',
            'status_helper'         => ' ',
        ],
    ],
];
