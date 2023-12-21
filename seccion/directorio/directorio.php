<?php
session_start();
?>
<div class="container">
    <div class="row">
        <div class="col mt-4">
            <h2 style="text-align:center;">Directorio</h2>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <div class="row mb-2 flex-row d-flex justify-content-between">
                <?php
                if ($_SESSION["directorio"] === "editar") {
                ?>
                    <div class="col mt-4">
                        <a href="#insertarModal" class="btn btn-primary" data-bs-toggle="modal"><i class="bi bi-plus"></i>
                            Nuevo</a>
                    </div>
                <?php
                }
                ?>


                <div class="col mt-4 d-flex justify-content-end">
                    <form class="d-flex flex-row" role="search">
                        <i id="xSearchDir" class="bi bi-x-circle clear-search-dir icon-clear-dir" style="padding-right: 7px;" onclick="CerrarIconDirBuscar()"></i>
                        <input style="max-width:450px;" class="form-control me-2" type="search" placeholder="Buscar en directorio" id="buscarDirectorio" aria-label="Search">

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container">

            <div class="row">
                <div class="col">
                    <!-- Se realiza la conexión con la basde de datos Directorio -->
                    <?php include_once('../../bd/directorio/conector_BD_directorio.php'); ?>


                    <div id="tabla_directorio">

                        <?php include_once('../../bd/directorio/conector_BD_directorio.php');

                        //Obtener el número total de registros y calcular el número total de páginas,cálculos para la paginación de la tabla directorio
                        $result = $conn->query("SELECT COUNT(*) as total FROM directorio");
                        $row = $result->fetch_assoc();
                        $total_registros = $row['total'];
                        $registros_por_pagina = 4;
                        $total_paginas = ceil($total_registros / $registros_por_pagina);

                        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
                        $offset = ($pagina - 1) * $registros_por_pagina;

                        $query = "SELECT * FROM directorio LIMIT $offset, $registros_por_pagina";
                        $result = $conn->query($query);
                        ?>

                        <div class="table-responsive table-fixed">
                            <table class="table table-striped table-hover" id="table-directorio">
                                <!-- Las cabeceras de la tabla directorio-->
                                <thead style="position: sticky;top:0;">
                                    <tr>
                                        <th style="display:none;" scope="col">id</th>
                                        <th style="background-color:#0f6ba5;color: #fff;text-align:center;" scope="col">
                                            Puesto</th>
                                        <th style="background-color:#0f6ba5;color: #fff;text-align:center;" scope="col">
                                            Nombre</th>
                                        <th style="background-color:#0f6ba5;color: #fff;text-align:center;" scope="col">
                                            Apellidos</th>
                                        <th style="background-color:#0f6ba5;color: #fff;text-align:center;" scope="col">
                                            Oficina</th>
                                        <th style="background-color:#0f6ba5;color: #fff;text-align:center;" scope="col">
                                            Teléfono</th>
                                        <th style="background-color:#0f6ba5;color: #fff;text-align:center;" scope="col">
                                            Extensión</th>
                                        <th style="background-color:#0f6ba5;color: #fff;text-align:center;" scope="col">
                                            Correo</th>

                                        <?php
                                        if ($_SESSION["directorio"] === "editar") {
                                        ?>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;color:orange;" scope="col">Edit</th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;color:red;" scope="col">Del</th>
                                        <?php
                                        }
                                        ?>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                        <tr class="celda_tabla_directorio">

                                            <td style='display:none;'><?php echo $row['id'] ?></td>
                                            <td style='text-align:center;'><?php echo $row['puesto'] ?>
                                            </td>
                                            <td style='text-align:center;'><?php echo $row['nombre'] ?>
                                            </td>
                                            <td style='text-align:center;'>
                                                <?php echo $row['apellidos'] ?></td>
                                            <td style='text-align:center;'><?php echo $row['oficina'] ?>
                                            </td>
                                            <td style='text-align:center;'><?php echo $row['telefono'] ?>
                                            </td>
                                            <td style='text-align:center;'>
                                                <?php echo $row['extension'] ?></td>
                                            <td style='text-align:center;'><?php echo $row['correo'] ?>
                                            </td>
                                            <?php

                                            if ($_SESSION["directorio"] === "editar") {
                                            ?>
                                                <td style='text-align:center;'> <button id='btn-edit-directorio' class='edit-table' data-bs-toggle='modal' data-bs-target='#modal-edit-directorio<?php echo $row['id']; ?>'>
                                                        <i class='bi bi-pencil-square'></i></button>
                                                <td style='text-align:center;'> <button id='btn-del-directorio' class='del-table' data-bs-toggle='modal' data-bs-target='#modal-del-directorio<?php echo $row['id']; ?>'><i class='bi bi-trash'></i></button>
                                                    <!-- El modal de editar-->
                                                    <?php include("./modal/modal_editar.php"); ?>

                                                    <!-- El modal de Eliminar-->
                                                    <?php include("./modal/modal_eliminar.php");
                                                    ?>

                                                <?php
                                            }
                                                ?>

                                        </tr>

                                    <?php endwhile; ?>

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <!-- El modal de editar-->
                <?php
                include("../directorio/modal/modal_editar.php");
                ?>

                <!-- El modal de Eliminar-->
                <?php
                include("../directorio/modal/modal_eliminar.php");
                ?>

                <!-- El modal para insertar un nuevo contacto en el Directorio-->
                <?php include("../directorio/modal/modal_insertar.php"); ?>

            </div>


        </div>


    </div>


    <!--<td style='text-align:center;'>   <button class='edit-table' data-bs-toggle='modal' data-bs-target='#modal-edit-directorio'> <i class='bi bi-pencil-square'></i></button>
                            <td style='text-align:center;'>   <button class='del-table' data-bs-toggle='modal' data-bs-target='#modal-del-directorio'><i class='bi bi-trash'></i></button>-->




</div>
</div>