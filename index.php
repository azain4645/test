<?php 

// testtest
require_once('appvars.php');
$pbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('エラー：サーバーとの接続に失敗しました');

if(isset($_POST['submit'])){
    foreach($_POST['todelete'] as $delete_id){
    $query = "DELETE FROM anser WHERE id = $delete_id";
    mysqli_query($pbc, $query) or die('エラー：データベースの問い合わせに失敗');
    }
    echo '顧客を削除しました<br>';
};
?>

// Bug fix by imaizume
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>リスト</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">辛口診断</a>
  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="ナビゲーションの切替">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">ホーム <span class="sr-only">(現位置)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">リンク1</a>
      </li>
    </ul>
    <span class="navbar-text">
      管理者用画面
    </span>
  </div>
</nav>
<div class="container">
    <h1 class="mt-3 mb-5">あなたの○○になる確率は？</h1>
    <div class="row mb-5">
        <h5 class="col-12">データを入力する</h5>
        <form action="karakuti_record.php" method='post'>
        <div class="form-group row">
            <label for="nameval" class="col-sm-2 col-form-label mb-1">パーセント</label>
            <div class="col-sm-3">
                <input type="text" class="form-control mb-3" name="percent" required="" size="5">
            </div>
            <div class="col-sm-6"></div>
            <label for="textval" class="col-sm-2 col-form-label mb-1">コメント</label>
            <div class="col-sm-10 mb-3">
                <textarea type="text" class="form-control mb-3" id="textval" name="comment" rows="5" required=""></textarea>
            </div>
            <div class="col-sm-10 offset-sm-2">
                <button class="button" type="submit">データを保存する</button>
            </div>
        </div>
        </form>
    </div>
    <div class="row">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table class="table">
    <tr>
        <th>削除</th>
        <th>ID</th>
        <th>％</th>
        <th>コメント</th>
    </tr>
    <?php
            $pbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('エラー：サーバーとの接続に失敗しました');

            $query = "select * from anser";
            $result = mysqli_query($pbc, $query) or die('エラー：データベースの問い合わせに失敗');

            while ($row = mysqli_fetch_array($result)){
                echo '<tr>';
                echo '<td>' . '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]"></td>';
                echo '<td>' . $row['id'] .'</td>';
                echo '<td>' . $row['percent'] .'</td>';
                echo '<td>' . $row['comment'] .'</td>';
                echo '</tr>';
            }

            mysqli_close($pbc);
    ?>
    </table>
    <input type="submit" name="submit" value="削除">
    </form>
    </div>
</div>
<div class="mt-5 mb-5">  </div>
</body>
</html>
