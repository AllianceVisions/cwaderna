<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $i = 1;
        $permissions = [

            [
                'id'    => $i++,
                'title' => 'user_management_access',
            ],

            //permissions
            [
                'id'    => $i++,
                'title' => 'permission_create',
            ],
            [
                'id'    => $i++,
                'title' => 'permission_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'permission_show',
            ],
            [
                'id'    => $i++,
                'title' => 'permission_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'permission_access',
            ],

            //roles
            [
                'id'    => $i++,
                'title' => 'role_create',
            ],
            [
                'id'    => $i++,
                'title' => 'role_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'role_show',
            ],
            [
                'id'    => $i++,
                'title' => 'role_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'role_access',
            ],

            //users
            [
                'id'    => $i++,
                'title' => 'user_create',
            ],
            [
                'id'    => $i++,
                'title' => 'user_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'user_show',
            ],
            [
                'id'    => $i++,
                'title' => 'user_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'user_access',
            ], 

            //cities
            [
                'id'    => $i++,
                'title' => 'city_create',
            ],
            [
                'id'    => $i++,
                'title' => 'city_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'city_show',
            ],
            [
                'id'    => $i++,
                'title' => 'city_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'city_access',
            ],

            //skills
            [
                'id'    => $i++,
                'title' => 'skill_create',
            ],
            [
                'id'    => $i++,
                'title' => 'skill_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'skill_show',
            ],
            [
                'id'    => $i++,
                'title' => 'skill_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'skill_access',
            ],

            //events
            [
                'id'    => $i++,
                'title' => 'event_create',
            ],
            [
                'id'    => $i++,
                'title' => 'event_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'event_show',
            ],
            [
                'id'    => $i++,
                'title' => 'event_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'event_access',
            ],

            //caders
            [
                'id'    => $i++,
                'title' => 'cader_create',
            ],
            [
                'id'    => $i++,
                'title' => 'cader_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'cader_show',
            ],
            [
                'id'    => $i++,
                'title' => 'cader_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'cader_access',
            ],

            //provider_man
            [
                'id'    => $i++,
                'title' => 'provider_man_create',
            ],
            [
                'id'    => $i++,
                'title' => 'provider_man_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'provider_man_show',
            ],
            [
                'id'    => $i++,
                'title' => 'provider_man_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'provider_man_access',
            ],

            //items
            [
                'id'    => $i++,
                'title' => 'items_create',
            ],
            [
                'id'    => $i++,
                'title' => 'items_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'items_show',
            ],
            [
                'id'    => $i++,
                'title' => 'items_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'items_access',
            ],

            //event organizer
            [
                'id'    => $i++,
                'title' => 'event_organizer_create',
            ],
            [
                'id'    => $i++,
                'title' => 'event_organizer_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'event_organizer_show',
            ],
            [
                'id'    => $i++,
                'title' => 'event_organizer_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'event_organizer_access',
            ],

            //cader managment access
            [
                'id'    => $i++,
                'title' => 'cader_managment_access',
            ],

            //caders
            [
                'id'    => $i++,
                'title' => 'cader_create',
            ],
            [
                'id'    => $i++,
                'title' => 'cader_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'cader_show',
            ],
            [
                'id'    => $i++,
                'title' => 'cader_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'cader_access',
            ],

            //provider man managment
            [
                'id'    => $i++,
                'title' => 'provider_man_mangment_access',
            ],

            //categories
            [
                'id'    => $i++,
                'title' => 'category_create',
            ],
            [
                'id'    => $i++,
                'title' => 'category_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'category_show',
            ],
            [
                'id'    => $i++,
                'title' => 'category_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'category_access',
            ],

            //provider_man
            [
                'id'    => $i++,
                'title' => 'provider_man_create',
            ],
            [
                'id'    => $i++,
                'title' => 'provider_man_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'provider_man_show',
            ],
            [
                'id'    => $i++,
                'title' => 'provider_man_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'provider_man_access',
            ],

            //items
            [
                'id'    => $i++,
                'title' => 'item_create',
            ],
            [
                'id'    => $i++,
                'title' => 'item_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'item_show',
            ],
            [
                'id'    => $i++,
                'title' => 'item_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'item_access',
            ],

            //event managment access
            [
                'id'    => $i++,
                'title' => 'event_managment_access',
            ],

            //events
            [
                'id'    => $i++,
                'title' => 'event_create',
            ],
            [
                'id'    => $i++,
                'title' => 'event_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'event_show',
            ],
            [
                'id'    => $i++,
                'title' => 'event_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'event_access',
            ],

            //services
            [
                'id'    => $i++,
                'title' => 'services_create',
            ],
            [
                'id'    => $i++,
                'title' => 'services_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'services_show',
            ],
            [
                'id'    => $i++,
                'title' => 'services_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'services_access',
            ],

            //specializations
            [
                'id'    => $i++,
                'title' => 'specialization_create',
            ],
            [
                'id'    => $i++,
                'title' => 'specialization_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'specialization_show',
            ],
            [
                'id'    => $i++,
                'title' => 'specialization_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'specialization_access',
            ],

            //alerts
            [
                'id'    => $i++,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => $i++,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'user_alert_access',
            ], 

            //audit logs
            [
                'id'    => $i++,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => $i++,
                'title' => 'audit_log_show',
            ], 

            //settings
            [
                'id' => $i++,
                'title' => 'setting_access'
            ],
            
            // break types
            [
                'id'    => $i++,
                'title' => 'break_type_create',
            ],
            [
                'id'    => $i++,
                'title' => 'break_type_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'break_type_show',
            ],
            [
                'id'    => $i++,
                'title' => 'break_type_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'break_type_access',
            ],
        ];

        Permission::insert($permissions);
    }
}