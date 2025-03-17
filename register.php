<?php
require_once 'inc/functions.inc.php';

if (isset($_SESSION['user'])) {
  header("location:profile.php");
}

$info = "";

if (!empty($_POST)) {
  $check = true;
  foreach ($_POST as $key => $value) {
    if (empty(trim($value))) {
      $check = false;
    }
  }
  if ($check === false) {
    $info .= alert("Please fill in all the form's fields", "danger");
  } else {
    // LASTNAME 
    if (!isset($_POST['lastname']) || strlen(trim($_POST['lastname'])) < 2 || strlen(trim($_POST['lastname'])) > 50) {
      $info .= alert("Lastname is invalid", "danger");
    }

    //  FIRSTNAME 
    if (!isset($_POST['firstname']) || strlen(trim($_POST['firstname'])) < 2 || strlen(trim($_POST['firstname'])) > 50) {
      $info .= alert("Firstname is invalid", "danger");
    }

    // NICKNAME
    if (!isset($_POST['nickname']) || strlen(trim($_POST['nickname'])) < 3 || strlen(trim($_POST['nickname'])) > 50) {
      $info .= alert("Nickname is invalid", "danger");
    }

    // EMAIL
    if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 5 || strlen(trim($_POST['email'])) > 100 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $info .= alert("Email is invalid", "danger");
    }


    // PHONE 
    $regexPhone = "/^[0-9]{10}$/";
    if (!isset($_POST['phone']) || !preg_match($regexPhone, $_POST['phone'])) { // je vérifier si le téléphone contien 10 chiffres
      $info .= alert("Phone number is invalid", "danger");
    }

    $regexMdp = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';


    // PASSWORD & CONFIRM PASSWORD
    if ($password !== $confirmPassword) {
      $info .= alert("Passwords do not match", "danger");
    } else {
      if (!isset($_POST['password']) || !preg_match($regexMdp, $_POST['password'])) {
        $info .= alert("Password is invalid", "danger");
      }
    }

    //  CIVILITY 
    if (!isset($_POST['civility']) || !in_array($_POST['civility'], ['m', 'f'])) {
      $info .= alert("Civility is invalid", "danger");
    }

    // BIRTHDAY 
    $year1 = ((int) date('Y')) - 13; // 2012
    $year2 = ((int) date('Y')) - 90; // 1935
    $birthdayYear = explode('-', $_POST['birthday']);

    if (!isset($_POST['birthday']) || (int) $birthdayYear[0] > $year1 || (int) $birthdayYear[0] < $year2) {
      $info .= alert("Birthday is invalid", "danger");
    }

    // ADDRESS 
    if (!isset($_POST['address']) || strlen(trim($_POST['address'])) < 5 || strlen(trim($_POST['address'])) > 50) {
      $info .= alert("Address is invalid", "danger");
    }

    // ZIPCODE
    if (!isset($_POST['zipcode']) || !preg_match('/^[0-9]{5}$/', $_POST['zipcode'])) {
      $info .= alert("Zipcode is invalid", "danger");
    }

    // CITY 
    if (!isset($_POST['city']) || strlen(trim($_POST['city'])) < 5 || strlen(trim($_POST['city'])) > 50) {
      $info .= alert("City is invalid", "danger");
    }

    // COUNTRY 
    if (!isset($_POST['country']) || strlen(trim($_POST['country'])) < 5 || strlen(trim($_POST['country'])) > 50) {
      $info .= alert("Country is invalid", "danger");
    }

    if (empty($info)) {
      $info = alert("Your form has been sent successfuly", 'success');

      $lastname = trim($_POST['lastname']);
      $firstname = trim($_POST['firstname']);
      $nickname = trim($_POST['nickname']);
      $email = trim($_POST['email']);
      $phone = trim($_POST['phone']);
      $password = trim($_POST['password']);
      $confirmPassword = trim($_POST['confirmPassword']);
      $civility = trim($_POST['civility']);
      $birthday = trim($_POST['birthday']);
      $address = trim($_POST['address']);
      $zipcode = trim($_POST['zipcode']);
      $city = trim($_POST['city']);
      $country = trim($_POST['country']);

      $passHash = password_hash($password, PASSWORD_DEFAULT);
      // Cette fonction PHP crée un hachage sécurisé d'un mot de passe en utilisant un algorithme de hachage fort : génère une chaîne de caractères unique à partir d'une entrée. C'est un mécanisme unidirectionnel dont l'utilité est d'empêcher le déchiffrement d'un hash. Lors de la connexion, il faudra comparer le hash stocké dans la base de données avec celui du mot de passe fourni par l'internaute.
      // PASSWORD_DEFAULT : constante indique à password_hash() d'utiliser l'algorithme de hachage par défaut actuel c'est le plus recommandé car elle garantit que le code utilisera toujours le meilleur algorithme disponible sans avoir besoin de modifications.
      // debug($passHash);

      $emailAlreadyExist = checkUserEmail($email);
      $nicknameAlreadyExist = checkUserNickname($nickname);
      $userAlreadyExist = checkUserEmailNickname($email, $nickname);

      if ($emailAlreadyExist) { // email exists in the DB
        $info .= alert("Email already in use", "warning");
      } elseif ($nicknameAlreadyExist) { // nickname exists in the DB
        $info .= alert("Nickname already in use", "warning");
      }
      if ($userAlreadyExist) { // Both email & nickmane are from the same users in the DB
        $info .= alert("User already exists in Database! Login <a href='auth.php' class='text-danger fw-bold'>here</a>", "warning");
      } else {
        addUser($lastname, $firstname, $nickname, $email, $phone, $passHash, $civility, $birthday, $address, $zipcode, $city, $country);
        $info .= alert("Registration successful, you can login <a href='auth.php' class='text-danger fw-bold'>here</a>", "success");
        header("location:auth.php");
        exit;
      }
    }
  }
}


require_once 'inc/header.inc.php';
?>


<div class="w-75 m-auto p-5" style="background: rgba(20, 20, 20, 0.9);">
  <h2 class="text-center mb-5 p-3">Create an account</h2>
  <?= $info; ?>

  <form action="" method="post" class="p-5">
    <div class="row mb-3">
      <div class="col-md-6 mb-5">
        <label for="lastName" class="form-label mb-3">Lastname</label>
        <input type="text" class="form-control fs-5" id="lastname" name="lastname">
      </div>
      <div class="col-md-6 mb-5">
        <label for="firstName" class="form-label mb-3">Firstname</label>
        <input type="text" class="form-control fs-5" id="firstname" name="firstname">
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 mb-5">
        <label for="pseudo" class="form-label mb-3">Nickname</label>
        <input type="text" class="form-control fs-5" id="nickname" name="nickname">
      </div>
      <div class="col-md-4 mb-5">
        <label for="email" class="form-label mb-3">Email</label>
        <input type="text" class="form-control fs-5" id="email" name="email" placeholder="exemple.email@exemple.com">
      </div>
      <div class="col-md-4 mb-5">
        <label for="phone" class="form-label mb-3">Phone</label>
        <input type="text" class="form-control fs-5" id="phone" name="phone">
      </div>

    </div>
    <div class="row mb-3">
      <div class="col-md-6 mb-5">
        <label for="password" class="form-label mb-3">Password</label>
        <input type="password" class="form-control fs-5" id="password" name="password"
          placeholder="Entrer votre mot de passe">
      </div>
      <div class="col-md-6 mb-5">
        <label for="confirmMdp" class="form-label mb-3">Confirm password</label>
        <input type="password" class="form-control fs-5 mb-3" id="confirmPassword" name="confirmPassword"
          placeholder="Confirmer votre mot de passe ">
        <input type="checkbox" id="showHide"> <span class="text-danger">Show/hide password</span>
      </div>


    </div>
    <div class="row mb-3">
      <div class="col-md-6 mb-5">
        <label class="form-label mb-3">Civility</label>
        <select class="form-select fs-5" name="civility">
          <option value="m">Male</option>
          <option value="f">Female</option>
        </select>
      </div>
      <div class="col-md-6 mb-5">
        <label for="birthday" class="form-label mb-3">Date of birth</label>
        <input type="date" class="form-control fs-5" id="birthday" name="birthday">
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-12 mb-5">
        <label for="address" class="form-label mb-3">Address</label>
        <input type="text" class="form-control fs-5" id="address" name="address">
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-3">
        <label for="zip" class="form-label mb-3">Zipcode</label>
        <input type="text" class="form-control fs-5" id="zip" name="zipcode">
      </div>
      <div class="col-md-5">
        <label for="city" class="form-label mb-3">City</label>
        <input type="text" class="form-control fs-5" id="city" name="city">
      </div>
      <div class="col-md-4">
        <label for="country" class="form-label mb-3">Country</label>
        <input type="text" class="form-control fs-5" id="country" name="country">
      </div>
    </div>
    <div class="row mt-5">
      <button class="w-25 m-auto btn btn-danger btn-lg fs-5" type="submit">Register</button>
      <p class="mt-5 text-center">You already have an account?! <a href="auth.php" class=" text-danger">Login here</a>
      </p>
    </div>
  </form>
</div>

<?php
require_once 'inc/footer.inc.php';
?>