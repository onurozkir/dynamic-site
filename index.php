<?php
include('bilesenler/header.php');
include('function/connection.php');
?>
<style>
    .ece {
        background-color: black;
        color: beige;
        font-size: 20px;
    }

    h1 {
        border-style: dashed;
        border-color: darkblue;
        color: darkblue;
        text-align: center;
        background: sandybrown;
    }

    .e {
        float: left;
        margin-right: 30px;
        color: purple;
        font-size: 15px;

    }

    #e {
        float: right;
        font-size: 20px;
        background: blue;
    }

    .v {
        margin-left: 320px;
    }

    .baslik {
        margin-left: 320px;
        color: darkorchid;

    }

    .icerik-alani {
        margin-left: 20px;
        width: 250px;
        height: 223px;
        float: left;
        background-color: red;
    }

    .title {
        text-align: center;
        font-size: 18px;
        font-weight: 700;
        color: black;
    }

    .content {
        text-align: justify;
        font-size: 14px;
        font-weight: 500;
        color: black;
    }


</style>
<title>Kamp Zamanı</title>
</head>
<body background="assets/img/arka.jpg">
<header>
    <?php
    if (isset($_SESSION["user"]) && count($_SESSION["user"]) > 0) { ?>
        <h1>Merhaba <?php echo $_SESSION['user']['user_name'] . " " . $_SESSION['user']['sur_name'] ?></h1>
    <?php } ?>


    <h1> Toparlayın çantalarınızı, doğaya kavuşacağız! <img src="assets/img/cadir.png" width="50px" height="50px"></h1>
    <h1> <?php print_r($_SESSION['user']) ?></h1>
</header>

<div>
    <a class="ece" href="http://odev.ooo/index.php">Ana Sayfa</a>
    <a class="ece" href="hakkımızda.html">Hakkımızda</a>

    <?php
    if (isset($_SESSION["user"]) || count($_SESSION["user"]) > 0) { ?>
        <a class="ece" href="http://odev.ooo/profil.php" target="_blank">Profil</a>
        <a class="ece" href="http://odev.ooo/cikis.php">Cikis Yap</a>
    <?php } else { ?>
        <a class="ece" href="kayitol.php" target="_blank">Kayıt Ol</a>
        <a class="ece" href="http://odev.ooo/uyegirisi.php">Üye Girişi</a>
    <?php } ?>


    <div>
        <a id="e" href="icerik.php">
            <mark>İçerik Gönder</mark>
        </a>
    </div>


</div>

<br>


<div class="ece">

    <a class="ece" href="https://www.decathlon.com.tr/" target="_blank">Kamp Ekipmanları</a>
    <a class="ece" href="kampyerleri.html" target="_blank">Kamp Yerleri</a>
    <a class="ece" href="seyahat.html" target="_blank">Sık Sorulan Sorular</a>
</div>
<br>
<br>

<nav class="e">
    <div style="width: 100%; float:left">
        <?php include "function/connection.php";
        $result = $conn->prepare("SELECT post_title  as title, post_icerik as content, id
FROM post ");

        $result->execute();
        $result->fetch(PDO::FETCH_ASSOC);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="icerik-alani">
                <p class="title"><?php echo $row['title']; ?></p>
                <p class="content">
                    <?php if (strlen($row['content']) > 80) {
                        echo substr($row['content'], 0, 80) . '.....';
                    } else {
                        echo $row['content'];
                    } ?></p>
                <p class="title"><a href="icerik-oku.php?id=<?php echo $row['id']; ?>">Devamı..</a></p>
            </div>
        <?php } ?>
    </div>
    <div style="width: 100%; float:left">
        <a href="sirt.html"><img src="assets/img/sirt.jpg">
            <mark>Sırt Çantası Nasıl Hazırlanır</mark>
        </a>
        <a href="gezgin.html"><img src="assets/img/gez.jpg">
            <mark>Gezgin Olmak</mark>
        </a>
        <a href="yenice.html"><img src="assets/img/yen.jpg" height="200px" width="200px">
            <mark>Size Yenice'den Bahseden Oldu mu</mark>
        </a>

    </div>

</nav>


<nav class="bolu" style="    width: 100%;
    float: left;
    height: 45px;">
    <p class="baslik">BOLU, YEDİGÖLLER TANITIM VİDEOSU</p>
</nav>


<video class="v" src="assets/img/bolu.mp4" controls></video>

<footer class="bolu">
    <p class="baslik">Tüm Hakları Saklıdır</p>


</footer>


</body>
</html>
