<?php
require_once('functions.php');
setToken();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>新規作成</title>
</head>

<body>
  <?php if (isset($_SESSION['err'])) : ?>
  <!--isset()はsession[]の中身を見ているのではなく、SESSION['err']があるのかを見ている-->
  <p><?= $_SESSION['err']; ?></p>
  <?php endif; ?>
  <form action="store.php" method="post">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    <input type="text" name="todo">
    <input type="submit" value="新規作成">
  </form>
  <div>
    <a href="index.php">一覧へもどる</a>
  </div>
  <?php unsetSession(); ?>
</body>

</html>