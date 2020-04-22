<nav class="navbar navbar-expand-md navbar-dark bg-info">

    <a class="navbar-brand" href="index.php">La sainte redstone</a>

    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#mainNavbarCollapsible" aria-controls="mainNavbarCollapsible"
    aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>

    </button>



    <div class="collapse navbar-collapse" id="mainNavbarCollapsible">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

            <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="articles.php">Articles</a>
            </li>
        <?php 
        
            if(isConnected()){
                if($_SESSION['user']['admin'] == 1){
                    echo '                    
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Deconnexion</a>
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php">profil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="true">Admin</a>
                        <div class="dropdown-menu"> 
                            <a class="dropdown-item" href="admin-add-article.php">Ajouter un article</a>
                        </div>
                    </li>';

                }elseif($_SESSION['user']['admin'] == 0 ){
                    echo '
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Deconnexion</a>
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php">profil</a>
                    </li>';
                }
            
            }else{
                echo '

                <li class="nav-item">
                    <a class="nav-link" href="login.php">Connexion</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="register.php">Inscription</a>
                </li>';
                
            };


            
        ?>
            
            

        </ul>

        <form class="form-inline my-2 my-lg-0" method="GET" action="search.php">

            <input class="form-control mr-sm-2" type="text" placeholder="Chercher un article" name="query">

            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>

        </form>

    </div>
</nav>

