<?php
require_once "vendor/autoload.php";

use Alura\Pdo\Infrastructure\Persistance\ConnectionFactory;

$connection = ConnectionFactory::createConnection();

$createTableSql = '
  CREATE TABLE IF NOT EXISTS students (
    id integer primary key,
    name text,
    birth_date text
  );

  CREATE TABLE IF NOT EXISTS phones (
    id integer primary key,
    area_code text,
    number text,
    student_id integer,
    foreign key (student_id) references students(id)
  );
';

$connection->exec($createTableSql);
