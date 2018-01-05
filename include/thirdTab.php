<!---->
<!--THIRD TAB (PHOTOS)-->
<!---->


<div id="image_list" class="tabcontent"
     style="display: <?php echo ($_SESSION['set_tab'] == 'three') ? 'block' : 'none'; ?>">
    <h2>Photos</h2>
    <form class="upload" method="post" action="" enctype="multipart/form-data">
            <input type="file" name="image_file" required/><br>
            <input type="text" name="image_name" placeholder="caption" required/><br>
            <button type="submit">Upload</button>
        </form>
    <div class="image_block">
        <?php
        //This is the directory where images will be saved
        if (!empty($_FILES)) {
            $target = "img/" . basename($_FILES['image_file']['name']);

            //This gets all the other information from the form
            $Filename = basename($_FILES['image_file']['name']);
            $caption = $_POST['image_name'];

            $save_file = $Filename . "&" . $caption . "\n";
            //Writes the Filename to the server
            $set = '';

            $handle = fopen('files/image.txt', 'a');
            $file = file('files/image.txt');

            foreach ($file as $line) {
                if ($save_file == $line) {
                    echo "<i style='margin: -100px 0 0 -500px'>Filename already exist<i>";
                    $set = 'ok';
                    break;
                }
            }
            if ($set != 'ok') {
                if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target)) {
                    fwrite($handle, $save_file);
                } else {
                    //Gives and error if its not
                    echo "Sorry, there was a problem uploading your file.";
                }
            }

        }
        $file = file('files/image.txt');
        if (isset($_GET['thirdTab_id'])) {
            $del_id = $_GET['thirdTab_id'];
            $file[$del_id] = '';
            $handle1 = fopen('files/image.txt', 'w');
            fwrite($handle1, implode($file));
			header ('Location: welcome.php?tabThree_delete=ok');
			die;
		}

        $j = 0;
        $file = file('files/image.txt');
        foreach ($file as $show_line) {
            $image = explode('&', $show_line);
            echo "<div class=\"image_list\"><img src=\"img/{$image[0]}\">";
            echo "<p>{$image[1]}</p><a href=\"?thirdTab_id={$j}\">&times</a></div>";
            $j++;
        }
        ?>
    </div>
</div>
