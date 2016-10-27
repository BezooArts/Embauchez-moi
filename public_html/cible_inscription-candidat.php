<?php
try
{
	$bdd = new PDO('mysql: host=localhost;dbname=embauchez-moi;charset=utf8' , 'root', "");
}
catch(Exception $e)
{
	die('Erreur:' .$e->getMessage());
}

/*
$reponse = $bdd->query('SELECT * FROM candidat');

while($donnees = $reponse->fetch())
{
	echo $donnees['mail'];
	echo $donnees['password'];
}

*/

?>


<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Embauchez-moi</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
        
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
      
    </head>
    <body>
         
        
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
			<a href="index.php"><img id="logo" src="img/logo.png" alt="logo"/></a>
			<nav>
                    <ul>
                        <li><a id="toggle">Menu</a></li>
                        <li><a href="logout.php">Déconnexion</a></li>
                    </ul>
                </nav>
            </header>
        </div>
        <div class="main-container">
            <div class="main wrapper clearfix">
                <aside id="menu">
                      <br/>
                    <ul><li><a href="home.php">Mon Profil</a></li></ul>
                       <a href="remplir-profil.php" id="sousmenu">Modifier Profil</a><br/>
                       <a href="competences-menu.php" id="sousmenu">Compétences</a><br/>
                       <a href="formation-menu.php" id="sousmenu">Formation</a><br/>
                       <a href="permis-menu.php" id="sousmenu">Permis</a><br/>
                       <a href="projet-menu.php" id="sousmenu">Projet</a>
                       
                       <ul><li><a href="rechercher.php">Rechercher</a></li></ul>
                        
                    
                    </aside>
                <article>
                    <header>
                       
                        <h1>Tentative Inscription...</h1>
                        <p>
						<?php
						$_POST['mail'] = trim($_POST['mail']);
						$_POST['mail'] = strip_tags($_POST['mail']);
						$_POST['mail'] = htmlspecialchars($_POST['mail']);
					
						$_POST['mailverif'] = trim($_POST['mailverif']);
						$_POST['mailverif'] = strip_tags($_POST['mailverif']);
						$_POST['mailverif'] = htmlspecialchars($_POST['mailverif']);
						
						$_POST['password'] = trim($_POST['password']);
						$_POST['password'] = strip_tags($_POST['password']);
						$_POST['password'] = htmlspecialchars($_POST['password']);
						
						$_POST['passverif'] = trim($_POST['passverif']);
						$_POST['passverif'] = strip_tags($_POST['passverif']);
						$_POST['passverif'] = htmlspecialchars($_POST['passverif']);
				  
						
						if(!isset($_POST['mail'])){
							echo "Veuiller remplir le champ Adresse Email ! <br/><a href='inscription-candidat.html'>Retour</a>";
							
						}
						
						else if(!isset($_POST['mailverif'])){
							echo "Veuiller remplir le deuxième champ Adresse Email ! <br/><a href='inscription-candidat.html'>Retour</a>";
							
						}
						
						else if(!isset($_POST['password'])){
							echo "Veuiller remplir le champ Mot de Pass ! <br/><a href='inscription-candidat.html'>Retour</a>";
							
						}	
						
						else if(!isset($_POST['passverif'])){
							echo "Veuiller remplir le deuxième champ Mot de Pass ! <br/><a href='inscription-candidat.html'>Retour</a>";
							
						}
						
						else if(($_POST['mail'] != $_POST['mailverif']) OR ($_POST['password'] != $_POST['passverif'])){
							echo "Les données saisies dans les deux champs email ou <br/>les deux champs mot de pass ne sont pas identitiques. <br/><a href='inscription-candidat.html'>Retour</a>";
						}
						
						else {
							
							$profilStatut='non';
							
							$stmt = $bdd->prepare('INSERT INTO candidat(mail,password,profilStatut) VALUES(:mail,:password, :statut)');
							$stmt->bindValue('mail',$_POST['mail']);
							$stmt->bindValue('password',$_POST['password']);
							$stmt->bindValue('statut',$profilStatut);
							$stmt->execute();
							
						echo "Inscription Réussie, redirection dans 5 secondes !";	
						header( "refresh:5;url=login.php" );	
							
						}
						
						
						?>
						</p>
                    </header>
                    
                </article>

                

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
                <h3>Embauchez-moi</h3>
            </footer>
        </div>

        <script src="js/main.js"></script>

    </body>
</html>