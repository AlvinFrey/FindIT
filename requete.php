<meta charset="utf-8">

<center>

<?php

	 //Initialisation des requêtes pour les artistes de Deezer

	 $url_requete_artistes = "http://api.deezer.com/user/me/artists?access_token=" . $access_token;
	 $requete_artistes = file_get_contents($url_requete_artistes);
	 $requete_json_artistes = json_decode($requete_artistes);

	 //Mise en place de la boucle pour récupérer tout les artistes et les tester	

	 $count_artistes = $requete_json_artistes->total;
	 $count_artistes = $count_artistes-2;
	 $i = -1;

	 //Tant que $i est inférieur ou égal à $count_artistes alors on fetch les valeurs des artistes 

	  while($i<=$count_artistes){

	 	$i = $i+1;

	 	$artistes_nom = $requete_json_artistes->data[$i]->name;

	 	$artistes_image = $requete_json_artistes->data[$i]->picture;

	 	$array_artistes = array(

	 		"nom" => $artistes_nom,

	 		"image" => $artistes_image,

	 	);

	 	//Mise en place de l'API Songkick

		$url_requete_songkick = "http://api.songkick.com/api/3.0/events.json?apikey=API_SONGKICK&artist_name=".$artistes_nom."";
		$sortie_songkick = file_get_contents($url_requete_songkick);
		$sortie_songkick_json = json_decode($sortie_songkick);
		$count_songkick = $sortie_songkick_json->resultsPage->totalEntries;
   		$count_songkick = $count_songkick-2;
   		$i_songkick = 0;

   		while ($i_songkick <= $count_songkick){

   			$i_songkick=$i_songkick+1;

			$concerts_titre =  $sortie_songkick_json->resultsPage->results->event[$i_songkick]->displayName;
		   	$concerts_lieu =  $sortie_songkick_json->resultsPage->results->event[$i_songkick]->location->city;
		   	$concerts_date =  $sortie_songkick_json->resultsPage->results->event[$i_songkick]->start->date;
		   	$concerts_heure =  $sortie_songkick_json->resultsPage->results->event[$i_songkick]->start->time;
		   	$concerts_lat =  $sortie_songkick_json->resultsPage->results->event[$i_songkick]->location->lat;
		   	$concerts_long =  $sortie_songkick_json->resultsPage->results->event[$i_songkick]->location->lng;
		   	$concerts_uri =  $sortie_songkick_json->resultsPage->results->event[$i_songkick]->uri;

		   	$array_concerts = array(

		   	 		"titre" => $concerts_titre,

		   	 		"lieu" => $concerts_lieu,

		   	 		"date" => $concerts_date,

		   	 		"heure" => $concerts_heure,

		   	 		"latitude" => $concerts_lat,

		   	 		"longitude" => $concerts_long,

		   	 		"lien" => $concerts_uri,

		   	);

		   	$concerts_lat = round($concerts_lat);
			$concerts_long = round($concerts_long);

	 		if($concerts_titre!=NULL){

	 			echo '<u><h1>'.$artistes_nom.' : </h1></u>';

	 			echo '<img src='.$artistes_image.'></img>';

			    echo '<br/>';
			 	
			 	echo '<br/>';

	 			echo '<p>Le concert ('.$concerts_titre.') sera le '.$concerts_date.' à '.$concerts_heure.' et se trouvera à '.$concerts_lieu.'</p>';
	 			
	 			echo '<br/>';

	 			echo '<img style="max-width: 100%;height: auto;-webkit-border-radius: 15px;-moz-border-radius: 15px;border-radius: 15px;" border="0" src=http://maps.googleapis.com/maps/api/staticmap?center='.$concerts_lat.','.$concerts_long.'&zoom=13&size=600x300&maptype=roadmap&markers=color:blue|label:S|'.$concerts_lat.','.$concerts_long.'></img>';		

	 			echo '<br/>';

	 			echo '<br/>';

	 			echo '<a href="'.$concerts_uri.'"><p>Réserver une place</p></a>';
				
				echo '<a href="https://www.google.fr/maps/dir/'. $ville_user .'/'. $sortie_songkick_json->resultsPage->results->event[$i_songkick]->location->city .'/am=t/data=!4m13!4m12!1m5!1m1!1"><p>Itinéraire pour aller à ce concert</p></a>';

				if($concerts_lat==$user_lat_arrondis&&$concerts_long==$user_lat_arrondis){

					function distance($lat1, $long1, $lat2, $long2){


						$theta = $long1 - $long2;

						$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
						$dist = acos($dist);
						$dist = rad2deg($dist);

						$km = $dist * 60 * 1.1515;

						return($km * 1.609344);

					}

					echo '<u style="color : red;"><h4 style="color : red;"><img src="http://findicons.com/files/icons/1034/elementary/16/emblem_danger.png"></img> Ce concert se trouve près de chez vous (';echo round(distance($user_lat, $user_lng, $concerts_lat, $concerts_long)) . ' Km )<img src="http://findicons.com/files/icons/1034/elementary/16/emblem_danger.png"></img></h4></u>';

				}

			    echo '<hr>';

			 }

	 }

}

?>

</center>