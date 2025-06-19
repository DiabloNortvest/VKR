<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Главная — Адвокат Девятовский В.А.</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" href="favicon.ico" />
  <style>
    .hero-image img {
      width: 100%;
      max-height: 400px;
      object-fit: cover;
      border-radius: 6px;
      margin-bottom: 25px;
    }
    .services-icons {
      display: flex;
      justify-content: space-around;
      margin: 30px 0;
      flex-wrap: wrap;
    }
    .icon-item {
      text-align: center;
      max-width: 150px;
      margin: 10px;
    }
    .icon-item img {
      max-width: 80px;
      height: auto;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
<header>
  <div class="container header-content">
    <div class="logo">⚖️</div>
    <h1>Адвокат Девятовский В.А.</h1>
    <nav>
      <a href="index.php" class="active">Главная</a>
      <a href="about.php">Обо мне</a>
      <a href="services.php">Услуги</a>
      <a href="team.php">Команда</a>
      <a href="articles.php">Статьи</a>
      <a href="contact.php">Контакты</a>
    </nav>
  </div>
</header>

<main class="container">
  <h2>Юридическая поддержка от профессионала с опытом</h2>

  <div class="hero-image">
    <img src="images/law-office.jpg" alt="Офис адвоката Девятовского В.А." />
  </div>

  <p>Адвокат Девятовский В.А. оказывает квалифицированную юридическую помощь в различных правовых вопросах — от консультации до судебного представительства. Надёжность, компетентность и внимание к деталям — ключевые принципы работы кабинета.</p>

  <section class="services-icons">
    <div class="icon-item">
      <img src="images/consultation.png" alt="Консультации" />
      <p>Юридические консультации</p>
    </div>
    <div class="icon-item">
      <img src="images/contracts.png" alt="Договоры" />
      <p>Составление договоров</p>
    </div>
    <div class="icon-item">
      <img src="images/court.png" alt="Судебное представительство" />
      <p>Защита в суде</p>
    </div>
    <div class="icon-item">
      <img src="images/real-estate.png" alt="Сделки" />
      <p>Правовой анализ сделок</p>
    </div>
  </section>

  <section>
    <h3>Почему стоит обратиться именно к нам</h3>
    <ul>
      <li>Глубокое знание законодательства и судебной практики</li>
      <li>Индивидуальный подход к каждой ситуации</li>
      <li>Конфиденциальность и прозрачность взаимодействия</li>
      <li>Эффективные решения и реальная помощь</li>
    </ul>
  </section>

  <section>
    <h3>Ключевые направления работы</h3>
    <ul>
      <li>Консультации по гражданским и семейным спорам</li>
      <li>Разработка, проверка и сопровождение договоров</li>
      <li>Судебное представительство по делам различной сложности</li>
      <li>Юридическое сопровождение сделок с недвижимостью</li>
    </ul>
  </section>

  <p>Оставить заявку или задать вопрос можно на странице <a href="contact.php">Контакты</a>. Свяжитесь с нами — мы готовы взяться за дело.</p>
</main>

<footer>
  <div class="container">
    <p>© 2025 Адвокат Девятовский В.А. Все права защищены.</p>
  </div>
</footer>
</body>
</html>
