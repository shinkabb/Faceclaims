<?php

require_once MYBB_ROOT . "inc/functions.php";

class Shinka_Faceclaims_Service_FaceclaimsService
{
    public static function handle()
    {
        self::setup();

        $allclaims = Shinka_Faceclaims_Manager::get();
        return Shinka_Faceclaims_Presenter_FaceclaimsPagePresenter::present($allclaims);
    }

    protected static function setup()
    {
        global $lang, $templatelist;

        $templatelist .= "faceclaims, faceclaims_user";

        if (!$lang->faceclaims) {
            $lang->load('faceclaims');
        }

        add_breadcrumb($lang->faceclaims, "faceclaims.php");
    }
}