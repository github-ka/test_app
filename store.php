<?php

// functions.php 内にある createData関数 にPOSTデータを渡すことが可能になる

require_once('functions.php');

$res = saveDataAfterRedirect();
if ($res === 'index') {
  header('Location: ./index.php');
} else {
  // var_dump($_SERVER['HTTP_REFERER']);
  // header('Location: '.$_SERVER['HTTP_REFERER']);
  oneReturn();
}