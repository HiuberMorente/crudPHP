const urlConsulta = "../Controller/EmployeeConsultas.php";


const showResultOnTable = (data) => {
  let formTable = document.querySelector("#tablaEmpleado");
  formTable.innerHTML = "";

  for(let item of data) {
    var salario = item.salary.toLocaleString("es-GT", {
      style:"currency",
      currency: "GTQ",
      minimumFractionDigits: 2,
      maximunFractionDigits: 2
    })

    formTable.innerHTML += `
      <tr>
        <td class="text-center">${item.id}</td>                
        <td class="text-center">${item.name}</td>                
        <td class="text-center">${item.address}</td>                
        <td class="text-center">${salario}</td>
        <td>
          <div class="text-center">
            <button type="" class="btn btn-primary text-white" onclick="editEmployee(${item.id})">
              <i class="fa fa-pen"></i>
            </button>
            <button type="" class="btn btn-danger text-white" onclick="deleteEmployee(${item.id})">
              <i class="fa fa-pen"></i>
            </button>
          </div>
        </td>                
      </tr>
    `;
  }
}

const createEmployee = () => {
  Swal.fire({
    title: "Agregar empleado",
    html: `
      <form id="createForm">
        <input type="text" name="tipoOperacion" value="create" hidden="true">
        <hr>
        <input type="text" id="employeeName" name="employeeName" class="form-control" placeholder="Ingrese Nombre" required>
        <hr>
        <input type="text" id="employeeAddress" name="employeeAddress" class="form-control" placeholder="Ingrese Dirección" required>
        <hr>
        <input type="number" id="employeeSalary" name="employeeSalary" class="form-control" placeholder="Ingrese Salario" required>
      </form>
    `,
    showCancelButton: true,
    confirmButtonColor: "#3083d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Agregar",
    preConfirm: () => {
      const form = document.querySelector("#createForm");
      if(!form.checkValidity()){
        Swal.showValidationMessage(
          "Por favor ingrese todos los campos obligatorios"
        );
      }
    }
  }).then(result => {
    if(result.value) {
      const datosEmpleados = document.querySelector("#createForm");
      const createData = new FormData(datosEmpleados);

      fetch(urlConsulta, {
        method: "post",
        body: createData
      })
      .then(data => data.json())
      .then(data => {
        showResultOnTable(data);
        Swal.fire(
          "Éxito",
          "Se agregó correctamente",
          "success"
        )
      })
      .catch(error => console.log("Error create: ", error))
    }
  });
}

const editEmployee = (id) => {
  let formData = new FormData();
  formData.append("tipoOperacion", "edit");
  formData.append("id", id);

  fetch(urlConsulta, {
    method: "post",
    body: formData
  })
  .then(data => data.json())
  .then(data => {
    for(let item of data) {
      var id = item.id;
      var nombre  = item.name;
      var direccion = item.address;
      var salario = item.salary;
    }
    Swal.fire({
      title: "Actualizar información",
      html: `
        <form id="updateForm">
          <input type="text" value="update" name="tipoOperacion" hidden="true" />
          <input type="number" value="${id}" hidden="true" name="idEmp" class="form-control" placeholder="ID empleado" />
          <hr>
          <input type="text" value="${nombre}" name="nombreEmp" class="form-control" placeholder="Nombre" required/>
          <hr>
          <input type="text" value="${direccion}" name="direccionEmp" class="form-control" placeholder="Dirección" required/>
          <hr>
          <input type="number" value="${salario}" name="salarioEmp" class="form-control" placeholder="Salario" required/>
        </form>
      `,
      showCancelButton: true,
      confirmButtonColor: "#3083d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Guardar",
      preConfirm: () => {
        const createForm = document.querySelector("#updateForm");
        if(!createForm.checkValidity()) {
          Swal.showValidationMessage("Por favor complete todos los campos obligatorios");
        }
      }
    })
    .then(result => {
      if(result.value) {
        const datos = document.querySelector("#updateForm");
        const updateData = new FormData(datos);

        fetch(urlConsulta, {
          method: "post",
          body: updateData
        })
        .then(data => data.json())
        .then(data => {
          showResultOnTable(data);
          Swal.fire(
            "Éxito",
            "Se actualizo correctamente",
            "success"
          )
        })
        .catch(error => console.log("Error update: ", error))
      }
    })
    .then(error => console.log("Error edit: ", error))
  })
}

const deleteEmployee = (id) => {
  Swal.fire({
    title: "Estas seguro de eliminar el registro",
    text: "Ya no podra recuperar",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar"
  })
  .then(result => {
    if(result.value) {
      let formData = new FormData();
      formData.append("tipoOperacion", "delete");
      formData.append("id", id);

      fetch(urlConsulta, {
        method: "post",
        body: formData
      })
      .then(data => data.json())
      .then(data => {
        showResultOnTable(data);
        Swal.fire(
          "Eliminado",
          "Se elimino correctamente",
          "success"
        )
      })
      .catch(error => console.log("Error delete: ", error))
    }

  })
}
