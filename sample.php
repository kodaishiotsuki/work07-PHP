<?php
$FILE = 'data.txt'; //ファイルの指定
$DATA = []; //一回分の投稿情報(HTML投稿画面)
$BOARD = []; //全ての投稿


//-----保存された内容をブラウザに表示-----//
if ($FILE) { //ファイルがある場合
  //ファイル全体を読み込んで配列に格納
  $BOARD = file('data.txt', FILE_IGNORE_NEW_LINES); //配列の各要素の最後の改行を省略(よくわからん！！！)
  // var_dump($BOARD);
  // exit();
} else { //ファイルがなかった場合
  $FILE = fopen('data.txt', 'w'); //書き込み＆削除用ファイルを開く
  fclose($FILE); //ファイルを閉じる
}


//-----投稿メソッド-----//
//⬇︎何かが投稿された⬇︎
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //投稿ボタンが押された場合
  if (!empty($_POST['txt'])) {
    $text = $_POST['txt']; //データの受け取り
    $fp = fopen("data.txt", 'a'); //ファイルを開く
    flock($fp, LOCK_EX); //ファイルをロック
    fwrite($fp, $text . "\n"); //指定したファイル($fp)に指定したデータ($text)を書き込む
    flock($fp, LOCK_UN); //ファイルのロック解除
    fclose($fp); //ファイルを閉じる
  }


  
  //-----削除メソッド-----//
  //削除ボタンが押された場合
  if (isset($_POST['del'])) {
    //ファイルを開く
    $fp = fopen("data.txt", 'w');
    // var_dump($BOARD);
    // exit();


    // 配列要素のキーと値のペアを取り出すとき
    // foreach (<配列の変数> as <各要素のキーが格納される変数> => <各要素が格納される変数> ) {
    // ループ処理をここへ記述
    // }


    foreach ($BOARD as $key => $NEWBOARD) {
      //いまいちわからん...
      if ($key != $_POST['del']) {
        flock($fp, LOCK_EX); //ファイルロック
        fwrite($fp, $NEWBOARD . "\n"); //ファイル書き込み
        flock($fp, LOCK_UN); //ファイルロック解除
      }
    }
    fclose($fp); //ファイル閉じる
  }

  //指定したページにリダイレクト
  header('Location: ' . $_SERVER['SCRIPT_NAME']);
  exit;
}

// var_dump($BOARD);
// var_dump($DATA);
// var_dump($DATA);
// var_dump($key);

?>





<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TODOリスト</title>
  <!-- <link rel="stylesheet" href="./css/reset.css"> -->
  <link rel="stylesheet" href="./css/styles.css">
</head>

<body>

  <div class="container">
    <h1>Today's TODO</h1>
    <p id="realtime"></p>
    <form action="" method="post">
      <input type="text" name="txt" class="text">
      <input type="submit" value="投稿" class="btn">
    </form>


    <table>
      <?php foreach ($BOARD as $key => $DATA) { ?>
        <tr>
          <td><?= $DATA; ?></td>
          <td>
            <form action="" method="post">
              <input type="hidden" name="del" value="<?= $key; ?>" class="text">
              <input type="submit" value="削除" class="btn">
            </form>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>

  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- javascript -->
  <script>
    //リアルタイム表示
    const realtime = document.getElementById('realtime');
    console.log(realtime);

    function time() {
      let today = new Date();
      realtime.innerHTML = today.toLocaleString("ja");
      window.requestAnimationFrame(time);
    };

    time();
  </script>
</body>

</html>