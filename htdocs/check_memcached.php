<?php
$host = 'mysql';

$username = 'data_user';
$password = 'data';
$database = 'data_master';

$memcachedHost = 'memcached';
$memcachedPort = 11211;

$cacheKey = 'all_students_data';

$expireSeconds = 60;

$memcached = new Memcached();
$memcached->addServer($memcachedHost, $memcachedPort);

$results = null;
$source = '';

$cachedData = $memcached->get($cacheKey);

if($memcached->getResultCode() == Memcached::RES_SUCCESS){
    $results = $cachedData;
    $source = 'Memcached(キャッシュ)';
} else {
    try{
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM students");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $memcached->set($cacheKey, json_encode($results), $expireSeconds);
    $source = 'MySQL(データベース)';
    } catch (PDOException $e) {
        echo "データベースエラー: " . $e->getMessage();
        exit;
    }
}
$students = is_string($results) ? json_decode($results, true) : $results;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>student_list</title>
</head>
<body>

<h1>student_list</h1>

<!-- データ取得元をヘッダーに表示 -->
<p>データ取得元: <strong><?php echo htmlspecialchars($source, ENT_QUOTES, 'UTF-8'); ?></strong></p>

<?php
if (!empty($students) && count($students) > 0) {
    echo "<table border='1'>";

    // ヘッダー
    echo "<thead><tr>";
    foreach (array_keys($students[0]) as $column) {
        echo "<th>" . htmlspecialchars($column, ENT_QUOTES, 'UTF-8') . "</th>";
    }
    echo "</tr></thead>";

    // データ
    echo "<tbody>";
    foreach ($students as $row) {
        echo "<tr>";

        foreach ($row as $column => $value) {
            echo "<td>";
            if ($column === 'class_id') {
                echo "<a href='get_class.php?class_id=" . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . "'>" .
                     htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . "</a>";
            } else {
                echo htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
            }
            echo "</td>";
        }

        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

    echo "<br>";
    echo "<a href='register_form.html'>登録</a>";

} else {
    echo "<p>生徒データが存在しません。</p>";
}
?>

</body>
</html>