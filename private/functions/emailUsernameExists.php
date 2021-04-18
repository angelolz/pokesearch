<?php
function emailExists($email)
{
    $con = $dbc->getConnection();
    try
    {
        $q = $con->prepare("SELECT EXISTS(SELECT * FROM Users WHERE email = :email) AS 'exists'");
        $q->bindParam(":email", $email);
        $q->execute();

        $exists = $q->fetch(PDO::FETCH_ASSOC);
        return $exists;
    }

    catch (PDOException $e)
    {
        $logger->LogWarn("Unable to check if email exists: " . $e->getMessage());
    }
}

function usernameTaken($username)
{
    $con = $dbc->getConnection();
    try
    {
        $q = $con->prepare("SELECT EXISTS(SELECT * FROM Users WHERE username = :username) AS 'exists'");
        $q->bindParam(":username", $username);
        $q->execute();

        $exists = $q->fetch(PDO::FETCH_ASSOC);
        return $exists;
    }

    catch (PDOException $e)
    {
        $logger->LogWarn("Unable to check if username was taken: " . $e->getMessage());
    }
}
?>
