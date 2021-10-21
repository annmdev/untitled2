<?php
$start_time = microtime(true);
session_start();
$count = 0;

$is_received_data_correct = isset($_POST["arg-r"]) && isset($_POST["arg-x"]) && isset($_POST["arg-y"])
    && is_received_data_correct($_POST["arg-r"], $_POST["arg-x"], $_POST["arg-y"]);

if ($is_received_data_correct) {
    $r = $_POST["arg-r"];
    $x = $_POST["arg-x"];
    $y = $_POST["arg-y"];
    $res = is_belongs($r, $x, $y) ? "true" : "false";

    $_SESSION["sr"][] = $r;
    $_SESSION["sx"][] = $x;
    $_SESSION["sy"][] = $y;
    $_SESSION["s_res"][] = $res;
}

////////////////////////////////////////////
function write_prev()
{
    if (isset($_SESSION["sr"]) && isset($_SESSION["sy"]) && isset($_SESSION["sx"]) && isset($_SESSION["s_res"])) {
        $sr = $_SESSION["sr"];
        $sy = $_SESSION["sy"];
        $sx = $_SESSION["sx"];
        $s_res = $_SESSION["s_res"];
        global $count;
        $count = sizeof($_SESSION["sr"]);

        foreach ($sr as $i => $v) {
            addLine($i + 1, $v, $sx[$i], $sy[$i], $s_res[$i]);
        }
    }
}

function is_received_data_correct($r, $x, $y)
{
    if (is_numeric($r) && ($r > 1) && ($r < 4)
        && is_numeric($x) && ($x - floor($x) == 0) && ($x >= -3) && ($x <= 5)
        && is_numeric($y) && ($y > -5) && ($y < 5)
    ) return true;

    return false;
}

function is_belongs($r, $x, $y)
{
    if ((($x >= 0) && ($x <= $r) && ($y >= -$r) && (($y <= 0) || ($x * $x + $y * $y <= $r * $r)))
        || (($x <= 0) && ($y <= 0) && ($y >= -$x - $r / 2))) {
        return true;
    }
    return false;
}

function addLine($num, $r, $x, $y, $res)
{
    echo "<tr>
                <td>$num</td>
                <td>$r</td>
                <td>$x</td>
                <td>$y</td>
                <td>$res</td>
            </tr>";
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web: lab 1</title>
    <style>
        body{
            margin: 0;
        }
        .data-table-container{
            width: 100%;
            height: 100%;
            margin-top: 48px;
            font-family: monospace;
            font-size: large;
        }

        td{
            vertical-align: top;
        }

        #left-space, #right-space{
            width: 25%;
        }

        #data-table-column{
            width: 50%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
            border-radius: 8px;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
        }

        #data-table-column:hover{
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.25);
        }

        .table-name{
            width: 100%;
            font-size: 1.6em;
            font-weight: bold;
            text-align: center;
            margin: 16px;
        }

        .data-table{
            width: 100%;
            padding: 0 16px;
            text-align: center;
            table-layout: fixed;
            border-collapse: collapse;
        }

        #r-col, #res-col, #x-col, #y-col{
            width: 23%;
        }
        #num-col{
            width: 8%;
        }
        .data-table tr:hover{
            box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.2);
        }
        .data-table td, .data-table th{
            padding: 8px;
            min-width: 32px;
        }
        .data-table tr td:first-child{
            background: #dcdcdc;
        }
        .time_block{
            padding: 16px;
        }
        #err_block{
            color: red;
            padding: 8px;
        }

        #success_notify{
            color: #45a049;
            padding: 8px;
        }

    </style>
</head>
<body>

<table class='data-table-container'>
    <tr>
        <td id="left-space"></td>
        <td id="data-table-column">
            <div class='table-name'>История результатов</div>
            <table class='data-table'>
                <tr>
                    <th id="num-col">Номер запроса</th>
                    <th id="r-col">Параметр R</th>
                    <th id="x-col">Координата X</th>
                    <th id="y-col">Координата Y</th>
                    <th id="res-col">Результат</th>
                </tr>
                <?php
                write_prev();
                ?>
            </table>
            <?php if (!$is_received_data_correct): ?>
                <div id="err_block">Получены неверные значения переменных.</div>
            <?php else: ?> <div id="success_notify">Получен результат: <?php echo $res?></div>
            <?php endif; ?>
        </td>
        <td id="right-space"></td>
    </tr>
    <tr>
        <td class="time_block" colspan="3">
            <div id="time">The time of your request: <?php echo date('H:i:s'); ?></div>
            <br>
            <div id="exec_duration">Duration of execution: <?php echo round(microtime(true) - $start_time, 5); ?>с</div>
        </td>
    </tr>
</table>

</body>
</html>



