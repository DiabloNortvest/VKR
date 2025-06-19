<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
require '../db.php';

$stmt = $pdo->query('SELECT * FROM requests ORDER BY created_at DESC');
$requests = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Заявки — Адвокат Девятовский В.А.</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <header>
    <div class="container header-content">
      <div class="logo">⚖️</div>
      <h1>Управление заявками</h1>
      <nav>
        <a href="dashboard.php">Главная</a>
        <a href="articles.php">Статьи</a>
        <a href="requests.php" class="active">Заявки</a>
        <a href="logout.php">Выйти</a>
      </nav>
    </div>
  </header>
  <main class="container">
    <h2>Список заявок с сайта</h2>
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Имя</th>
          <th>Email</th>
          <th>Телефон</th>
          <th>Сообщение</th>
          <th>Дата</th>
          <th>Действия</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($requests as $req): ?>
          <tr>
            <td><?= htmlspecialchars($req['id']) ?></td>
            <td><?= htmlspecialchars($req['name']) ?></td>
            <td><?= htmlspecialchars($req['email']) ?></td>
            <td><?= htmlspecialchars($req['phone']) ?></td>
            <td><?= nl2br(htmlspecialchars($req['message'])) ?></td>
            <td><?= htmlspecialchars($req['created_at']) ?></td>
            <td>
              <a href="edit_request.php?id=<?= $req['id'] ?>">Редактировать</a> |
              <a href="delete_request.php?id=<?= $req['id'] ?>" onclick="return confirm('Удалить эту заявку?')">Удалить</a>
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
