<?php
require_once("val_session_admin.php");
?>
<?php
// Incluir archivo de base de datos
require_once("db.php");
// Funcion para el botón enviar
if (isset($_POST['modificarUser'])) {
    $cedula = $_POST['cedula'];
    $area = $_POST['area'];
    $primer_nombre = $_POST['primer_nombre'];
    $segundo_nombre = $_POST['segundo_nombre'];
    $primer_apellido = $_POST['primer_apellido'];
    $segundo_apellido = $_POST['segundo_apellido'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $addrol_select = $_POST['addrol_select'];


    mysqli_query($conexion, "
update usuarios set 
area='$area',
primer_nombre='$primer_nombre', 
segundo_nombre='$segundo_nombre', 
primer_apellido='$primer_apellido', 
segundo_apellido='$segundo_apellido', 
email='$email',
contrasena='$contrasena',
rol='$addrol_select'
where cedula='$cedula'") or
        die("Problemas en el select:" . mysqli_error($conexion));
}
?>


<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="..\img\SOPIEC.ico" type="image/x-icon">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Datos de usuario actualizado
    </title>

    <!-- Estilos CSS Toastr -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- BOOTSTRAP STYLES-->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../css/font-awesome.css" rel="stylesheet" />
    <!-- FONTAWESOME CDN -->
    <script src="https://kit.fontawesome.com/763b114892.js" crossorigin="anonymous"></script>
    <!-- CUSTOM STYLES-->
    <link href="../css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <!-- Contenedor principal -->
    <div id="wrapper">
        <?php include_once("../modelos/navbar_header_admin_vs.php"); ?>

        <!-- Contenido de la pagina, lado derecho ancho  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">

                        <div class="usuarios-buscar">
                            <h2>Datos de usuario actualizado</h2>
                            <!-- Barra de busqueda -->
                            <form class="form-inline my-2 my-lg-0 barra-buscar" action="buscarusuario.php" method="GET">
                                <input class="form-control mr-sm-2" type="search" placeholder="C.C" aria-label="Search"
                                    id="buscar_usuario" name="buscar_usuario">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="boton_buscar"
                                    id="boton_buscar">Buscar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr />

                <div id="contenedor-usuarios" class="contenedor-usuarios">
                    <div class="row contenedor-tabla">

                        <!-- Datos del usuario actualizado -->
                        <div class="datos-user-act">
                            <h2>Cedula: <span class="color-datos-act"><?php echo $cedula ?> </span></h2>
                            <h2>Primer nombre: <span class="color-datos-act"><?php echo $primer_nombre ?> </span></h2>
                            <h2>Area: <span class="color-datos-act"><?php echo $area ?> </span></p>
                                <h2>Segundo nombre: <span class="color-datos-act"><?php echo $segundo_nombre ?> </span>
                                </h2>
                                <h2>Primer apellido: <span class="color-datos-act"><?php echo $primer_apellido ?>
                                    </span></h2>
                                <h2>Segundo apellido: <span class="color-datos-act"><?php echo $segundo_apellido ?>
                                    </span></h2>
                                <h2>Correo: <span class="color-datos-act"><?php echo $email ?> </span></h2>
                                <h2>Rol: <span class="color-datos-act"><?php echo $addrol_select ?> </span></h2>
                        </div>

                        <div class="botones-edi-elim">
                            <label for="edit" class="fa">Editar: </label>
                            <a id="edit" class="btn btn-lg fa fa-pen"
                                href="../../modificar.php?cedula=<?php echo $cedula ?>"></a>
                            <label for="del" class="fa">Eliminar: </label>
                            <a id="del" class="btn btn-lg fa fa-trash-alt" href="#"
                                onclick="confirmacion_borrar(<?php echo $cedula ?>)"></a>
                        </div>
                        <!-- Boton Ver todos los usuarios. -->
                        <div class="col-md-4 col-sm-12">
                            <a href="../../usuarios.php"
                                class="btn btn-success btn-lg btn-block ajustar-boton btn-verusuarios ">VER TODOS LOS
                                USUARIOS</a>
                        </div>
                    </div>
                </div>
            </div>

            <input hidden id="mostrarCC" value="<?php echo $cedula ?>"></input>
            <input hidden id="mostrarNombre" value="<?php echo $primer_nombre ?>"></input>
            <!-- /. ROW  -->    <?php 
    include('../modelos/footer.php')
    ?>
        </div>
    
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../js/custom.js"></script>

    <!-- CDN Jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Script Toastr -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="../js/validaciones.js"></script>

    <!-- Alerta borrar -->
    <script type="text/javascript">
        // var nombre = document.getElementById("nombre");
        // console.log(nombre.value);

        function confirmacion_borrar(cedula) {

            if (confirm(`¿Realmente desea eliminar el usuario con C.C ${cedula}?`)) {


                toastr["warning"]("El usuario con C.C #" + cedula + " ha sido eliminado.", "Usuario eliminado")

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "5000",
                    "hideDuration": "5000",
                    "timeOut": "5000",
                    "extendedTimeOut": "5000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                setTimeout(() => {
                    window.location.href = "borrar.php?cedula=" + cedula
                }, 1000);
            }
        }
    </script>
    <!-- Alerta usuario actualizado -->
    <script>
        var cedula = document.getElementById('mostrarCC').value;
        var mostrarNombre = document.getElementById('mostrarNombre').value;

        document.readyState =
            toastr["success"]("El usuario " + mostrarNombre + " con C.C #" + cedula +
                " ha sido actualizado exitosamente.",
                "Usuario actualizado")

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "5000",
            "hideDuration": "5000",
            "timeOut": "5000",
            "extendedTimeOut": "5000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

</body>

</html>