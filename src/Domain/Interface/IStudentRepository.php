<?php

namespace Alura\Pdo\Domain\Interface;
use Alura\Pdo\Domain\Model\Student;

interface IStudentRepository {
  public function allStudents(): array;
  public function studentsBirthAt(\DateTimeInterface $birthDate): array;
  public function studentsWithPhones(): array;
  public function save(Student $student): bool;
  public function remove(int $id): bool;
}