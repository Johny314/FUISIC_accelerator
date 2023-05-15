<!DOCTYPE html>
<html>
<head>
    <title>База данных</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/index_style.css">
    <link rel="stylesheet" href="style/collections_style.css">
</head>
<body>
<div class="container">
    <div class="header">
        <a href="index.html" class="header-text main_txt">Главная</a>
        <a href="collections.php" class="header-text coll_txt">Подборки</a>
        <a href="Tests.php" class="header-text test_txt">Тесты</a>
        <a href="support.php" class="header-text help_txt">Помощь</a>
        <?php
        // Проверяем, авторизован ли пользователь
        if (!isset($_COOKIE['user'])) {
            echo ("<a href='Validation-form/login-form.php' class='header-text auth_txt'>войти</a>");
        }
        else echo ("<a href='Validation-form/login-form.php' class='header-text auth_txt'>Профиль</a>");
        ?>
        <a href="index.php" id="logo"></a>
    </div>
    <form method="GET" action="show_tasks.php">
        <?php
        $link = new mysqli('localhost', 'p523033_admin', 'eQ5kJ0dN5a', 'p523033_test_3');
        $query = "SELECT * FROM Разделы";
        $result = mysqli_query($link, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<p class="name_of_collections">' . $row['Название'] . '</p>';

            $query2 = "SELECT * FROM Тесты WHERE Раздел = '{$row['Код Раздела']}'";
            $result2 = mysqli_query($link, $query2);

            echo '<div class="btn-group-horizontal mt-2" id="conteiner_mt" role="group">';

            while ($row2 = mysqli_fetch_assoc($result2)) {
                echo '<a class="coll_block ph start_ph p_ph" id="coll_block_text" href="show_tasks.php?test=' . $row2['Код_Теста'] . '">' . $row2['Название'] . '</a>';
            }

            echo '</div>';

            mysqli_free_result($result2);
        }

        mysqli_free_result($result);
        mysqli_close($link);
        ?>
    </form>
</div>
<div id="footer">
    <p id="footer_heading">FUISIC</p>
    <p id="footer_text">Контакты: avmineev@edu.hse.ru</p>
</div>
<script>
    function startTest(testId) {
        window.location.href = "test.php?id="+testId;
    }
</script>
<script src="jquery-3.6.1.min.js"></script>
</body>
</html>