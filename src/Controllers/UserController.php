<?php
require_once __DIR__ . '/../Core/BaseController.php';
require_once __DIR__ . '/../../init.php';
require_once __DIR__ . '/../Core/BaseModel.php';
require_once __DIR__ . '/../Models/UserModel.php';

class UserController extends BaseController
{
  protected $model;
  protected $users;
  public function __construct()
  {
    $this->model = new BaseModel();
    $this->users = new UserModel();
  }
  public function index()
  {
    $users = $this->users->getUsers();
    require BASE_DIR . '/src/Views/users/index.php';
  }

  public function create()
  {
    require_once BASE_DIR . '/src/Views/create/index.php';
  }

  public function save()
  {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];

      if ($name == '') {
        $_SESSION['nameError'] = "Пароль не может быть пустым";
      }

      if ($email == '') {
        $_SESSION['emailError'] = "Почта не может быть пустой";
      }

      if ($phone == '') {
        $_SESSION['phoneErorr'] = 'Телефон не может быть пустым';
      }

      try {
        $stmt = $this->model->prepare("INSERT INTO users (name, email, phone) VALUES (:name, :email, :phone)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        header('Location: /');
      } catch (PDOException $e) {
        echo "Ошибка подключения или выполнения запроса: " . $e->getMessage();
      }
    }
  }

  public function edit()
  {
    $id = $_GET['id'] ?? null;
    if ($id === null) {
      echo "ID не указан";
      return;
    }

    $stmt = $this->model->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    require_once BASE_DIR . '/src/Views/edit/index.php';
  }
  public function saveEdit()
  {
    session_start();

    if (isset($_POST['id'], $_POST['name'], $_POST['email'], $_POST['phone'])) {
      $id = (int)$_POST['id'];
      $name = trim($_POST['name']);
      $email = trim($_POST['email']);
      $phone = trim($_POST['phone']);

      $hasError = false;

      if ($name === '') {
        $_SESSION['errorName'] = "Имя не может быть пустым";
        $hasError = true;
      }

      if ($email === '') {
        $_SESSION['errorEmail'] = "Почта не может быть пустой";
        $hasError = true;
      }

      if ($phone === '') {
        $_SESSION['errorPhone'] = "Телефон не может быть пустым";
        $hasError = true;
      }

      if ($hasError) {
        $_SESSION['oldName'] = $name;
        $_SESSION['oldEmail'] = $email;
        $_SESSION['oldPhone'] = $phone;

        header("Location: /user/edit?id=$id");
        exit;
      }

      $stmt = $this->model->prepare("UPDATE users SET name = :name, email = :email, phone = :phone WHERE id = :id");
      $stmt->execute([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'id' => $id,
      ]);

      unset($_SESSION['errorName'], $_SESSION['errorEmail'], $_SESSION['errorPhone']);
      unset($_SESSION['oldName'], $_SESSION['oldEmail'], $_SESSION['oldPhone']);

      header("Location: /");
      exit;
    } else {
      echo "Данные не получены";
    }
  }

  public function delete()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405);
      echo "Метод должен быть POST";
      exit;
    }

    if (empty($_POST['id'])) {
      echo "ID не указан";
      exit;
    }

    $id = (int)$_POST['id'];

    $stmt = $this->model->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);

    if ($stmt->rowCount() > 0) {
      header('Location: /');
      exit;
    } else {
      echo "Пользователь не найден или не удалён";
    }
  }
}
