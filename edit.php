<?php
  require_once('functions.php');
  setToken();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>編集</title>
</head>
<body>
  <?php if (isset($_SESSION['err'])) : ?>
    <p><?= $_SESSION['err']; ?></p>
  <?php endif; ?>
  <form action="store.php" method="post">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <input type="hidden" name="id" value="<?= h($_GET['id']); ?>">
    <input type="text" name="todo" value="<?= h(select($_GET['id'])); ?>">
    <input type="submit" value="更新">
  </form>
  <div>
    <a href="index.php">一覧へもどる</a>
  </div>
  <?php unsetSession(); ?>
</body>
</html>