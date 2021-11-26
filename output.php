<?php
// var_dump($_POST);
// exit();

//ポストを受け取る
$gender = $_POST['gender'];
$question_1 = $_POST['question_1'];
$question_2 = $_POST['question_2'];
$question_3 = $_POST['question_3'];
$question_4 = $_POST['question_4'];
$question_5 = $_POST['question_5'];
//受け取った内容をまとめる
$str = $gender . ',' . $question_1 . ',' . $question_2 . ',' . $question_3 . ',' . $question_4 . ',' . $question_5;
//書き込み
$file = fopen('data/data.csv', 'a'); //ファイルの読み込み
flock($file, LOCK_EX); //ファイルロック
fwrite($file, $str . "\n"); //ファイルの書き込み("\n"は改行)
flock($file, LOCK_UN); //ファイルロック解除
fclose($file); //ファイルを閉じる


// リロード防止//（上手くできない。。。。。）
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  header("Location:output.php");
  exit();
}

// if(!isset($_POST) || $_POST === ''){
//   exit();
// }



//読み込み
$table = ''; //出力用の変数を用意
$file = fopen('data/data.csv', 'r'); //ファイルを開く
flock($file, LOCK_EX); //ファイルをロック
if ($file) {
  while ($data = fgetcsv($file, 10000)) { //fgetcsv()で1行ずつ取得⇨$dataに格納
    // var_dump($data);
    // exit();
    $table .= '<tr>'; //trを表示
    foreach ($data as $d) { //配列$dataから要素の値を変数$dに代入
      $table .= '<td>' . $d . '</td>'; //tdに$d(表示内容)を入れる
    }
    $table .= "</tr>\n"; //trを表示(\nで改行)
  }
}
flock($file, LOCK_UN); //ファイルロック解除
fclose($file); //ファイルを閉じる


// -----csvファイルを配列に-----//

// ファイルを変数に入れる
$csv_file = file_get_contents('data/data.csv');

//変数を改行毎の配列に変換
$aryHoge = explode("\n", $csv_file);

$aryCsv = [];
foreach ($aryHoge as $key => $value) {
  //if($key == 0) continue; 1行目が見出しなど、取得したくない場合
  if (!$value) continue; //空白行が含まれていたら除外
  $aryCsv[] = explode(",", $value);
}
// print_r($aryCsv[0]);
?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>結果表示</title>
  <style>
    body {
      background-color: #fff1cf;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .main {
      width: 100%;
      display: flex;
      flex-wrap: wrap;
    }

    .graph {
      width: 33%;
      margin-top: 100px;
    }

    .sub{
      margin-left: 20%;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- グラフ -->
    <div class="main">
      <div class="graph">
        <canvas id="myPieChart"></canvas>
      </div>
      <div class="graph">
        <canvas id="myPieChart1"></canvas>
      </div>
      <div class="graph">
        <canvas id="myPieChart2"></canvas>
      </div>
      <div class="graph">
        <canvas id="myPieChart3"></canvas>
      </div>
      <div class="graph">
        <canvas id="myPieChart4"></canvas>
      </div>
      <div class="graph">
        <canvas id="myPieChart5"></canvas>
      </div>
    </div>
  </div>

  <div class="sub">
    <table id="raw" border="1" cellspacing="0" bordercolor="#000000">
      <tr>
        <th>性別</th>
        <th>サウナの有無</th>
        <th>サウナの頻度</th>
        <th>サウナの目的</th>
        <th>サウナの重視</th>
        <th>サウナ絶望感</th>
      </tr>
      <?php foreach ($aryCsv as $value) { ?>
        <tr>
          <td><?= $value[0] ?></td>
          <td><?= $value[1] ?></td>
          <td><?= $value[2] ?></td>
          <td><?= $value[3] ?></td>
          <td><?= $value[4] ?></td>
          <td><?= $value[5] ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>




  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- chart.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
  <!-- javascript -->
  <script>
    //PHP→js
    const hogeArray = <?= json_encode($aryCsv) ?>;
    console.log(hogeArray);


    //------------------------グラフsection--------------------------//
    //-----変数定義-----//
    //性別
    let genders = {
      maleCount: 0,
      femaleCount: 0
    };
    //question_1
    let question1 = {
      answer1: 0,
      answer2: 0,
      answer3: 0
    };
    //question_2
    let question2 = {
      answer1: 0,
      answer2: 0,
      answer3: 0,
      answer4: 0,
      answer5: 0,
      answer6: 0,
    };
    //question_3
    let question3 = {
      answer1: 0,
      answer2: 0,
      answer3: 0,
      answer4: 0,
      answer5: 0
    }
    //question_4
    let question4 = {
      answer1: 0,
      answer2: 0,
      answer3: 0,
      answer4: 0,
    }
    //question_5
    let question5 = {
      yes: 0,
      no: 0
    }
    //-----変数定義おわり-----//


    //-----円グラフ（性別）-----//
    for (i = 0; i < hogeArray.length; i++) {
      if (hogeArray[i][0] === 'male') {
        genders.maleCount++;
        // console.log(genders.maleCount);
      } else if (hogeArray[i][0] === 'female') {
        genders.femaleCount++;
        // console.log(genders.femaleCount);
      }

      var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ["男性", "女性", ], //データ項目のラベル
          datasets: [{
            backgroundColor: [
              "#ff0000",
              "#00ffff",
            ],
            data: [genders.maleCount, genders.femaleCount] //グラフのデータ
          }]
        },
        options: {
          title: {
            display: true,
            //グラフタイトル
            text: '性別'
          }
        }
      });
    };


    //-----円グラフ（質問1）-----//
    for (i = 0; i < hogeArray.length; i++) {
      switch (hogeArray[i][1]) {
        case '行ったことがある':
          question1.answer1++
          break

        case '行ったことはないが、行ってみたい':
          question1.answer2++
          break

        case '行ったことはなく、今後も行く予定はない':
          question1.answer3++
          break
      }

      var ctx1 = document.getElementById("myPieChart1");
      var myPieChart1 = new Chart(ctx1, {
        type: 'pie',
        data: {
          labels: [
            "行ったことがある",
            "行ったことはないが、行ってみたい",
            "行ったことはなく、今後も行く予定はない"
          ], //データ項目のラベル
          datasets: [{
            backgroundColor: [
              "#f5f5f5",
              "#999999",
              "#cccccc"
            ],
            data: [
              question1.answer1,
              question1.answer2,
              question1.answer3
            ] //グラフのデータ
          }]
        },
        options: {
          title: {
            display: true,
            //グラフタイトル
            text: '質問1'
          }
        }
      });
    }


    //-----円グラフ（質問2）-----//
    for (i = 0; i < hogeArray.length; i++) {
      switch (hogeArray[i][2]) {
        case '週に2回以上':
          question2.answer1++
          break

        case '週に1回程度':
          question2.answer2++
          break

        case '月に数回程度':
          question2.answer3++
          break

        case '2〜3ヶ月に1回程度':
          question2.answer4++
          break

        case '半年に1回程度':
          question2.answer5++
          break

        case '1年に1回程度':
          question2.answer6++
          break
      }

      var ctx2 = document.getElementById("myPieChart2");
      var myPieChart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
          labels: [
            "週に2回以上",
            "週に1回程度",
            "月に数回程度",
            "2〜3ヶ月に1回程度",
            "半年に1回程度",
            "1年に1回程度",
          ], //データ項目のラベル
          datasets: [{
            backgroundColor: [
              "#9900ff",
              "#ff0066",
              "#ff9900",
              "#66ff00",
              "#00ff99",
              "#0066ff",
            ],
            data: [
              question2.answer1,
              question2.answer2,
              question2.answer3,
              question2.answer4,
              question2.answer5,
              question2.answer6,
            ] //グラフのデータ
          }]
        },
        options: {
          title: {
            display: true,
            //グラフタイトル
            text: '質問2'
          }
        }
      });
    }


    //-----円グラフ（質問3）-----//
    for (i = 0; i < hogeArray.length; i++) {
      switch (hogeArray[i][3]) {
        case '疲労回復効果':
          question3.answer1++
          break

        case 'ダイエット':
          question3.answer2++
          break

        case '安眠効果':
          question3.answer3++
          break

        case '友人との交流の場':
          question3.answer4++
          break

        case 'ととのいたい!!':
          question3.answer5++
          break
      }

      var ctx3 = document.getElementById("myPieChart3");
      var myPieChart3 = new Chart(ctx3, {
        type: 'pie',
        data: {
          labels: [
            "疲労回復効果",
            "ダイエット",
            "安眠効果",
            "友人との交流の場",
            "ととのいたい!!"
          ], //データ項目のラベル
          datasets: [{
            backgroundColor: [
              "#995c00",
              "#1f9900",
              "#009999",
              "#1f0099",
              "#99005c",
            ],
            data: [
              question3.answer1,
              question3.answer2,
              question3.answer3,
              question3.answer4,
              question3.answer5
            ] //グラフのデータ
          }]
        },
        options: {
          title: {
            display: true,
            //グラフタイトル
            text: '質問3'
          }
        }
      });
    }


    //-----円グラフ（質問4）-----//
    for (i = 0; i < hogeArray.length; i++) {
      switch (hogeArray[i][4]) {
        case '価格':
          question4.answer1++
          break

        case 'サウナ室の温度':
          question4.answer2++
          break

        case '外気浴など、クールダウンできる場所':
          question4.answer3++
          break

        case '水風呂の温度':
          question4.answer4++
          break
      }

      var ctx4 = document.getElementById("myPieChart4");
      var myPieChart4 = new Chart(ctx4, {
        type: 'pie',
        data: {
          labels: [
            "価格",
            "サウナ室の温度",
            "外気浴など、クールダウンできる場所",
            "水風呂の温度"
          ], //データ項目のラベル
          datasets: [{
            backgroundColor: [
              "#998d7a",
              "#7a997e",
              "#7a8699",
              "#997a95",
            ],
            data: [
              question4.answer1,
              question4.answer2,
              question4.answer3,
              question4.answer4
            ] //グラフのデータ
          }]
        },
        options: {
          title: {
            display: true,
            //グラフタイトル
            text: '質問4'
          }
        }
      });
    }


    //-----円グラフ（質問5）-----//
    for (i = 0; i < hogeArray.length; i++) {
      if (hogeArray[i][5] === 'ある...') {
        question5.yes++;
      } else if (hogeArray[i][5] === 'ない!!') {
        question5.no++;
      }

      var ctx5 = document.getElementById("myPieChart5");
      var myPieChart5 = new Chart(ctx5, {
        type: 'pie',
        data: {
          labels: ["ある...", "ない!!", ], //データ項目のラベル
          datasets: [{
            backgroundColor: [
              "#ffff00",
              "#0000ff",
            ],
            data: [question5.yes, question5.no] //グラフのデータ
          }]
        },
        options: {
          title: {
            display: true,
            //グラフタイトル
            text: '質問5'
          }
        }
      });
    };






    //グラフ
    // var ctx = document.getElementById("myPieChart");
    // var myPieChart = new Chart(ctx, {
    //   type: 'pie',
    //   data: {
    //     labels: ["賛成", "反対", "わからない", "未回答"], //データ項目のラベル
    //     datasets: [{
    //       backgroundColor: [
    //         "#c97586",
    //         "#bbbcde",
    //         "#93b881",
    //         "#e6b422"
    //       ],
    //       data: [45, 32, 18, 5] //グラフのデータ
    //     }]
    //   },
    //   options: {
    //     title: {
    //       display: true,
    //       //グラフタイトル
    //       text: '新法案賛否'
    //     }
    //   }
    // });
  </script>
</body>

</html>