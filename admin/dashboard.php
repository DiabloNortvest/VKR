<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Администрирование — Адвокат Девятовский В.А.</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <header>
    <div class="container header-content">
      <div class="logo">⚖️</div>
      <h1>Панель администратора</h1>
      <nav>
        <a href="dashboard.php" class="active">Главная</a>
        <a href="articles.php">Статьи</a>
        <a href="requests.php">Заявки</a>
        <a href="logout.php">Выйти</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <h2>Добро пожаловать</h2>
    <p>Вы находитесь в административной части сайта адвоката Девятовского В.А. Здесь вы можете управлять заявками от клиентов и публиковать новые статьи.</p>
  </main>

  <footer>
    <div class="container">
      <p>© 2025 Адвокат Девятовский В.А. Все права защищены.</p>
    </div>
  </footer>
</body>
</html>
