<?php
/*
 dbCreate.php（データベース初期化）

 @author  田岡勇大
 @version 2.0
 @date    6月10日
*/

/* インポート */
require_once('utilConnDB.php');
$utilConnDB = new UtilConnDB();

/*
 * 社員（syain）データベース作成
 */
$dbSW  = $utilConnDB->createDB();  // false:not create
/*
 * 社員（syain）データベースに接続
 */
$pdo   = $utilConnDB->connect();   // null:not found

/*
 * 社員（syain）テーブル作成
 */
/* 登録済みの確認 */
$sql    = "show tables like 'item';";
$ret    = $pdo->query($sql);
$findSW = false;
while ($row = $ret->fetch(PDO::FETCH_NUM)) {
  $tableList[] = $row[0];
  if ($row[0] == 'item') {
    $findSW = true;
  }
}
if ($findSW == true) {
  $sql   = 'drop table item;';
  $count = $pdo->query($sql);
}
/* syainテーブル生成          */
$sql = 'create table item('
     . 'itemNumber varchar(10) primary key, '
     . 'itemName varchar(50), '
     . 'itemPrice integer'
     . ');';
$count = $pdo->query($sql);

/* syainテーブルにデータ登録  */
insItem($pdo);

function insItem($pdo) {
    $sql   = "insert into item values('0001', 'お茶', '100');";
    $count = sql_exec($pdo, $sql);

    $sql   = "insert into item values('0002', 'お菓子', '450');";
    $count = sql_exec($pdo, $sql);

    $sql   = "insert into item values('0003', '服', '19300');";
    $count = sql_exec($pdo, $sql);
}

/*
 * SQL文実行
 */
function sql_exec($pdo, $sql) {
    $count = $pdo->exec($sql);

    return $count;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ショッピングサイト</title>
</head>
<body>

<form name="myForm1" action="index.php" method="post">
  <h2>実習No.3 データベース初期化（デバッグ用）</h2>
　データベースを初期化しました。<p />
  <input type="submit" value="戻る" />
</form>
</body>
</div>
</html>