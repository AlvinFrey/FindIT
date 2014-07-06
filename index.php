<html>


	<head>

		<title>FindIT</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="https://bootflat.github.io/bootflat/css/bootflat.css">
	    <link rel="icon" type="image/png" href="icon.png" />

	</head>

	<body style="background-color: rgb(241, 242, 246);">

	<?php

	 //Initialisation des variables pour la géolocalisation

	   $geoPlugin_array = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
	   $user_lat = $geoPlugin_array['geoplugin_latitude'];
	   $user_lng = $geoPlugin_array['geoplugin_longitude'];

	   $user_lat_arrondis = round($geoPlugin_array['geoplugin_latitude']);
	   $user_lng_arrondis = round($geoPlugin_array['geoplugin_longitude']);

	 //Mise en place de l'API Deezer

	   $app_id = "SECRET_DEFENSE"; //A changer
	   $secret = "DESOLE_VOUS_N'AUREZ_PAS_NOS_CODES :p"; // A changer
				
	   $redirect_uri = "http://tixis-lab.com/FindIT/";
	   $url_oauth = "https://connect.deezer.com/oauth/auth.php?app_id=" . $app_id . "&redirect_uri=".$redirect_uri."&perms=basic_access,email,manage_library,offline_access ";
	   $url_access_token = "http://connect.deezer.com/oauth/access_token.php?app_id=". $app_id ."&secret=". $secret ."&code=". $_GET['code'] ."";

	  //Mise en place du bouton et de l'access_token

	   echo '<center><a href="'. $url_oauth .'"><img src="http://upload.wikimedia.org/wikipedia/fr/0/00/Deezer_logo.png"></img></a></center>';

	   $access_token = file_get_contents($url_access_token);
	   $access_token = str_replace("access_token=", "", $access_token);
	   $access_token = str_replace("&expires=0", "", $access_token);

	  //Si l'access_token est = à wrong code alors on ne fais rien sinon on inclus la page requete.php

	   if ($access_token=="wrong code"){

	            
		            
	   }else{

	     include("requete.php");

	   }

	?>

	<center>

		<u><h3>Social : </h3></u>

		<br/>

		<a href="https://twitter.com/share" class="twitter-share-button" data-text="Je viens de tester un super système pour trouver des places de concert près de chez soi" data-lang="fr" data-size="large">Tweeter</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FTixis%2F140148279427566%3Fref%3Dbr_tf&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=215414585257094" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:80px;" allowTransparency="true"></iframe>
	
	</center>

	</body>

    <script src="https://bootflat.github.io/bootflat/js/icheck.min.js"></script>
    <script src="https://bootflat.github.io/bootflat/js/jquery.fs.selecter.min.js"></script>
    <script src="https://bootflat.github.io/bootflat/js/jquery.fs.stepper.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</htmL>