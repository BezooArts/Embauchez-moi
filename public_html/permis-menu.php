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
 $res2 = $bdd->query("SELECT * FROM permis WHERE id_candidat=".$_SESSION['candidat']);
 $count1 = $res2->rowCount();
 
 /*$res=mysql_query("SELECT * FROM candidat WHERE id_candidat=".$_SESSION['candidat']);
 $userRow=mysql_fetch_array($res);*/
 
 if($userRow['profilStatut']=="non"){
	 header("Location: remplir-profil.php");
 }
 
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
button {
	-moz-box-shadow:inset 0px 9px 30px 5px #29bbff;
	-webkit-box-shadow:inset 0px 9px 30px 5px #29bbff;
	box-shadow:inset 0px 9px 30px 5px #29bbff;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #842da1), color-stop(1, #2c87b8));
	background:-moz-linear-gradient(top, #842da1 5%, #2c87b8 100%);
	background:-webkit-linear-gradient(top, #842da1 5%, #2c87b8 100%);
	background:-o-linear-gradient(top, #842da1 5%, #2c87b8 100%);
	background:-ms-linear-gradient(top, #842da1 5%, #2c87b8 100%);
	background:linear-gradient(to bottom, #842da1 5%, #2c87b8 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#842da1', endColorstr='#2c87b8',GradientType=0);
	background-color:#842da1;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;
	border:1px solid #0b0e07;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	padding:9px 23px;
	text-decoration:none;
	text-shadow:0px 1px 0px #263666;
}
button:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #2c87b8), color-stop(1, #842da1));
	background:-moz-linear-gradient(top, #2c87b8 5%, #842da1 100%);
	background:-webkit-linear-gradient(top, #2c87b8 5%, #842da1 100%);
	background:-o-linear-gradient(top, #2c87b8 5%, #842da1 100%);
	background:-ms-linear-gradient(top, #2c87b8 5%, #842da1 100%);
	background:linear-gradient(to bottom, #2c87b8 5%, #842da1 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2c87b8', endColorstr='#842da1',GradientType=0);
	background-color:#2c87b8;
}
button:active {
	position:relative;
	top:1px;
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
                <article>
                    <header>
                       
                    </header>
					
					<h2>Mes permis</h2>
					
					<?php 
					
					if($count1 > 0){
						while($userPermisRow = $res2->fetch()){
						   echo "Permis: ".$userPermisRow['permis']."<br/><a href='permis_change.php?id=".$userPermisRow['id_permis']."&change=delete'> Supprimer </a><br/><br/>"; 
						   }
					}
					
					else {
						echo "Vous n'avez aucun permis d'ajoutée !<br/>";
						
					}
				
					
					?>
					
					<a href="permis.php">Ajouter un Permis</a>
					
                    <footer>
					</footer>
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
