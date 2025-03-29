<?php
if( !isset($_GET['id']) || empty($_GET['id']) )
{
    die("Fali ID proizvoda!");
}

require_once "baza.php";

$idProizvoda = $_GET['id'];

$rezultat = $baza->query(" SELECT * FROM proizvodi WHERE id = $idProizvoda ");
    
if($rezultat->num_rows == 0)
{
    die("Ovaj proizvod ne postoji");
}

$proizvod = $rezultat->fetch_assoc();

if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script src="js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>

    <div class="container d-flex align-items-center justify-content-center flex-column col-5 mt-5 ">

        <h1><?= $proizvod['ime'] ?></h1>
        <p><?= $proizvod['opis'] ?></p>
        <p>Cena proizvoda: <?= $proizvod['cena'] ?> &euro;</p>

        <?php if($proizvod['kolicina'] == 0): ?>
            <p class="text-danger">Nema na stanju</p>
        <?php else: ?>
            <p class="text-success">Ima na stanju</p>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['ulogovan'])): ?>
            <form method="POST" action="korpa.php">
                <input type="number" name="kolicina" placeholder="Unesite kolicinu proizvoda">
                <input type="hidden" name="id_proizvoda" value="<?= $proizvod['id'] ?>">
                <button class="btn btn-primary">Dodaj u korpu</button>
            </form>
        <?php else: ?>
            <a class="btn btn-primary" href="login1.php">Kliknite da se ulogujete da bi kupili</a>
            <?php endif; ?>
    </div>

</body>
</html>