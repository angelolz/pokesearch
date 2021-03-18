<?php
require_once '../php_scripts/KLogger.php';

class DBConnection
{
    protected $logger;

    public function __construct()
    {
        $this->logger = new KLogger("../log.txt", KLogger::DEBUG);
    }

    private function getConnection()
    {
        try
        {
            //read db login info from file and save to array
            $dbInfo = parse_ini_file("../etc/db.ini");

            //read from array
            $url = $dbInfo['url'];
            $username = $dbInfo['username'];
            $password = $dbInfo['password'];

            //get connection
            $connection = new PDO($url, $username, $password);
            $this->logger->LogDebug("Successfully connected!");
        }

        catch (PDOException $e)
        {
            $this->logger->LogError("Connection failed: " . $e->getMessage());
        }

        return $connection;
    }

    public function addUser($email, $username, $password)
    {
        $con = $this->getConnection();
        try
        {
            $q = $con->prepare("INSERT INTO Users (email, username, password) VALUES (:email, :username, :password)");
            $q->bindParam(":email", $email);
            $q->bindParam(":username", $username);
            $q->bindParam(":password", $password);
            return $q->execute();
        }

        catch (PDOException $e)
        {
            $logger->LogWarn("Unable to register: " . $e-getMessage());
        }

        catch (Exception $e)
        {
            $logger->LogWarn("Unable to register: " . $e-getMessage());
        }
    }

    public function emailExists($email)
    {
        $con = $this->getConnection();
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
            $this->$logger->LogWarn("Unable to check if email exists: " . $e-getMessage());
        }
    }

    public function usernameTaken($username)
    {
        $con = $this->getConnection();
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
            $this->$logger->LogWarn("Unable to check if username was taken: " . $e-getMessage());
        }
    }

    public function userExists($username, $password)
    {
        $con = $this->getConnection();
        try
        {
            $sql = "";
            if(strpos($username, '@') !== false)
            {
                $sql = "SELECT * FROM Users WHERE email = :username AND password = :password;";
            }

            else
            {
                $sql = "SELECT * FROM Users WHERE username = :username AND password = :password;";
            }

            $q = $con->prepare($sql);
            $q->bindParam(":username", $username);
            $q->bindParam(":password", $password);
            $q->execute();
            $user = $q->fetch();
            return $user;
        }

        catch (PDOException $e)
        {
            $this->$logger->LogWarn("Unable to check if username was taken: " . $e-getMessage());
        }
    }
}
?>
