<?php

//korpa.php -> post metoda
// id_proizvoda- koji proizvod je u pitanju
//kolicina- koliko komada zelimo
//$_SESSION['user_id']- ko je osoba koja narucuje
// cena- select price from proizvodi where id

if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}

//Dodavanje narudzbina u bazu
if(!isset($_POST['id_proizvoda']) || empty ($_POST['id_proizvoda']))
{
    die("Morate uneti ID proizvoda");
}
if(!isset($_POST['kolicina']) || empty ($_POST['kolicina']))
{
    die("Morate uneti kolicinu proizvoda");
}

//cena -> podataka iz baze za taj proizvod -> id_proizvoda
require_once "baza.php";

$idProizvoda = $_POST['id_proizvoda'];
$kolicina = $_POST['kolicina'];
$idKorisnika = $_SESSION['user_id'];

$rezultat=$baza->query("SELECT cena FROM proizvodi WHERE id = $idProizvoda");
$redIzBaze= $rezultat->fetch_assoc(); // ["cena"=> "1999.99"]
$cena=$redIzBaze['cena'];
$cena= $cena * $kolicina;

    $idProizvoda = $baza->real_escape_string($idProizvoda);
    $kolicina = $baza->real_escape_string($kolicina);
    $cena = $baza->real_escape_string($cena);
    $idKorisnika = $baza->real_escape_string($idKorisnika);

$baza->query("INSERT INTO narudzbine (id_proizvoda, id_korisnika, kolicina, cena) VALUES ($idProizvoda, $idKorisnika, $kolicina, $cena)");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script src="js/bootstrap.min.js"></script>
    <title>Korpa</title>
</head>
<body>
  
        <div class="alert alert-primary col-4 m-3" role="alert" >
            <?php if($baza): ?>
                <p>Proizvod je uspešno dodat u korpu!</p>
            <?php else: ?>
                <p>Došlo je do greške prilikom dodavanja proizvoda.</p>
            <?php endif; ?>
        <a class="btn btn-primary " href="proizvodi.php">Nastavi kupovinu!</a>
        <a class="btn btn-primary " href="moja_korpa.php">Idi u korpu!</a>


        </div>
        
    </body>
</html>

