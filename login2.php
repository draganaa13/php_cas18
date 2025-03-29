<?php
if (!isset ($_POST['email']) || empty($_POST['email']) )
{
    die ("Niste uneli email korisnika");
}
if (!isset ($_POST['sifra']) || empty($_POST['sifra']) )
{
    die ("Niste uneli sifru korisnika");
}

require_once "baza.php";

$email = $_POST['email'];
$sifra = $_POST['sifra'];



$rezultat = $baza->query("SELECT * FROM korisnici WHERE email='$email'");

if ($rezultat -> num_rows == 1)
{
    $korisnik = $rezultat -> fetch_assoc();
    $verifikovanaSifra = password_verify($sifra, $korisnik['lozinka']);
    if ($verifikovanaSifra == true)
    {
        if (session_status() == PHP_SESSION_NONE)
            {
                session_start();
            }
        $_SESSION['ulogovan'] = true;
        $_SESSION['user_id'] = $korisnik ['id'];
        echo header("Location: proizvodi.php");
    }
    else {
        echo "Sifra nije tacna";
    }
}
else {
    echo "Korisnik ne postoji.";
}

