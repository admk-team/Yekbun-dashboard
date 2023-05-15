<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = json_decode(file_get_contents(base_path('resources/data/permissions.json')));
        foreach ($permissions as $permission) {
            $identifier = strtolower(str_replace(' ', '_', $permission->name));
            $exists = Permission::where('identifier', $identifier)->first();
            if ($exists) continue;
            Permission::create([
                "name" => $permission->name,
                "identifier" => $identifier
            ]);
        }
    }
}
