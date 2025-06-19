<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = isset($_POST['login']) ? trim($_POST['login']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    require '../db.php';

    $stmt = $pdo->prepare('SELECT * FROM admins WHERE login = ?');
    $stmt->execute(array($login));
    $admin = $stmt->fetch();

    if ($admin && md5($password) === $admin['password']) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $message = 'Неверный логин или пароль';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Вход - Админка</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
  <main class="container">
    <h2>Вход в административную панель</h2>
    <?php if ($message != ''): ?>
      <p style="color:red;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="POST" action="login.php">
      <label>Логин:<br />
        <input type="text" name="login" required />
      </label><br />
      <label>Пароль:<br />
        <input type="password" name="password" required />
      </label><br />
      <button type="submit">Войти</button>
    </form>
  </main>
</body>
</html>
