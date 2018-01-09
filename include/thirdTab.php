<!---->
<!--THIRD TAB (PHOTOS)-->
<!---->


<div id="image_list" class="tabcontent"
     style="display: <?php echo ($_SESSION['set_tab'] == 'three') ? 'block' : 'none'; ?>">
    <form class="upload" method="post" action="" enctype="multipart/form-data">
        <h4>Upload one/more files</h4>
        <br>
        <input multiple type="file" name="image_file[]" required/><br>
        <input type="text" name="image_name" placeholder="Caption" required/><br>
        <button type="submit">Upload</button>
    </form>
    <div class="image_block">
        <h2>Photos</h2>

        <?php
        if (!empty($_FILES)) {
            $caption = $_POST['image_name'];
            $name_imgfile = $_FILES['image_file']['name'];
            $tmp_imgfile = $_FILES['image_file']['tmp_name'];
            $error_imgfile = $_FILES['image_file']['error'];

            for ($i = 0; $i < count($name_imgfile); $i++) {

                $img_data = $name_imgfile[$i];
                $target = md5(time() . rand()) . "." . pathinfo($img_data, PATHINFO_EXTENSION);
                $save_file = $target . "&" . $caption . "\n";

                $handle = fopen('files/image.txt', 'a');
                if (move_uploaded_file($tmp_imgfile[$i], "img/" . $target)) {
                    fwrite($handle, $save_file);
                } else {
                    //Gives and error if its not
                    echo "Sorry, there was a problem uploading your file.";
                }
            }
        }
        if (file_exists('files/image.txt')) {
            $file = file('files/image.txt');
            if (isset($_GET['thirdTab_id'])) {
                $del_id = $_GET['thirdTab_id'];

                //deletes file from the server i.e. the directory
                $delete_image = explode('&', $file[$del_id]);
                $path = "img/" . $delete_image[0];
                unlink($path);

                $file[$del_id] = '';
                $handle1 = fopen('files/image.txt', 'w');
                fwrite($handle1, implode($file));
                header('Location: welcome.php?tabThree_delete=ok');
                die;
            }

            $j = 0;
            $file = file('files/image.txt');
            echo "<form method='post' action='download.php'>";
            foreach ($file as $show_line) {
                $image = explode('&', $show_line);
                echo "<div class=\"image_list\">";
                echo "<a href=\"download.php?thirdTab_download={$j}\" style='left:0;'><img src=\"download.png\"></a>";
                echo "<label for='zip_id{$j}'><input type='checkbox' name='download_zip[]' value='{$j}' id='zip_id{$j}'><p>{$image[1]}</p></input></label>";
                echo "<a href=\"?thirdTab_id={$j}\" style='right:0;'>&times</a>";
                echo "<img onclick=\"window . location . href = 'view.php?id={$j}'\" src=\"img/{$image[0]}\">";
                echo "</div>";
                $j++;
            }

            echo "<button class='zip_download' type='submit'>Download <br><img src='download.png'><br> checked</button></form>";
        }
        ?>
    </div>
</div>
