<?php
include_once("db.php");
ob_start();
session_start();
if(!isset($_SESSION['candidat'])){
	header("Location:login.php");
	exit;
}
if (!empty($_POST['nom']) && !empty($_POST['categorie']) && !empty($_POST['lien'])){
$stmt = $bdd->prepare('INSERT INTO projet (id_candidat,nom,categorie,description) VALUES(:id_candidat, :nom, :categorie, :description)');
$stmt->execute(array(
    'id_candidat' => $_SESSION['candidat'], 
    'nom' => $_POST['nom'],
    'categorie' => $_POST['categorie'], 
    'description' => $_POST['description']
));

 
$id_projet = $bdd->lastInsertId();
$req = $bdd->prepare('INSERT INTO galerie (nom, lien, id_projet) VALUES(:nom, :lien, :id_projet)');
$req->execute(array('nom'=>$_POST['nom'], 'lien'=>$_POST['lien'], 'id_projet'=>$id_projet));
    echo "Votre photo à bien été enregistrée dans la galerie.";
	
	if(isset($_FILES['lien'])){
    $file_name = $_FILES['lien']['name'];
    $file_size =$_FILES['lien']['size'];
    $file_tmp =$_FILES['lien']['tmp_name'];
    $file_type=$_FILES['lien']['type'];
    move_uploaded_file($file_tmp,"img/".$file_name);
}   
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
        <link rel="stylesheet" type="text/css" href="styleprojet.css">
        <style>
		
		
		.obligatoire{
                color:#cc0033;
            }
            @media only screen and (min-width:1140px){
            #inscription {
                padding-left:100px;
            }
            
            form {
                margin-left: 195px;
            }
            
            h1 {
                margin-left: 95px;
                font-family: Lato;
            }
            
            h2 {
                margin-left: 35px;
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
               <img id="logo" src="img/logo.png" alt="logo"/>
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
              
					<section>

<article id="inscription">
<form action="projet.php" method="post" >
    <h2>Projet </h2>
    <label>Nom:</label><br/>
    <input type="text" name="nom">
    <br>
    <br>
    <label>Catégorie:</label><br/>
    <input type="text" name="categorie">
    <br>
    <br>
    <label>Description:</label>
    <br>
    <textarea id="txtArea" name="description" rows="9" cols="50"></textarea>
    <br>
    <br>
    <label>Ajouter des photos du projet:</label>
    <br>
    <input type="file" name="lien">
    <br>
    <br>
   <input type="submit" name="valider" value="Valider">
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
		
		</script>
		
</body>
</html>
</html>