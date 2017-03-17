<?php
	session_start();
?>

<!-- ADD -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> <?php echo date('d/m/Y h:i:s'); ?> </title>
    </head>
    <body>
        <h1>Update Data</h1>
		<?php include('menu.html');
		echo ('</br>');?>
		
		
		<?php
//========================================================================================================================================================================	
		if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
		{
		
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=facturef2b;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
				die('Erreur :'.$e->getMessage());
			}
			
			echo ($_SESSION['pseudo']);
			?>
			
			<form action="UpdateData.php" method="post">
				<select name="nomTable">
					<option value="_client">Client</option>
					<option value="_produit">Produit</option>
					<option value="_facture">Facture</option>
					<option value="_dfacture">D_Facture</option>
					<option value="_membres">Membres</option>
				</select>
				<p><input type="submit" value="Valider" /></p>
			</form>
			<?php
			
			if (isset($_POST['nomTable']))
			{
				if ($_POST['nomTable'] == "_membres")
				{?>
					<form action="UpdateData.php" method="post">
						<p>Pseudo du membre : <input type="text" name="_PseudoMembre"/></br></p>
						<p>Mot de passe du membre  : <input type="text" name="_MDPMembre"/></br></p>
						<p>Email du membre : <input type="text" name="_EmailMembre"/></br></p>
						<p><input type="submit" value="Valider" /></br></p>
					</form>
					
					<?php
						$req = $bdd->prepare('UPDATE membres SET pseudo = :nvpseudo, pass = :nvpass, email = nvemail WHERE pseudo = :currpseudo');
						$req->execute(array(
							'nvpseudo' => $_POST['_PseudoMembre'],
							'nvpass' => $_POST['_MDPMembre'],
							'nvemail' => $_POST['_EmailMembre'],
							'currpseudo' => $_SESSION['pseudo']
							));
					?>
					
					<table>
						<tr>
							<th>Nouveau Nom du membre</th>
							<th>Nouveau Mot de passe du membre</th>
							<th>Nouveau Email du membre</th>
						</tr>
						
						<?php
						while ($donnees = $req->fetch())
						echo "
							<tr>
								<td>".$donnees['nvpseudo']."</td>
								<td>".$donnees['nvpass']."</td>
								<td>".$donnees['nvemail']."</td>
							</tr>";
							?>
				<?php
				}
			}
		}
				?>
<!--//=======================================================================================================================================================================   -->	
    </body>
	<footer>
		<?php
			echo ('</br>');
			include('footer.html');
		?>
	</footer>

</html>