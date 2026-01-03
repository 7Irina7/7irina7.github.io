<?php
// ================= KOMMENTAR-SYSTEM =================
$commentFile = __DIR__ . "/comments.json";

if (!file_exists($commentFile)) {
    file_put_contents($commentFile, "{}");
}

$allComments = json_decode(file_get_contents($commentFile), true);
if (!is_array($allComments)) {
    $allComments = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_comment"])) {
    $photoId = trim($_POST["photo_id"] ?? "");
    $comment = trim($_POST["comment"] ?? "");

    if ($photoId !== "" && $comment !== "") {
        if (!isset($allComments[$photoId])) {
            $allComments[$photoId] = [];
        }

        $allComments[$photoId][] = [
            "text" => htmlspecialchars($comment, ENT_QUOTES, "UTF-8"),
            "time" => date("d.m.Y H:i")
        ];

        file_put_contents(
            $commentFile,
            json_encode($allComments, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            LOCK_EX
        );

        header("Location: " . $_SERVER["REQUEST_URI"]);
        exit;
    }
}
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8" />
  <title>Murki 🐾</title>
  <meta name="description" content="Webseite meiner Katze Murki" />
  <meta name="author" content="Irina U" />
  <link rel="stylesheet" href="./css/style.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
</head>

<body>
<nav>
  <ul>
    <li><a href="#">Home</a></li>
    <li><a href="./ajax.html">Info(Ajax)</a></li>
    <li><a href="#">Fotos</a></li>
    <li><a href="#">Kontakt</a></li>
  </ul>
</nav>

<header>
  <h1>🐾 Herzlich Willkommen auf Murkis Seite</h1>
</header>

<section class="info">
  <p>🐱 Murki ist ein 8 Jahre alter Mischling aus Maine Coon und europäischem Kater...</p>
</section>

<section class="gallery">

<!-- FOTO 1 -->
<div class="photo">
  <img class="bild" src="./images/balkon1.jpeg" alt="Murki auf dem Balkon"/>
  <p class="bildText">🪴 Zwischen den Blumentöpfen auf dem Balkon fühlt sich Murki am wohlsten.</p>

  <div class="comment-block">
    <a href="#" class="show-comment">💬 Kommentar schreiben</a>

    <form method="post">
      <input type="hidden" name="photo_id" value="foto1">
      <div class="textarea-wrapper" style="display:none;">
        <textarea class="comment-textarea" name="comment" maxlength="500" placeholder="Dein Kommentar..." required></textarea>
        <div class="char-count">500 Zeichen verbleibend</div>
        <button type="submit" name="add_comment">Absenden</button>
      </div>
    </form>

    <div class="comment-list">
      <?php foreach (array_reverse($allComments["foto1"] ?? []) as $c): ?>
        <div class="comment-item">
          <small><?= $c["time"] ?></small><br>
          <?= nl2br($c["text"]) ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- FOTO 2 -->
<div class="photo">
  <img class="bild" src="./images/schlaf.jpeg" alt="Murki schläft"/>
  <p class="bildText">💤 Hier schläft Murki nach einem langen Tag voller Abenteuer.</p>

  <div class="comment-block">
    <a href="#" class="show-comment">💬 Kommentar schreiben</a>

    <form method="post">
      <input type="hidden" name="photo_id" value="foto2">
      <div class="textarea-wrapper" style="display:none;">
        <textarea class="comment-textarea" name="comment" maxlength="500" placeholder="Dein Kommentar..." required></textarea>
        <div class="char-count">500 Zeichen verbleibend</div>
        <button type="submit" name="add_comment">Absenden</button>
      </div>
    </form>

    <div class="comment-list">
      <?php foreach (array_reverse($allComments["foto2"] ?? []) as $c): ?>
        <div class="comment-item">
          <small><?= $c["time"] ?></small><br>
          <?= nl2br($c["text"]) ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- FOTO 3 -->
<div class="photo">
  <img class="bild" src="./images/schlaf2.jpg" alt="Murki Tisch"/>
  <p class="bildText">☀️ Murki liebt es, sich auf dem Tisch auszuruhen.</p>

  <div class="comment-block">
    <a href="#" class="show-comment">💬 Kommentar schreiben</a>

    <form method="post">
      <input type="hidden" name="photo_id" value="foto3">
      <div class="textarea-wrapper" style="display:none;">
        <textarea class="comment-textarea" name="comment" maxlength="500" placeholder="Dein Kommentar..." required></textarea>
        <div class="char-count">500 Zeichen verbleibend</div>
        <button type="submit" name="add_comment">Absenden</button>
      </div>
    </form>

    <div class="comment-list">
      <?php foreach (array_reverse($allComments["foto3"] ?? []) as $c): ?>
        <div class="comment-item">
          <small><?= $c["time"] ?></small><br>
          <?= nl2br($c["text"]) ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

</section>

<footer>
  <p>Danke, dass du Murki besucht hast 💛</p>
</footer>

<script src="./js/main.js"></script>
</body>
</html>
