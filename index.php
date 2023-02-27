<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>test6</title>

  <!-- bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

  <!-- font-awesome -->
  <script src="https://kit.fontawesome.com/2496d96d1c.js" crossorigin="anonymous"></script>

  <!-- sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
  <header class="container">
    <nav class="text-center">
      <h3>Empleados</h3>
    </nav>
  </header>

  <main class="container" style="margin-top: 50px;">
    <div class="row">
      <div class="col-md-2">
        <button class="btn btn-success w-100" onclick="createEmployee()">Agregar</button>
      </div>
    </div>

    <div class="table-responsive" style="margin-top: 20px;">
      <table class="table table-bordered table-striped">
        <thead class="text-center">
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>Salario</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="tablaEmpleado">
          <?php
          require_once "config/Connection.php";
          require_once "Model/EmployeeModel.php";

          $consulta = new EmployeeModel();
          $dataEmployee = $consulta -> showEmployee();

          foreach($dataEmployee as $employee) {

            $id = $employee["id"];
            
            echo '
              <tr>
                <td class="text-center">'. $id .'</td>                
                <td class="text-center">'. $employee["name"] .'</td>                
                <td class="text-center">'. $employee["address"] .'</td>                
                <td class="text-center">Q. '. number_format($employee["salary"], 2, ".", ",") .'</td>
                <td>
                  <div class="text-center">
                    <button type="" class="btn btn-primary text-white" onclick="editEmployee(' .$id.')">
                      <i class="fa fa-pen"></i>
                    </button>
                    <button type="" class="btn btn-danger text-white" onclick="deleteEmployee(' .$id.')">
                      <i class="fa fa-times"></i>
                    </button>
                  </div>
                </td>                
              </tr>
            ';

          }

          ?>
        </tbody>
      </table>
    </div>
  </main>

  <script src="./js/app.js"></script>
</body>
</html>