<!---->
<!--SECOND TAB-->
<!---->
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