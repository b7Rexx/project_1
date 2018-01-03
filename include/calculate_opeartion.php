<?php
/**
 * Calculator using form from second tab
 * sets session for tab_block and tab_default
 * changes inline display style of tab block
 */
$output = '';
$num1 = '';
$num2 = '';
$operator = '';

if (!empty($_POST)) {
    $num1 = $_POST['first'];
    $num2 = $_POST['second'];
    $operator = $_POST['operator'];
    if (is_numeric($num1) && is_numeric($num2)) {
        switch ($operator) {
            case 'addition':
                $output = $num1 + $num2;
                break;
            case 'subtraction':
                $output = $num1 - $num2;
                break;
            case 'multiple':
                $output = $num1 * $num2;
                break;
            case 'quotient':
                $output = $num1 / $num2;
                break;
            default:
                echo 'unknown operator.please use: +,-,*,/';
        }
    } else {
        $output = '0';
    }

    $_SESSION['tab_block'] = 'block';
    $_SESSION['tab_default'] = 'none';

}else{
    $_SESSION['tab_block'] = 'none';
    $_SESSION['tab_default'] = 'block';

}
?>
