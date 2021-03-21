<?php
require_once __DIR__ . '/vendor/autoload.php';
use PokeAPI\Client;

$client = new Client();

// Returns a PokeAPI\Pokemon\Species instance
$species = $client->species('bulbasaur'); // or $client->species(1);

print($species->getName()); // 'bulbasaur'
$growthRate = $species->getGrowthRate(); // A proxy of PokeAPI\Pokemon\GrowthRate

$growthRate->getName(); // Here the real API call to the GrowthRate endpoint is made
