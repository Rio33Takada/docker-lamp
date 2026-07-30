<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>display_students</title>
</head>

<body>

<h1>student_list</h1>

<?php
if (isset($_SESSION['students'])) {
    $students = $_SESSION['students'];

    if (count($students) > 0) {

        echo "<table border='1'>";

        // ヘッダー
        echo "<thead><tr>";
        foreach (array_keys($students[0]) as $column) {
            echo "<th>" . htmlspecialchars($column) . "</th>";
        }
        echo "<th>削除</th>";
        echo "</tr></thead>";

        // データ
        echo "<tbody>";
        foreach ($students as $row) {

            echo "<tr>";

            foreach ($row as $column => $value) {

                echo "<td>";

                if ($column === 'class_id') {
                    echo "<a href='get_class.php?class_id=" .
                        htmlspecialchars($value) . "'>" .
                        htmlspecialchars($value) .
                        "</a>";
                } else {
                    echo htmlspecialchars($value);
                }

                echo "</td>";
            }

            // 削除ボタン
            echo "<td>";
            echo "<form action='delete_student.php' method='POST'
                    onsubmit=\"return confirm('この学生を削除しますか？');\">";
            echo "<input type='hidden' name='student_id'
                    value='" . htmlspecialchars($row['student_id']) . "'>";
            echo "<button type='submit'>削除</button>";
            echo "</form>";
            echo "</td>";

            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

        echo "<br>";
        echo "<a href='register_form.html'>登録</a>";

    } else {
        echo "<p>no students1</p>";
    }

    unset($_SESSION['students']);

} else {
    echo "<p>no students2</p>";
}
?>

</body>
</html>