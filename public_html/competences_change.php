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
 $res2 = $bdd->query("SELECT * FROM competences WHERE id_candidat=".$_SESSION['candidat']." AND id_competences=".$_GET['id']);
 $userCompetenceRow= $res2->fetch();
 
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
		if($userCompetenceRow['id_competences']==NULL) {
			header("refresh:7;url=competences-menu.php");
			echo "Vous avez tenté de modifier le URL, veuiller svp utiliser seulement les menus !<br/> Redirection dans 5 secondes";
		}
		
		
		else {
		
		if($_GET['change']=='edit')	{
			
		if(isset($_GET['id'])){
		 if ( isset($_POST['submit']) ) {
				
					  $nom = trim($_POST['nom']);
					  $nom = strip_tags($nom);
					  $nom = htmlspecialchars($nom);
					  
					  $niveau = trim($_POST['niveau']);
					  $niveau = strip_tags($niveau);
					  $niveau = htmlspecialchars($niveau);
					  
					  $id_competence = trim($_POST['id_competences']);
					  $id_competence = strip_tags($id_competence);
					  $id_competence = htmlspecialchars($id_competence);
					  
					  if(isset($_POST['description'])){
					  $description = trim($_POST['description']);
					  $description = strip_tags($description);
					  $description = htmlspecialchars($description);}
					  
					  else {$description = NULL;}
					  
					  
					  
					  
			if (!isset($nom) OR !isset($niveau)){
					$error = true;
					echo $passError = "<br/>Vous n'avez pas rempli tous les champs obligatoires.";
					
					}
					  
					else {
					
					$stmt = $bdd->prepare("UPDATE competences SET nom=:nom, description=:description, niveau=:niveau WHERE id_candidat=:candidat_session AND id_competences=:competence");
					$stmt->execute(array(
					'nom'=>$nom,
					'niveau'=>$niveau,
					'description'=>$description,
					'candidat_session'=>$_SESSION['candidat'],
					'competence'=>$id_competence
					));
					
					echo "<br/><h2>Modification Effectué !</h2><h4>Actualisation dans 2 secondes...</h4>";
					
					header("Refresh:2");
					
					}					
 
		}
		
		}
		
		else {
			echo "<br/>Vous n'êtes pas passez par le lien par default";
		}
		
		
		
				}
				
				else if($_GET['change']=='delete'){
					
					 
	 $sql = "DELETE FROM competences WHERE id_candidat=:candidat_session AND id_competences=:id_competence";
	 $req = $bdd->prepare($sql);
	 $req->execute(array(
	 'candidat_session'=>$_SESSION['candidat'],
	 'id_competence'=>$_GET['id']
	 ));
					
					echo 'La compétence a correctement était supprimé ! <br/> &nbsp &nbsp REDIRECTION dans 5 secondes ! ';
					header("refresh:5;url=competences-menu.php");
				}
				
				else {
								header("refresh:7;url=competences-menu.php");
			echo "Vous avez tenté de modifier le URL, veuiller svp utiliser seulement les menus !<br/> Redirection dans 5 secondes";				
				}
				
				
 
 ?>
 
 <?php if($_GET['change']=='edit'){?>
               <form method="post" action="competences_change.php?id=<?php echo $_GET['id']; ?>&change=<?php echo $_GET['change']; ?>">
	 
     <fieldset>
       <h2><?php echo $userCompetenceRow['nom']; ?></h2>
		<label>Nom<span class="obligatoire">*</span>:</label>
                <input type="text" name="nom" required="required" value="<?php echo $userCompetenceRow['nom'];?>"><br/><br/>
		
		<label>Niveau<span class="obligatoire">*</span>: (1:minimum - 5:maximum)</label>
		<input type="number" name="niveau" min="1" max="5" required="required" value="<?php echo $userCompetenceRow['niveau'];?>"><br/><br/>
		
		<label>Description:</label><br/>
		<input type="text" name="description" value="<?php if(isset($userCompetenceRow['description'])){echo $userCompetenceRow['description'];}?>"><br/><br/>
		<input type="hidden" name="id_competences" value="<?php if(isset($_GET['id'])){ echo $_GET['id']; } ?>">
		<input type="submit" value="Valider" name="submit">
	  </fieldset>
  
		</form>
 <?php }
 

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
