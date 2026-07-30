<?php
// データベースへ接続するために必要な情報
// ホストはDBコンテナ
$host = 'mysql';
// mysql接続用のユーザー
$username = 'data_user';
$password = 'data';
$database = 'data_master';

// データベースへ接続するためのクラス生成
$mysql = new mysqli($host, $username, $password, $database);

// 接続エラーの確認
if ($mysql->connect_error) {
    die("データベース接続エラー: " . $mysql->connect_error);
}

$class_id = 0;
if(isset($_GET['class_id'])){
    $class_id = $_GET['class_id'];
}

if($class_id) {
    $sql = "SELECT * FROM classes WHERE class_id = ". $class_id;
    }
    else{
    $sql = "SELECT * FROM classes";
}


// クエリの実行
$result = $mysql->query($sql);

// 結果の処理
if ($result) {
    if ($result && $result->num_rows > 0) {
    $classes = [];
    while ($row = $result->fetch_assoc()) {
        $classes[] = $row;
    }

    echo "<table>";
    echo "<thead><tr>";

    foreach (array_keys($classes[0]) as $column) {
        echo "<th>" . htmlspecialchars($column) . "</th>";
    }
    echo "</tr></thead>";
    
    echo "<tbody>";

    foreach ($classes as $row) {
        echo "<tr>";

        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    } else {
        echo "該当するデータはありません。";
    }
    // 結果セットを解放
    // $result->free();
} else {
    echo "クエリの実行に失敗しました: " . $mysql->error;
}

// データベース接続を閉じる
$mysql->close();

?>