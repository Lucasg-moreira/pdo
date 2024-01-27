<?php
require_once "vendor/autoload.php";

use Alura\Pdo\Infrastructure\Persistance\ConnectionFactory;
use Alura\Pdo\Infrastructure\Repository\StudentRepository;

$connection = ConnectionFactory::createConnection();
$studentRepository = new StudentRepository($connection);

var_dump($studentRepository->studentsWithPhones());
