<?php
session_start();
?>
<div class="container-fluid p-0">
    <div class="row">
        <div class="col mt-4 mb-4">
            <h2 class="titulo_seccion" style="text-align:center;">Sanciones de prestaciones</h2>
        </div>
    </div>
    <div class="row">
        <div style="padding-left:30px; padding-right:30px;" class="container-fluid">
            <div class="row mb-2 flex-row d-flex justify-content-between">
                <div class="col-6 d-flex">
                    <?php
                    if ($_SESSION["sanciones"] === "editar") {
                    ?>
                    <div class="col d-flex">
                        <a href="#insertarModal" class="btn btn-primary" data-bs-toggle="modal"><i
                                class="bi bi-plus"></i>
                            Nuevo</a>

                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div style="padding-left:30px; padding-right:30px;" class="container-fluid">

                <div class="row">
                    <div class="col">
                        <!-- Se realiza la conexión con la basde de datos Directorio -->
                        <?php include_once('../../bd/dp_melilla/conector_BD_dp_melilla.php'); ?>


                        <div id="tabla_directorio">

                            <?php include_once('../../bd/dp_melilla/conector_BD_dp_melilla.php');

                            //consulta a base de datos. Obtener las sanciones de las personas de dp_melilla
                            $result = $conn->query("SELECT p.APELLIDOSNOMBRE, p.NIFDNI,p.persona_id, s.*
                            FROM personas p
                            JOIN sanciones s ON p.persona_id = s.persona_id;");



                            ?>

                            <div class="table-responsive table-fixed">
                                <table class="table table-striped table-hover" id="table-directorio">
                                    <!-- Las cabeceras de la tabla directorio-->
                                    <thead style="position: sticky;top:0;">
                                        <tr>
                                            <th style="display:none;" scope="col">id</th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="estadoSancionesFilter">Estado</label><br>
                                                <select name="estadoSancionesFilter" id="estadoSancionesFilter"
                                                    class="form-select">
                                                    <option selected>Seleccionar...</option>
                                                    <option>RESUELTO</option>
                                                    <option>PENDIENTE</option>
                                                </select>

                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="fechaListadoSancionesFilter">F.Listado</label><br>
                                                <input type="date" name="fechaListadoSancionesFilter"
                                                    class="form-select" id="fechaListadoSancionesFilter">
                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="dniFilter">DNI/NIE</label><br>
                                                <input type="text" class="form-control" id="dniFilter">
                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="nombreFilter">Nombre</label><br>
                                                <input type="text" class="form-control" id="nombreFilter">
                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="infraccionesSancionesFilter">Infracciones</label><br>
                                                <select name="infracconesSancionesFilter"
                                                    id="infracconesSancionesFilter" class="form-select">
                                                    <option selected>Seleccionar...</option>
                                                    <option>1ª</option>
                                                    <option>2ª</option>
                                                    <option>3ª</option>
                                                </select>
                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="tipoSancionFilter">Tipo Sanción</label><br>
                                                <input type="text" class="form-control" id="tipoSancionFilter">
                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="fechaBajaFilter">F. Baja Sanción</label><br>
                                                <input type="text" class="form-control" id="fechaBajaFilter">
                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="fechaARBajaFilter">F. AR Baja</label><br>
                                                <input type="text" class="form-control" id="fechaARBajaFilter">
                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="fechaFinAlegacionesFilter">F. Fin Plazo Aleg.</label><br>
                                                <input type="text" class="form-control" id="fechaFinAlegacionesFilter">
                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="naComunicacionFilter">NA Comunicación</label><br>
                                                <input type="text" class="form-control" id="naComunicacionFilter">
                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="sePuedeResolverFilter">Se puede Resolver</label><br>
                                                <input type="text" class="form-control" id="sePuedeResolverFilter">
                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="estimadaFilter">Estimada</label><br>
                                                <input type="text" class="form-control" id="estimadaFilter">
                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="controlNominaFilter">Control Nómina</label><br>
                                                <input type="text" class="form-control" id="controlNominaFilter">
                                            </th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;"
                                                scope="col">
                                                <label for="motivoFilter">Motivo</label><br>
                                                <input type="text" class="form-control" id="motivoFilter">
                                            </th>


                                            <?php
                                            if ($_SESSION["sanciones"] === "editar") {
                                            ?>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;color:orange;"
                                                scope="col">Edit</th>
                                            <th style="background-color:#0f6ba5;color: #fff;text-align:center;color:red;"
                                                scope="col">Del</th>
                                            <?php
                                            }
                                            ?>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                        <tr class="celda_tabla_directorio">


                                            <td style='display:none;'><?php echo $row['sancion_id'] ?></td>
                                            <td style='display:none;'><?php echo $row['persona_id'] ?>
                                            </td>
                                            <td style='text-align:center;'><?php echo $row['ts_idEstado'] ?>
                                            </td>
                                            <td style='text-align:center;'>
                                                <?php echo date('d-m-y', strtotime($row['ts_fecha_real_baja'])); ?></td>
                                            <td style='text-align:center;'><?php echo $row['NIFDNI'] ?>
                                            </td>
                                            <td style='text-align:center;'><?php echo $row['APELLIDOSNOMBRE'] ?>
                                            </td>
                                            <td style='text-align:center;'>
                                                <?php echo $row['ts_varias_infracciones'] ?></td>
                                            <td style='text-align:center;'><?php echo $row['ts_tipo_sancion'] ?>
                                            </td>
                                            <td style='text-align:center;'><?php echo $row['ts_fecha_listado'] ?>
                                            </td>
                                            <td style='text-align:center;'><?php echo $row['ts_ar_baja'] ?>
                                            </td>
                                            <td style='text-align:center;'><?php echo $row['ts_fin_plazo_alegar'] ?>
                                            </td>
                                            <td style='text-align:center;'><?php echo $row['ts_na_comunicacion'] ?>
                                            </td>
                                            <td style='text-align:center;'><?php echo $row['ts_se_puede_resolver'] ?>
                                            </td>
                                            <td style='text-align:center;'><?php echo $row['ts_estimada'] ?>
                                            </td>
                                            <td style='text-align:center;'><?php echo $row['ts_control_nomina'] ?>
                                            </td>
                                            <td style='text-align:center;'><?php echo $row['ts_motivo'] ?>
                                            </td>
                                            <?php

                                                if ($_SESSION["directorio"] === "editar") {
                                                ?>
                                            <td style='text-align:center;'> <button id='btn-edit-directorio'
                                                    class='edit-table' data-bs-toggle='modal'
                                                    data-bs-target='#modal-edit-directorio<?php echo $row['id']; ?>'>
                                                    <i class='bi bi-pencil-square'></i></button>
                                            <td style='text-align:center;'> <button id='btn-del-directorio'
                                                    class='del-table' data-bs-toggle='modal'
                                                    data-bs-target='#modal-del-directorio<?php echo $row['id']; ?>'><i
                                                        class='bi bi-trash'></i></button>
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
    </div>