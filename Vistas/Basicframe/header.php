<?php
include_once 'sessionframe.php';
?>

<!doctype html>
<html lang="es">

<head>
    <title><?php echo $title; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://www.myersdaily.org/joseph/javascript/md5.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


    <script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>

    <!-- propios -->
    <script type="text/javascript" src="../../Vistas/Scripts/scripts.js"></script>
    <link rel="stylesheet" href="../../Vistas/Styles/styles.css">
    <link rel="stylesheet" href="../../Vistas/Styles/bootstrap.min.css">
    <!-- propios -->

    <!-- Criptografia -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>



    <!-- <script type="text/javascript" src="./include/jquery.validate.js"></script> -->


</head>

<body>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs bg-dark colorCab" id="navId" style="border:0px; display:flex;">
        <div>
            <li style="margin:0px;">
                <a href="../Indices/archivoscargados.php" class="nav-link active" style="margin:0px; padding: 0px">
                    <h1 style="font-weight:bold">FAEA-111_FiDrive</h1>
                </a>
            </li>
        </div>
        <div style="float:right">
            <?php if (session::sessionActiva()) { ?>
                <li>
                    <form action='../Indices/login.php' method='post'>
                        <button> Cerrar Sesion</button>
                    </form>
                </li>

                <li>
                    <button disabled> Bienvenido <?php echo "{$_SESSION["uslogin"]}" ?></button>

                </li> <?php } ?>
        </div>
    </ul>

    <div class="row" style="height: 800px; padding: 30px; overflow: scroll">
        <div class="col col-md-9">
            <div class="card" id="cardyb">
                <div class="card-header bg-info">
                    <b class="fas fa-h1"><?php echo $cardtitle ?></b>
                </div>
                <div class="card-body bg-light">