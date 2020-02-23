<?php

class Shinka_Faceclaims_Presenter_FaceclaimsPagePresenter
{
    public static function present($allclaims = null)
    {
        global $lang, $templates, $headerinclude, $header, $errors, $multipage, $footer;

        if (!$lang->faceclaims) {
            $lang->load('faceclaims');
        }

        $faceclaims = Shinka_Faceclaims_Presenter_FaceclaimsPresenter::present($allclaims['faceclaims']);
        $graveyardclaims = Shinka_Faceclaims_Presenter_FaceclaimsPresenter::present($allclaims['graveyardclaims']);

        return eval($templates->render('faceclaims'));
    }
}
