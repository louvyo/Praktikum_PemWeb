<?php

@include 'koneksi.php';

if (isset($_POST['add_product'])) {
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    
    // Mendapatkan ekstensi file
    $file_extension = pathinfo($p_image, PATHINFO_EXTENSION);

    // Generate nama file baru
    $current_date = date('Y-m-d');
    $new_file_name = $current_date . ' ' . $p_name . '.' . $file_extension;
    $p_image_folder = 'uploads/' . $new_file_name;

    $insert_query = mysqli_query($conn, "INSERT INTO `produk`(nama, harga, gambar) VALUES('$p_name', '$p_price', '" . basename($new_file_name) . "')") or die('query failed');

    if ($insert_query) {
        move_uploaded_file($p_image_tmp_name, $p_image_folder);
        $message[] = 'product add successfully';
    } else {
        $message[] = 'could not add the product';
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $result = mysqli_query($conn, "SELECT gambar FROM `produk` WHERE id = $delete_id");
    $row = mysqli_fetch_assoc($result);
    $file_to_delete = 'uploads/' . $row['gambar'];

    if (unlink($file_to_delete)) {
        $delete_query = mysqli_query($conn, "DELETE FROM `produk` WHERE id = $delete_id") or die('query failed');
        
        if ($delete_query) {
            header('location:admin_panel.php');
            $message[] = 'product has been deleted';
        } else {
            $message[] = 'product deleted, but the database could not be updated';
        }
    } else {
        $message[] = 'could not delete the product image';
    }
}


if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_price = $_POST['update_p_price'];

    // Mendapatkan nama file gambar sebelumnya
    $previous_image = mysqli_query($conn, "SELECT gambar FROM `produk` WHERE id = $update_p_id");
    $row = mysqli_fetch_assoc($previous_image);
    $previous_image_name = $row['gambar'];

    // Handle gambar baru
    if (!empty($_FILES['update_p_image']['name'])) {
        $update_p_image = $_FILES['update_p_image']['name'];
        $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];

        $file_extension = pathinfo($update_p_image, PATHINFO_EXTENSION);
        $current_date = date('Y-m-d');
        $new_file_name = $current_date . ' ' . $update_p_name . '.' . $file_extension;
        $update_p_image_folder = 'uploads/' . $new_file_name;

        unlink('uploads/' . $previous_image_name);

        $update_query = mysqli_query($conn, "UPDATE `produk` SET nama = '$update_p_name', harga = '$update_p_price', gambar = '" . basename($new_file_name) . "' WHERE id = '$update_p_id'");

        if ($update_query) {
            move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
            $message[] = 'product updated successfully';
            header('location:admin_panel.php');
        } else {
            $message[] = 'product could not be updated';
            header('location:admin_panel.php');
        }
    } else {
        $update_query = mysqli_query($conn, "UPDATE `produk` SET nama = '$update_p_name', harga = '$update_p_price' WHERE id = '$update_p_id'");

        if ($update_query) {
            $message[] = 'product updated successfully';
            header('location:admin_panel.php');
        } else {
            $message[] = 'product could not be updated';
            header('location:admin_panel.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">
    <style>
        #jam {
            margin: 0;
            font-size: var(--h3-font);
            text-align: center;
        }
    </style>

</head>

<body>

    <?php

    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        };
    };

    ?>

    <div class="container">

        <section>
            <a href="admin_logout.php" type="button" class="btn">Log out</a>
            <p id="jam">
                <?php
                date_default_timezone_set("Asia/Pontianak");
                echo date("l, d F Y - H:i:s");
                ?>
            </p>
            <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
                <h3>add a new product</h3>
                <input type="text" name="p_name" placeholder="enter the product name" class="box" autocomplete="off" required>
                <input type="number" name="p_price" min="0" placeholder="enter the product price" class="box" autocomplete="off" inputmode="numeric">
                <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
                <input type="submit" value="add the product" name="add_product" class="add-btn">
            </form>

        </section>

        <section class="display-product-table">

            <table>

                <thead>
                    <th>product image</th>
                    <th>product name</th>
                    <th>product price</th>
                    <th>action</th>
                </thead>

                <tbody>
                    <?php

                    $select_products = mysqli_query($conn, "SELECT * FROM `produk`");
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($row = mysqli_fetch_assoc($select_products)) {
                    ?>

                            <tr>
                                <td><img src="uploads/<?php echo $row['gambar']; ?>" height="100" alt=""></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td>Rp. <?php echo $row['harga']; ?></td>
                                <td>
                                    <a href="admin_panel.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
                                    <a href="admin_panel.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
                                </td>
                            </tr>

                    <?php
                        };
                    } else {
                        echo "<div class='empty'>no product added</div>";
                    };
                    ?>
                </tbody>
            </table>

        </section>

        <section class="edit-form-container">

            <?php

            if (isset($_GET['edit'])) {
                $edit_id = $_GET['edit'];
                $edit_query = mysqli_query($conn, "SELECT * FROM `produk` WHERE id = $edit_id");
                if (mysqli_num_rows($edit_query) > 0) {
                    while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
            ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <img src="uploads/<?php echo $fetch_edit['gambar']; ?>" height="200" alt="">
                            <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
                            <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['nama']; ?>" autocomplete="off">
                            <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['harga']; ?>" autocomplete="off">
                            <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                            <input type="submit" value="update the prodcut" name="update_product" class="option-btn">
                            <button type="button" id="close-edit" class="option-btn">Cancel</button>

                        </form>

            <?php
                    };
                };
                echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
            };
            ?>

        </section>

    </div>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Event listener untuk tombol "cancel"
            document.getElementById('close-edit').addEventListener('click', function() {
                document.querySelector('.edit-form-container').style.display = 'none';
                window.location.href = 'admin_panel.php';
            });
        });

        function updateClock() {
            var elementJam = document.getElementById("jam");
            var now = new Date();
            var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var day = days[now.getDay()];
            var date = now.getDate();
            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            var month = months[now.getMonth()];
            var year = now.getFullYear();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            var timeString = day + ', ' + date + ' ' + month + ' ' + year + ' - ' + (hours < 10 ? "0" : "") + hours + ':' + (minutes < 10 ? "0" : "") + minutes + ':' + (seconds < 10 ? "0" : "") + seconds;
            elementJam.innerText = timeString;
        }

        updateClock();
        setInterval(updateClock, 1000);
    </script>
</body>

</html>