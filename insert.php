<?php
include('functions.php');
//入力チェック(受信確認処理追加)
if(
  !isset($_POST['name']) || $_POST['name']=="" ||
  !isset($_POST['email']) || $_POST['email']=="" ||
  !isset($_POST['detail']) || $_POST['detail']==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$name   = $_POST['name'];
$email  = $_POST['email'];
$detail = $_POST['detail'];

//2. DB接続します(エラー処理追加)
$pdo = db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO '. $table .'(id, name, email, detail, indate )VALUES(NULL, :a1, :a2, :a3, sysdate())');
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $email, PDO::PARAM_STR);
$stmt->bindValue(':a3', $detail, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  errorMsg($stmt);
}else{
  //５．index.phpへリダイレクト
  header('Location: index.php');
  exit;
}
?>
