<?php
// src/Controller/MapController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MapController extends AbstractController
{
	#[Route('/map/{slug}')]
    public function showmap($slug = null): Response
    {
		dump($slug);
        $number = random_int(0,100);

		if (is_null($slug)){
			$location = ["Tallinn", "58.850304,25.476789"];
			$coords = "59.437332, 24.745199";
			$place = "Tallinn";
			
		}
		else{
		
			// Open the file for reading
			if (($handle = fopen('coords.txt', 'r')) !== false) {
				$data = []; // Initialize an empty array
				// Loop through each line of the file
				while (($line = fgetcsv($handle, 0, "\t")) !== false) {
					$data[] = $line; // Add each row as an indexed array
		}
			fclose($handle); // Close the file
			}
			dump($data);
			
			// set as default if no match
			$coords = "59.434358,24.742334";
			$place = "Tallinn";
			for ($i = 0; $i < count($data); $i++) {
				if ($data[$i][0] == $slug){
					dump($data[$i][1]);
					$coords = $data[$i][1];
					$place = $data[$i][0];
					}
			}

			$places = [$coords, $place];
			dump($places);
		}
		
		
		$places = [$coords, $place];
		dump($places);

		return $this->render('map/map.html.twig', [
			'message' => $places,
			]);
    }
}