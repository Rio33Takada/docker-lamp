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

$student_name = $_POST['student_name'];
$class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);

$sql = "
SELECT MIN(t1.student_id + 1) AS next_id
FROM students t1
LEFT JOIN students t2
ON t1.student_id + 1 = t2.student_id
WHERE t2.student_id IS NULL
";

$result = $mysql->query("SELECT student_id FROM students ORDER BY student_id");

$student_id = 1;

while ($row = $result->fetch_assoc()) {
    if ($row['student_id'] != $student_id) {
        break;
    }
    $student_id++;
}

if ($class_id === false || $class_id === null) {
    die("Class IDは整数で入力してください。");
} else {
    $sql = "INSERT INTO students (student_id, student_name, class_id)
    VALUES (?, ?, ?)";

    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("isi", $student_id, $student_name, $class_id);
}


$stmt = $mysql->prepare($sql);

if (!$stmt) {
    die("Prepare失敗: " . $mysql->error);
}

$stmt->bind_param("isi", $student_id, $student_name, $class_id);

if ($stmt->execute()) {
    echo "登録が完了しました。";
    echo "<br>";
    echo "<a href='get_students.php'>一覧</a>";
} else {
    echo "登録に失敗しました: " . $stmt->error;
}

$stmt->close();

// データベース接続を閉じる
$mysql->close();

?>
