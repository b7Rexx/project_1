<!---->
<!--FIRST TAB (ADMIN TAB)-->
<!---->

<div id="Admin" class="tabcontent" style="display: <?=$_SESSION['tab_default'];?>">
    <?php

    /**
     * put admin by default when all account removed
     */

    if (empty(file('user_pass.txt'))) {
        $handle = fopen('user_pass.txt', 'a');
        fwrite($handle, "admin=username&password=admin\n");
        fclose($handle);
    }
    $read_file = file('user_pass.txt');
    $imp = implode('=username&password=', $read_file);
    $all_admin = explode('=username&password=', $imp);
    //print_r($all_admin);

    ?>
    <div class="table">
        <h2 style="margin-top: 50px;">List of Admin</h2>
        <table class="admin_list">
            <tr>
                <th>Username</th>
                <th>Password</th>
            </tr>
            <?php
            /**
             * Table to show and remove username and password list
             */
            if (is_array($all_admin)) {
                for ($i = 0, $j = 0; $i < count($all_admin);) {
                    echo "<tr>";
                    echo "<td >{$all_admin[$i]}</td ><td>{$all_admin[$i+1]}</td >";
                    echo "<td><a href=\"delete.php?id=" . $j . "\">&times</a></td>";
                    echo "</tr >";
                    $i += 2;
                    $j++;
                }
            }
            ?>
        </table>
    </div>
</div>
