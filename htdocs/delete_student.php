<?php

$host = 'mysql';
$username = 'data_user';
$password = 'data';
$database = 'data_master';

$mysql = new mysqli($host, $username, $password, $database);

if ($mysql->connect_error) {
    die("接続失敗: " . $mysql->connect_error);
}

$student_id = filter_input(INPUT_POST, 'student_id', FILTER_VALIDATE_INT);

if ($student_id === false || $student_id === null) {
    die("不正なstudent_idです。");
}

$stmt = $mysql->prepare("DELETE FROM students WHERE student_id = ?");
$stmt->bind_param("i", $student_id);

if ($stmt->execute()) {
    // header("Location: get_students.php"); // 一覧を取得するページ名に変更

    echo "ID:" . htmlspecialchars($student_id) . " deleted";
    echo "<br>";
    echo "<a href='get_students.php'>back</a>";
    exit;
} else {
    echo "削除に失敗しました: " . $stmt->error;
}

$stmt->close();
$mysql->close();