<?php


define('RACINE_SITE', "http://localhost/Cinema-PHP/");
session_start();
// Alert function
function alert(string $content, string $class): string
{
  return '<div class="d-flex alert alert-' . $class . ' align-items-center w-50 mx-auto"><span class="mx-auto">' . $content . '</span><button type="button" class="btn-close align-self-center position-absolute end-0 top-50" data-bs-dismiss="alert"></button></div>';
}

// Debugging function
function debug($var)
{
  echo '<pre class="bg-light border border-dark p-5 text-danger w-50 fw-bold mt-5">';
  var_dump($var);
  echo '</pre>';
}

// DB connexion function

// We will use the PHP Data Objects (PDO) extension, which defines an excellent interface for accessing a database from PHP and executing SQL queries.
// To connect to the database with PDO, you need to create an instance of this PDO object that represents a connection to the database. To do this, you need to use the class constructor.
// This constructor requires certain parameters:
// We declare environment constants that will contain the information for connecting to the database.

// Server constant
define('DB_HOST', 'localhost');

// Database name constant
define('DB_NAME', 'cinema');

// Database user constant
define('DB_USER', 'root');

// Database password constant
define('DB_PASSWORD', '');

// DSN variable

function dbConnect(): object
{
  $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
  try {
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // echo "Database connection successful";
  } catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
  }

  return $pdo;
}

// Category table
function createCategoryTable(): void
{
  $pdo = dbConnect();
  $sql = "CREATE TABLE IF NOT EXISTS categories (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL, description TEXT NULL
  )";
  $pdo->exec($sql);
}

// createCategoryTable();

// Films table
function createFilmsTable(): void
{
  $pdo = dbConnect();
  $sql = "CREATE TABLE IF NOT EXISTS films (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    director VARCHAR(50) NOT NULL,
    actors VARCHAR(250) NOT NULL,
    ageLimit VARCHAR(5) NULL,
    duration VARCHAR(20) NOT NULL,
    synopsis TEXT NOT NULL,
    date DATE NOT NULL,
    image VARCHAR(250) NOT NULL,
    price FLOAT NOT NULL,
    stock BIGINT NOT NULL,
    category_id INT(11) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id)
  )";
  $pdo->exec($sql);
}

// createFilmsTable();

// Users table
function createUsersTable(): void
{
  $pdo = dbConnect();
  $sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    nickname VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    civility ENUM('m', 'f') NOT NULL,
    birthday DATE NOT NULL,
    address VARCHAR(255) NOT NULL,
    zipcode VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    country VARCHAR(50) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
  )";
  $pdo->exec($sql);
}

// createUsersTable();

// Foreign keys
function createForeignKeys(string $FKTable, string $fKey, string $PKTable, string $pKey): void
{
  $pdo = dbConnect();
  $sql = "ALTER TABLE $FKTable ADD FOREIGN KEY ($fKey) REFERENCES $PKTable($pKey)";
  $pdo->exec($sql);
}

// Check if entered email already exists in the DB
function checkUserEmail(string $email): mixed
{
  $pdo = dbConnect();
  $sql = "SELECT email from USERS WHERE email = :email";
  $request = $pdo->prepare($sql);
  $request->execute(array(
    ':email' => $email
  ));
  $result = $request->fetch();

  return $result;
}

// Check if entered nickname already exists in the DB
function checkUserNickname(string $nickname): mixed
{
  $pdo = dbConnect();
  $sql = "SELECT nickname from USERS WHERE nickname = :nickname";
  $request = $pdo->prepare($sql);
  $request->execute(array(
    ':nickname' => $nickname
  ));
  $result = $request->fetch();

  return $result;
}

// Check if entered email & nickname already exists in the DB
function checkUserEmailNickname(string $email, string $nickname): mixed
{
  $pdo = dbConnect();
  $sql = "SELECT * from USERS WHERE email = :email AND nickname = :nickname";
  $request = $pdo->prepare($sql);
  $request->execute(array(
    ':email' => $email,
    ':nickname' => $nickname
  ));
  $result = $request->fetch();

  return $result;
}

// Add User function
function addUser(string $lastname, string $firstname, string $nickname, string $email, string $phone, string $password, string $civility, string $birthday, string $address, string $zipcode, string $city, string $country): void
{
  // Create an associative array with the names of the fields in the users table as keys
  $data =
    [
      'lastname' => $lastname,
      'firstname' => $firstname,
      'nickname' => $nickname,
      'email' => $email,
      'phone' => $phone,
      'password' => $password,
      'civility' => $civility,
      'birthday' => $birthday,
      'address' => $address,
      'zipcode' => $zipcode,
      'city' => $city,
      'country' => $country,
    ];

  // Escape the data and protect against vulnerabilities
  foreach ($data as $key => $value) {
    $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

  }
  $pdo = dbConnect();
  $sql = "INSERT INTO users (lastname, firstname, nickname, email, phone, password, civility, birthday, address, zipcode, city, country) VALUES (:lastname, :firstname, :nickname, :email, :phone, :password, :civility, :birthday, :address, :zipcode, :city, :country)";

  $request = $pdo->prepare($sql);

  $request->execute($data);
}

function fetchAllUsers(): ?array
{
  $pdo = dbConnect();
  $sql = "SELECT * FROM users";
  $request = $pdo->query($sql);
  $result = $request->fetchAll();

  return $result;
}

// Modify user role
function modifyUserRole(int $userId, string $newRole): void
{
  $pdo = dbConnect();
  $sql = "UPDATE users SET role = :newRole WHERE id = :userId";
  $request = $pdo->prepare($sql);
  $request->execute(array(
    ':userId' => $userId,
    ':newRole' => $newRole
  ));
}

function deleteUser(int $userId): void
{
  $pdo = dbConnect();
  $sql = 'DELETE FROM users WHERE id = :id';
  $request = $pdo->prepare($sql);
  $request->execute(array(
    ':id' => $userId
  ));
}

function addCategory(string $name, string $description): void
{

  $data =
    [
      'name' => $name,
      'description' => $description
    ];

  foreach ($data as $key => $value) {
    $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }

  $pdo = dbConnect();
  $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";
  $request = $pdo->prepare($sql);
  $request->execute($data);
}

function getAllCategories($order = "id"): array
{
  $pdo = dbConnect();
  $sql = "SELECT * FROM categories ORDER BY $order";
  $request = $pdo->prepare($sql);
  $request->execute();
  $result = $request->fetchAll();

  return $result;
}

function getCategoryById(int $id): ?array
{
  $pdo = dbConnect();
  $sql = "SELECT * FROM categories WHERE id = :id";
  $request = $pdo->prepare($sql);
  $request->execute(array(
    ":id" => $id
  ));
  $result = $request->fetch();

  return $result;
}


function updateCategory(int $id, string $name, string $description): void
{
  $pdo = dbConnect();
  $sql = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
  $request = $pdo->prepare($sql);
  $request->execute(array(
    ':id' => $id,
    ':name' => $name,
    ':description' => $description
  ));
}

function deleteCategory(int $id): void
{
  $pdo = dbConnect();
  $sql = 'DELETE FROM categories WHERE id = :id';
  $request = $pdo->prepare($sql);
  $request->execute(array(
    ':id' => $id
  ));
}

function categoryExist(string $name): array
{
  $pdo = dbConnect();
  $sql = 'SELECT * FROM categories WHERE name = :name';
  $request = $pdo->prepare($sql);
  $request->execute(array(
    ':name' => $name
  ));
  $result = $request->fetchAll();

  return $result;
}

// Films functions

function addFilm(string $title, string $director, string $actors, string $ageLimit, string $duration, string $synopsis, string $date, string $image, float $price, int $stock, int $category_id): void
{
  $pdo = dbConnect();
  $sql = 'INSERT INTO films (title, director, actors, ageLimit, duration, synopsis, date, image, price, stock, category_id) VALUES (:title, :director, :actors, :ageLimit, :duration, :synopsis, :date, :image, :price, :stock, :category_id)';
  $request = $pdo->prepare($sql);
  $request->execute(array(
    'title' => $title,
    'director' => $director,
    'actors' => $actors,
    'ageLimit' => $ageLimit,
    'duration' => $duration,
    'synopsis' => $synopsis,
    'date' => $date,
    'image' => $image,
    'price' => $price,
    'stock' => $stock,
    'category_id' => $category_id
  ));
}

function getFilms(): array
{
  $pdo = dbConnect();
  $sql = 'SELECT * FROM films';
  $request = $pdo->query($sql);
  $result = $request->fetchAll();
  return $result;
}

function getFilmById(int $id): ?array
{
  $pdo = dbConnect();
  $sql = "SELECT * FROM films WHERE id = :id";
  $request = $pdo->prepare($sql);
  $request->execute(array(
    ":id" => $id
  ));
  $result = $request->fetch();

  return $result;
}
function updateFilm(string $title, string $director, string $actors, string $ageLimit, string $duration, string $synopsis, string $date, string $image, float $price, int $stock, int $category_id, int $id): void
{
  $pdo = dbConnect();
  $sql = "UPDATE films SET title = :title, director = :director, actors = :actors, ageLimit = :ageLimit, duration = :duration, synopsis = :synopsis, date = :date, image = :image, price = :price, stock = :stock, category_id = :category_id WHERE id = :id";
  $request = $pdo->prepare($sql);
  $request->execute([
    'title' => $title,
    'director' => $director,
    'actors' => $actors,
    'ageLimit' => $ageLimit,
    'duration' => $duration,
    'synopsis' => $synopsis,
    'date' => $date,
    'image' => $image,
    'price' => $price,
    'stock' => $stock,
    'category_id' => $category_id,
    'id' => $id
  ]);
}

// Delete film
function deleteFilm($id): void
{
  $pdo = dbConnect();
  $sql = "DELETE FROM films WHERE id = :id";
  $request = $pdo->prepare($sql);
  $request->execute([':id' => $id]);
}

function logout(): void
{
  session_destroy();
  header("Location:" . RACINE_SITE . "index.php");
  exit;
}
