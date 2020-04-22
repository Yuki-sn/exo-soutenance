<?php 
    require 'Parts/connexion.php';
    session_start();
    
    //connexion a la bdd
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=la_saint_redstone;charset=utf8', 'root', '');

        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(Exception $e){

        die('Il y a un problème avec la bdd : ' . $e->getMessage());
    }

    $response = $bdd->query("SELECT article.id , article.title , article.content , article.create_date , users.firstname, users.lastname FROM article INNER JOIN users ON author = users.id ORDER BY create_date");

    $article = $response->fetchAll(PDO::FETCH_ASSOC);
    $response->closeCursor();

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
            <h1 class="text-center col-12 mt-5">Accueil</h1>
            <h2 class="text-center col-12">Bvn sur la sainte redstone !</h2>
            
        </div>
        <div class="row">
            <h2 class="col-12 text-center">Les deux derniers articles du site </h2>
            <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header bg-primary text-white">
                            <?php echo htmlspecialchars($article[0]['title']) ?>                            
                        </div>
                        <div class="card-body">
                        <?php echo htmlspecialchars($article[0]['content']) ?> 
                        <a href="article_info.php?id=<?php echo htmlspecialchars($article[0]['id']) ?>">Lire la suite</a>              
                        </div>
                        <div class="card-footer text-muted">
                        Le 
                        <strong>
                            <?php echo htmlspecialchars($article[0]['create_date']) ?>
                        </strong>
                            par 
                         <strong>
                            <?php echo htmlspecialchars($article[0]['firstname']).' ' .htmlspecialchars($article[0]['lastname']);  ?>
                        </strong>
                    </div>
                    <div class="card my-4">
                        <div class="card-header bg-primary text-white">
                        <?php echo htmlspecialchars($article[1]['title']) ?>                            
                        </div>
                        <div class="card-body">
                        <?php echo htmlspecialchars($article[1]['content']) ?> 
                        <a href="article_info.php?id=<?php echo htmlspecialchars($article[1]['id']) ?>">Lire la suite</a>                           
                        </div>
                        <div class="card-footer text-muted">
                        Le 
                        <strong>
                            <?php echo htmlspecialchars($article[1]['create_date']) ?>
                        </strong>
                            par 
                         <strong>
                            <?php echo htmlspecialchars($article[1]['firstname']).' ' .htmlspecialchars($article[1]['lastname']);  ?>
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