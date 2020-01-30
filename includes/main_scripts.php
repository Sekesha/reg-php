<?php

$ss = auth();

function auth()
{
    if (!isset($_SESSION['user_data']['status'])) $_SESSION['user_data']['status'] = "user";
    if ($_SESSION['user_data']['status'] === 'auth') {
        $str = "Привет " . $_SESSION['user_data']['name'] . "<a href=\"/user.php?page=exit\">Выход</a>";
    } elseif (isset($_SESSION['user_data']['status'])) {
        $str = "<a href=\"/user.php?page=regiser\">Регистрация</a><a href=\"/user.php?page=auth\">Войти</a>";
    } //elseif (){}
    return $str;
}


function stat_user($status)
{
    if ($_GET['page'] == 'auth') {
        $string_page = "<h1>Авторизация</h1><hr><br>
        <div>
            <form class=\"reg_form\" action=\"\" method=\"post\">
                <div><input type=\"text\" name=\"login\" placeholder=\"Логин\"></div>
                <div><input type=\"password\" name=\"pass\" placeholder=\"Пароль\"></div>
                <div>
                    <button class=\"submit_button\" type=\"submit\" name=\"user_go\" value=\"registration\">
                        Войти
                    </button>
                    <div>
                        <? echo $status; ?>
                    </div>
                </div>
            </form>
        </div>";

    } elseif ($_GET['page'] == 'regiser') {
        $string_page = "<h1>Регистрация</h1><hr><br>
        <div>
            <form class=\"reg_form\" action=\"\" method=\"post\">
                <div><input type=\"text\" name=\"new_login\" placeholder=\"Новый логин\"></div>
                <div><input type=\"password\" name=\"new_pass\" placeholder=\"Новый пароль\"></div>
                <div><input type=\"password\" name=\"new_pass1\" placeholder=\"Подтверждение пароля\"></div>
                <div>
                    <button class=\"submit_button\" type=\"submit\" name=\"new_user\" value=\"registration\">
                        Регистрация
                    </button>
                </div>
                <div>
                    <? echo $status; ?>
                </div>
            </form>
        </div>";
    } elseif ($_GET['page'] == 'exit') {
        $_SESSION = [];
        $_SESSION['user_data']['status'] = "user";
        $_POST = null;
        unset($_COOKIE[session_name()]);
        session_destroy();
        header('Location: /');
    }
    return $string_page;
}

function user_login($connect) //регистрация и авторизация
{
    if (isset($_POST['new_user'])) { //регистрация
        $status = "";
        $new_login = trim(htmlspecialchars($_POST['new_login']));
        $new_pass = trim(htmlspecialchars($_POST['new_pass']));
        $new_pass1 = trim(htmlspecialchars($_POST['new_pass1']));

        $query = "SELECT id FROM users WHERE user_login = '" . $new_login . "'";
        $result = mysqli_num_rows(mysqli_query($connect, $query));

        if ($result) $status = "Логин существует";
        elseif (($new_login != '') && ($new_pass != '') && ($new_pass == $new_pass1)) {
            $query = "INSERT INTO users VALUES (NULL, '" . $new_login . "', '" . password_hash($new_pass, PASSWORD_DEFAULT) . "', '0');";
            $result = mysqli_query($connect, $query);
            $_SESSION['user_data']['status'] = 'user';
            $status = "Регистрация успешна";
            header('Location: /');
        } else $status = "Данные введины неправильно";
    }

    if (isset($_POST['user_go'])) {  //авторизация

        $login = trim(htmlspecialchars($_POST['login']));
        $pass = trim(htmlspecialchars($_POST['pass']));


        $query = "SELECT * FROM users WHERE user_login = '" . $login . "'";
        $result = mysqli_query($connect, $query) or die('Ошибка подключения' . mysqli_error());
        $result = mysqli_fetch_assoc($result);

        $db_login = $result['user_login'];
        $db_pass = $result['user_pass'];
        if (isset($result['user_login'])) {
            if (($login === $db_login) && (password_verify($pass, $db_pass))) {
                $_SESSION['user_data']['status'] = 'auth';
                $_SESSION['user_data']['name'] = $_POST['login'];
                $status = $_SESSION['user_data']['status'];
                header('Location: /');
            } else $status = "Неверный логин и/или пароль";
        } else $status = "Нет данных пользователя";
    }
    return $status;
}

?>
