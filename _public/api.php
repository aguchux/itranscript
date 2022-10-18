<?php



$Route->add('/api/v1/accounts/list', function () {

    header("Content-type: application/json; charset=utf-8");
    header("Access-Control-Allow-Origin: *");

    $Template = new Apps\Template;

    $DB = new Apps\MysqliDb;
    $users = $DB->get('esut_accounts');
    $Template->debug(json_encode($users));

}, 'GET');


$Route->add('/api/v1/accounts/login/{email}/{password}', function ($email,$password) {

    header("Content-type: application/json; charset=utf-8");
    $Template = new Apps\Template;

    $DB = new Apps\MysqliDb;
    $DB->where("email",$email)->where("password",$password);
    $users = $DB->get('esut_accounts');
    
    $Template->debug(json_encode($users));

}, 'GET');

