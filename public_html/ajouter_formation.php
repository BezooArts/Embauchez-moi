<?php
include_once("db.php");

ob_start();
session_start();

if(!isset($_SESSION['candidat'])){
	header("Location:login.php");
	exit;
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
		
		
		
		
		.obligatoire{
                color:#cc0033;
            }
            @media only screen and (min-width:1140px){
            #inscription {
                padding-left:100px;
            }
            
            form {
                margin-left: 95px;
				width:39%;
                
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
			
			
	.erreur {
  color:red;
  font-size: 20px;
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
              
					<section><?php
if(!empty($_POST['valider'])){
if(isset($_POST['valider']))
					
		{
			if(isset($_POST['capt1'])){
				$diplome='1';
			}
			
			else{
				$diplome='0';
			}
			
			
		$stmt = $bdd->prepare('INSERT INTO formation
			(id_candidat, nom, annee, diplome_obtenu, niveau, domaine, etablissement) 
			VALUES 
			(:id_candidat, :nom, :annee, :diplome_obtenu, :niveau, :domaine, :etablissement)');

		/*$stmt->execute(array(/
			'id_candidat' => $_SESSION['candidat'],
			'nom' => (isset($_POST['nom']) ) ? $_POST['nom'] : null,
			'annee' => (isset($_POST['annee']) ) ? $_POST['annee'] : null,
			'diplome_obtenu' => $diplome ,
			'niveau' => (isset($_POST['niveau']) ) ? $_POST['niveau'] : null,
			'domaine' => (isset($_POST['domaine']) ) ? $_POST['domaine'] : null,
			'etablissement' => (isset($_POST['etablissement']) ) ? $_POST['etablissement'] : null));*/
			
		$stmt->bindValue('id_candidat',$_SESSION['candidat']);
		$stmt->bindValue('nom',$_POST['nom']);
		$stmt->bindValue('annee',$_POST['annee']);
		$stmt->bindValue('diplome_obtenu',$diplome);
		$stmt->bindValue('niveau',$_POST['niveau']);
		$stmt->bindValue('domaine',$_POST['domaine']);
		$stmt->bindValue('etablissement',$_POST['etablissement']);
		$stmt->execute();	

		echo "Votre formation à été bien enregistrée";
		

		}

			else
		{

			echo "La formation n'est pas remplie";

		}
}
?>
	<form action="ajouter_formation.php" method="POST">
	<h2>Ajouter une formation ou un diplôme</h2>

	<label>Formation ou diplôme</label><br/>
	<input type="text" name="nom" required="required"/><br/><br/>
	<label>Année</label><br/><input type="text" name="annee" required="required"/><br/><br/>
	<label><input type="checkbox" name="capt1" value="1" checked="checked" id="box1" > Diplôme Obtenu</label>
	<br/>

	
	<br/>
	<select required="required" style="color:black;" name="niveau" size="1">
	<option selected>Niveau</option>
	<option>bac + 5</option>
	<option>bac + 3</option>
	<option>bac + 2</option>
	<option>bac</option>
	<option>CAP, BEP ou équivalent</option>
	<option>2nd ou 1ère achevée</option>
	<option>BEPC ou 3ème achevée</option>
	<option>4ème achevée</option>
	<option>Aucune formation scolaire</option>
	</select>
	
	<br/>
	<br/>
	

	<select style="color:black;" name="domaine" size="1">
	<option selected>Domaine</option>
	<option>Agriculture</option>
	<option>Architecte, urbanisme, paysage, construction(BTP)</option>
	<option>Art, design</option>
	<option>Audiovisuel, spectacle</option>
	<option>Audit, gestion</option>
	<option>Automobile</option>
	<option>Banque, Assurance</option>
	<option>Chimie, Pharmacie</option>
	<option>Commerce, distribution</option>
	<option>Communication, Marketing, publicité</option>
	<option>Construction aéronautique, ferroviaire et navale</option>
	<option>Culture, artisanat d'art</option>
	<option>Défense, sécurité</option>
	<option>Droit, justice</option>
	<option>Edition, journalisme</option>
	<option>Electronique</option>
	<option>Energie</option>
	<option>Enseignement</option>
	<option>Environnement</option>
	<option>Bois(filière)</option>
	<option>Fonction Publique</option>
	<option>Hôtellerie, restauration</option>
	<option>Industrie alimentaire</option>
	<option>Informatique, internet et télécom</option>
	<option>Jeu Vidéo</option>
	<option>Maintenance, entretien</option>
	<option>Mécanique</option>
	<option>Mode et industrie textile</option>
	<option>Logistique, Transport</option>
	<option>Santé</option>
	<option>Social</option>
	<option>Recherche</option>
	<option>Sport, Loisirs, tourisme</option>
	<option>Traduction, interprétation</option>
	<option>Verre, béton, céramique</option>
	</select>
	
	<br/>
	<br/>

	<label>Etablissement</label><br/><input type="text" name="etablissement" required="required"/><br/><br/>

	<input type="submit" name="valider">
	
	</form>
	<br/>
	
	</section>
	  </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
                <h3>Embauchez-moi</h3>
            </footer>
        </div>
 
        <script src="js/main.js"></script>
		
		</script>
		
</body>
</html>





