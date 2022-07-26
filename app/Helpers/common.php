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

define('NOT_STARTED' , Article::PROGRESS_NOT_STARTED);
define('PROCESSING' , Article::PROGRESS_PROCESSING);
define('COMPLETED' , Article::PROGRESS_COMPLETED);

define('ROLE_ADMIN', Admin::ROLE_ADMIN);
define('ROLE_SUPERVISOR', Admin::ROLE_SUPERVISOR);
define('ROLE_OPERATOR', Admin::ROLE_OPERATOR);

define('ASC', 'ASC');
define('DESC', 'DESC');

define('LABEL_TYPE_IMAGE', 'LABEL_TYPE_IMAGE');
define('LABEL_TYPE_URL', 'LABEL_TYPE_URL');

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

if (! function_exists('getUrlName')) {
    function getUrlName($key,$value) {
        return url()->current() . "?$key=$value";
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
                return 'Unable to detect';
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

if (! function_exists('checkSort')) {
    function checkSort($params, $field, $sort) {
        return isset($params['sort_by']) && $params['sort_by'] === $field && isset($params['sort_value']) && strtoupper($params['sort_value']) === $sort;
    }
}

if (! function_exists('getUniqueArray')) {
    function getUniqueArray($key, $array) {
        $unique_type_array = [];
        foreach($array as $element) {
            $hash = $element[$key];
            $unique_type_array[$hash] = $element;
        }
        return array_values($unique_type_array);
    }
}
