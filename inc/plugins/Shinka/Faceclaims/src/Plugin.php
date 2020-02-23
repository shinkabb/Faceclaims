<?php

/**
 * Responsible for common plugin functions
 *
 * Should not be invoked manually.
 *
 * @package  Shinka\Faceclaims
 */
function faceclaims_info()
{
    global $lang;

    if (!$lang->faceclaims) {
        $lang->load('faceclaims');
    }

    return array(
        'name' => $lang->faceclaims,
        'description' => $lang->faceclaims_description,
        'website' => 'https://github.com/ShinkaBB/Faceclaims',
        'author' => 'Shinka',
        'authorsite' => 'https://github.com/ShinkaBB',
        'codename' => 'faceclaims',
        'version' => '2.0.0',
        'compatibility' => '18*',
    );
}

/**
 * @return void
 */
function faceclaims_install()
{
    Shinka_Faceclaims_Service_InstallService::handle();
}

/**
 * @return boolean
 */
function faceclaims_is_installed()
{
    global $mybb;

    return isset($mybb->settings["faceclaims_fid"]);
}

/**
 * @return void
 */
function faceclaims_uninstall()
{
    Shinka_Faceclaims_Service_UninstallService::handle();
}

function faceclaims_activate()
{}

function faceclaims_deactivate()
{}

