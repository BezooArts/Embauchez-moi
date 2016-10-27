<?php
 ob_start();
 session_start();
 require_once 'db.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['candidat']) ) {
  header("Location: login.php");
  exit;
 }
 // select loggedin users detail
 $res = $bdd->query("SELECT * FROM candidat WHERE id_candidat=".$_SESSION['candidat']);
 $userRow= $res->fetch();
 $res2 = $bdd->query("SELECT * FROM permis WHERE id_candidat=".$_SESSION['candidat']." AND id_permis=".$_GET['id']);
 $userPermisRow= $res2->fetch();
 
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
        
        
             <style>
            .obligatoire{
                color:#cc0033;
            }
            @media only screen and (min-width:1140px){
            #inscription {
                padding-left:100px;
            }
            
            form {
                margin-left: 95px;
                width:57%;
            }
            
            h1 {
                margin-left: 95px;
                font-family: Lato;
            }
            
            h2 {
                
                font-family: Lato;
            }
            
            p {
                margin-left: 95px;
                font-family: Lato;
            }
            
            }
        </style>
        
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
                <article id="inscription">
						<?php
		if($userPermisRow['id_permis']==NULL) {
			header("refresh:7;url=permis-menu.php");
			echo "Vous avez tenté de modifier le URL, veuiller svp utiliser seulement les menus !<br/> Redirection dans 5 secondes";
		}
		
		else {
		
		
				
				if($_GET['change']=='delete'){
					
					 
	 $sql = "DELETE FROM permis WHERE id_candidat=:candidat_session AND id_permis=:id_permis";
	 $req = $bdd->prepare($sql);
	 $req->execute(array(
	 'candidat_session'=>$_SESSION['candidat'],
	 'id_permis'=>$_GET['id']
	 ));
					
					echo 'La compétence a correctement était supprimé ! <br/> &nbsp &nbsp REDIRECTION dans 5 secondes ! ';
					header("refresh:5;url=permis-menu.php");
				}
				
				else {
			header("refresh:7;url=permis-menu.php");
			echo "Vous avez tenté de modifier le URL, veuiller svp utiliser seulement les menus !<br/> Redirection dans 5 secondes";
	
				}
				
 

		}
 ?>
 
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
