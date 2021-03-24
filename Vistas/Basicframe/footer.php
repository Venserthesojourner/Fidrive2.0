</div>
</div>
</div>
<?php

if (!strpos($_SERVER['REQUEST_URI'], "archivoscargados.php") === False) { ?>
    <div class="col col-md-3">
        <div class="card" id="cardyb">
            <div class="card-header bg-info">
                <b class="fas fa-h1">Recientes</b>
            </div>
            <div class="card-body bg-light">


                <div class="row">
                    <hr>
                    Link: <a href="unlugar.php"> <?php echo $link = md5("unlinkcualquiera"); ?></a><br>
                    <br>
                    <hr>
                    Nombre: <?php echo $Nombre = "LuigiPhoto.jpg"; ?><br>
                    Usuario: <?php echo $Usuario = "Luigi"; ?><br>
                    Hace <?php echo $horas = 5; ?> Horas<br>
                    <hr>

                </div>

            </div>
        </div>
    </div>
<?php } ?>
</div>

<div class="card bg-dark">

    <div class="container p-3 ">
        <div class="card-footer text-muted">
            <i class="fas fa-solar-panel    " style="color:wheat">FAEA-111_FiDrive</i>

            <p class="float-right mt-auto py-3">
                Cañete Luis Miguel - PWD 2020
            </p>
            <p>Trabajo practico implementando PHP-html y framework como Bootstrap y jQuery</p>
            <p>Bootstrap: <a href="https://getbootstrap.com/">Visite su sitio.</a></p>
        </div>
    </div>
</div>
</body>

</html>