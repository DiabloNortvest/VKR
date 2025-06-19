<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require '../db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header('Location: articles.php');
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($title === '' || $content === '') {
        $message = 'Пожалуйста, заполните все обязательные поля.';
    } else {
        $stmt = $pdo->prepare('UPDATE articles SET title = ?, content = ? WHERE id = ?');
        if ($stmt->execute([$title, $content, $id])) {
            $message = 'Статья успешно обновлена.';
        } else {
            $message = 'Ошибка при сохранении статьи.';
        }
    }
}

$stmt = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
$stmt->execute([$id]);
$article = $stmt->fetch();

if (!$article) {
    header('Location: articles.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Редактирование статьи — Адвокат Девятовский В.А.</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<header>
  <div class="container header-content">
    <div class="logo">⚖️</div>
    <h1>Редактирование статьи</h1>
    <nav>
      <a href="dashboard.php">Главная</a>
      <a href="articles.php" class="active">Статьи</a>
      <a href="requests.php">Заявки</a>
      <a href="logout.php">Выйти</a>
    </nav>
  </div>
</header>
<main class="container">
  <?php if ($message !== ''): ?>
    <p><?php echo htmlspecialchars($message); ?></p>
  <?php endif; ?>
  <form method="POST" action="edit_article.php?id=<?php echo $id; ?>" class="edit-form">
    <label>Заголовок:<br />
      <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required />
    </label><br />
    <label>Содержание:<br />
      <textarea name="content" required rows="10"><?php echo htmlspecialchars($article['content']); ?></textarea>
    </label><br />
    <button type="submit">Сохранить</button>
  </form>
</main>
<footer>
  <div class="container">
    <p>© 2025 Адвокат Девятовский В.А. Все права защищены.</p>
  </div>
</footer>
</body>
</html>
