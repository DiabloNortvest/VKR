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
    header('Location: requests.php');
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message_text = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message_text === '') {
        $message = 'Пожалуйста, заполните обязательные поля.';
    } else {
        $stmt = $pdo->prepare('UPDATE requests SET name = ?, email = ?, phone = ?, message = ? WHERE id = ?');
        if ($stmt->execute([$name, $email, $phone, $message_text, $id])) {
            $message = 'Заявка успешно обновлена.';
        } else {
            $message = 'Ошибка при обновлении заявки.';
        }
    }
}

$stmt = $pdo->prepare('SELECT * FROM requests WHERE id = ?');
$stmt->execute([$id]);
$request = $stmt->fetch();

if (!$request) {
    header('Location: requests.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Редактирование заявки — Адвокат Девятовский В.А.</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<header>
  <div class="container header-content">
    <div class="logo">⚖️</div>
    <h1>Редактирование заявки</h1>
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
  <form method="POST" action="edit_request.php?id=<?php echo $id; ?>" class="edit-form">
    <label>Имя:<br />
      <input type="text" name="name" value="<?php echo htmlspecialchars($request['name']); ?>" required />
    </label><br />
    <label>Email:<br />
      <input type="email" name="email" value="<?php echo htmlspecialchars($request['email']); ?>" required />
    </label><br />
    <label>Телефон:<br />
      <input type="text" name="phone" value="<?php echo htmlspecialchars($request['phone']); ?>" />
    </label><br />
    <label>Сообщение:<br />
      <textarea name="message" required rows="6"><?php echo htmlspecialchars($request['message']); ?></textarea>
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
