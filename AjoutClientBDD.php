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
        <h1>Ma page web</h1>
		<?php include('menu.html');?>
		
		
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
			?>
			
			<form action="AjoutClientBDD.php" method="post">
				<p>Nom du Client : <input type="text" name="_NomClient"/></br></p>
				<p>Prénom du Client : <input type="text" name="_PrenomClient"/></br></p>
				<p>Adresse du Client : <input type="text" name="_AdresseClient"/></br></p>
				<p>Code Postal du Client : <input type="text" name="_Cp"/></br></p>
				<p>Ville du Client : <input type="text" name="_VilleClient"/></br></p>
				<p>Pays du Client : <input type="text" name="_PaysClient"/></br></p>
				<p><input type="submit" value="Valider" /></p>
			</form>
			
			<?php
			if (isset($_POST['_NomClient']) OR isset($_POST['_PrenomClient']) OR isset($_POST['_AdresseClient']) OR isset($_POST['_Cp']) OR isset($_POST['_VilleClient']) OR isset($_POST['_PaysClient']))
			{
				$req = $bdd->prepare('INSERT INTO client(NomClient, PrenomClient,AdresseClient, Cp, VilleClient, PaysClient) VALUES(:nomclient, :prenomclient, :adresseclient, :cp, :villeclient, :paysclient)');
				$req->execute(array(
					'nomclient' => $_POST['_NomClient'],
					'prenomclient' => $_POST['_PrenomClient'],
					'adresseclient' => $_POST['_AdresseClient'],
					'cp' => $_POST['_Cp'],
					'villeclient' => $_POST['_VilleClient'],
					'paysclient' => $_POST['_PaysClient']
					));

				echo 'Le client a bien été ajouté !</br>';
			}
		?>
<!--//=======================================================================================================================================================================   -->	


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