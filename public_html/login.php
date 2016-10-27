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
                margin-left: 95px;
                font-family: Lato;
            }
            
            p {
                margin-left: 95px;
                font-family: Lato;
            }
            
            }

        </style>
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
                   <h1>Embauchez-Moi!</h1>

	<h2>Connexion</h2>

	<form action="login.php" method="POST">
	<label>Adresse Mail:</label><br/>
	<input type="email" name="mail" required="required"/><br/>
	<br/>
	<label>Mot de passe:</label><br/>
	<input type="password" name="password" required="required"/><br/>
	<br/>
	<input name="submit" type="submit" value="Valider" >
	</form>
                </article>
			
				<?php
				 ob_start();
				 session_start();
				 require_once 'db.php';
				 
				 // it will never let you open index(login) page if session is set
				 if ( isset($_SESSION['candidat'])!="" ) {
				  header("Location: home.php");
				  exit;
				 }
				 
				 $error = false;
				 
				 if( isset($_POST['submit']) ) { 
				  
				  // prevent sql injections/ clear user invalid inputs
				  $email = trim($_POST['mail']);
				  $email = strip_tags($email);
				  $email = htmlspecialchars($email);
				  
				  $pass = trim($_POST['password']);
				  $pass = strip_tags($pass);
				  $pass = htmlspecialchars($pass);
				  // prevent sql injections / clear user invalid inputs
				  
				  if(empty($email)){
				   $error = true;
				   echo $emailError = "Please enter your email address.";
				  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
				   $error = true;
				   echo $emailError = "Please enter valid email address.";
				  }
				  
				  if(empty($pass)){
				   $error = true;
				   echo $passError = "Please enter your password.";
				  }
				  
				  // if there's no error, continue to login
				  if (!$error) {
				   
				   $password = $pass; // password hashing using SHA256
				  
				   /*$res=mysql_query("SELECT id_candidat, mail, password FROM candidat WHERE mail='$email'");
				   $row=mysql_fetch_array($res);*/
				   
				    $res = $bdd->query("SELECT id_candidat, mail, password FROM candidat WHERE mail='$email'");
					$row= $res->fetch();
 
				   
				   // $count = mysql_num_rows($res); 
				   $count = $res->rowCount(); 
				   
				   if( $count == 1 && $row['password']==$password ) {
					$_SESSION['candidat'] = $row['id_candidat'];
					header("Location: home.php");
				   } else {
					echo $errMSG = "Incorrect Credentials, Try again...";
				   }
					
				  }
				  
				 }
				 
				 else {
					 
					 
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
    </body>
</html>
