<?php include("navBar.php") ?>
<!-- //* incluir la CONECTION CLASS para poder usar y con ello MOSTRAR datos -->
<?php include("conection.php") ?>

<?php
//* CODE de CONSULTA
$objConectionConsulta = new conection();
$proyectos= $objConectionConsulta -> consultarProyectos("SELECT * FROM `proyectos`");


?>
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Bienvenidos</h1>
            <p class="col-md-8 fs-4">
                A mi portfolio en PHP!!
            </p>
            <!-- <button class="btn btn-primary btn-lg" type="button">
                Example button
            </button> -->
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($proyectos as $proyecto){ ?>
        <div class="col">
            <div class="card">
                <img  src="imgs/<?php echo $proyecto['imagen']; ?>" class="card-img-top"  alt="<?php echo $proyecto['imagen']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $proyecto['nombre']; ?></h5>
                    <p class="card-text"><?php echo $proyecto['descripcion']; ?></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <br/>

<?php include("footer.php") ?>