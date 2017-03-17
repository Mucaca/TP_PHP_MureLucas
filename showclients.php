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
        <h1>Afficher les clients</h1>
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
		<form action="showclients.php" method="post">
			<select name="nomTable">
				<option value="_client">Client</option>
				<option value="_produit">Produit</option>
				<option value="_facture">Facture</option>
				<option value="_dfacture">D_Facture</option>
			</select>
			<p><input type="submit" value="Valider" /></p>
		</form>
		<?php
			if (isset($_POST['nomTable']))
			{
				if ($_POST['nomTable'] == "_client")
				{
	?>
					<table>
						<tr>
							<th>Numéro du client</th>
							<th>Nom du client</th>
							<th>Prénom du client</th>
							<th>Adresse du client</th>
							<th>Code postal du client</th>
							<th>Ville du client</th>
							<th>Pays du client</th>
						</tr>
				<?php
					$reponse = $bdd->query('SELECT * FROM client');
					while ($donnees = $reponse->fetch())
					{
				?>
				
						<?php echo "<tr>
							<td>".$donnees['NumClient']."</td>
							<td>".$donnees['NomClient']."</td>
							<td>".$donnees['PrenomClient']."</td>
							<td>".$donnees['AdresseClient']."</td>
							<td>".$donnees['Cp']."</td>
							<td>".$donnees['VilleClient']."</td>
							<td>".$donnees['PaysClient']."</td>
						</tr>
					<style type='text/css'>
						table
						{
							border-collapse: collapse;
						}
						td, th /* Mettre une bordure sur les td ET les th */
						{
							border: 1px solid black;
						}
					</style>"
					?>
				<?php
					}
				}
				
				if ($_POST['nomTable'] == "_facture")
				{
	?>
					<table>
						<tr>
							<th>Numéro de facture</th>
							<th>Date de la facture</th>
							<th>Numéro du client</th>
						</tr>
				<?php
					$reponse = $bdd->query('SELECT * FROM facture');
					while ($donnees = $reponse->fetch())
					{
				?>
				
						<?php echo "<tr>
							<td>".$donnees['NumFacture']."</td>
							<td>".$donnees['DateFacture']."</td>
							<td>".$donnees['NumClient']."</td>
						</tr>
					<style type='text/css'>
						table
						{
							border-collapse: collapse;
						}
						td, th /* Mettre une bordure sur les td ET les th */
						{
							border: 1px solid black;
						}
					</style>"
					?>
				<?php
					}
				}
								
				if ($_POST['nomTable'] == "_produit")
				{
	?>
					<table>
						<tr>
							<th>Numéro du produit</th>
							<th>Des</th>
							<th>PUHT</th>
						</tr>
				<?php
					$reponse = $bdd->query('SELECT * FROM produits');
					while ($donnees = $reponse->fetch())
					{
				?>
				
						<?php echo "<tr>
							<td>".$donnees['NumProduit']."</td>
							<td>".$donnees['Des']."</td>
							<td>".$donnees['PUHT']."</td>
						</tr>
					<style type='text/css'>
						table
						{
							border-collapse: collapse;
						}
						td, th /* Mettre une bordure sur les td ET les th */
						{
							border: 1px solid black;
						}
					</style>"
					?>
				<?php
					}
				}
				
				if ($_POST['nomTable'] == "_dfacture")
				{
	?>
					<table>
						<tr>
							<th>Quantité</th>
							<th>Numéro de facture</th>
							<th>Numéro du produit</th>
						</tr>
				<?php
					$reponse = $bdd->query('SELECT * FROM d_facture');
					while ($donnees = $reponse->fetch())
					{
				?>
				
						<?php echo "<tr>
							<td>".$donnees['Qte']."</td>
							<td>".$donnees['NumFacture']."</td>
							<td>".$donnees['NumProduit']."</td>
						</tr>
					<style type='text/css'>
						table
						{
							border-collapse: collapse;
						}
						td, th /* Mettre une bordure sur les td ET les th */
						{
							border: 1px solid black;
						}
					</style>"
					?>
				<?php
					}
				}
				
				
			}
				?>
				</table>
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