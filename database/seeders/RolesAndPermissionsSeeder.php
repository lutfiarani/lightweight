<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Membuat Izin

        $inputMasterData = Permission::create(['name' => 'input_master_data']);
        $deleteMasterData = Permission::create(['name' => 'delete_master_data']);
        $updateMasterData = Permission::create(['name' => 'update_master_data']);
        $viewMasterData = Permission::create(['name' => 'view_master_data']);

        $inputDataTimbangan = Permission::create(['name' => 'input_data_timbangan']);
        $deleteDataTimbangan = Permission::create(['name' => 'delete_data_timbangan']);
        $viewDataTimbangan = Permission::create(['name' => 'view_data_timbangan']);

        $dashboardData = Permission::create(['name' => 'dashboard_data']);

        // Membuat Peran
        $adminRole = Role::create(['name' => 'dev']);
        $productionRole = Role::create(['name' => 'prod']);
        $viewerRole = Role::create(['name' => 'viewer']);

        // Memberikan izin kepada peran
        $role_user_requestor = Role::findByName('dev');
        $role_user_requestor->givePermissionTo($inputMasterData, $deleteMasterData, $updateMasterData, $viewMasterData);

        $productionRole = Role::findByName('prod');
        $productionRole->givePermissionTo($inputDataTimbangan, $deleteDataTimbangan, $viewDataTimbangan);

        $viewerRole = Role::findByName('viewer');
        $viewerRole->givePermissionTo($dashboardData);
    }
}
