<?php
require_once "vendor/autoload.php";

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistance\ConnectionFactory;
use Alura\Pdo\Infrastructure\Repository\StudentRepository;

$connection = ConnectionFactory::createConnection();
$studentRepository = new StudentRepository($connection);

$connection->beginTransaction();
try {
  $student = new Student(null, 'nico sadfkl', new DateTimeImmutable('2014-10-12'));
  $studentRepository->save($student);

  $student_1 = new Student(null, 'vaid a errodfkl', new DateTimeImmutable('2014-10-12'));
  $studentRepository->save($student_1);
  $connection->commit();
} catch (\PDOException $e) {
  echo $e->getMessage();
  $connection->rollBack();
}
