<?php
require "koneksi.php";

// Fungsi untuk mengambil data keranjang
function getCartItems($conn) {
    $sql = "SELECT * FROM keranjang";
    $result = $conn->query($sql);
    return $result;
}

// Handle "Add to Cart" action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    
    // Insert the product into the cart
    $stmt = $conn->prepare("INSERT INTO keranjang (nama, harga, gambar) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $product_name, $product_price, $product_image);
    
    if ($stmt->execute()) {
        echo "Product added to cart successfully.";
    } else {
        echo "Error adding product to cart: " . $stmt->error;
    }
    
    $stmt->close();
}

// Ambil data keranjang
$cartItems = getCartItems($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 30px 0;
        }

        .cart-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .cart-item {
            width: 250px;
            margin: 20px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }

        .cart-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .cart-item img {
            width: 100%;
            height: auto;
            border-radius: 8px 8px 0 0;
        }

        .cart-item-info {
            padding: 15px;
        }

        .cart-item h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }

        .cart-item p {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .cart-item button {
            background-color: #ee4d2d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease-in-out;
            width: 100%;
        }

        .cart-item button:hover {
            background-color: #ff6348;
        }
    </style>
</head>

<body>
    <div style="text-align: left; padding: 10px;">
        <button class="button" onclick="window.location.href='index.php'">Back</button>
    </div>

    <h1>Keranjang Belanja</h1>

    <div class="cart-list">
        <?php
        if ($cartItems->num_rows > 0) {
            while ($item = $cartItems->fetch_assoc()) {
                echo "<div class='cart-item'>";
                echo "<h3>Produk: " . $item['nama'] . "</h3>";
                echo "Harga: " . $item['harga'] . "<br>";
                echo "Gambar: <img src='upload/" . $item['gambar'] . "' width='100'><br>";

                // Tombol Hapus
                echo "<form action='hapusitem.php' method='post'>";
                echo "<input type='hidden' name='item_id' value='" . $item['id'] . "'>";
                echo "<button type='submit' name='remove_from_cart'>Hapus</button>";
                echo "</form>";

                echo "<hr>";
                echo "</div>";
            }
        } else {
            echo "Keranjang belanja Anda kosong.";
        }
        ?>
    </div>
</body>

</html>