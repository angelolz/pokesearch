<?php
function searchPokemon() {
    $list = file_get_contents("https://pokeapi.co/api/v2/pokemon-species?offset=0&limit=1000");
    $list = json_decode($list);

    foreach($list->results as $result)
    {
        if(levenshtein(strtolower($_GET['q']), strtolower($result->name), 1, 2, 2) <= 4)
        {
            $matches[] = $result->name;
        }
    }

    if(!isset($matches))
    {
        $errors[] = "No results found! Try checking your spelling and try again.";
        $class = "fail";
    }
}
?>
