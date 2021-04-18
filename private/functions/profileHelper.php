<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
require_once CLASSES_PATH . "/DBConnection.php";

//profile functions
function addTeam($userId, $teamName)
{
    $db = new DBConnection();
    $con = $db->getConnection();
    try
    {
        $q = $con->prepare("INSERT INTO Team (owner, team_name) VALUES (:user_id, :teamname)");
        $q->bindParam(":user_id", $userId);
        $q->bindParam(":teamname", $teamName);
        $finished = $q->execute();


        if($finished)
        {
            $q = $con->prepare('SELECT team_id, owner FROM Team WHERE owner = :userId ORDER BY team_id DESC');
            $q->bindParam(":userId", $userId);
            $q->execute();

            $latestTeam = $q->fetch(PDO::FETCH_ASSOC);
            return $latestTeam;
        }

        else return $finished;
    }

    catch (PDOException $e)
    {
        $db->logger->LogWarn("Unable to register: " . $e->getMessage());
    }

    catch (Exception $e)
    {
        $db->logger->LogWarn("Unable to register: " . $e->getMessage());
    }
}

function addPokemon($teamId, $pkmnName, $move1, $move2, $move3, $move4)
{
    $db = new DBConnection();
    $con = $db->getConnection();
    try
    {
        $q = $con->prepare("INSERT INTO Moves (move1, move2, move3, move4) VALUES (:move1, :move2, :move3, :move4)");
        $q->bindParam(":move1", $move1);
        $q->bindParam(":move2", $move2);
        $q->bindParam(":move3", $move3);
        $q->bindParam(":move4", $move4);
        $db->logger->LogInfo("attempting to insert into Moves...");
        $insertedMoveset = $q->execute();

        if($insertedMoveset)
        {
            $q = $con->prepare('SELECT * FROM Moves WHERE moveset_id = (SELECT LAST_INSERT_ID())');
            $q->execute();

            $latestMoveset = $q->fetch(PDO::FETCH_ASSOC);
            $db->logger->LogInfo("latestmovesetId: " . $latestMoveset['moveset_id']);

            $q = $con->prepare("INSERT INTO Pokemon (pokemon_name, team_id, moveset_id) VALUES (:name, :teamId, :movesetId)");
            $q->bindParam(":name", $pkmnName);
            $q->bindParam(":teamId", $teamId);
            $q->bindParam(":movesetId", $latestMoveset['moveset_id']);
            $q->execute();
        }

        return $insertedMoveset;
    }

    catch (PDOException $e)
    {
        $db->logger->LogWarn("Unable to add Pokémon: " . $e->getMessage());
    }

    catch (Exception $e)
    {
        $db->logger->LogWarn("Unable to add Pokémon: " . $e->getMessage());
    }
}

function getTeam($teamId)
{
    $db = new DBConnection();
    $con = $db->getConnection();
    try
    {
        $sql = "SELECT * FROM Team WHERE team_id = :teamId";

        $q = $con->prepare($sql);
        $q->bindParam(":teamId", $teamId);
        $q->execute();
        $team = $q->fetchAll(PDO::FETCH_ASSOC);

        return $team;
    }

    catch (PDOException $e)
    {
        $db->logger->LogWarn("Unable to get user's teams: " . $e->getMessage());
    }
}

function getTeams($userId)
{
    $db = new DBConnection();
    $con = $db->getConnection();
    try
    {
        $sql = "SELECT * FROM Team WHERE owner = :userId";

        $q = $con->prepare($sql);
        $q->bindParam(":userId", $userId);
        $q->execute();
        $teams = $q->fetchAll(PDO::FETCH_ASSOC);

        return $teams;
    }

    catch (PDOException $e)
    {
        $db->logger->LogWarn("Unable to get user's teams: " . $e->getMessage());
    }
}

function getPokemon($teamId)
{
    $db = new DBConnection();
    $con = $db->getConnection();
    try
    {
        $sql = "SELECT * FROM Pokemon WHERE team_id = :teamId";

        $q = $con->prepare($sql);
        $q->bindParam(":teamId", $teamId);
        $q->execute();
        $pokemonList = $q->fetchAll(PDO::FETCH_ASSOC);

        return $pokemonList;
    }

    catch (PDOException $e)
    {
        $db->logger->LogWarn("Unable to get user's teams: " . $e->getMessage());
    }
}

function getMoveSet($movesetId)
{
    $db = new DBConnection();
    $con = $db->getConnection();
    try
    {
        $sql = "SELECT * FROM Moves WHERE moveset_id = :movesetId";

        $q = $con->prepare($sql);
        $q->bindParam(":movesetId", $movesetId);
        $q->execute();
        $moveset = $q->fetchAll(PDO::FETCH_ASSOC);

        return $moveset;
    }

    catch (PDOException $e)
    {
        $db->logger->LogWarn("Unable to get pokemon's moveset: " . $e->getMessage());
    }
}
?>
