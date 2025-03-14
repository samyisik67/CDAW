<?php
require_once("UserModel.php");

class UsersController {

    private $requestMethod;

    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getAllUsers();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }

        return $response;

        // header($response['status_code_header']);
        // if ($response['body']) {
        //     echo $response['body'];
        // }
    }

    private function getAllUsers()
    {
        //l'API nous renvoie les utilisateurs au format JSON
        $st = UserModel::getAllUsers();
        return json_encode($st);
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
