<?php
	session_start();
?>

<!-- READ -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> <?php echo date('d/m/Y h:i:s'); ?> </title>
    </head>
    <body>
        <h1>Recherche dans les différentes tables</h1>
		<?php
			include('menu.html'); 
			echo ('</br>');
			
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
			
		?>
			<form action="affichageBDD.php" method="post">
				<select name="nomTable">
					<option value="_client">Client</option>
					<option value="_produit">Produit</option>
					<option value="_users">Users</option>
					<option value="_facture">Facture</option>
				</select>
				<p>Rechercher dans la base le nom d'un client : <input type="text" name="_Entry"/></p>
				<p><input type="submit" value="Valider" /></p>
			</form>
			
			<?php
			if (isset($_POST['nomTable']))
			{
				if ($_POST['nomTable'] == "_client")
				{
					if (isset($_POST['_Entry']))
					{
						$req = $bdd->prepare('SELECT * FROM client WHERE NomClient = ?');
						$req->execute(array($_POST['_Entry']));
						?>
						<table>
						<tr>
							<th> Numéro du client </th>
							<th> Nom du client </th>
							<th> Prénom du client </th>
							<th> Adresse du client </th>
							<th> Code postal du client </th>
							<th> Ville du client </th>
							<th> Pays du client </th>
						</tr>
						<?php
						while ($donnees = $req->fetch())
						echo "
							<tr>
								<td>".$donnees['NumClient']."</td>
								<td>".$donnees['NomClient']."</td>
								<td>".$donnees['PrenomClient']."</td>
								<td>".$donnees['AdresseClient']."</td>
								<td>".$donnees['Cp']."</td>
								<td>".$donnees['VilleClient']."</td>
								<td>".$donnees['PaysClient']."</td>
							</tr>";
						
						//echo $donnees['NomClient'] . " " . $donnees['PrenomClient'] . "</br>";
						//echo $donnees['PrenomClient'];
					}
				}
				if ($_POST['nomTable'] == "_users")
				{
					if (isset($_POST['_Entry']))
					{
						$req = $bdd->prepare('SELECT * FROM membres WHERE pseudo = ?');
						$req->execute(array($_POST['_Entry']));
						?>
						<table>
						<tr>
							<th> Numéro Utilisateur </th>
							<th> User </th>
							<th> Email </th>
							<th> Password </th>
							<th> Date d'inscription </th>
						</tr>
						<?php
						while ($donnees = $req->fetch())
						echo "
							<tr>
								<td>".$donnees['id']."</td>
								<td>".$donnees['pseudo']."</td>
								<td>".$donnees['email']."</td>
								<td>".$donnees['pass']."</td>
								<td>".$donnees['date_inscription']."</td>
							</tr>";
						
						//echo $donnees['NomClient'] . " " . $donnees['PrenomClient'] . "</br>";
						//echo $donnees['PrenomClient'];
					}
				}
				if ($_POST['nomTable'] == "_produit")
				{
					if (isset($_POST['_Entry']))
					{
						$req = $bdd->prepare('SELECT * FROM produits WHERE Des = ?');
						$req->execute(array($_POST['_Entry']));
						?>
						<table>
						<tr>
							<th> Numéro du produit </th>
							<th> Type </th>
							<th> PUHT </th>
						</tr>
						<?php
						while ($donnees = $req->fetch())
						echo "
							<tr>
								<td>".$donnees['NumProduit']."</td>
								<td>".$donnees['Des']."</td>
								<td>".$donnees['PUHT']."</td>
							</tr>";
						
						//echo $donnees['NomClient'] . " " . $donnees['PrenomClient'] . "</br>";
						//echo $donnees['PrenomClient'];
					}
				}
			}
			?>
			</table>
			<style type='text/css'>
				table
				{
					border-collapse: collapse;
				}
				td, th
				{
					border: 1px solid black;
				}
			</style>
		<?php
		}
		?>
			
    </body>
		<footer>
		<?php
			echo ('</br>');
			include('footer.html');
		?>
	</footer>

</html>