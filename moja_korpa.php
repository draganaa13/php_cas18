<?php

if(session_status()== PHP_SESSION_NONE)                                     // POKRENUTI SESIJU AKO NIJE POKRENUTA
{
    session_start();
}
                                                                            // IZBACITI PORUKU AKO NIJE ULOGOVAN
if(!isset($_SESSION['ulogovan']))
{
    die("Morate biti ulogovani da bi videli ovu stranicu");
}

// 1. IZVUCI SVE NARUDZBENICE IZ BAZE NA OSNOVU USER_ID
// 2. ISPISATI SVE NARUDZBENICE NA STRANI
require_once "baza.php";                                                    //POVEZIVANJE SA BAZOM

$userId = $_SESSION['user_id'];                                                     // spojiti tabele u bazi i izvuci odredjene podatke na usnovu user_id
$rezultat= $baza -> query("SELECT  narudzbine.kolicina, narudzbine.cena, proizvodi.ime                      
FROM narudzbine INNER JOIN proizvodi ON proizvodi.id = narudzbine.id_proizvoda 
WHERE narudzbine.id_korisnika = $userId");
                                                                                
$narudzbine = $rezultat->fetch_all(MYSQLI_ASSOC);                                   //vratiti rezultat ka assoc array

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script src="js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>

    
        <?php if($rezultat->num_rows == 0):  ?>                         
            <h1>Nemate nijedan proizvod u korpi!</h1>               /* PROVERA DA LI POSTOJI PROIZVOD U KORPI ZA TAJ USER_ID    */

        <?php else:  ?>
            <h5 class="mt-3 ms-3">Imate <?php echo ($rezultat->num_rows);?> proizvoda u korpi:</h5>
            <div class="row">
            <?php
            $redniBr=1;
            foreach($narudzbine as $narudzba): ?>             
                <div class="card  mb-3 text-dark col-11 col-sm-5 col-md-5 col-lg-2 ms-3 mt-3">
                <div class="card-body">
                <p>Proizvod u korpi broj: <?= $redniBr ?></p>
                <p>Proizvod: <?= $narudzba['ime'] ?> </p>              
                <p>Kolicina: <?= $narudzba['kolicina'] ?> </p>
                <p>Cena: <?= $narudzba['cena'] ?> </p>
                <a href="proizvod.php" class="btn btn-primary bg-success">Pogledaj proizvod</a>
                </div>
                </div>
            <?php
                $redniBr++;
                endforeach; ?>
            </div>
        <?php   endif; ?>
                <a href="aaa" class="btn btn-primary col-2">Kupi</a>
                <a href="proizvodi.php" class="btn btn-primary col-2">Vrati me u prodavnicu</a>
</body>
</html>




