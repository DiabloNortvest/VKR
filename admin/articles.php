<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
require '../db.php';

$stmt = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
$articles = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Публикации — Адвокат Девятовский В.А.</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <header>
    <div class="container header-content">
      <div class="logo">⚖️</div>
      <h1>Публикации</h1>
      <nav>
        <a href="dashboard.php">Главная</a>
        <a href="articles.php" class="active">Статьи</a>
        <a href="requests.php">Заявки</a>
        <a href="logout.php">Выйти</a>
      </nav>
    </div>
  </header>
  <main class="container">
    <h2>Список опубликованных материалов</h2>
    <p><a href="add_article.php">Добавить новую статью</a></p>
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Заголовок</th>
          <th>Дата публикации</th>
          <th>Действия</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($articles as $art): ?>
        <tr>
          <td><?php echo htmlspecialchars($art['id']); ?></td>
          <td><a href="edit_article.php?id=<?php echo $art['id']; ?>"><?php echo htmlspecialchars($art['title']); ?></a></td>
          <td><?php echo htmlspecialchars($art['created_at']); ?></td>
          <td>
            <a href="edit_article.php?id=<?php echo $art['id']; ?>">Редактировать</a> |
            <a href="delete_article.php?id=<?php echo $art['id']; ?>" onclick="return confirm('Удалить эту статью?')">Удалить</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
  <footer>
    <div class="container">
      <p>© 2025 Адвокат Девятовский В.А. Все права защищены.</p>
    </div>
  </footer>
</body>
</html>
