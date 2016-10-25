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
                <article id="inscription">
               <form method="post" action="profilFinish.php">
	 
     <fieldset>
       <legend>1. Vos informations Personnelles</legend>
		<label>Nom<span class="obligatoire">*</span>:</label>
                <input type="text" name="nom" required="required" value="<?php if(isset($userRow['nom'])){echo $userRow['nom'];}?>"><br/><br/>
		
		<label>Prenom<span class="obligatoire">*</span>:</label>
		<input type="text" name="prenom" required="required" value="<?php if(isset($userRow['prenom'])){echo $userRow['prenom'];}?>"><br/><br/>
	
		<label>Date de naissance<span class="obligatoire">*</span>:</label>
		<input type="Date" name="date" required="required" value="<?php if(isset($userRow['date_naissance'])){echo $userRow['date_naissance'];}?>"><br/><br/>
		
		<label> Code postal:</label>
		<input type="text" name="cp"><br/><br/>
		
		<label> Ville<span class="obligatoire">*</span>:</label>
		<input type="text" name="ville" required="required" value="<?php if(isset($userRow['ville'])){echo $userRow['ville'];}?>"><br/><br/>
		
		<label> Tel:</label><br/>
		<input type="text" name="phone"><br/><br/>
		
		<label> Site web:</label><br/>
		<input type="url" name="web"><br/><br/>
		
		<label> Réseaux sociaux:</label><br/>
		<input type="url" name="reseau">
	  </fieldset>
      <br>
	 <fieldset>
	   <legend> 2. Joindre Fichier</legend>

       <label> Photo de profil:</label>
       <input type="file" name="photo">
       <label> Format (jpeg, png)</label>
       </br>
       <br>
        <label> Autres fichiers:</label>
       <input type="file" name="autrefichier">
       <label> Format (pdf)</label>
        </br>
       <input type="submit" value="Valider" name="submit">

	  </fieldset>
		</form>
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
