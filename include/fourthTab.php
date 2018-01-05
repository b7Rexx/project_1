<!---->
<!--THIRD TAB (PHOTOS)-->
<!---->
<?php
$samsung = '0';
$sandisk = '0';
$toshiba = '0';
$packing = [];
$delivery = '';
$zone = '';
$total = '0';

if (isset($_POST['price_calc'])) {
    $samsung = $_POST['samsung'];
    $sandisk = $_POST['sandisk'];
    $toshiba = $_POST['toshiba'];
    $packing = (isset($_POST['packing'])?$_POST['packing']:[]);
    $delivery = $_POST['delivery'];
    $zone = $_POST['zone'];

    $total = $sandisk * 700 + $samsung * 650 + $toshiba * 750;

    $total += ($zone == 'ktm') ? $total * 0.1 : 0;

    foreach ($packing as $data) {
        $total = ($data == 'box') ? $total + 100 : "$total";
        $total = ($data == 'package') ? $total + 200 : "$total";
        $total = ($data == 'plastic') ? $total + 50 : "$total";
    }
    $total = ($delivery == 'home') ? $total + 100 : $total;
}

?>

<div id="pendrive_price_calc" class="tabcontent"
     style="display: <?php echo ($_SESSION['set_tab'] == 'four') ? 'block' : 'none'; ?>">
    <h2>Calculate price here</h2>
    <div class="pendrive">
        <form action="" method="post">
            <br>
            <p>Sandisk : <input name="sandisk" type="text" value="<?= $sandisk; ?>"> x Rs.700</p><br>
            <p>Samsung : <input name="samsung" type="text" value="<?= $samsung; ?>"> x Rs.650</p><br>
            <p>Toshiba : <input name="toshiba" type="text" value="<?= $toshiba; ?>"> x Rs.750</p><br>

            <input type="checkbox" name="packing[]" value="box" <?php foreach ($packing as $data1) {
                echo ($data1 == 'box') ? 'checked' : '';
            } ?> > Box(Rs.100)
            <input type="checkbox" name="packing[]" value="package" <?php foreach ($packing as $data2) {
                echo ($data2 == 'package') ? 'checked' : '';
            } ?> > Package(Rs.200)
            <input type="checkbox" name="packing[]" value="plastic" <?php foreach ($packing as $data3) {
                echo ($data3 == 'plastic') ? 'checked' : '';
            } ?> > Plastic(Rs.50)<br><br>
            <input type="radio" name="delivery" value="pickup" <?php
            echo ($delivery != 'home') ? 'checked' : ''; ?> >Pickup
            <input type="radio" name="delivery" value="home" <?php
            echo ($delivery == 'home') ? 'checked' : ''; ?> >Home delivery(Rs.100)<br><br>
            <select name="zone">
                <option>-->Choose a region<--</option>
                <option value="ktm" <?php echo ($zone == 'ktm') ? 'selected' : ''; ?> >Kathmandu(+ 10%)</option>
                <option value="brj" <?php echo ($zone == 'brj') ? 'selected' : ''; ?> >Birgunj</option>
                <option value="pkr" <?php echo ($zone == 'pkr') ? 'selected' : ''; ?> >Pokhara</option>
                <option value="ctn" <?php echo ($zone == 'ctn') ? 'selected' : ''; ?> >Chitwan</option>
            </select><br>
            <input style="visibility:hidden" type="text" name="price_calc" value="four"><br>
            <button type="submit">Calculate</button>
            <input type="text" value="<?= $total ?>" disabled>
        </form>
    </div>
</div>