<?php
header('Content-Type: text/html; charset=utf-8');
require 'db.php';

$stmt = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
$articles = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Статьи — Адвокат Девятовский В.А.</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<header>
  <div class="container header-content">
    <div class="logo">⚖️</div>
    <h1>Адвокат Девятовский В.А.</h1>
    <nav>
      <a href="index.php">Главная</a>
      <a href="about.php">Обо мне</a>
      <a href="services.php">Услуги</a>
      <a href="team.php">Команда</a>
      <a href="articles.php" class="active">Статьи</a>
      <a href="contact.php">Контакты</a>
    </nav>
  </div>
</header>

<main class="container">
  <h2>Юридические статьи и полезные материалы</h2>
  <?php if (count($articles) == 0): ?>
    <p>На данный момент статьи отсутствуют. Новые материалы появятся в ближайшее время.</p>
  <?php else: ?>
    <ul class="articles-list">
      <?php foreach ($articles as $article): ?>
        <li>
          <h3><?= htmlspecialchars($article['title']) ?></h3>
          <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
          <hr>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</main>

<footer>
  <div class="container">
    <p>© 2025 Адвокат Девятовский В.А. Все права защищены.</p>
  </div>
</footer>
</body>
</html>
