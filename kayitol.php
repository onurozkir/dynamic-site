<?php include('bilesenler/header.php') ?>

<?php
if (isset($_POST['kayitOl'])) {

    $kontrol = true;
    $name = $_POST['isim'];
    $surname = $_POST['soyisim'];
    $mail = $_POST['email'];
    $pass = md5(trim($_POST['pass']));
    $sex = $_POST['cinsiyet'];
    if ($name != '' && $mail != '' && $pass != '' && $sex != '') {
        include "function/connection.php";
        $date = date('d.m.Y H:i:s');
        if ($sex == 'Kadın') {
            $sex = 1;
        } else {
            $sex = 0;
        }

        $result = $conn->query("SELECT email FROM user WHERE email = '{$mail}'")->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            echo "Bu Mail daha önce kullanılmıştır farklı bir mail adresi deneyiniz ---> " . $mail;
            die();
        }
    } else {
        $kontrol = false;
    }

    if ($kontrol == true) {
        include "function/connection.php";
        $sql = "INSERT INTO user (user_name, sur_name, email, pass, sex, level, createdAt, updatedAt)
                    VALUES ('" . $name . "', '" . $surname . "', '" . $mail . "', '" . $pass . "', " . $sex . ", 
                    0, STR_TO_DATE(DATE_FORMAT(SYSDATE(), '%Y-%m-%d %H:%i:%s'), '%Y-%m-%d %H:%i:%s'), 
                    STR_TO_DATE(DATE_FORMAT(SYSDATE(), '%Y-%m-%d %H:%i:%s'), '%Y-%m-%d %H:%i:%s')  )";

        $insert = $conn->exec($sql);
        if ($insert) {
            $last_id = $conn->lastInsertId();
            $userResult = $conn->query("SELECT id, user_name, sur_name, email,
 sex, level, STR_TO_DATE(createdAt, '%Y-%m-%d') as createdAt FROM user WHERE id = '{$last_id}'")->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $userResult;
            header('Location: index.php');
        } else {
            echo " bir sorunla karşılaşıldı lütfen daha sonra tekrar deneyiniz";
            die();
        }
    } else {
        echo " bir sorunla karşılaşıldı lütfen daha sonra tekrar deneyiniz";
        die();
    }
}

?>
<title>Kamp Zamanı Kayıt Ol</title>
</head>
<body class="tasarım">

<form action="#" method="post" class="kayit-form">
    <p>İsim</p>
    <p><input class="tasarım" name="isim" type="text" placeholder="İsim"></p>
    <p>Soiyisim</p>
    <p><input class="tasarım" name="soyisim" type="text" placeholder="Soyisim"></p>
    <p>E-mail</p>
    <p><input class="tasarım" name="email" type="text" placeholder="E-mail"></p>
    <p>Şifre</p>
    <p><input class="tasarım" name="pass" type="password" placeholder="şifre"></p>
    <p>Cinsiyetiniz:</p>

    <input type="radio" name="cinsiyet" value="Kadın">Kadın<br>
    <input type="radio" name="cinsiyet" value="Erkek">Erkek<br>
    <input type="submit" value="Kayıt Ol" name="kayitOl">
</form>


</body>
</html>
