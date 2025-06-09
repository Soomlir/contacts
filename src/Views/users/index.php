<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Список контактов</title>
  <link rel="stylesheet" href="/styles.css">
</head>

<body>
  <table class="user-table">
    <tr class="user-table__row user-table__header">
      <td class="user-table__cell">Айди</td>
      <td class="user-table__cell">Имя</td>
      <td class="user-table__cell">Почта</td>
      <td class="user-table__cell">Телефон</td>
      <td class="user-table__cell">Редактировать</td>
      <td class="user-table__cell">Удалить</td>
    </tr>
    <?php foreach ($users as $user): ?>
      <tr class="user-table__row">
        <td class="user-table__cell"><?php echo htmlspecialchars($user['id']); ?></td>
        <td class="user-table__cell"><?php echo htmlspecialchars($user['name']); ?></td>
        <td class="user-table__cell"><?php echo htmlspecialchars($user['email']); ?></td>
        <td class="user-table__cell"><?php echo htmlspecialchars($user['phone']); ?></td>
        <td class="user-table__cell"><a href="/user/edit?id=<?php echo urlencode($user['id']); ?>">Редактировать</a></td>
        <td class="user-table__cell">
          <form method="POST" action="/user/delete" onsubmit="return confirm('Вы уверены, что хотите удалить этот контакт?');" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
            <button type="submit" class="user-table__delete-button">Удалить</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <a href="/user/create" class="add-contact-button">Добавить контакт</a>

</body>

</html>
