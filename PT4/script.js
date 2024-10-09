const header = document.querySelector("header");

window.addEventListener("scroll", function () {
  header.classList.toggle("sticky", window.scrollY > 0);
});

let menu = document.querySelector("#menu-icon");
let navlist = document.querySelector(".navlist");

menu.onclick = () => {
  menu.classList.toggle("bx-x");
  navlist.classList.toggle("open");
};

window.onscroll = () => {
  menu.classList.remove("bx-x");
  navlist.classList.remove("open");
};

function darkmode() {
  var SetTheme = document.body;

  SetTheme.classList.toggle("dark-mode");

  if (SetTheme.classList.contains("dark-mode")) {
    // Mode gelap diaktifkan
    document.documentElement.style.setProperty("--background-color", "#242424");
    document.documentElement.style.setProperty("--text-color", "#ffffff");
    document.querySelector(".home").style.backgroundColor = "#121212";
    document.querySelector(".aboutme").style.backgroundColor = "#121212";
    document.querySelector(".contact").style.backgroundColor = "#111111";
    document.querySelector(".last-text").style.background = "#111111";
    document.querySelector(".contact").style.color = "#ffffff";

    const infoElements = document.querySelectorAll(
      ".info p, .info span, .info h2"
    );
    infoElements.forEach(function (element) {
      element.style.color = "#ffffff";
    });

    // Mengubah warna teks pada elemen "aboutme" menjadi putih
    const aboutmeElements = document.querySelectorAll(
      ".aboutme p, .aboutme span, .aboutme h2"
    );
    aboutmeElements.forEach(function (element) {
      element.style.color = "#ffffff";
    });
  } else {
    // Mode gelap dinonaktifkan
    document.documentElement.style.setProperty("--background-color", "#ffffff");
    document.documentElement.style.setProperty("--text-color", "#111111");
    document.querySelector(".home").style.backgroundColor = "#FAF0E6";
    document.querySelector(".aboutme").style.backgroundColor = "#FAF0E6";
    document.querySelector(".contact").style.backgroundColor = "";
    document.querySelector(".contact").style.color = "";
    document.querySelector(".last-text").style.background = "";

    const infoElements = document.querySelectorAll(
      ".info p, .info span, .info h2"
    );
    infoElements.forEach(function (element) {
      element.style.color = "";
    });

    const aboutmeElements = document.querySelectorAll(
      ".aboutme p, .aboutme span, .aboutme h2"
    );
    aboutmeElements.forEach(function (element) {
      element.style.color = "";
    });
  }
}

const profileImage = document.getElementById("profile-image");

profileImage.addEventListener("click", function () {
  const isFlipped =
    window.getComputedStyle(profileImage).getPropertyValue("transform") ===
    "matrix(-1, 0, 0, 1, 0, 0)";

  if (isFlipped) {
    profileImage.style.transform = "scaleX(1)";
  } else {
    profileImage.style.transform = "scaleX(-1)";
  }
  profileImage.style.cursor = "pointer";
});

const spanHuda = document.querySelector(".info span");
let isWhite = false;

spanHuda.addEventListener("click", function () {
  if (isWhite) {
    spanHuda.style.color = "";
  } else {
    spanHuda.style.color = "white";
  }

  isWhite = !isWhite;
});

// Array untuk menyimpan data produk
const products = [];

document
  .getElementById("add-product-button")
  .addEventListener("click", function () {
    addProduct();
  });

function addProduct() {
  const productName = document.getElementById("product-name").value;
  const productPrice = document.getElementById("product-price").value;
  const productImage = document.getElementById("product-image").files[0];

  // Buat objek produk baru
  const product = {
    name: productName,
    price: productPrice,
    image: productImage,
  };

  // Simpan produk ke dalam array
  products.push(product);

  // Tampilkan data produk di elemen HTML
  displayProducts();

  // Reset formulir setelah menambahkan produk
  document.getElementById("product-name").value = "";
  document.getElementById("product-price").value = "";
  document.getElementById("product-image").value = "";
}

function displayProducts() {
  const productListContainer = document.getElementById(
    "product-list-container"
  );
  productListContainer.innerHTML = ""; // Kosongkan container sebelum menambahkan produk lagi

  for (const product of products) {
    const productItem = document.createElement("div");
    productItem.className = "product-item";
    productItem.innerHTML = `<h3>${product.name}</h3><p>Harga: IDR ${product.price}</p>`;
    productListContainer.appendChild(productItem);
  }
}
///////////////////////////////////////////////////////////////////////
// Fungsi untuk menampilkan pop-up kupon
function showCouponPopup() {
  var couponPopup = document.getElementById("couponPopup");
  couponPopup.style.display = "block";
}

// Fungsi untuk menyembunyikan pop-up kupon
function hideCouponPopup() {
  var couponPopup = document.getElementById("couponPopup");
  couponPopup.style.display = "none";
}

// Fungsi untuk menampilkan pop-up login
function showLoginPopup() {
  var loginPopup = document.getElementById("loginPopup");
  loginPopup.style.display = "block";
}

// Fungsi untuk menyembunyikan pop-up login
function hideLoginPopup() {
  var loginPopup = document.getElementById("loginPopup");
  loginPopup.style.display = "none";
}

// Event listener untuk tombol redeem kupon
var redeemCouponBtn = document.getElementById("redeemCouponBtn");
redeemCouponBtn.addEventListener("click", function (event) {
  showCouponPopup();
  event.preventDefault(); // Mencegah tindakan default dari link
});

// Event listener untuk tombol login
var loginButton = document.querySelector(".login-button");
loginButton.addEventListener("click", function (event) {
  showLoginPopup();
  event.preventDefault(); // Mencegah tindakan default dari tombol login
});

// Fungsi untuk logout
function logout() {
  // Lakukan tindakan logout di sini, seperti menghapus sesi atau mengarahkan ke halaman logout
  // Contoh mengarahkan ke halaman logout:
  window.location.href = 'logout.php'; // Ganti dengan URL halaman logout Anda
}

// Menambahkan event listener untuk tombol "Keluar"
document.getElementById('logout-button').addEventListener('click', logout);

