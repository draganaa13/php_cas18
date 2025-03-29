<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script src="js/bootstrap.min.js"></script>
    <title>login</title>
</head>
<body>

<form action="login2.php" method="POST" class="d-flex justify-content-center">

    <div class=" mt-3  flex-column col-3 ">
            <div class="form-group mb-2">
                    <label for="email">Email adresa:</label>
                    <input required type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Unesite email">
                    
   
            </div>
            <div class="form-group mb-2">
                    <label for="sifra">Sifra:</label>
                    <input required name="sifra" type="password" class="form-control" id="sifra" placeholder="Unesite sifru">
            </div>
 
        <button type="submit" class="btn btn-primary  col-5 ">Uloguj me</button>
    </div>
   
</form>
    
    
    
</body>
</html>



