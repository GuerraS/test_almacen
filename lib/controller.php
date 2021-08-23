<?php
session_start();
require ('model.php');
$objItem = new Items;



if( !empty($_POST) ){

    $data = $_POST;
    // print_r( $data["index"]);

}


switch ( $data["index"] ) {

    case "getCounters":

        $objItem->getCounters();
        // $result = $objUser->getCounters();
        break;
    case "getCategories":

        $objItem->getCategories();
        break;

    case 'getCalidad':

        $objItem->getCalidad();

        break;
    case 'getModelo':

        $objItem->getModelo();

        break;
    case 'getMaterial':

        $objItem->getMaterial();

        break;
    case 'insertNewItem';
        
        $objItem->insertNewItem($data["formArray"]);
        
        break;
    case 'getTableExits':
        
        $objItem->getTableExits();

        break;
    case 'setExits':
    
        $objItem->setExits($data["inputArray"],$data["id_calidad"]);

        break;

}
// $response = $objUser->verifyUser($username);
// echo json_encode($response);


