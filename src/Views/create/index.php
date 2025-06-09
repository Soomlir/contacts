<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Создать контакт</title>
  <link rel="stylesheet" href="/styles.css">
</head>

<body>
  <div class="contact-create">
    <h1 class="contact-create__title">Создать контакт</h1>
    <form action="/user/save" method="post" class="contact-create__form">
      <label class="contact-create__field">
        Имя
        <input type="text" name="name" class="contact-create__input">
      </label>
      <label class="contact-create__field">
        Почта
        <input type="text" name="email" class="contact-create__input">
      </label>
      <label class="contact-create__field">
        Телефон
        <input type="text" name="phone" class="contact-create__input">
      </label>
      <button type="submit" class="contact-create__submit">Добавить</button>
      <a href="/" class="contact-create__back">Вернуться назад</a>
    </form>
  </div>

</body>

</html>
