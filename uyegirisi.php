<?php include('bilesenler/header.php') ?>
<?php
if (count($_SESSION["user"]) > 0) {
    header('Location: index.php');
} else {
    if (isset($_POST['girisYap'])) {
        include 'function/connection.php';
        $email = trim($_POST['email']);
        $pass = md5(trim($_POST['password']));
        if ($email != '' && $pass != '') {
            $result = $conn->query("SELECT id, pass, user_name, sur_name, email,
 sex, level, STR_TO_DATE(createdAt, '%Y-%m-%d') as createdAt FROM user WHERE email = '{$email}'")->fetch(PDO::FETCH_ASSOC);
            if (count($result) > 0) {
                if ($result['pass'] == $pass) {
                    $_SESSION['user'] = $result;
                    header('Location: index.php');
                } else {
                    echo "Şifre Yanlış";
                    die();
                }
                die();
            } else {
                echo "Böyle bir kullanıcı adı yok";
                die();
            }
        } else {
            echo "gerekli alanları doldurunuz";
            die();
        }
    }
}
?>

<title>Kamp Zamanı Üye Girişi</title>
</head>
<body class="tasarım2">
<form action="#" method="post">
    <p>Email</p>
    <p><input type="text" placeholder="Email Adı" name="email"></p>
    <p>Şifre</p>
    <p><input type="password" name="password" placeholder="Şifre"></p>
    <br>
    <input type="submit" value="Giriş Yap" name="girisYap">

</form>

</body>
</html>
