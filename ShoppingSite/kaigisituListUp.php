<?php
/*
 kaigisituListUp.php（会議室情報取得　メイン）
 
 @author  自分の名前
 @version 2.0
 @date    作成日
*/

// header('Content-Type: text/plain; charset=utf-8'); // この行をコメントアウトまたは削除

class KaigisituList {
    /*
     * 会議室表から会議室を取得する
     * 　全会議室データをArrayListクラスに登録して戻す
     *
     * @param $pdo データベース接続オブジェクト
     * @return $kaigisituList 全会議室データ
     */
    public function listUp() {
        // インスタンス生成
        require_once("kaigisituSQL.php");
        require_once("../utilConnDB.php");

        $kaigisituSQL = new KaigisituSQL();
        $utilConnDB = new UtilConnDB();

        // DB接続
        $pdo = $utilConnDB->connect();

        $kaigisituList = array();
        $kaigisituList = $kaigisituSQL->selectAll($pdo);

        // DB切断
        $utilConnDB->disconnect($pdo);

        return $kaigisituList;
    }
}
?>