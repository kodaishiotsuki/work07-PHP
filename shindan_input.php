<?php
//4択の選択肢を5問表示させる
//選択肢ごとに点数を設ける
$aryShindan = [];

$cnt = 1;
$aryShindan[$cnt]['question'] = '妻・夫、または彼女・彼氏がいる??';
$aryShindan[$cnt]['answer'][] = ['point' => 4, 'text' => 'いる'];
$aryShindan[$cnt]['answer'][] = ['point' => 3, 'text' => 'いたけど1年以内に分かれた'];
$aryShindan[$cnt]['answer'][] = ['point' => 2, 'text' => 'いたけど5年以内に分かれた'];
$aryShindan[$cnt]['answer'][] = ['point' => 1, 'text' => 'いない歴＝年齢'];


$cnt = 2;
$aryShindan[$cnt]['question'] = 'あなたのLINEの友達の人数は？';
$aryShindan[$cnt]['answer'][] = ['point' => 4, 'text' => '100人以上'];
$aryShindan[$cnt]['answer'][] = ['point' => 3, 'text' => '30～99人'];
$aryShindan[$cnt]['answer'][] = ['point' => 2, 'text' => '10～29人'];
$aryShindan[$cnt]['answer'][] = ['point' => 1, 'text' => '9人以下'];

$cnt = 3;
$aryShindan[$cnt]['question'] = '週ごとに友達とは何日会う？';
$aryShindan[$cnt]['answer'][] = ['point' => 4, 'text' => '3日以上'];
$aryShindan[$cnt]['answer'][] = ['point' => 3, 'text' => '2日'];
$aryShindan[$cnt]['answer'][] = ['point' => 2, 'text' => '1日'];
$aryShindan[$cnt]['answer'][] = ['point' => 1, 'text' => '1回も合わない日が多い'];

$cnt = 4;
$aryShindan[$cnt]['question'] = '年賀状は何枚届いた？';
$aryShindan[$cnt]['answer'][] = ['point' => 4, 'text' => '20枚以上'];
$aryShindan[$cnt]['answer'][] = ['point' => 3, 'text' => '10~19枚'];
$aryShindan[$cnt]['answer'][] = ['point' => 2, 'text' => '5~9枚'];
$aryShindan[$cnt]['answer'][] = ['point' => 1, 'text' => '4枚以下'];

$cnt = 5;
$aryShindan[$cnt]['question'] = 'あけおめLINEが届いた人数は？';
$aryShindan[$cnt]['answer'][] = ['point' => 4, 'text' => '20人以上'];
$aryShindan[$cnt]['answer'][] = ['point' => 3, 'text' => '10~19人'];
$aryShindan[$cnt]['answer'][] = ['point' => 2, 'text' => '5~9人'];
$aryShindan[$cnt]['answer'][] = ['point' => 1, 'text' => '4人以下'];

// print_r($aryShindan);

// var_dump($aryShindan);
// exit();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>リア充診断</title>
  <link rel="stylesheet" href="./css/shindan.css">
</head>

<body>
  <div class="main">
    <h1>リア充診断</h1>
    <form action="shindan_result.php" method="post">
      <!-- 設定した配列をforeachで回してHTMLを生成 -->
      <!-- タイトル -->
      <?php foreach ($aryShindan as $key1 => $val1) { ?>
        <p><?= $key1 . '.' . $val1['question'] ?></p>

        <!-- 選択肢のループ -->
        <?php foreach ($val1['answer'] as $key2 => $val2) { ?>
          <div>
            <label>
              <input required type="radio" name="shindan<?= $key1 ?>" value="<?= $val2['point'] ?>"> <?= $val2['text'] ?>
            </label>
          </div>
        <?php } ?>

        
      <?php } ?>
      <input class="btn" type="submit" value="回答する">
    </form>
  </div>


  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- javascript -->
  <script>

  </script>
</body>

</html>