<?php 
    require 'Parts/connexion.php'; // recup des donnée de connextion
    session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La sainte redstone - Acceuil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php 
        include 'Parts/nav.php';  
    ?>
    <div class="container">
        <div class="row">
            <h1 class="text-center col-12 mt-5">Mon Profil</h1>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3 my-4">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Email</strong> : <?php echo htmlspecialchars($_SESSION['user']['email']) ?></li>
                    <li class="list-group-item"><strong>Prénom</strong> : <?php echo htmlspecialchars($_SESSION['user']['firstname']) ?></li>
                    <li class="list-group-item"><strong>Nom</strong> : <?php echo htmlspecialchars($_SESSION['user']['lastname']) ?></li>
                    <li class="list-group-item"><strong>Status</strong> : <?php if($_SESSION['user']['admin'] == 0){echo 'compte utilisateur ';}elseif($_SESSION['user']['admin'] ==1 ){echo ' compte administrateur';};?></li>
                    <li class="list-group-item"><strong>Date d'inscription</strong> : <?php echo htmlspecialchars($_SESSION['user']['register_date']) ?></li>
                </ul>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>