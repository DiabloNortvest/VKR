<?php
header('Content-Type: text/html; charset=utf-8');

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message_text = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message_text === '') {
        $message = 'Пожалуйста, заполните обязательные поля.';
    } else {
        require 'db.php';
        $stmt = $pdo->prepare('INSERT INTO requests (name, email, phone, message) VALUES (?, ?, ?, ?)');
        if ($stmt->execute([$name, $email, $phone, $message_text])) {
            $message = 'Спасибо! Ваша заявка отправлена.';
            $name = $email = $phone = $message_text = '';
        } else {
            $message = 'Ошибка при отправке заявки.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Контакты — Адвокат Девятовский В.А.</title>
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
      <a href="articles.php">Статьи</a>
      <a href="contact.php" class="active">Контакты</a>
    </nav>
  </div>
</header>

<main class="container">
  <h2>Связаться со мной</h2>

  <?php if (!empty($message)): ?>
    <p class="form-message"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

  <form method="POST" class="edit-form">
    <label for="name">Ваше имя *</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($name ?? '') ?>" required>

    <label for="email">Email *</label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($email ?? '') ?>" required>

    <label for="phone">Телефон</label>
    <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($phone ?? '') ?>">

    <label for="message">Ваше сообщение *</label>
    <textarea name="message" id="message" required><?= htmlspecialchars($message_text ?? '') ?></textarea>

    <button type="submit">Отправить</button>
  </form>

  <p style="margin-top: 30px;">Вы также можете связаться по телефону <strong>+7 (999) 123-45-67</strong> или по электронной почте <strong>advokat@example.com</strong>. Приём ведётся по предварительной записи.</p>
</main>

<footer>
  <div class="container">
    <p>© 2025 Адвокат Девятовский В.А. Все права защищены.</p>
  </div>
</footer>
</body>
</html>
