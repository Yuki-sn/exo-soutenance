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


    $response = $bdd->query("SELECT `title`,`create_date`, users.firstname, users.lastname FROM article INNER JOIN users ON author = users.id ORDER BY create_date
    ");

    $articles = $response->fetchAll(PDO::FETCH_ASSOC);
    // echo '<pre>';
    // print_r($articles);
    // echo '</pre>';

    $response->closeCursor();


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La sainte redstone - Articles</title>
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
            <h1 class="text-center col-12 mt-5">Liste des articles</h1>
        </div>
        <table class="table table-hover col-12 mt-4">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Date de parution</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-6">                                                                               
                        <a href="article.php?id=2"><?php echo htmlspecialchars($articles[0]['title']) ?></a>
                    </td>
                    <td class="col-2"><?php echo htmlspecialchars($articles[0]['firstname']).' '.htmlspecialchars($articles[0]['lastname']) ?></td>

                    <td class="col-3"><?php echo htmlspecialchars($articles[0]['create_date']); ?></td>
                    </tr>
                    <tr>
                    <td class="col-6">
                        <a href="article.php?id=1"><?php echo htmlspecialchars($articles[1]['title']) ?></a>
                    </td>
                    <td class="col-2"><?php echo htmlspecialchars($articles[1]['firstname']).' '.htmlspecialchars($articles[1]['lastname']) ?></td>
                    </td>      
                    <td class="col-3"><?php echo htmlspecialchars($articles[1]['create_date']); ?></td>
                </tr>
            </tbody>
        </table>
    </div>



    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>