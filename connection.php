<?php

// DBに接続し処理を行うための記述

require_once('config.php');


// DB接続処理
function connectPdo()
{
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}



// 重複チェック
function diffData($todo_txt)
{
  $dbh = connectPdo();
  $sql = 'SELECT count(todo) FROM todos WHERE todo = :todo_txt';
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':todo_txt', $todo_txt, PDO::PARAM_STR);
  $stmt->execute();
  $data = $stmt->fetch();
  return $data['count(todo)'];
}


// 新規作成処理
function createTodoData($todo_txt) //データの登録処理
{
  $dbh  = connectPdo();//DBへ接続するconnectPdo関数 を呼びだし返り値を$dbhに格納
  $sql  = 'INSERT INTO todos (todo) VALUES (:todo_txt)';//新しくデータを追加する処理＝INSERT文を使いSQL文を作成
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':todo_txt', $todo_txt, PDO::PARAM_STR);//bindValu = 与えられた変数や数値を型を指定してパラメータに入れる関数
  $stmt->execute();//実行関数
}


// データの所得処理
function getAllTodos()
{
  $dbh = connectPdo();//DBへ接続するconnectPdo関数 を呼びだし返り値を$dbhに格納
  $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL'; //todosテーブルから、削除(論理削除)をしていないデータを全て取得するというSQL文を $sql に格納

  // $stmt = $dbh->prepare($sql);
  // $stmt->execute();
  // return $stmt->fetchAll();

  return $dbh->query($sql)->fetchAll();
  //$dbh->query($sql) でDBに対して上記のSQL文を実行--fetchAll() で実行結果を全件配列で取得--その結果をreturn
}

  
// データの更新処理
function updateTodoData($id, $todo_txt)
{
  $dbh = connectPdo();//DB接続
  $sql = 'UPDATE todos SET todo = :todo_txt WHERE id = :id';//update処理を行う・todosテーブルのidカラムがPOSTで受けとったidのところのデータを更新するという処理
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':todo_txt', $todo_txt, PDO::PARAM_STR);
  $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
  $stmt->execute();
}

// データの所得処理 
function getSelectedTodo($id)
{
  $dbh = connectPdo();
  $sql = 'SELECT * FROM todos WHERE id = :id AND deleted_at IS NULL';
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetch();
  return $data['todo'];
}


// データの削除・今回は論理削除
function deleteTodoData($id)
{
  $dbh = connectPdo();
  $now = date('Y-m-d H:i:s');
  $sql = 'UPDATE todos SET deleted_at = :now WHERE id = :id';
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->bindValue(':now', $now);
  $stmt->execute();
}