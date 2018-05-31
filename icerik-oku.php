<?php
include "bilesenler/header.php";
include "function/connection.php";


$id = $_GET['id'];
if ($id == '' || $id == null) {
    header('Location: index.php');
}

if (isset($_POST["yorumPaylas"])) {
    if (isset($_SESSION['user']) && count($_SESSION["user"]) > 0) {
        $comment = $_POST['yorum'];
        $username = $_SESSION['user']['id'];
        $createDate = date('YmdHis');
        if ($comment != '' && $username != '') {

            $sql = "INSERT INTO Comments (user_id, post_id, post_comment, createdAt)
                    VALUES (" . $username . ", " . $id . ", '" . $comment . "', '" . $createDate . "')";

            $insert = $conn->exec($sql);
            if (!$insert) {
                echo " bir sorunla karşılaşıldı lütfen daha sonra tekrar deneyiniz";
                die();
            }
        }
    } else {
        header('Location: uyegirisi.php');
    }
}

?>
<?php
include "function/connection.php";
$row = $conn->query("SELECT a.post_title  as title, a.post_icerik as content, a.id as id, b.user_name username, b.sur_name sur_name,
DATE_FORMAT(a.createdAt, '%Y-%m-%d %H:%i:%s') create_date
FROM post a,user b
WHERE a.user_id = b.id AND a.id = '{$id}'")->fetch(PDO::FETCH_ASSOC);
?>
<title><?php echo $row['title'] ?></title>
<style>
    .gülay {
        font-family: 'Times New Roman', Times, serif;
        color: brown;
        font-size: 20px;

    }
</style>
</head>

<body class="gülay">
<div class="ece">
    <a href="index.php">Ana Sayfa</a>


</div>
<h2>
    <mark><?php echo $row['title']; ?></mark>
</h2>

<p>
    <strong><?php echo $row['content'] ?></strong>

</p>

<h2>
    <mark>Bu yazı <?php echo $row['username'] . " " . $row["sur_name"] . " tarafından " . $row['create_date']; ?>
        tarihine yazıldı.
    </mark>
</h2>

<div style="width: 100%">

    <?php include "function/connection.php";
    $result = $conn->prepare(" SELECT a.post_comment as comment2, DATE_FORMAT(a.createdAt, '%Y-%m-%d %H:%i:%s') create_date,
  c.user_name username, c.sur_name surname
FROM Comments a, post b, user c where a.post_id = '{$id}' and a.post_id = b.id and a.user_id = c.id ");

    $result->execute();
    $result->fetch(PDO::FETCH_ASSOC);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="yorum" style="background: red">
            <p style="color:white"><?php echo $row['comment2']; ?></p>
            <p style="color:white"><?php echo $row['create_date']; ?></p>
            <p style="color:white"><?php echo $row['username'] . "  " . $row['surname']; ?></p>
        </div>
    <?php } ?>
</div>
<?php if (isset($_SESSION['user']) && count($_SESSION["user"]) > 0) { ?>
    <form action="#" method="post">
        <textarea cols="40px" rows="25px" name="yorum" placeholder="yorum paylaş.."></textarea><br>
        <input type="submit" value="Paylaş" name="yorumPaylas"><br>
    </form>
<?php } ?>

</body>
</html>
