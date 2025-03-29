

<?php

require_once "baza.php";

$rezultat = $baza -> query ("SELECT * FROM proizvodi");
$proizvodi = $rezultat -> fetch_all (MYSQLI_ASSOC);


if (session_status() == PHP_SESSION_NONE)
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
  
</head>



            <div class="col-12  bg-dark text-info d-flex justify-content-center align-items-center gap-3" style="height: 80px;">
                <a href="proizvodi.php">Glavna</a>

                <?php if(isset ($_SESSION['ulogovan'])): ?>
                    <a href="session_destroy.php">Logout</a>
                    <a href="moja_korpa.php">Korpa</a>
                <?php else: ?>
                    <a href="login1.php">Login</a>
                <?php endif; ?>
                 
                    
    
            </div>
                
                <div class="container d-flex col-10 flex-wrap">
                <?php foreach($proizvodi as $proizvod): ?>
                    <div class="card col-3 d-flex m-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= $proizvod['ime'] ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $proizvod['opis'] ?></h6>
                            <p class="card-text">Cena proizvoda: <?= $proizvod['cena']   ?> &euro;</p>
                            <p class="card-text">Na stanju: <?= $proizvod['kolicina'] ?></p>

                            <?php if($proizvod['kolicina'] == 0): ?>
                            <p class="text-danger">Nema na stanju</p>
                             <?php else: ?>
                            <p class="text-success">Ima na stanju</p>
                            <?php endif; ?>


                            <a class="card-link btn btn-primary" href="proizvod.php?id=<?= $proizvod['id'] ?>">Pogledaj proizvod</a>

                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
        



    
</body>
</html>




