<?php
require_once 'db/database.php';
require_once 'api/Category.php';
require_once 'api/User.php';

$url = explode("/", $_SERVER['QUERY_STRING']);
header('Access-Control-Allow-Origin:application/json');
header('Content-Type:application/json');

//print_r($url);die;

if ($url[1] == 'v1') {
    //category
    if ($url[2] == 'category') {
        $category = new Category();
        //methods
        switch ($url[3]) {
            case 'all':
                $data = $category->all();
                $res = [
                    'status' => 200,
                    'data' => $data,
                ];
                echo json_encode($res);
                break;
            case 'add':
                header('Access-Control-Allow-Methods: POST');
                $data = file_get_contents("php://input");
                $data_de = json_decode($data, true);
                $res = $category->add($data_de);

                if ($res) {
                    http_response_code(201);
                    $res = [
                        'status' => 201,
                        'massage' => 'Category inserted successfully'
                    ];
                } else {
                    http_response_code(400);

                    $res = [
                        'status' => 400,
                        'massage' => 'ERROR'
                    ];
                }
                echo json_encode($res);

                break;
            case 'update':
                header('Access-Control-Allow-Methods: PUT');
                $data = file_get_contents("php://input");
                $data_de = json_decode($data, true);
                $id = ["id" => $data_de['id']];
                $data = $data_de['category'];
                $res = $category->update($data, $id);
                if ($res) {
                    http_response_code(201);

                    $res = [
                        'status' => 201,
                        'massage' => 'Category updated successfully'
                    ];
                } else {
                    http_response_code(400);

                    $res = [
                        'status' => 400,
                        'massage' => 'ERROR'
                    ];
                }
                echo json_encode($res);
                break;
            case 'delete':
                header('Access-Control-Allow-Methods: DELETE');
                $data = file_get_contents("php://input");
                $data_de = json_decode($data, true);
//                print_r($data_de);die;
                $res = $category->delete($data_de);
                if ($res) {
                    $res = [
                        'status' => 201,
                        'massage' => 'user deleted successfully'
                    ];
                } else {
                    $res = [
                        'status' => 400,
                        'massage' => 'ERROR'
                    ];
                }

                break;
            default:
                $res = [
                    'status' => 404,
                    'massage' => 'NOT FOUND'
                ];
                echo json_encode($res);


        }
    }
    //user
    if ($url[2] == 'user') {
        $user = new User();
        //methods
        switch ($url[3]) {
            case 'all':
                $data = $user->all();
//                echo json_encode($data);
                $res = [
                    'status' => 200,
                    'data' => $data,
                ];
                echo json_encode($res);
                break;
            case 'add':
                header('Access-Control-Allow-Methods: POST');
                $data = file_get_contents("php://input");
                $data_de = json_decode($data, true);
                $res = $user->add($data_de);
                if ($res) {
                    http_response_code(201);

                    $res = [
                        'status' => 201,
                        'massage' => 'user inserted successfully'
                    ];
                } else {
                    http_response_code(400);

                    $res = [
                        'status' => 400,
                        'massage' => 'ERROR'
                    ];
                }
                echo json_encode($res);
                break;
            case 'update':
                header('Access-Control-Allow-Methods: PUT');
                $data = file_get_contents("php://input");
                $data_de = json_decode($data, true);
                $id = ["id" => $data_de['id']];
                $data = $data_de['user'];
                $res = $user->update($data, $id);
                if ($res) {
                    http_response_code(201);

                    $res = [
                        'status' => 201,
                        'massage' => 'user updated successfully'
                    ];
                } else {
                    http_response_code(400);
                    $res = [
                        'status' => 400,
                        'massage' => 'ERROR'
                    ];
                }
                echo json_encode($res);
                break;
            case 'delete':
                header('Access-Control-Allow-Methods: DELETE');
                $data = file_get_contents("php://input");
                $data_de = json_decode($data, true);
                $res = $user->delete($data_de);

                if ($res) {
                    http_response_code(201);
                    $res = [
                        'status' => 201,
                        'massage' => 'user deleted successfully'
                    ];
                } else {
                    http_response_code(400);
                    $res = [
                        'status' => 400,
                        'massage' => 'ERROR'
                    ];
                }
                break;
            default:
                http_response_code(404);

                $res = [
                    'status' => 404,
                    'massage' => 'NOT FOUND'
                ];
                echo json_encode($res);

        }
    }

}