<?php
// Koneksi ke database
function get_db_connection()
{
    $host = 'localhost';
    $db   = 'rfc_db';
    $user = 'root';      // sesuaikan
    $pass = '';          // sesuaikan
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        die('Koneksi database gagal: ' . $e->getMessage());
    }
}

// Simpan kritik & saran
function save_feedback($name, $email, $message, $rating = null)
{
    $pdo = get_db_connection();
    $sql = "INSERT INTO feedbacks (name, email, message, rating) 
            VALUES (:name, :email, :message, :rating)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name'    => $name,
        ':email'   => $email,
        ':message' => $message,
        ':rating'  => $rating !== '' ? $rating : null,
    ]);
}

// Ambil semua feedback (untuk review)
function get_all_feedbacks()
{
    $pdo = get_db_connection();
    $sql = "SELECT * FROM feedbacks ORDER BY created_at DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

// Fungsi untuk mendapatkan data menu
function getMenuItems()
{
    return [
        [
            'id' => 1,
            'name' => 'Espresso',
            'description' => 'Kopi murni dengan rasa kuat dan aroma yang khas',
            'price' => 25000,
            'category' => 'hot',
            'image' => 'images/espresso.jpg'
        ],
        [
            'id' => 2,
            'name' => 'Cappuccino',
            'description' => 'Espresso dengan steamed milk dan foam yang lembut',
            'price' => 32000,
            'category' => 'hot',
            'image' => 'images/cappuccino.jpg'
        ],
        [
            'id' => 3,
            'name' => 'Latte',
            'description' => 'Espresso dengan steamed milk yang creamy',
            'price' => 35000,
            'category' => 'hot',
            'image' => 'images/latte.jpg'
        ],
        [
            'id' => 4,
            'name' => 'Iced Americano',
            'description' => 'Espresso dengan air dan es, menyegarkan',
            'price' => 28000,
            'category' => 'cold',
            'image' => 'images/iced-americano.jpg'
        ],
        [
            'id' => 5,
            'name' => 'Caramel Macchiato',
            'description' => 'Espresso dengan caramel, steamed milk dan foam',
            'price' => 38000,
            'category' => 'cold',
            'image' => 'images/caramel-macchiato.jpg'
        ],
        [
            'id' => 6,
            'name' => 'Croissant',
            'description' => 'Pastri Prancis yang renyah dan buttery',
            'price' => 22000,
            'category' => 'snack',
            'image' => 'images/croissant.jpg'
        ],
        [
            'id' => 7,
            'name' => 'Chocolate Muffin',
            'description' => 'Muffin cokelat yang lembut dan kaya rasa',
            'price' => 18000,
            'category' => 'snack',
            'image' => 'images/chocolate-muffin.jpg'
        ]
    ];
}

// Fungsi untuk merender item menu
function renderMenuItem($item)
{
    return "
    <div class='menu-item' data-category='{$item['category']}'>
        <div class='item-image'>
            <img src='{$item['image']}' alt='{$item['name']}'>
        </div>
        <div class='item-info'>
            <h3>{$item['name']}</h3>
            <p>{$item['description']}</p>
            <div class='item-price'>Rp " . number_format($item['price'], 0, ',', '.') . "</div>
            <button class='add-to-cart' data-id='{$item['id']}' data-name='{$item['name']}' data-price='{$item['price']}'>
                Tambah ke Keranjang
            </button>
        </div>
    </div>
    ";
}
