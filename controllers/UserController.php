<?php

require_once(__DIR__."/../models/User.php");

class UserController{

private $userModel;


public function __construct($pdo)
{
$this->userModel=
new User($pdo);
}


public function index()
{
return
$this->userModel
->getCustomers();
}


public function destroy($id)
{
return
$this->userModel
->deleteCustomer($id);
}


public function show($id)
{
return
$this->userModel
->getById($id);
}

}