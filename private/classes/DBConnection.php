<?php
require_once '../php_scripts/KLogger.php';

class DBConnection
{
    public $logger;

    public function __construct()
    {
        $this->$logger = new KLogger("private/log.txt", KLogger::DEBUG);
    }

    private function getConnection()
    {
        //read db login info from file and save to array
        $dbInfo = parse_ini_file("../etc/db.ini");

        //read from array
        $host = $dbInfo['host'];
        $username = $dbInfo['username'];
        $password = $dbInfo['password'];
        $dbName = $dbInfo['name'];

        try
        {
            $db = new PDO("mysql:host={$host};dbname={$dbName}", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $this->$logger->LogDebug("database con made!");
        }

        catch (PDOException $e)
        {
            // $this->logger->LogError("Connection failed: " . $e->getMessage());
        }

        return $db;
    }
    //register function
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
            // $this->$logger->LogWarn("Unable to check if email exists: " . $e-getMessage());
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
            // $this->$logger->LogWarn("Unable to check if username was taken: " . $e-getMessage());
        }
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
            print($e->getMessage());
            // $logger->LogWarn("Unable to register: " . $e-getMessage());
        }

        catch (Exception $e)
        {
            print($e->getMessage());
            // $logger->LogWarn("Unable to register: " . $e-getMessage());
        }
    }

    //login functions
    public function userExists($username, $password)
    {
        $con = $this->getConnection();
        try
        {
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
            $count = $q->rowCount();
            $row = $q->fetch(PDO::FETCH_ASSOC);

            return $row;
        }

        catch (PDOException $e)
        {
            print($e->getMessage());
            // $this->$logger->LogWarn("Unable to check if user exists: " . $e-getMessage());
        }
    }
}
?>
