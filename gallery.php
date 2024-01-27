<?php include("navBar.php") ?>
<?php include("conection.php") ?>

<?php 

//* INSERT
if($_POST){

    // print_r($_POST); //* Para verificar lo que se envía

    $nombre=$_POST['nombre'];
    $descripcion=$_POST['descripcion'];

    //* para la IMG es diferente <- solo NOMBRE
    $imagen=$_FILES['img']['name']; // en este caso recepciona el nombre (string) del archivo guardado

    //todo: ADJUNTAR IMAGEN <- guardar a carpeta img
    //* hacer que el nombre varie para que si img con igual nombre se seleccionan se puedan guardar sin generar errores
    $fecha= new DateTime();
    $imgNombreUsar = $fecha->getTimestamp()."_".$imagen;

    //* ADJUNTAR IMAGEN 
    $imagen_temporal=$_FILES['img']['tmp_name'];
    //                   data a guardar   dirección y nombre
    move_uploaded_file($imagen_temporal, "imgs/".$imgNombreUsar);

    $objConection = new conection();

    //todo: primer modo de probar CONECTAR y el manejo de INSERTAR datos a nuestra DB
    // $sql="INSERT INTO `proyectos` (`nombre`, `imagen`, `descripcion`) VALUES ('MiApp', 'app.jpg', 'Es una SPA');"; // INSERT ---
    // $objConection->ejecutar($sql);

    //todo: Cargando data real del FORM
    $sql="INSERT INTO `proyectos` (`nombre`, `imagen`, `descripcion`) VALUES ('$nombre', '$imgNombreUsar', '$descripcion');"; // INSERT ---
    $objConection->ejecutar($sql);

    // $id=$objConection->ejecutar($sql); //* así lo usamos para manejar la recepción de la información

    //* Anexo para evitar el autorefresh
    header("location:gallery.php");

    /*
    Esta línea de código generalmente se utiliza después de realizar ciertas acciones, 
    como procesar un formulario o llevar a cabo una operación en el servidor, para redirigir 
    al usuario a una página diferente después de completar la acción. 
    En el contexto del código nuestro, se utiliza para evitar un "autorefresh" después 
    de realizar ciertas operaciones en la página gallery.php
    */
};

//* para ELIMINAR REGISTRO <- obtenemos por params ?borrar=1 el id y aplicamos la sentencia correspondiente para eliminar esa fila de la tabla proyectos
if($_GET){
    // "DELETE FROM proyectos WHERE `proyectos`.`id` = 1"
    $id=$_GET['borrar'];
    // if($id){ //* validamos si es un número o lo que sea necesario
    // }
    $objConection = new conection();

    // //* BORRADO SIMPLE
    // $sql="DELETE FROM proyectos WHERE `proyectos`.`id` =".$id;
    // $objConection->ejecutar($sql);

    //* BORRADO con IMG
    $imagen= $objConection -> consultarProyectos("SELECT imagen FROM `proyectos` WHERE id=".$id);
    // print_r($imagen); // print para saber lo que llega de la consulta
    // print_r($imagen[0]['imagen']); // ver el dato justo que necesitamos (el nombre del archivo de la imagen)

    //* aplicamos UNLINK para el borrado
    unlink("imgs/".$imagen[0]['imagen']); // ruta (url) del archivo a borrar

    //* y borramos los datos de la db
    $sql="DELETE FROM proyectos WHERE `proyectos`.`id` =".$id;
    $objConection->ejecutar($sql);

    //* Anexo para evitar el autorefresh
    header("location:gallery.php");
};

//* CONSULTAR
$objConectionConsulta = new conection();
$proyectos= $objConectionConsulta -> consultarProyectos("SELECT * FROM `proyectos`");

// print_r($proyectos)




?>
  <br />
    <div class="container">
        <div class="row">
            <div class="col-md-5">
              <div class="card">
              <div class="card-header">Formulario para agragar proyectos</div>
              <div class="card-body">
              <h4 class="card-title">Datos del proyecto</h4>
              <p class="card-text"></p>
            <form action="gallery.php" method="post" encType="multipart/form-data">
            Nombre del proyecto: 
            <!-- aplicar REQUIRE como validación simple desde los INPUT -->
            <input class="form-control" type="text" name="nombre" id="nombre" required></input>
            <br />
            Imagen del proyecto:
            <input class="form-control" type="file" name="img" id="img" required></input>
            <br />
            <div class="mb-3">
                <label for="" class="form-label">Breve descripción:</label>
                <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
            </div>
            <br />
            <input class="btn btn-success" type="submit" value="Enviar proyecto"></input>
            </form>
        </div>
    </div>
            </div>
            <div
                class="col-md-7"
            >
                <div
    class="table-responsive"
  >
    <table
        class="table table-primary"
    >
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Imagen</th>
                <th scope="col">Descripción</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($proyectos as $proyecto){ ?>
            <tr class="">
                <td scope="row"><?php echo $proyecto['id']; ?></td>
                <td><?php echo $proyecto['nombre']; ?></td>
                <!-- <td><?php echo $proyecto['imagen']; ?></td> -->
                <!-- para MOSTRAR IMG implementamos -->
                <td><img
                src="imgs/<?php echo $proyecto['imagen']; ?>"
                class="img-fluid rounded-top"
                alt="<?php echo $proyecto['imagen']; ?>"
                srcset=""
                width="100"
                /></td>
                <td><?php echo $proyecto['descripcion']; ?></td>
                <!-- al HREF le pasamos un param ? con un id y le indicamos así que borrar por la url (por params) -->
                <td><a
                    name=""
                    id=""
                    class="btn btn-primary"
                    href="?borrar=<?php echo $proyecto['id']; ?>"
                    role="button"
                    >Eliminar</a
                >
                </td>
            </tr>
            <?php } ?>
            <!-- <tr class="">
                <td scope="row">Item</td>
                <td>Item</td>
                <td>Item</td>
            </tr> -->
        </tbody>
    </table>
  </div>
            </div>
            
        </div>
    </div>
    

    
  <br />

  
  
    
<?php include("footer.php") ?>