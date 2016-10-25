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
 /*$res=mysql_query("SELECT * FROM candidat WHERE id_candidat=".$_SESSION['candidat']);
 $userRow=mysql_fetch_array($res);*/
 
 
 $res = $bdd->query("SELECT * FROM candidat WHERE id_candidat=".$_SESSION['candidat']);
$userRow= $res->fetch();
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
                
            }
            
            h1 {
                margin-left: 95px;
                font-family: Lato;
            }
            
            h2 {
                margin-left: 95px;
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
                    <ul><li><a href="">Mon Profil</a></li></ul>
                       <a href="#" id="sousmenu">Sous Menu</a><br/>
                       <a href="#" id="sousmenu">Sous Menu</a><br/>
                       <a href="#" id="sousmenu">Sous Menu</a><br/>
                       <a href="#" id="sousmenu">Sous Menu</a>
                       
                       <ul><li>Rechercher</li></ul>
                        
                    
                    </aside>
                <article id="inscription"><?php
				
				
				if ( isset($_POST['submit']) ) {
				
					  $nom = trim($_POST['nom']);
					  $nom = strip_tags($nom);
					  $nom = htmlspecialchars($nom);
					  
					  $prenom = trim($_POST['prenom']);
					  $prenom = strip_tags($prenom);
					  $prenom = htmlspecialchars($prenom);
					  
					  $ville = trim($_POST['ville']);
					  $ville = strip_tags($ville);
					  $ville = htmlspecialchars($ville);
					  
					  $date = trim($_POST['date']);
					  $date = strip_tags($date);
					  $date = htmlspecialchars($date);
					  
					  if (!isset($nom) OR !isset($prenom) OR !isset($ville) OR !isset($date)){
					$error = true;
					echo $passError = "Vous n'avez pas rempli tous les champs obligatoires.<br/><a href='remplir-profil.php'>Retour</a>";
					
					}
					  
					else {
			
					$profilChange = 'oui';
					
					/*$query = "UPDATE candidat SET nom='$nom', ville='$ville', prenom='$prenom', date_naissance='$date', profilStatut='oui' WHERE id_candidat='".$_SESSION['candidat']."'";
					echo $query;
					$res = mysql_query($query);*/
					
					$stmt = $bdd->prepare("UPDATE candidat SET nom=:nom, ville=:ville, prenom=:prenom, date_naissance=:date, profilStatut=:profilStatut WHERE id_candidat=:candidat_session");
					$stmt->execute(array(
					'nom'=>$nom,
					'prenom'=>$prenom,
					'ville'=>$ville,
					'date'=>$date,
					'profilStatut'=>$profilChange,
					'candidat_session'=>$_SESSION['candidat'] 
					));
					
					header('Location:home.php');
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
