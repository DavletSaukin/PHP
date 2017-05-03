<?php
header("Content-Type: text/plain; charset=utf-8");
$cname = $_POST['name'];
$csurname = $_POST['surname'];
setcookie('name', $cname, time()+60*60*24*365*10,"/", "http://localhost:9001");
setcookie('surname', $csurname, time()+60*60*24*365*10,"/", "http://localhost:9001");

class Student
{
    public $name;
    public $surname;
    public $gender;
    public $gruop;
    public $mail;
    public $score;
    public $yearofbirth;
    public $placeofbirth;
    public $password;
}

function setStudentsInfo($student) //сохраняем информацию о студенте
{
    foreach ($_POST as $key => $info)
    {
         $student->$key = array_key_exists($key, $_POST) ? strval($_POST[$key]) : '';
    }  
}

foreach ($_POST as $info_of_student) //проверяем все ли данные введены
{
    if ($info_of_student == '')
    {
    header('Location: http://localhost:9001/list.php',TRUE,307);
    exit;
    }
}

$student = new Student;
setStudentsInfo($student);

$mysqli = new mysqli("localhost", "root", "password", "students"); //подключение к БД
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (!(isset($_COOKIE['name'])))
{
    $mail = preg_replace('/@/','\@',$student->mail);//экранирование эмэйла

    //отправка данных в БД
    $mysqli->query("INSERT INTO student VALUES ('$student->name', '$student->surname', '$student->gender', '$student->gruop', '$mail', '$student->score', '$student->yearofbirth', '$student->placeofbirth', '$student->password')");
    if ($mysqli->errno) 
    {
    echo 'Error ('.$mysqli->errno.') '.$mysqli->error."\n";
    }
}


//выравнивание по правому краю
function padLeft($string, $length)
{
    $str = "{$string}";
    $count = mb_strlen($str);
    $countOfGaps = $length-$count;
    echo str_repeat(" ", $countOfGaps).$str;
}

//выравнивание по левому краю
function padRight($string, $length)
{
    $str = "{$string}";
    $count = mb_strlen($str);
    $countOfGaps = $length-$count;
    echo $str.str_repeat(" ", $countOfGaps);
}

$result = $mysqli->query('SELECT name, surname, gender, gruop, mail, score, yearofbirth, placeofbirth FROM student',MYSQLI_STORE_RESULT);
$st = $result->fetch_all();

$fullname = isset($_COOKIE['name']) ? $_COOKIE['name']." ".$_COOKIE['surname'] : $student->name." ".$student->surname;

echo "Здравствуйте, ".$fullname."\n"."Благодарим за регистрацию\n";

//заголовок таблицы 
echo padRight("Имя",20) .
     padRight("Фамилия",20) .
     padRight("Пол",10) .
     padRight("Группа",10) .
     padRight("E-mail",20) .
     padLeft("Кол-во баллов",13) .
     padLeft("Год рождения",15) .
     padLeft("Местный/иногородний",25)."\n\n";

//вывод таблицы
for($i=0; $i<$result->num_rows; $i++)
{
    echo padRight($st[$i][0],20) .
         padRight($st[$i][1],20) .
         padRight($st[$i][2],10) .
         padRight($st[$i][3],10) .
         padRight($st[$i][4],20) .
         padLeft($st[$i][5],13) .
         padLeft($st[$i][6],15) .
         padLeft($st[$i][7],25)."\n";        
}

echo $_COOKIE['name'];
echo $_COOKIE['surname'];
?>