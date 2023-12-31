<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Рейтинг пользователей</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/style/background_style.css"/>
    </head>

    <body>

    <div class="background">

        <?php include '../header.php'?>

        <div class="container">
            <h2>Рейтинг пользователей</h2>
            <?php
            // Подключение к БД
            $db = new mysqli('localhost', 'p523033_admin', 'eQ5kJ0dN5a', 'p523033_Test_3');

            // Выборка всех пользователей и их количества выполненных заданий, отсортированных по убыванию
            $query = "SELECT `Пользователи`.`Имя`, COUNT(*) AS `Количество_заданий` FROM `История` JOIN `Пользователи`
          ON `История`.`Пользователь` = `Пользователи`.`Код пользователя` GROUP BY `Пользователи`.`Имя`
          ORDER BY `Количество_заданий` DESC";
            $result = mysqli_query($db, $query);

            $query2 = "SELECT `Пользователи`.`Имя`, COUNT(*) AS `Количество_заданий_2` FROM `История тестов` JOIN `Пользователи`
          ON `История тестов`.`Пользователь` = `Пользователи`.`Код пользователя` GROUP BY `Пользователи`.`Имя`
          ORDER BY `Количество_заданий_2` DESC";
            $result2 = mysqli_query($db, $query2);

            // Формирование HTML-таблицы с данными
            echo '<h4>Рейтинг по подборкам</h4>';
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr><th>#</th><th>Имя пользователя</th><th>Количество выполненных заданий</th></tr>';
            echo '</thead>';
            echo '<tbody>';
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr><td>'.$i.'</td><td>'.$row['Имя'].'</td><td>'.$row['Количество_заданий'].'</td></tr>';
                $i++;
            }
            echo '</tbody>';
            echo '</table>';

            if (!$result) {
                die('Ошибка запроса: ' . mysqli_error($db));
            }

            echo '<h4>Рейтинг по тестам</h4>';
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr><th>#</th><th>Имя пользователя</th><th>Количество выполненных заданий</th></tr>';
            echo '</thead>';
            echo '<tbody>';
            $i = 1;
            while ($row = mysqli_fetch_assoc($result2)) {
                echo '<tr><td>'.$i.'</td><td>'.$row['Имя'].'</td><td>'.$row['Количество_заданий_2'].'</td></tr>';
                $i++;
            }
            echo '</tbody>';
            echo '</table>';

            if (!$result2) {
                die('Ошибка запроса: ' . mysqli_error($db));
            }

            // Закрытие соединения с БД
            mysqli_close($db);
            ?>

            <div class="button">
                <a href="profile.php" class="btn btn-secondary" style="float: right;">Отменить</a>
            </div>
        </div>

        <?php include '../footer.php'?>


    </div>

    <script src="/libs/jquery-3.6.1.min.js"></script>
    <script src="/libs/bootstrap-5.3.1-dist/js/bootstrap.min.js"></script>

    </body>

</html>
