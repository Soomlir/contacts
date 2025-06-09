<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Удалить контакт</title>
</head>

<body>
  <form method="POST" action="/user/delete.php" onsubmit="return confirm('Вы уверены?');" style="display:inline;">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
    <button type="submit">Удалить</button>
  </form>
</body>

</html>
