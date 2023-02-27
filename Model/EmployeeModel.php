<?php

class EmployeeModel extends Connection {
  public function showEmployee() {
    $consulta = Connection::connect() -> prepare("SELECT * FROM employees");
    $consulta -> execute();
    return $consulta -> fetchAll(PDO::FETCH_ASSOC);
  }

  public function createEmpoyee($data) {
    $consulta = Connection::connect() -> prepare("INSERT INTO employees(name, address, salary) VALUES (:nombre, :direccion, :salario)");

    $consulta -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
    $consulta -> bindParam(":direccion", $data["direccion"], PDO::PARAM_STR);
    $consulta -> bindParam(":salario", $data["salario"], PDO::PARAM_STR);

    if($consulta -> execute()) {
      $response = self::showEmployee();
      return $response;
    } else {
      return "Error create employee";
    }
  }
  public function getEmployee($id) {
    $consulta = Connection::connect() -> prepare("SELECT * FROM employees WHERE id=:id");
    $consulta -> bindParam(":id", $id, PDO::PARAM_INT);
    if($consulta -> execute()) {
      return $consulta -> fetchAll(PDO::FETCH_ASSOC);
    } else {
      return "Error get employee";
    }
  }
  public function updateEmployee($data) {

    $consulta = Connection::connect() -> prepare("UPDATE employees SET name=:nombre, address=:direccion, salary=:salario WHERE id=:id");

    $consulta -> bindParam(":id", $data["id"], PDO::PARAM_INT);
    $consulta -> bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
    $consulta -> bindParam(":direccion", $data["direccion"], PDO::PARAM_STR);
    $consulta -> bindParam(":salario", $data["salario"], PDO::PARAM_STR);
 
    if($consulta -> execute()) {
      $response = self::showEmployee();
      return $response;
    } else {
      return "Error update employee";
    }

  }
  public function deleteEmployee($id) {

    $consulta = Connection::connect() -> prepare("DELETE FROM employees WHERE id=:id");
    $consulta -> bindParam(":id", $id, PDO::PARAM_INT);
    if($consulta -> execute()) {
      $response = self::showEmployee();
      return $response;
    } else {
      return "Error delete employee";
    }
  }

}