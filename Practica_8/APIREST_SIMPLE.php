<?php
//recursos
$allowedResourceTypes = [
    'books',
    'authors',
    'genres',
];

$resourceType = $_GET['resource_type'];

//Verificar si pertenece la url que nos entregaron en los recursos.
if( !in_array($resourceType,$allowedResourceTypes)){
    die;
}

//Definir los recursos
$books = [
    1 =>[
        'titulo' => 'Lo qu el viento se llevo',
        'id_autor' =>2,
        'id_genero' =>2,
    ],
    2 =>[
        'titulo' => '100 años de soledad',
        'id_autor' =>2,
        'id_genero' =>1,
    ],
    3 =>[
        'titulo' => 'La Odiadera',
        'id_autor' =>1,
        'id_genero' =>2,
    ],
];

header('Content-Type: application/json');

// Levantamos el id del recurso buscado
$resourceId = array_key_exists('resource_id',$_GET)? $_GET['resource_id']: '';


switch(strtoupper($_SERVER['REQUEST_METHOD'])){
    case 'GET':
        if( empty($resourceId)){
            echo json_encode( $books);
        }else {
            if( array_key_exists($resourceId,$books)){
                echo json_encode($books[$resourceId]);
            }
        }
        break;
    case 'POST':
        $json = file_get_contents('php://input');
        $books[] = json_decode($json, true);
        //echo array_keys($books)[count($books)-1];
        echo json_encode($books);
        break;
    case 'PUT':
        if(!empty($resourceId) && array_key_exists($resourceId,$books)){
            $json = file_get_contents('php://input');
            //transformamos el json recibido a un nuevo elemento
            $books[$resourceId] = json_decode($json, true);
            echo json_encode($books);
        }
        break;
    case 'DELETE':
        //Validamos que el recurso exista
        if(!empty($resourceId) && array_key_exists($resourceId,$books)){
            unset($books[$resourceId]);
        }

        echo json_encode($books);
        break;
}

?>