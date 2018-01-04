<!---->
<!--SECOND TAB-->
<!---->
<?php
/**
 * Calculator using form from second tab
 */
$output = '';
$num1 = '';
$num2 = '';
$operator = '';
if (isset($_POST['first']) && isset($_POST['second']) && isset($_POST['operator'])) {
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

    $_SESSION['set_tab'] = 'two';
}
?>


<div id="Calculator" class="tabcontent" style="display: <?php echo ($_SESSION['set_tab'] == 'two')? 'block':'none';?>">
    <form action="" method="post">
        <input type="text" name="first" placeholder="First Number"
               value="<?php echo (isset($_POST['first'])) ? $_POST['first'] : ''; ?>"><br>
        <input type="text" name="second" placeholder="Second Number"
               value="<?php echo (isset($_POST['second'])) ? $_POST['second'] : ''; ?>"><br>
        <select name="operator">
            <option <?php echo ($operator == 'addition') ? 'selected' : ''; ?> value="addition">+</option>
            <option <?php echo ($operator == 'subtraction') ? 'selected' : ''; ?> value="subtraction">-
            </option>
            <option <?php echo ($operator == 'multiple') ? 'selected' : ''; ?> value="multiple">*</option>
            <option <?php echo ($operator == 'quotient') ? 'selected' : ''; ?> value="quotient">/</option>
        </select>
        <input type="submit" value="    =    " style="margin-left:30px ">
    </form>
    <br>
    <input type="text" disabled value="<?= $output; ?>">
</div>