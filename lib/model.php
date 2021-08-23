<?php
error_reporting(E_ALL);
include("connection.php");
class Items extends Connection
{
    function __construct()
    {
        parent::__construct();
    }
    function getCounters()
    {


        try {

            $getCounter = $this->_db->prepare("SELECT sum(cantidad) cantidad  FROM `tbl_movimientos` where tipo = ? ");

            if ($getCounter->bind_param("i", $estatus) && $getCategory = $this->_db->prepare("SELECT * FROM tbl_calidad ")) {

                //get entries
                $estatus = 1;
                $in = 0;
                $getCounter->execute();
                $result_counter = $getCounter->get_result();
                if ($result_counter->num_rows > 0) {

                    $result = $result_counter->fetch_assoc();
                    $in = $result["cantidad"] != NULL ? $result["cantidad"] : 0;
                }


                //get exits
                $estatus = 2;
                $out = 0;
                $getCounter->execute();
                $result_counter = $getCounter->get_result();

                if ($result_counter->num_rows > 0) {

                    $result = $result_counter->fetch_assoc();
                    $out = $result["cantidad"] != NULL ? $result["cantidad"] : 0;
                }
                $getCounter->close();


                //get category
                $getCategory->execute();
                $result_category = $getCategory->get_result();
                $category = $result_category->num_rows;
                $getCategory->close();

                $getTotal = $this->_db->prepare("SELECT sum(cantidad) as total FROM `tbl_item` ");

                if ($getTotal->execute()) {

                    $result_total = $getTotal->get_result();

                    if ($result_total->num_rows > 0) {

                        $result = $result_total->fetch_assoc();
                        $total = $result["total"];
                    } else {

                        $total = 0;
                    }
                } else {

                    throw new Exception($this->_db->error . " " . $this->_db->connect_error, 1);
                }

                echo json_encode([$in, $out, $category, $total]);
            } else {

                throw new Exception($this->_db->error . " " . $this->_db->connect_error, 1);
            }
        } catch (Exception $e) {

            print($e);
            echo json_encode(false);
        }
    }

    function getCalidad()
    {

        $array = [];
        if (!isset($_POST['searchTerm'])) {

            $sqlGetDepto = "SELECT id_calidad as id, descripcion_calidad as text  FROM tbl_calidad ";
            $query = $this->_db->query($sqlGetDepto);

            if ($query->num_rows > 0) {

                while ($row = mysqli_fetch_assoc($query)) {

                    $array[] = $row;
                }
            }
            echo json_encode($array);
        } else {

            $search = $this->_db->real_escape_string($_POST['searchTerm']);
            $search = " descripcion_calidad LIKE '%$search%'";
            $sqlGetDepto = "SELECT id_calidad as id, descripcion_calidad as text  FROM tbl_calidad where $search ";

            $query = $this->_db->query($sqlGetDepto);

            if ($query->num_rows > 0) {

                while ($row = mysqli_fetch_assoc($query)) {

                    $array[] = $row;
                }
            }
            echo json_encode($array);
        }
    }

    function getModelo()
    {


        $array = [];
        if (!isset($_POST['searchTerm'])) {

            $sqlGetDepto = "SELECT id_modelo as id, descripcion_modelo as text  FROM tbl_modelo ";
            $query = $this->_db->query($sqlGetDepto);

            if ($query->num_rows > 0) {



                while ($row = mysqli_fetch_assoc($query)) {

                    $array[] = $row;
                }
            }
            echo json_encode($array);
        } else {

            $search = $this->_db->real_escape_string($_POST['searchTerm']);
            $search = " descripcion_modelo LIKE '%$search%' ";
            $sqlGetDepto = "SELECT id_modelo as id, descripcion_modelo as text  FROM tbl_modelo where $search ";

            $query = $this->_db->query($sqlGetDepto);

            if ($query->num_rows > 0) {

                while ($row = mysqli_fetch_assoc($query)) {

                    $array[] = $row;
                }
            }

            echo json_encode($array);
        }
    }

    function getMaterial()
    {


        $array = [];
        if (!isset($_POST['searchTerm'])) {

            $sqlGetDepto = "SELECT id_material as id, descripcion_material as text  FROM tbl_material ";
            $query = $this->_db->query($sqlGetDepto);

            if ($query->num_rows > 0) {



                while ($row = mysqli_fetch_assoc($query)) {

                    $array[] = $row;
                }
            }
            echo json_encode($array);
        } else {

            $search = $this->_db->real_escape_string($_POST['searchTerm']);
            $search = " descripcion_material LIKE '%$search%' ";
            $sqlGetDepto = "SELECT  id_material as id, descripcion_material as text  FROM tbl_material where $search ";

            $query = $this->_db->query($sqlGetDepto);

            if ($query->num_rows > 0) {

                while ($row = mysqli_fetch_assoc($query)) {

                    $array[] = $row;
                }
            }

            echo json_encode($array);
        }
    }

    function getTableExits()
    {

        $requestData = $_REQUEST;

        $id_calidad =  $requestData["id_calidad"];
        $sqlTotalData = "   SELECT 
                                    color
                                FROM
                                    tbl_item
                                      
                                where id_calidad = $id_calidad ";

        $resultado = $this->_db->query($sqlTotalData);

        $totalData = "";

        if ($resultado->num_rows > 0) {

            $totalData = $resultado->num_rows;
        }

        $totalRowFiltered = "     SELECT 
                                        color
                                    FROM
                                        tbl_item
                                        
                                    where id_calidad = $id_calidad ";

        // falta consultar el avatar del responsable
        $data = "     SELECT 

                            id_item,color,capacidad,descripcion_material,descripcion_modelo,cantidad
                        
                        FROM tbl_item ti

                        INNER JOIN tbl_material tma

                            ON ti.id_material = tma.id_material
                        
                        INNER JOIN tbl_modelo tmo

                            ON ti.id_modelo = tmo.id_modelo

                            
                        where id_calidad = $id_calidad ";

        if (!empty($requestData['search']['value'])) {
            //    $totalRowFiltered.="and ( ta.nombre LIKE '%".$requestData['search']['value']."%'  OR fecha LIKE '%".$requestData['search']['value']."%' OR tasu.nombre_sucursal LIKE '%".$requestData['search']['value']."%' OR tl.nombre LIKE '%".$requestData['search']['value']."%' OR tauu.nombre LIKE '%".$requestData['search']['value']."%')  ";        			
            $data .= "and ( descripcion_material LIKE '%" . $requestData['search']['value'] . "%'  OR descripcion_modelo LIKE '%" . $requestData['search']['value'] . "%' ) ";
        }

        $data .= " ORDER BY cantidad desc LIMIT " . $requestData["start"] . "," . $requestData["length"];

        $totalFiltered = "";

        $resultado = $this->_db->query($totalRowFiltered);

        $totalRowFiltered = mysqli_num_rows($resultado);

        if ($totalRowFiltered > 0) {

            $totalFiltered = $totalRowFiltered;
        }

        $array_json = [];

        $result = $this->_db->query($data);

        if ($result->num_rows > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                $array_json[] = $row;
            }
        }


        // //si la consulta inicial no trae valores se retorns $array_-json vacio
        // $array_json=array();
        // $array_json[0] = array("id"=> 1,"nombre"=> "Lorem ipsum","tipo"=> "Sugerencia","fecha"=>"01.Junio.2021","estatus"=> "1","estatus_div"=> "<span class='label' style='color:white;background-color:#722063;'>Nuevo</span>","accion"=> "<i data-toggle='modal' data-target='#modalShowBuzonAdmn' class='zoom fa fa-comments'></i>");
        // $array_json[1] = array("id"=> 2,"nombre"=> "Lorem ipsum","tipo"=> "Agradecimiento","fecha"=>"01.Junio.2021","estatus"=> "1","estatus_div"=>"<span class='label' style='color:white;background-color:#f2cb07;'>Pendiente</span>","accion"=> "<i data-toggle='modal' data-target='#modalShowBuzonHistorial' class='zoom fa fa-eye'></i>");
        // $array_json[2] = array("id"=> 3,"nombre"=> "Lorem ipsum","tipo"=> "Queja","fecha"=>"01.Junio.2021","estatus"=> "1","estatus_div"=> "<span class='label' style='color:white;background-color:#722063;'>Nuevo</span>","accion"=> "<i data-toggle='modal' data-target='#modalShowBuzonAdmn' class='zoom fa fa-comments'></i>");
        // $array_json[3] = array("id"=> 4,"nombre"=> "Lorem ipsum","tipo"=> "Sugerencia","fecha"=>"01.Junio.2021","estatus"=> "1","estatus_div"=> "<span class='label' style='color:white;background-color:#722063;'>Nuevo</span>","accion"=> "<i data-toggle='modal' data-target='#modalShowBuzonAdmn' class='zoom fa fa-comments'></i>");
        $json_data = array(
            "draw"            => intval($requestData['draw']),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $array_json
        );
        echo json_encode($json_data);
    }

    function getCategories(){


        try {
          
            $getCounter = $this->_db->prepare("SELECT sum(cantidad) cantidad  FROM tbl_item where id_calidad = ? ");
            
            if ($getCounter->bind_param("i", $id_calidad)) {
    
                //get baja
                $id_calidad = 1;
                $baja = 0;
                $getCounter->execute();
                $result_counter = $getCounter->get_result();
                if ($result_counter->num_rows > 0) {
    
                    $result = $result_counter->fetch_assoc();
                    $baja = $result["cantidad"] != NULL ? $result["cantidad"] : 0;
                }
    
    
                //get alta
                $id_calidad = 2;
                $alta = 0;
                $getCounter->execute();
                $result_counter = $getCounter->get_result();
    
                if ($result_counter->num_rows > 0) {
    
                    $result = $result_counter->fetch_assoc();
                    $alta = $result["cantidad"] != NULL ? $result["cantidad"] : 0;
                }
                $getCounter->close();

                echo json_encode([ $baja, $alta]);

                
            }else{
                
                throw new Exception($this->_db->error . " " . $this->_db->connect_error, 1);
  
            }

        } catch (Exception $e) {
          
            print($e);
            echo json_encode(false);

        }
        

    }

    function insertNewItem($arrayForm)
    {


        try {

            $cantidadNueva = $arrayForm[0]["value"];

            $idCalidad = $arrayForm[1]["value"];

            $idModelo = $arrayForm[2]["value"];

            $idMaterial = $arrayForm[3]["value"];

            $capacidad = $arrayForm[4]["value"];

            $color = $arrayForm[5]["value"];

            $idCalidad = $this->verifyCalidad($idCalidad);

            $idModelo =  $this->verifyModelo($idModelo);

            $idMaterial =  $this->verifyMaterial($idMaterial);


            $estatus = 1;
            $sql = "SELECT id_item,cantidad FROM tbl_item where color = '$color' and capacidad = $capacidad and estatus = $estatus and id_calidad = $idCalidad and id_material = $idMaterial and id_modelo = $idModelo ";
            $veryfyItem = $this->_db->query($sql);

            if ($veryfyItem->num_rows > 0) {

                $result = mysqli_fetch_assoc($veryfyItem);

                $id_item = $result["id_item"];

                $cantidad = $result["cantidad"];

                $total = $cantidadNueva + $cantidad;

                $update = $this->_db->prepare("UPDATE tbl_item set cantidad = ? where id_item = ?");

                if ($update->bind_param('ii', $total, $id_item)) {

                    $update->execute();

                    $a = $this->registerMovement($id_item, $total, 1);

                    echo json_encode(true);
                } else {

                    throw new Exception($this->_db->error . " " . $this->_db->connect_error, 1);
                }
            } else {

                $insert = $this->_db->prepare("INSERT INTO tbl_item(color,capacidad,estatus,id_calidad,id_material,id_modelo,cantidad) VALUES(?,?,?,?,?,?,?)");

                if ($insert->bind_param('siiiiii', $color, $capacidad, $estatus, $idCalidad, $idMaterial, $idModelo, $cantidadNueva)) {

                    $insert->execute();

                    $id_item = $insert->insert_id;

                    $a = $this->registerMovement($id_item, $cantidadNueva, 1);

                    echo json_encode(true);
                } else {

                    throw new Exception($this->_db->error . " " . $this->_db->connect_error, 1);
                }
            }
        } catch (Exception $e) {

            print($e);
            // echo json_encode(false);            
        }
    }

    function setExits($inputArray, $calidad)
    {

        try {

            $total = 0;
            $update = $this->_db->prepare("UPDATE tbl_item SET cantidad = cantidad - ? where id_item = ?");
            $update->bind_param('ii', $nuevaCantidad, $id_item);

            foreach ($inputArray as $key => $value) {

                if ($value["value"] != "" && $value["value"] > 0) {

                    $nuevaCantidad = $value["value"];

                    $id_item = $value["name"];

                    $update->execute();

                    $res = $this->registerMovement($id_item, $nuevaCantidad, 2);

                    $total = $total + $nuevaCantidad;
                }
            }
           
            $totalItems = intdiv($total, 10);

            if ($total > 0) {

                if($totalItems > 0){

                    $id_calidad = 1;
                    $select = $this->_db->prepare("SELECT  id_item,cantidad  FROM  tbl_item where cantidad > ? and id_calidad = ? order by cantidad desc LIMIT 1");
                    $select->bind_param("ii", $totalItems, $id_calidad);
    
                    if ($calidad == "Alta") {
    
                        $totalItems = $totalItems * 3;
                    } elseif ($calidad == "Baja") {
    
                        $totalItems = $totalItems * 2;
                    }
    
                    $select->execute();
    
                    $result_counter = $select->get_result();
                    
                   
                    if ($result_counter->num_rows > 0) {
    
                        $result = $result_counter->fetch_assoc();
    
                        $nuevaCantidad = $totalItems;
    
                        $id_item = $result["id_item"];
    
                        $update->execute();
    
                        $res = $this->registerMovement($id_item, $nuevaCantidad, 2);
    
                       
                    }
                }

                echo json_encode(true);
                
            }else {
                
                echo json_encode(false);

                
            }
        } catch (Exception $e) {

            echo $e;
        }
    }

    function registerMovement($id_item, $cantidad, $tipo)
    {


        try {

            $insertMovement = $this->_db->prepare("INSERT INTO tbl_movimientos (id_item,cantidad,tipo)VALUES(?,?,?)");

            if ($insertMovement->bind_param("iii", $id_item, $cantidad, $tipo)) {

                $insertMovement->execute();

                $insertMovement->close();
                return true;
            } else {

                throw new Exception($this->_db->error . " " . $this->_db->connect_error, 1);
            }
        } catch (Exception $e) {

            print($e);
            echo json_encode(false);
        }
    }

    function verifyCalidad($idCalidad)
    {

        try {

            $veryfy = $this->_db->prepare("SELECT * from tbl_calidad where id_calidad = ?");

            if ($veryfy->bind_param("i", $idCalidad)) {

                $veryfy->execute();

                $result = $veryfy->get_result();

                if ($results = $result->num_rows > 0) {

                    $veryfy->close();

                    return $idCalidad;
                } else {

                    $insertNew = $this->_db->prepare("INSERT INTO tbl_calidad ( descripcion_calidad ) VALUES( ? )");

                    if ($insertNew->bind_param("s", $idCalidad)) {

                        $insertNew->execute();

                        $idCalidad = $insertNew->insert_id;

                        $insertNew->close();

                        return  $idCalidad;
                    } else {

                        throw new Exception($this->_db->error . " " . $this->_db->connect_error, 1);
                    }
                }
            } else {

                throw new Exception($this->_db->error . " " . $this->_db->connect_error, 1);
            }
        } catch (Exception $e) {

            print($e);
            echo json_encode(false);
        }
    }

    function verifyModelo($idModelo)
    {


        try {

            $veryfy = $this->_db->prepare("SELECT * from tbl_modelo where id_modelo = ?");

            if ($veryfy->bind_param("i", $idModelo)) {

                $veryfy->execute();

                $result = $veryfy->get_result();

                if ($results = $result->num_rows > 0) {

                    $veryfy->close();

                    return $idModelo;
                } else {

                    $insertNew = $this->_db->prepare("INSERT INTO tbl_modelo ( descripcion_modelo ) VALUES( ? )");

                    if ($insertNew->bind_param("s", $idModelo)) {

                        $insertNew->execute();

                        $idModelo = $insertNew->insert_id;

                        $insertNew->close();

                        return  $idModelo;
                    } else {

                        throw new Exception($this->_db->error . " " . $this->_db->connect_error, 1);
                    }
                }
            } else {

                throw new Exception($this->_db->error . " " . $this->_db->connect_error, 1);
            }
        } catch (Exception $e) {

            print($e);
            echo json_encode(false);
        }
    }

    function verifyMaterial($idMaterial)
    {


        try {

            $veryfy = $this->_db->prepare("SELECT * from tbl_material where id_material = ?");

            if ($veryfy->bind_param("i", $idMaterial)) {

                $veryfy->execute();

                $result = $veryfy->get_result();

                if ($results = $result->num_rows > 0) {

                    return $idMaterial;
                } else {

                    $insertNew = $this->_db->prepare("INSERT INTO tbl_material ( descripcion_material ) VALUES( ? )");

                    if ($insertNew->bind_param("s", $idMaterial)) {

                        $insertNew->execute();

                        $idMaterial = $insertNew->insert_id;

                        return  $idMaterial;
                    } else {

                        throw new Exception($this->_db->error . " " . $this->_db->connect_error, 1);
                    }
                }
            } else {

                throw new Exception($this->_db->error . " " . $this->_db->connect_error, 1);
            }
        } catch (Exception $e) {

            print($e);
            echo json_encode(false);
        }
    }
}
