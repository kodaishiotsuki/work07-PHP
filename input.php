<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sauna_Research</title>
  <link rel="stylesheet" href="./css/input.css">
</head>


<body>
  <div class="container">
    <div class="main">
      <!-- formにはaction, method, nameを設定！ -->
      <h1>♨️サウナに行こう♨️</h1>
      <form action="output.php" method="post">
        <!-- <a href="output.php">一覧画面</a> -->



        <dl>
          <!-- アンケート1 -->
          <dt>■性別</dt>
          <dd class="gender">
            <div class="gender_select">
              <label><input type="radio" name="gender" value="male" required>male</label>
            </div>
            <div class="gender_select">
              <label><input type="radio" name="gender" value="female" required>female</label>
            </div>
          </dd>


          <!-- アンケート2 -->
          <dt>■あなたはサウナに行ったことがありますか??</dt>
          <dd class="question_1">
            <div class="question_1">
              <label><input type="radio" name="question_1" value="行ったことがある" required>行ったことがある</label>
            </div>
            <div class="question_1">
              <label><input type="radio" name="question_1" value="行ったことはないが、行ってみたい" required>行ったことはないが、行ってみたい</label>
            </div>
            <div class="question_1">
              <label><input type="radio" name="question_1" value="行ったことはなく、今後も行く予定はない" required>行ったことはなく、今後も行く予定はない</label>
            </div>
          </dd>


          <!-- アンケート3 -->
          <dt>■あなたはどのくらいの頻度でサウナに行きますか??</dt>
          <dd class="question_2">
            <div class="question_2">
              <label><input type="radio" name="question_2" value="週に2回以上" required>週に2回以上</label>
            </div>
            <div class="question_2">
              <label><input type="radio" name="question_2" value="週に1回程度" required>週に1回程度</label>
            </div>
            <div class="question_2">
              <label><input type="radio" name="question_2" value="月に数回程度" required>月に数回程度</label>
            </div>
            <div class="question_2">
              <label><input type="radio" name="question_2" value="2〜3ヶ月に1回程度" required>2〜3ヶ月に1回程度</label>
            </div>
            <div class="question_2">
              <label><input type="radio" name="question_2" value="半年に1回程度" required>半年に1回程度</label>
            </div>
            <div class="question_2">
              <label><input type="radio" name="question_2" value="1年に1回程度" required>1年に1回程度</label>
            </div>
          </dd>

          <!-- アンケート4 -->
          <dt>■あなたはどのような目的でサウナに行きますか??</dt>
          <dd class="question_3">
            <label><input type="radio" name="question_3" value="疲労回復効果" required>疲労回復効果</label><br>
            <label><input type="radio" name="question_3" value="ダイエット" required>ダイエット</label><br>
            <label><input type="radio" name="question_3" value="安眠効果" required>安眠効果</label><br>
            <label><input type="radio" name="question_3" value="友人との交流の場" required>友人との交流の場</label><br>
            <label><input type="radio" name="question_3" value="ととのいたい!!" required>ととのいたい!!</label>
          </dd>

          <!-- アンケート5 -->
          <dt>■あなたがサウナを選ぶ際、重視するポイントを教えてください。</dt>
          <dd class="question_4">
            <label><input type="radio" name="question_4" value="価格" required>価格</label><br>
            <label><input type="radio" name="question_4" value="サウナ室の温度" required>サウナ室の温度</label><br>
            <label><input type="radio" name="question_4" value="外気浴など、クールダウンできる場所" required>外気浴など、クールダウンできる場所</label><br>
            <label><input type="radio" name="question_4" value="水風呂の温度" required>水風呂の温度</label>
          </dd>

          <!-- アンケート6 -->
          <dt>■施設内が混雑しており、せっかく来たのに入れないときの絶望感を味わったことがありますか??<br>
            例:サウナ内に人が多すぎて入れなかった<br>
            例:外気浴スペースが混雑しており「ととのう」ことができなかった</dt>
          <dd class="question_5">
            <div class="question_5">
              <label><input type="radio" name="question_5" value="ある..." required>ある...</label>
              <label><input type="radio" name="question_5" value="ない!!" required>ない!!</label>
            </div>
          </dd>
        </dl>
    </div>


    <!-- ボタン -->
    <div class="button">
      <input type="submit" value="DONE" class="btn">
      <input type="reset" value="RESET" class="btn">
    </div>
    </form>
  </div>



</body>

</html>