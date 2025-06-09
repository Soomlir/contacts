<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Редактировать контакт</title>
  <link rel="stylesheet" href="/styles.css">
</head>

<body>
  <div class="contact-create">
    <h1 class="contact-create__title">Редактировать контакт</h1>
    <form action="/user/saveEdit" method="post" class="contact-create__form">

      <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">

      <label class="contact-create__field">
        Имя
        <input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['oldName'] ?? $user['name']); ?>" class="contact-create__input">
        <?php if (!empty($_SESSION['errorName'])): ?>
          <span class="contact-create__error"><?php echo $_SESSION['errorName']; ?></span>
        <?php endif; ?>
      </label>

      <label class="contact-create__field">
        Почта
        <input type="text" name="email" value="<?php echo htmlspecialchars($_SESSION['oldEmail'] ?? $user['email']); ?>" class="contact-create__input">
        <?php if (!empty($_SESSION['errorEmail'])): ?>
          <span class="contact-create__error"><?php echo $_SESSION['errorEmail']; ?></span>
        <?php endif; ?>
      </label>

      <label class="contact-create__field">
        Телефон
        <input type="text" name="phone" value="<?php echo htmlspecialchars($_SESSION['oldPhone'] ?? $user['phone']); ?>" class="contact-create__input">
        <?php if (!empty($_SESSION['errorPhone'])): ?>
          <span class="contact-create__error"><?php echo $_SESSION['errorPhone']; ?></span>
        <?php endif; ?>
      </label>

      <button type="submit" class="contact-create__submit">Сохранить</button>
      <a href="/" class="contact-create__back">Вернуться назад</a>
    </form>
    <?php
    unset($_SESSION['errorName'], $_SESSION['errorEmail'], $_SESSION['errorPhone']);
    unset($_SESSION['oldName'], $_SESSION['oldEmail'], $_SESSION['oldPhone']);
    ?>
  </div>
</body>

</html>
