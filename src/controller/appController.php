<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json; charset=UTF-8");

include_once "../model/DbContext.php";
include_once "../model/product.php";

if(!isset($db))
{
    $db = new DBContext();
}

$response = $db->jsonProducts();

if($response)
{
    $code = 200;
    echo returnJSON($response,$code);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message"=>"No products found.")
    );
}

function returnJSON($response,$code)
{
    header_remove();
    http_response_code($code);
    header('Content-Type:application/json');
    header('Status: '.$code);
    return json_encode(array('status'=>$code,'message'=>$response));
}
