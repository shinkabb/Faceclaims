<?php

/**
 * Manages objects in database
 *
 * @package Shinka\Faceclaims
 */
class Shinka_Faceclaims_Manager extends Shinka_Core_Manager_Manager
{
    static $query;

    private static function getFaceclaimFid() {
        global $mybb;

        return $mybb->settings['faceclaims_fid'];
    }

    private static function getDeceasedFid() {
        global $mybb;

        return $mybb->settings['faceclaims_deceased_fid'];
    }

    private static function getDeceasedValue() {
        global $mybb;

        return $mybb->settings['faceclaims_deceased_value'];
    }

    /** @return string Base query for faceclaims */
    private static function getQuery() {
        if (self::$query) {
            return self::$query;
        }

        // variables to replace in the query when eval'd
        $users_table = TABLE_PREFIX . "users";
        $userfields_table = TABLE_PREFIX . "userfields";
        $faceclaim_fid = self::getFaceclaimFid();

        $filename = MYBB_ROOT . 'inc/plugins/Shinka/Faceclaims/resources/sql/get_users_by_faceclaim.sql';
        $query = file_get_contents($filename);
        eval("\$query = \"$query\";");
        return $query;
    }

    public static function get(array $options = array())
    {
        global $db;

        $faceclaim_fid = self::getFaceclaimFid();
        $faceclaim_deceased_fid = self::getDeceasedFid();
        $faceclaim_deceased_value = self::getDeceasedValue();

        // exit if not set
        if (!$faceclaim_fid) {
            return;
        }

        $query = self::getQuery();

        $query = $db->write_query($query);
        while ($row = $db->fetch_array($query)) {
            $claim = self::toArray($row);
            $claim['faceclaim'] = $claim["fid{$faceclaim_fid}"];
            $claim['username'] = format_name(htmlspecialchars_uni($claim['username']), $claim['usergroup'], $claim['displaygroup']);
            $claim['profilelink'] = build_profile_link($claim['username'], $claim['uid']);

            if($faceclaim_deceased_fid && $claim["fid{$faceclaim_deceased_fid}"] == $faceclaim_deceased_value) {
                $graveyardclaims[] = $claim;
            }
            else {
                $faceclaims[] = $claim;
            }
        }

        return array(
            "faceclaims" => $faceclaims,
            "graveyardclaims" => $graveyardclaims
        );
    }
}
