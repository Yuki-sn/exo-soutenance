<?php 
    require 'Parts/connexion.php';
    session_start();

    if(!preg_match('/^[0-9]{1,999}$/', $_GET['id'])){  
        $errors[] = ' chiffre uniquement ';
    };

    if(!isset($errors)){

        //connexion a la bdd
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=la_saint_redstone;charset=utf8', 'root', '');

            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(Exception $e){

            die('Il y a un problème avec la bdd : ' . $e->getMessage());
        }


        $response = $bdd->prepare(" SELECT * FROM article INNER JOIN users ON article.author = users.id WHERE article.id = ?  ");
        $response->execute([
            $_GET['id'],
        ]);


        $article = $response->fetchAll(PDO::FETCH_ASSOC);

        $response->closeCursor();
    };

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

        if(isset($errors)){ 
            foreach($errors as $error){
                echo '<p style="color:red;">' . $error . '</p>';
            }
        }


    ?>
    <div class="container">
        <div class="row">
            <h1 class="text-center col-12 mt-5"><?php echo htmlspecialchars($article[0]['title']) ?></h1>
            <p class="text-center col-12"><a href="articles.php">Retour à la liste des articles</a></p>
        </div>
        <div class="row">
            <div class="col-12">

                <div class="card my-4">
                    <div class="card-body"> 
                        <?php echo htmlspecialchars($article[0]['content']);   ?>                
                    </div>
                    <div class="card-footer text-muted">
                        Le <strong>
                            <?php echo htmlspecialchars($article[0]['create_date']); ?>
                        </strong> par <strong>
                            <?php echo htmlspecialchars($article[0]['firstname']).' ' .htmlspecialchars($article[0]['lastname']);  ?>
                    </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>