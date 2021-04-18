<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
require_once 'KLogger.php';

class DBConnection
{
    public $logger;

    public function __construct()
    {
        $this->logger = new KLogger(LOG_PATH . "/log.txt", KLogger::DEBUG);
    }

    public function getConnection()
    {
        //if in heroku
        if(getenv("HEROKU") == 1)
        {
            $host = getenv("HOST");
            $username = getenv("USERNAME");
            $password = getenv("PASSWORD");
            $dbName = getenv("DBNAME");
        }

        //if not in heroku
        else
        {
            $dbInfo = parse_ini_file(PRIVATE_PATH . "/db.ini");

            //read from array
            $host = $dbInfo['host'];
            $username = $dbInfo['username'];
            $password = $dbInfo['password'];
            $dbName = $dbInfo['name'];
        }


        try
        {
            $db = new PDO("mysql:host={$host};dbname={$dbName}", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->logger->LogDebug("database connection made!");
        }

        catch (PDOException $e)
        {
            $this->logger->LogError("Connection failed: " . $e->getMessage());
        }

        return $db;
    }

    //register functions
    public function addUser($email, $username, $password)
    {
        $securePassword = password_hash($password, PASSWORD_BCRYPT);
        $con = $this->getConnection();
        try
        {
            $q = $con->prepare("INSERT INTO Users (email, username, password) VALUES (:email, :username, :password)");
            $q->bindParam(":email", $email);
            $q->bindParam(":username", $username);
            $q->bindParam(":password", $securePassword);

            return $q->execute();
        }

        catch (PDOException $e)
        {
            $this->logger->LogWarn("Unable to register: " . $e->getMessage());
        }

        catch (Exception $e)
        {
            $this->logger->LogWarn("Unable to register: " . $e->getMessage());
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
                $sql = "SELECT * FROM Users WHERE email = :username";
            }

            else
            {
                $sql = "SELECT * FROM Users WHERE username = :username";
            }

            $q = $con->prepare($sql);
            $q->bindParam(":username", $username);
            $q->execute();
            $row = $q->fetch(PDO::FETCH_ASSOC);

            if(password_verify($password, $row['password']))
            {
                return $row;
            }
        }

        catch (PDOException $e)
        {
            $this->logger->LogWarn("Unable to check if user exists: " . $e->getMessage());
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
            $this->logger->LogWarn("Unable to check if email exists: " . $e->getMessage());
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
            $this->logger->LogWarn("Unable to check if username was taken: " . $e->getMessage());
        }
    }
}
?>
