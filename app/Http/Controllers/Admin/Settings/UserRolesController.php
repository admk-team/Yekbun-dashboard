<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{
    public function standard()
    {
        $modules = json_decode(file_get_contents(base_path('resources/data/modules.json')));

        // Get permission names from Settings
        $userLevel = 'standard';
        $settingNamesChunks = array_map(function ($module) use ($userLevel) {
            $settingName = $userLevel . "_" . $module->name;
            return array_map(function ($permission) use ($settingName) {
                $settingName = $settingName . "_" . $permission->name;
                return $settingName;
            }, $module->userPermissions);
        }, $modules);

        $settingNames = [];
        foreach ($settingNamesChunks as $chunk) {
            $settingNames = array_merge($settingNames, $chunk);
        }

        d
        

        return view("content.settings.user_roles.standard", );
    }
}
