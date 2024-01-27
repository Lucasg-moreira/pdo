<?php

namespace Alura\Pdo\Infrastructure\Persistance;

use PDO;

class ConnectionFactory {
  public static function createConnection(): PDO { 
    $pathDb = __DIR__ . "../../../../db.sqlite";

    $connection = new PDO("sqlite:" . $pathDb);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connection;
  }
}