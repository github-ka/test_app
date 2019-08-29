<?php
  require_once('functions.php');
  unsetSession();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Home</title>
</head>
<body>
  <div>
    <a href="new.php">
      <p>新規作成</p>
    </a>
  </div>
  <div>
  <h2>登録したワード</h2>
    <table>
      <tr>
        <th>ID</th>
        <th>内容</th>
        <th>更新</th>
        <th>削除</th>
      </tr>
      <?php foreach (todoList() as $todo) : ?>
        <tr>
          <td><?= h($todo['id']); ?></td>
          <td><?= h($todo['todo']); ?></td>
          <td>
            <a href="edit.php?id=<?= h($todo['id']); ?>">更新</a>
          </td>
          <td>
            <form action="store.php" method="post">
              <input type="hidden" name="id" value="<?= h($todo['id']);?>">
              <button type="submit">削除</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>

    </table>
  </div>
</body>
</html>