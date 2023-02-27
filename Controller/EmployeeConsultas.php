<?php

require_once "../config/Connection.php";
require_once "../Model/EmployeeModel.php";


$tipoConsulta = $_POST["tipoOperacion"];


switch($tipoConsulta) {

  case "create":

    $data = array(
      'nombre' => $_POST["employeeName"],
      'direccion' => $_POST["employeeAddress"],
      'salario' => $_POST["employeeSalary"],

    );

    $consulta = new EmployeeModel();
    $request = $consulta -> createEmpoyee($data);
    echo json_encode($request);
    break;

  case "edit":
    $id = $_POST["id"];

    $consulta = new EmployeeModel();
    $request = $consulta -> getEmployee($id);
    echo json_encode($request);
    break;

  case "update":
    $data = array(
      'id' => $_POST["idEmp"],
      'nombre' => $_POST["nombreEmp"],
      'direccion' => $_POST["direccionEmp"],
      'salario' => $_POST["salarioEmp"],

    );
    $consulta = new EmployeeModel();
    $request = $consulta -> updateEmployee($data);
    echo json_encode($request);
    break;

  case "delete":
    $id = $_POST["id"];
    $consulta = new EmployeeModel();
    $request = $consulta -> deleteEmployee($id);
    echo json_encode($request);
    break;

  default:
    break;

}