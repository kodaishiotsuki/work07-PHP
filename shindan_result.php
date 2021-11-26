<?php
// print_r($_POST);
// var_dump($_POST);
// exit();

//ポイントを初期化
$point = 0;
foreach ($_POST as $key => $value) {
  //shindanという文字が含まれるキーだったら集計する
  if (strpos($key, 'shindan') !== false) {
    $point += $value;
  }
}

//合計数値ごとにテキスト表示を変える
$result_text = '';
if ($point == 20) {
  $result_text = 'すごい！あなたはスーパーリア充だ！';
} elseif ($point >= 15) {
  $result_text = '十分なリア充！爆発しろ！';
} elseif ($point >= 10) {
  $result_text = 'ややリア充！略してやや充！';
} elseif ($point >= 5) {
  $result_text = 'リア充の一歩手前！';
} else {
  $result_text = 'リア充力が足りない！でも幸せならいいかも！';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>結果発表</title>
  <link rel="stylesheet" href="./css/shindan.css">
</head>

<body>
  <div class="result">
    <h2>
      <?php echo $point . '点！' . $result_text; ?>
    </h2>
    <p style="color: red;">診断結果には何の意味もないので、結果を深く考えないでください。</p>
  </div>

</body>

</html>