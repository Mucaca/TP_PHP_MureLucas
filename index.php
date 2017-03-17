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
		<h1>Connexion</h1>
		<?php
			include('menu.html');
			echo ('</br>')
		?>
	
		<?php
		if (!isset($_SESSION['id']) AND !isset($_SESSION['pseudo']))
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
		
		<?php
			if (isset($_POST['_pseudo']) AND (isset($_POST['_pass'])))
			{
				// Hachage du mot de passe
				$pass_hache = sha1($_POST['_pass']);

				// Vérification des identifiants
				$req = $bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo AND pass = :pass');
				$req->execute(array(
					'pseudo' => $_POST['_pseudo'],
					'pass' => $pass_hache));

				$resultat = $req->fetch();

				if (!$resultat)
				{
					echo 'Mauvais identifiant ou mot de passe !</br>';
					echo 'Réessayer : <a href="index.php">Accueil</a>';
				}
				else
				{
					$_SESSION['id'] = $resultat['id'];
					$_SESSION['pseudo'] = $_POST['_pseudo'];
					echo 'Vous êtes connecté !</br>';
				}
			}
			else
			{
				include('login.html');
			}

		?>
		<?php
		}
		else
		{
			echo 'Vous êtes connecté !</br>';
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