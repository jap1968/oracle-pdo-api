<?php

class Handler {

  // ***************************************************************************

  protected $tag;
  protected $logger;
  protected $dbh;

  function __construct($app) {
    $this->tag = 'DB_Handler';
    $this->logger = $app->logger;
    $this->logger->info($this->tag);
    $dbh = $this->connectDB();
    $this->dbh = $dbh;
  }

  function __destruct() {
    $this->dbh = null;
  }

  // ***************************************************************************

  function connectDB() {
    $tag = "{$this->tag}->connectDB()";
    $this->logger->info($tag);
    $dbType = 'oci';

    $dbName = getenv('DBNAME');
    $dbUser = getenv('DBUSER');
    $dbPassword = getenv('DBPASSWORD');
    $dsn = "{$dbType}:dbname={$dbName};charset=UTF8";

    try {
      $this->dbh = new PDO($dsn, $dbUser, $dbPassword);
    } catch (PDOException $e) {
      $this->logger->error("{$tag}: {$e->getMessage()}");
      $this->dbh = null;
    }

    return $this->dbh;
  }

  // ***************************************************************************

  function getPlayerItems($idPlayer) {
    $tag = "{$this->tag}->getPlayerItems({$idPlayer})";
    $this->logger->info($tag);

    $sql = '
      SELECT *
      FROM items
      WHERE idPlayer = :idPlayer
    ';

    try {
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute(array(':idPlayer' => $idPlayer));
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      $this->logger->error("{$tag}: {$e->getMessage()}", $stmt->errorInfo());
      $result = false;
    }

    if ($stmt) {
      $stmt->closeCursor();
    }

    return $result;
  }

  // ***************************************************************************

}
