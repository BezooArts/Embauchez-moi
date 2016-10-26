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
			
			
	.erreur {
  color:red;
  font-size: 20px;
}

.rating {
	
	float:left;
	margin-top:15px;
}

.rating a {
	float: right;
   color: #aaa;
   text-decoration: none;
   font-size: 3em;
   transition: color .4s;
}
.rating a:hover,
.rating a:focus,
.rating a:hover ~ a,
.rating a:focus ~ a {
   color: #d708a0;
   cursor: pointer;
}


</style>
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
      
    </head>
           </body>
        
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
                    <ul><li><a href="remplir-profil.php">Mon Profil</a></li></ul>
                       <a href="#" id="sousmenu">Sous Menu</a><br/>
                       <a href="#" id="sousmenu">Sous Menu</a><br/>
                       <a href="#" id="sousmenu">Sous Menu</a><br/>
                       <a href="#" id="sousmenu">Sous Menu</a>
                       
                       <ul><li>Rechercher</li></ul>
                        
                    
                    </aside>
              
					<section>
					
<?php
include('db.php');
 ob_start();
 session_start();
 require_once 'db.php';
 
 if( !isset($_SESSION['candidat']) ) {
  header("Location: login.php");
  exit;
 }

if (!empty($_POST['nom']) && !empty($_POST['niveau'])){

$stmt = $bdd->prepare('INSERT INTO COMPETENCES(id_candidat,nom,niveau, description)
        VALUES (:id_candidat, :nom, :niveau, :description)');

    $stmt->execute (array('id_candidat'=>$_SESSION['candidat'],'nom'=>$_POST['nom'], 'niveau'=>$_POST['niveau'] , 'description'=> $_POST['description']));

    echo "Votre compétence à bien été enregistrée.";
	echo "<br/>Redirection dans 5 secondes !";	
						header( "refresh:5;url=home.php" );	


  }  
 else
 {

     //echo "le nom et/ou le niveau ne sont pas remplis.";
 ?>

<article id="inscription">
<form action="competences.php" method="post">
	<fieldset>
		<h2>Ajouter une compétence:</h2>
		<label>Nom: </label><br/>
		<input type="text" name="nom">
<?php
if(isset($_POST['nom']) && empty($_POST['nom'])){
	echo "<span class=\"erreur\">Le champs nom n'est pas rempli.</span>";
}
?>
		<br><br/>
		
		<label>Niveau:</label><br/>

       <div class="rating"><!--
   --><a onclick ="getElementById('niveau').value=5;" href="#1" title="Donner 5 étoiles">☆</a><!--
   --><a onclick ="getElementById('niveau').value=4;" href="#2" title="Donner 4 étoiles">☆</a><!--
   --><a onclick ="getElementById('niveau').value=3;" href="#3" title="Donner 3 étoiles">☆</a><!--
   --><a onclick ="getElementById('niveau').value=2;" href="#4" title="Donner 2 étoiles">☆</a><!--
   --><a onclick ="getElementById('niveau').value=1;" href="#5" title="Donner 1 étoile">☆</a>
</div>
<?php
if(isset($_POST['niveau']) && empty($_POST['niveau'])){
	echo "<span class=\"erreur\">le champs niveau n'est pas rempli.</span>";
}
?>

 <input id="niveau" type="hidden" name="niveau">
        <br>
        <br>
		<br/>
		<label>Description: facultatif</label>
		<br>
		​<input type="text" name="description"></textarea>
		<br>
		<br>
		
		<input type="submit" name="valider" value="Valider">
	</fieldset>
</form>

</section>


<?php
}
?>

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