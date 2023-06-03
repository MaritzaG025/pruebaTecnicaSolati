$(function() {
  var filasUsers = "";
  $.ajax({
    url: "../Controllers/controller.php",
    method: "GET"
  })
    .done(function(response) {
      JSON.parse(response).forEach(element => {
        filasUsers =
          filasUsers +
          ` <tr ALIGN=CENTER><td>${element.name}</td><td>${element.lastName}</td><td>${element.email}</td><td><button type="button" class="btn btn-danger" onclick="ConfirmDeletUser(${element.id})"><span class="bi-trash"></span></button></td></tr>`;
        document.getElementById("filasUsers").innerHTML = filasUsers;
      });
    })
    .fail(function(error) {
      filasUsers = "";
      document.getElementById("filasUsers").innerHTML = filasUsers;
      console.log(error);
    });
});

function CreateUser() {
  let infoUsuario = document.getElementsByClassName("form-control"),
    arrayGuardar = [];
  let count = 0;

  for (var i = 0; i < infoUsuario.length; i++) {
    arrayGuardar[i] = {
      id: infoUsuario[i].id,
      value: infoUsuario[i].value
    };
    if (infoUsuario[i].value === "") {
      count++;
    }
  }

  if (count > 0) {
    $("#modalErrores").modal("show");
    document.getElementById("bodyModal").innerHTML =
      "<h3>Datos Faltantes</h3><h3>Por favor complete los datos</h3>";
  } else {
    $.ajax({
      url: "../Controllers/controller.php",
      method: "POST",
      dataType: "JSON",
      data: {
        type: "CreateUser",
        name: arrayGuardar[0].value,
        lastname: arrayGuardar[1].value,
        email: arrayGuardar[2].value,
        password: arrayGuardar[3].value
      }
    })
      .done(function(response) {
        location.reload();
      })
      .fail(function(error) {
        location.reload();
      });
  }
}

function ConfirmDeletUser(idUser) {
  console.log(idUser);
  $("#modalErrores").modal("show");
  document.getElementById("bodyModal").innerHTML =
    "Seguro de eliminar este usuario?";
  // document.getElementById("buttonEliminar").classList.remove("d-none");
  document.getElementById(
    "buttonEliminar"
  ).innerHTML = `<button type="button" class="btn btn-danger" onclick="DeleteUser(${idUser})">eliminar</button>`;
}

function DeleteUser(idUser) {
  $("#modalErrores").modal("hide");
  $.ajax({
    url: "../Controllers/controller.php",
    method: "POST",
    dataType: "JSON",
    data: {
      type: "DeleteUser",
      userId: idUser
    }
  })
    .done(function(response) {
      location.reload();
    })
    .fail(function(error) {
      location.reload();
    });
}
