<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '18',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '19',
                'title' => 'user_alert_create',
            ],
            [
                'id'    => '20',
                'title' => 'user_alert_show',
            ],
            [
                'id'    => '21',
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => '22',
                'title' => 'user_alert_access',
            ],
            [
                'id'    => '23',
                'title' => 'product_access',
            ],
            [
                'id'    => '24',
                'title' => 'product_category_create',
            ],
            [
                'id'    => '25',
                'title' => 'product_category_edit',
            ],
            [
                'id'    => '26',
                'title' => 'product_category_show',
            ],
            [
                'id'    => '27',
                'title' => 'product_category_delete',
            ],
            [
                'id'    => '28',
                'title' => 'product_category_access',
            ],
            [
                'id'    => '29',
                'title' => 'product_stuff_create',
            ],
            [
                'id'    => '30',
                'title' => 'product_stuff_edit',
            ],
            [
                'id'    => '31',
                'title' => 'product_stuff_show',
            ],
            [
                'id'    => '32',
                'title' => 'product_stuff_delete',
            ],
            [
                'id'    => '33',
                'title' => 'product_stuff_access',
            ],
            [
                'id'    => '34',
                'title' => 'outlet_create',
            ],
            [
                'id'    => '35',
                'title' => 'outlet_edit',
            ],
            [
                'id'    => '36',
                'title' => 'outlet_show',
            ],
            [
                'id'    => '37',
                'title' => 'outlet_delete',
            ],
            [
                'id'    => '38',
                'title' => 'outlet_access',
            ],
            [
                'id'    => '39',
                'title' => 'training_access',
            ],
            [
                'id'    => '40',
                'title' => 'training_category_create',
            ],
            [
                'id'    => '41',
                'title' => 'training_category_edit',
            ],
            [
                'id'    => '42',
                'title' => 'training_category_show',
            ],
            [
                'id'    => '43',
                'title' => 'training_category_delete',
            ],
            [
                'id'    => '44',
                'title' => 'training_category_access',
            ],
            [
                'id'    => '45',
                'title' => 'training_class_create',
            ],
            [
                'id'    => '46',
                'title' => 'training_class_edit',
            ],
            [
                'id'    => '47',
                'title' => 'training_class_show',
            ],
            [
                'id'    => '48',
                'title' => 'training_class_delete',
            ],
            [
                'id'    => '49',
                'title' => 'training_class_access',
            ],
            [
                'id'    => '50',
                'title' => 'training_candidate_create',
            ],
            [
                'id'    => '51',
                'title' => 'training_candidate_edit',
            ],
            [
                'id'    => '52',
                'title' => 'training_candidate_show',
            ],
            [
                'id'    => '53',
                'title' => 'training_candidate_delete',
            ],
            [
                'id'    => '54',
                'title' => 'training_candidate_access',
            ],
            [
                'id'    => '55',
                'title' => 'gallery_create',
            ],
            [
                'id'    => '56',
                'title' => 'gallery_edit',
            ],
            [
                'id'    => '57',
                'title' => 'gallery_show',
            ],
            [
                'id'    => '58',
                'title' => 'gallery_delete',
            ],
            [
                'id'    => '59',
                'title' => 'gallery_access',
            ],
            [
                'id'    => '60',
                'title' => 'transaksi_create',
            ],
            [
                'id'    => '61',
                'title' => 'transaksi_edit',
            ],
            [
                'id'    => '62',
                'title' => 'transaksi_show',
            ],
            [
                'id'    => '63',
                'title' => 'transaksi_delete',
            ],
            [
                'id'    => '64',
                'title' => 'transaksi_access',
            ],
            [
                'id'    => '65',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}