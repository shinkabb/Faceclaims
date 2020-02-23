<?php

class Shinka_Faceclaims_Service_UninstallService
{
    public static $setting_group = "faceclaims";
    public static $prefix = "faceclaims";


    public static function handle()
    {
        require_once MYBB_ROOT . "inc/adminfunctions_templates.php";

        $gid = Shinka_Core_Manager_SettingGroupManager::destroy(self::$setting_group);
        Shinka_Core_Manager_SettingManager::destroy(self::$prefix);
        Shinka_Core_Manager_TemplateGroupManager::destroy(self::$prefix);

        rebuild_settings();
    }
}
