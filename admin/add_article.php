<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require '../db.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';

    if ($title === '' || $content === '') {
        $message = 'Пожалуйста, заполните все поля.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO articles (title, content) VALUES (?, ?)');
        if ($stmt->execute([$title, $content])) {
            $message = 'Статья успешно добавлена.';
            $title = '';
            $content = '';
        } else {
            $message = 'Ошибка при добавлении статьи.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Добавить статью — Адвокат Девятовский В.А.</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<header>
  <div class="container header-content">
    <div class="logo">⚖️</div>
    <h1>Добавить статью</h1>
    <nav>
      <a href="dashboard.php">Главная</a>
      <a href="articles.php">Статьи</a>
      <a href="requests.php">Заявки</a>
      <a href="logout.php">Выйти</a>
    </nav>
  </div>
</header>
<main class="container">
  <?php if ($message !== ''): ?>
    <p><?php echo htmlspecialchars($message); ?></p>
  <?php endif; ?>
  <form method="POST" action="add_article.php">
    <label>Заголовок:<br />
      <input type="text" name="title" value="<?php echo htmlspecialchars($title ?? ''); ?>" required />
    </label><br />
    <label>Содержание:<br />
      <textarea name="content" required rows="10"><?php echo htmlspecialchars($content ?? ''); ?></textarea>
    </label><br />
    <button type="submit">Добавить</button>
  </form>
</main>
<footer>
  <div class="container">
    <p>© 2025 Адвокат Девятовский В.А. Все права защищены.</p>
  </div>
</footer>
</body>
</html>
