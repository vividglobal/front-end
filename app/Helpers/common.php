<?php
use App\Models\Mongo\Article;
use App\Models\Mongo\Admin;
use App\Http\Services\UserRoleService;

define('STATUS_VIOLATION', Article::STATUS_VIOLATION);
define('STATUS_NONE_VIOLATION', Article::STATUS_NONE_VIOLATION);
define('AGREE', Article::AGREE_VIOLATION);
define('DISAGREE', Article::DISAGREE_VIOLATION);
define('ACTION_CHECK_STATUS', Article::ACTION_CHECK_STATUS);
define('ACTION_CHECK_CODE', Article::ACTION_CHECK_CODE);

define('ROLE_ADMIN', Admin::ROLE_ADMIN);
define('ROLE_SUPERVISOR', Admin::ROLE_SUPERVISOR);
define('ROLE_OPERATOR', Admin::ROLE_OPERATOR);

if (! function_exists('dump_data')) {
    function dump_data() {
        $args = func_get_args();
        echo '<pre>';
        foreach($args as $ag) {
            print_r($ag);
        }
        echo '<pre>';
        die();
    }
}

if (! function_exists('convertArrayToString')) {
    function convertArrayToString($dataArr, $keyValue) {
        $valueArr = [];
        foreach ($dataArr as $key => $obj) {
            $valueArr[] = $obj[$keyValue];
        }
        return implode(', ', $valueArr);
    }
}

if (! function_exists('isValidTimeStamp')) {
    function isValidTimeStamp($string) {
        return ( 1 === preg_match( '~^[1-9][0-9]*$~', $string ) );
    }
}

if (! function_exists('getExportUrl')) {
    function getExportUrl() {
        $queryString = $_SERVER['QUERY_STRING'];
        $currentUrl = url()->current();
        return $currentUrl.'?1=1&'.$queryString.'&export=true';
    }
}

if (! function_exists('isPendingStatus')) {
    function isPendingStatus($status) {
        return ($status === Article::STATUS_PENDING);
    }
}

if (! function_exists('isViolationStatus')) {
    function isViolationStatus($status) {
        return ($status === Article::STATUS_VIOLATION);
    }
}

if (! function_exists('isNoneViolationStatus')) {
    function isNoneViolationStatus($status) {
        return ($status === Article::STATUS_NONE_VIOLATION);
    }
}

if (! function_exists('getStatusText')) {
    function getStatusText($status) {
        switch($status) {
            case Article::STATUS_PENDING:
                return 'Reviewing';
            case Article::STATUS_VIOLATION:
                return 'Violation';
            case Article::STATUS_NONE_VIOLATION:
                return 'Non-violation';
            default:
                return $status;
        }
    }
}

if (! function_exists('isRole')) {
    function isRole($role) {
        return UserRoleService::isRole($role);
    }
}

if (! function_exists('getRole')) {
    function getRole() {
        return UserRoleService::getRole();
    }
}