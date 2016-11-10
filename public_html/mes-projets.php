<?php
 ob_start();
 session_start();
 require_once 'db.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['candidat']) ) {
  header("Location: login.php");
  exit;
 }
 
 $res = $bdd->query("SELECT * FROM candidat WHERE id_candidat=".$_SESSION['candidat']);
 $userRow= $res->fetch();
 
 $res2 = $bdd->query("SELECT * FROM projet WHERE id_candidat=".$_SESSION['candidat']);
 $count1 = $res2->rowCount();
 


 
 if($count1 > 0){
	 
	 while($userProjetCount=$res2->fetch()){
		$res3 = $bdd->query("SELECT * FROM galerie WHERE id_projet=".$userProjetCount['id_projet']);
		$userGalerie= $res3->fetch(); 
		
		 echo 'PROJET : '.$userProjetCount['nom'].'<br/>Catégorie: '.$userProjetCount['categorie'].'<br/>Description: '.$userProjetCount['description'].'<br/><img width="100px" src="img/'.$userGalerie['lien'].'" ALT="'.$userGalerie['nom'].'"/><br/><br/>';
	 }
	 
 }

?>