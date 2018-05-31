<?php
include 'bilesenler/header.php';
if (!isset($_SESSION['user']) && count($_SESSION["user"]) <= 0) {
    header('Location: uyegirisi.php');
}

?>
<?php

if (isset($_POST["icerikPaylas"])) {
    if (isset($_SESSION['user']) && count($_SESSION["user"]) > 0) {
        $title = $_POST['baslik'];
        $content = $_POST['icerik'];
        if ($title != '' && $content != '') {
            $user_id = $_SESSION['user']['id'];
            $datetime = date('YmdHis');
            $path = strReplace($title);
            include "function/connection.php";
            $sql = "INSERT INTO post (user_id, post_title, post_icerik, createdAt)
                    VALUES (" . $user_id . ", '" . $title . "', '" . $content . "', '" . $datetime . "')";

            $insert = $conn->exec($sql);
            if ($insert) {
                header('Location: index.php');
            } else {
                echo " bir sorunla karşılaşıldı lütfen daha sonra tekrar deneyiniz";
                die();
            }
        }
    } else {
        header('Location: uyegirisi.php');
    }
}

?>
<style>
    .icerikbaslik {
        background: brown;
        color: blueviolet;
        font-size: 25px;

    }

    .input {
        color: white;
        font-size: 18px;
    }

</style>
</head>
<body background="assets/img/oneri.jpg">

<p class="icerikbaslik"><strong>Lütfen bizimle içerik paylaşın paylaşın</strong></p>

<form action="#" method="post" enctype="multipart/form-data">
    <p class="input">Başlık : <input type="text" name="baslik" placeholder="başlık"></p>
    <textarea cols="40px" rows="25px" name="icerik" placeholder="paylaşınız.."></textarea><br>
    <input type="submit" value="Paylaş" name="icerikPaylas"><br>

</form>


</body>
</html>
