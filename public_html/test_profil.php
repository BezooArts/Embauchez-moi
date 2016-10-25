<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

			<?php
			try
			{
				$bdd = new PDO('mysql: host=localhost;dbname=embauchez-moi;charset=utf8' , 'root', "");
			}
			catch(Exception $e)
			{
				die('Erreur:' .$e->getMessage());
			}

			$reponse = $bdd->query('SELECT * FROM CANDIDAT');
			?>

		<table>
			<thead>
			<tr>
				<th>id_candidat</th>
				<th>mail</th>
				<th>password</th>
				<th>nom</th>
				<th>prenom</th>
				<th>date_naissance</th>
				<th>adresse</th>
				<th>cp</th>
				<th>ville</th>
				<th>tel</th>
				<th>mail_pro</th>
				<th>site_web</th>
				<th>photo_profil</th>
				<th>permis</th>
				<th>phrase_accroche</th>
			</tr>
			</thead>
			<tbody>

			<?php
		while($donnees = $reponse->fetch()){
		
			?>
			<tr>
				<td><?php echo $donnees['id_candidat'];?></td>
				<td><?php echo $donnees['mail'];?></td>
				<td><?php echo $donnees['password'];?></td>
				<td><?php echo $donnees['nom'];?></td>
				<td><?php echo $donnees['prenom'];?></td>
				<td><?php echo $donnees['date_naissance'];?></td>
				<td><?php echo $donnees['adresse'];?></td>
				<td><?php echo $donnees['cp'];?></td>
				<td><?php echo $donnees['ville'];?></td>
				<td><?php echo $donnees['tel'];?></td>
				<td><?php echo $donnees['mail_pro'];?></td>
				<td><?php echo $donnees['site_web'];?></td>
				<td><?php echo $donnees['photo_profil'];?></td>
				<td><?php echo $donnees['permis'];?></td>
				<td><?php echo $donnees['phrase_accroche'];?></td>
			</tr>
		<?php
		}
		?>
		</tbody>
		</table>
	</body>
</html>