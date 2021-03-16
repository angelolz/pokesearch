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
}
?>
