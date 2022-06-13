<?php

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
