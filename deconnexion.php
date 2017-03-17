<?php 
				session_start();

				// Suppression des variables de session et de la session
				$_SESSION = array();
				session_destroy();

				// Suppression des cookies de connexion automatique
				setcookie('login', '');
				setcookie('pass_hache', '');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> <?php echo date('d/m/Y h:i:s'); ?> </title>
    </head>
    <body>
		<h1>Déconnexion</h1>
			<?php include('menu.html');
			echo ('</br>');
			
			echo ('Vous avez bien été déconnecté');?>
	</body>
		<footer>
		<?php
			echo ('</br>');
			include('footer.html');
		?>
	</footer>

</html>