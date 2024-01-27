<?php
namespace Alura\Pdo\Infrastructure\Repository;

use Alura\Pdo\Domain\Interface\IStudentRepository;
use Alura\Pdo\Domain\Model\Phone;
use Alura\Pdo\Domain\Model\Student;
use PDO;

class StudentRepository implements IStudentRepository
{
  private $student;
  private $conn;

  public function __construct(PDO $connection)
  {
    $this->conn = $connection;
  }

  public function allStudents(): array
  {
    $statement = $this->conn->query('SELECT * FROM students;');

    $response = $statement->fetchAll(PDO::FETCH_ASSOC);
    $studentList = [];

    foreach ($response as $element)
      $studentList[] = new Student($element['id'], $element['name'], new \DateTimeImmutable($element['birth_date']));

    return $studentList;
  }

  public function remove(int $id): bool
  {
    $preparedStatement = $this->conn->prepare('DELETE FROM students WHERE id = ?;');

    $preparedStatement->bindValue(1, $id, PDO::PARAM_INT);

    return $preparedStatement->execute();
  }

  public function save(Student $student): bool
  {
    if (!$student) {
      throw new \Exception("Estudante não encontrado!");
    }

    $sql = "INSERT INTO students (name, birth_date) VALUES (?, ?));";

    $statement = $this->conn->prepare($sql);

    if (!$statement) {
      throw new \Exception("Error Processing Request", 1);
    }

    $statement->bindValue(1, $student->name());
    $statement->bindValue(2, $student->birthDate()->format("Y-m-d"));

    return $statement->execute();
  }

  public function studentsBirthAt(\DateTimeInterface $birthDate): array
  {
    $statement = $this->conn->query('SELECT * FROM students WHERE birth_date = ?;');

    $statement->bindValue(1, $birthDate->format('Y-m-d'));
    $statement->execute();

    return $this->hydrateStudentList($statement);
  }

  private function hydrateStudentList(\PDOStatement $statement): array
  {
    $studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);

    $studentList = [];

    foreach ($studentDataList as $element) {
      $studentList[] = new Student($element['id'], $element['name'], new \DateTimeImmutable($element['birth_date']));
    }

    return $studentList;
  }

  private function phillPhonesOf(Student $student): void
  {
    $sql = 'SELECT id, area_code, number FROM phones WHERE student_id = ?';

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(1, $student->id(), PDO::PARAM_INT);
    $stmt->execute();

    $phoneDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($phoneDataList as $data) {
      echo $data;
    }
  }

  public function studentsWithPhones(): array
  {
    $sql = '
      SELECT * FROM students JOIN phones on students.id = phones.student_id;
    ';

    $stmt = $this->conn->query($sql);
    $result = $stmt->fetchAll();
    $list = [];

    foreach ($result as $row) {
      if (!array_key_exists($row['id'], $list)) {
        $list[$row['id']] = new Student($row['id'], $row['name'], new \DateTimeImmutable($row['birth_date']));
      }

      $phone = new Phone($row['phone_id'], $row['area_code'], $row['number']);
      $list[$row['id']]->addPhone($phone);
    }

    return $list;
  }
}