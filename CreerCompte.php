<?php
	session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> <?php echo date('d/m/Y h:i:s'); ?> </title>
    </head>
    <body>
		<?php
			$estLog = false;
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=facturef2b;charset=utf8', 'root', '');
			}
			catch(Exception $e)
			{
				die('Erreur :'.$e->getMessage());
			}
		?>
		<h1>Créer un compte</h1>
			<?php include('menu.html');
			echo ('</br>')?>
		
		<form action="CreerCompte.php" method="post">
			<p>Login : 			<input type="text" name="_pseudo"/></p>
			<p>Mot de passe : 	<input type="password" name="_pass"/></p>
			<p>Email : 			<input type="text" name="_email"/></p>
			<p><input type="submit" value="Valider" /></p>
		</form>
		
		<?php 
		if (isset($_POST['_pseudo']) AND (isset($_POST['_pass'])) AND (isset($_POST['_email'])))
		{
			try
			{
			// Vérification de la validité des informations

			// Hachage du mot de passe
			$pass_hache = sha1($_POST['_pass']);

			// Insertion
			$req = $bdd->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
			$req->execute(array(
				'pseudo' => $_POST['_pseudo'],
				'pass' => $pass_hache,
				'email' => $_POST['_email']));
				
				echo ('</br>compte ajouté</br>');
			}
			catch(Exception $e)
			{
				die('Erreur :'.$e->getMessage());
			}
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