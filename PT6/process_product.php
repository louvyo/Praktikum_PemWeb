<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            background: url(img/yuhu.jpg) no-repeat;
            background-size: cover;
            /* Ubah ke "cover" agar gambar latar belakang memenuhi seluruh latar belakang */
        }

        /* Gaya CSS untuk tampilan produk */
        .product-container {
            text-align: center;
            margin: 0 auto;
            padding: 20px;
            /* Tambahkan jarak antara elemen-elemen dalam kontainer */
            border: 1px #c8815f;
            /* Ubah warna border dan tambahkan ketebalan */
            border-radius: 50px;
            /* Tambahkan sudut bulat ke kontainer */
            width: 400px;
            /* Kurangi lebar kontainer untuk tampilan yang lebih kompak */
            align-items: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: rgba(255, 218, 185, 0.8);
            /* Tambahkan transparansi ke latar belakang */
            backdrop-filter: blur(5px);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
            /* Tambahkan bayangan kontainer */
        }

        .product-image {
            max-width: 100%;
            /* Sesuaikan lebar gambar dengan lebar kontainer */
            max-height: 400px;
            /* Batasi tinggi gambar */
            min-width: 300px;
        }

        .product-name {
            font-weight: bold;
            margin-top: 10px;
            color: #333;
            /* Ubah warna teks nama produk */
        }

        .product-price {
            color: #c8815f;
            /* Warna harga produk */
        }

        .btn {
            display: inline-block;
            padding: 13px 25px;
            background: #c8815f;
            color: white;
            font-size: 15px;
            letter-spacing: 1px;
            font-weight: 600;
            border-radius: 5px;
            transition: all 0.35s ease;
            border: 1px solid #c8815f;
            text-decoration: none;
        }

        .btn:hover {
            transform: translateY(-5px);
            background: black;
        }
    </style>
</head>

<body>
    <div class="exit">
        <a href="index.html" id="logout-button" class="btn">Keluar</a>
    </div>

    <div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Check if the form was submitted using POST method

            // Check if all required fields are present
            if (isset($_POST["product-name"]) && isset($_POST["product-price"]) && isset($_FILES["product-image"])) {
                // Retrieve data from the form
                $productName = $_POST["product-name"];
                $productPrice = $_POST["product-price"];
                $productImage = $_FILES["product-image"];

                // Specify the upload directory
                $uploadDirectory = "uploads/"; // Change this to your desired directory

                // Check if the upload directory exists or create it
                if (!file_exists($uploadDirectory)) {
                    mkdir($uploadDirectory, 0755, true);
                }

                // Generate a unique filename to prevent overwriting existing files
                $targetFilePath = $uploadDirectory . uniqid() . '_' . basename($productImage["name"]);

                // Check if the file was uploaded successfully
                if (move_uploaded_file($productImage["tmp_name"], $targetFilePath)) {
                    // File upload was successful

                    // Display the received data and the uploaded image
                    echo '<div class="product-container">';
                    echo '<img class="product-image" src="' . $targetFilePath . '" alt="' . $productName . '">';
                    echo '<div class="product-name">' . $productName . '</div>';
                    echo '<div class="product-price">Price: Rp. ' . $productPrice;
                    echo '</div>';

                    // You can now use the $productName, $productPrice, and $targetFilePath to save the product data to a database or perform other actions as needed.
                } else {
                    echo "Error uploading the image.";
                }
            } else {
                echo "Missing required data.";
            }
        } else {
            echo "Invalid request method.";
        }
        ?>
    </div>


</body>

</html>