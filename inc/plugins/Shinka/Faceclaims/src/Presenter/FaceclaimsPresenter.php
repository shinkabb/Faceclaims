<?php

class Shinka_Faceclaims_Presenter_FaceclaimsPresenter
{
    /**
     * @param Shinka_Faceclaims_Entity_Faceclaims $faceclaims
     * @return mixed
     */
    public static function present($faceclaims)
    {
        global $lang, $templates;

        if (!$lang->faceclaims) {
            $lang->load('faceclaims');
        }

        return self::presentItems($faceclaims);
    }

    public static function presentItems($faceclaims) {
        $presented = array_map(function ($faceclaim) {
            return self::presentItem($faceclaim);
        }, $faceclaims);

        return implode($presented);
    }

    public static function presentItem($faceclaim) {
            global $templates;

            return eval($templates->render("faceclaims_faceclaim"));
    }
}
