<?php

class Shinka_Faceclaims_Service_InstallService
{
    public static function getSettingsGroup()
    {
        global $lang;

        if (!$lang->faceclaims) {
            $lang->load('faceclaims');
        }

        return array(
            "name" => 'faceclaims',
            "title" => $lang->faceclaims,
            "description" => $lang->faceclaims_description,
            "disporder" => 5,
            "isdefault" => 0,
        );
    }

    public static function getSettings()
    {
        global $lang;

        if (!$lang->faceclaims) {
            $lang->load('faceclaims');
        }

        return array(
            "faceclaims_fid" => array(
                "title" => $lang->faceclaims_claim_fid,
                "description" => $lang->faceclaims_claim_fid_description,
                "optionscode" => "text",
                "value" => "",
                "disporder" => 1,
            ),
            "faceclaims_deceased_fid" => array(
                "title" => $lang->faceclaims_deceased_fid,
                "description" => $lang->faceclaims_deceased_fid_description,
                "optionscode" => "text",
                "value" => "",
                "disporder" => 2,
            ),
            "faceclaims_deceased_value" => array(
                "title" => $lang->faceclaims_deceased_value,
                "description" => $lang->faceclaims_deceased_value_description,
                "optionscode" => "text",
                "value" => "Yes",
                "disporder" => 3,
            )
        );
    }

    public static $template_group = array(
        'prefix' => 'faceclaims',
        'title' => 'Faceclaims',
        'isdefault' => 1,
        'asset_dir' => MYBB_ROOT . "inc/plugins/Shinka/Faceclaims/resources/templates",
    );

    public static function handle()
    {
        require_once MYBB_ROOT . "inc/adminfunctions_templates.php";

        $setting_group = Shinka_Core_Entity_SettingGroup::fromArray(self::getSettingsGroup());

        $settings = self::getSettings();
        foreach ($settings as $key => &$setting) {
            $setting['name'] = $key;
            $setting = Shinka_Core_Entity_Setting::fromArray($setting);
        }

        $gid = Shinka_Core_Manager_SettingGroupManager::create($setting_group);
        Shinka_Core_Manager_SettingManager::create($settings, $gid);

        $template_groups = Shinka_Core_Entity_TemplateGroup::fromArray(self::$template_group);
        Shinka_Core_Manager_TemplateGroupManager::create($template_groups);

        rebuild_settings();
    }
}
