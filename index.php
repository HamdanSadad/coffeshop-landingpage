<?php
// index.php
include 'includes/functions.php';

// Proses form kritik & saran
$feedback_success = false;
$feedback_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_feedback'])) {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $rating  = trim($_POST['rating'] ?? '');

    if ($name === '' || $message === '') {
        $feedback_error = 'Nama dan pesan wajib diisi.';
    } else {
        try {
            save_feedback($name, $email, $message, $rating);
            $feedback_success = true;
        } catch (Exception $e) {
            $feedback_error = 'Gagal menyimpan kritik & saran.';
        }
    }
}

// Ambil semua feedback untuk section Review
$feedbacks = get_all_feedbacks();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rice Field Coffee - Pemesanan Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <main>

        <!-- BERANDA / HERO -->
        <section id="beranda" class="hero">
            <div class="hero-content">
                <h1>Rice Field Coffee</h1>
                <p>
                    Tempat terbaik untuk menikmati kopi dengan suasana sawah yang tenang dan menyegarkan.
                    Pesan minuman favoritmu secara online dengan mudah.
                </p>
                <a href="#menu" class="cta-button">Lihat Menu</a>
            </div>
        </section>

        <!-- MENU -->
        <section id="menu" class="menu-section">
            <h2>Menu Rice Field Coffee</h2>

            <div class="menu-filters">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="coffee">Coffee</button>
                <button class="filter-btn" data-filter="noncoffee">Non Coffee</button>
                <button class="filter-btn" data-filter="snack">Snack</button>
            </div>

            <div class="menu-items">
                <!-- Contoh item menu statis, sesuaikan harga & id -->
                <div class="menu-item" data-category="coffee">
                    <div class="item-image">
                        <img src="images/espresso.jpg" alt="Espresso">
                    </div>
                    <div class="item-info">
                        <h3>Espresso</h3>
                        <p>Espresso single shot untuk pecinta kopi pekat.</p>
                        <div class="item-price">Rp 15.000</div>
                        <button class="add-to-cart"
                            data-id="1"
                            data-name="Espresso"
                            data-price="15000">Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="menu-item" data-category="coffee">
                    <div class="item-image">
                        <img src="images/cappuccino.jpg" alt="Cappuccino">
                    </div>
                    <div class="item-info">
                        <h3>Cappuccino</h3>
                        <p>Kopi susu dengan foam lembut.</p>
                        <div class="item-price">Rp 22.000</div>
                        <button class="add-to-cart"
                            data-id="2"
                            data-name="Cappuccino"
                            data-price="22000">Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="menu-item" data-category="coffee">
                    <div class="item-image">
                        <img src="images/signature.jpg" alt="Rice Field Signature">
                    </div>
                    <div class="item-info">
                        <h3>Rice Field Signature</h3>
                        <p>Signature coffee khas Rice Field Coffee.</p>
                        <div class="item-price">Rp 28.000</div>
                        <button class="add-to-cart"
                            data-id="3"
                            data-name="Rice Field Signature"
                            data-price="28000">Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="menu-item" data-category="noncoffee">
                    <div class="item-image">
                        <img src="images/choco-latte.jpg" alt="Chocolate Latte">
                    </div>
                    <div class="item-info">
                        <h3>Chocolate Latte</h3>
                        <p>Minuman coklat creamy untuk non-kopi.</p>
                        <div class="item-price">Rp 23.000</div>
                        <button class="add-to-cart"
                            data-id="4"
                            data-name="Chocolate Latte"
                            data-price="23000">Tambah ke Keranjang</button>
                    </div>
                </div>

                <div class="menu-item" data-category="snack">
                    <div class="item-image">
                        <img src="images/fries.jpg" alt="French Fries">
                    </div>
                    <div class="item-info">
                        <h3>French Fries</h3>
                        <p>Kentang goreng renyah cocok untuk teman ngopi.</p>
                        <div class="item-price">Rp 18.000</div>
                        <button class="add-to-cart"
                            data-id="5"
                            data-name="French Fries"
                            data-price="18000">Tambah ke Keranjang</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- TENTANG KAMI -->
        <section id="tentang-kami" class="about-section">
            <div class="about-container">
                <div class="about-text">
                    <h2>Tentang Kami</h2>
                    <p>
                        Rice Field Coffee hadir untuk menghadirkan pengalaman ngopi yang berbeda.
                        Dengan pemandangan sawah yang hijau dan udara yang segar, kami ingin setiap
                        pengunjung merasa tenang dan nyaman.
                    </p>
                    <p>
                        Kami menggunakan biji kopi pilihan yang diolah dengan penuh ketelitian oleh barista
                        berpengalaman. Setiap cangkir kopi dibuat dengan hati, untuk menemani obrolan hangat
                        bersama teman, keluarga, maupun diri sendiri.
                    </p>
                </div>
                <div class="about-highlight">
                    <div class="about-card">
                        <h3>Visi</h3>
                        <p>Menjadi coffee shop favorit dengan nuansa alam yang menenangkan.</p>
                    </div>
                    <div class="about-card">
                        <h3>Misi</h3>
                        <ul>
                            <li>Menyajikan kopi berkualitas.</li>
                            <li>Menciptakan suasana nyaman dan hangat.</li>
                            <li>Memberikan pelayanan ramah dan cepat.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- TIM RFC -->
        <!-- TIM RFC -->
        <section id="tim-rfc" class="team-section">
            <h2>Tim Rice Field Coffee</h2>
            <p class="team-subtitle">
                Struktur organisasi Rice Field Coffee
            </p>

            <div class="team-structure">

                <!-- Owner & Co-Owner -->
                <div class="team-row double">
                    <div class="team-card">
                        <div class="team-photo">
                            <img src="images/owner.jpg" alt="Owner RFC">
                        </div>
                        <div class="team-role">Owner RFC</div>
                        <div class="team-name">Diyatrie Muhammad Bilal</div>
                    </div>

                    <div class="team-card">
                        <div class="team-photo">
                            <img src="images/co-owner.jpg" alt="Co Owner RFC">
                        </div>
                        <div class="team-role">Manajer</div>
                        <div class="team-name">Gilang Atha</div>
                    </div>
                </div>

                <!-- Marketing (2 bersampingan) -->
                <div class="team-row double">
                    <div class="team-card">
                        <div class="team-photo">
                            <img src="images/marketing1.jpg" alt="Marketing 1">
                        </div>
                        <div class="team-role">Supervisor</div>
                        <div class="team-name">Banu Segara</div>
                    </div>

                    <div class="team-card">
                        <div class="team-photo">
                            <img src="images/marketing2.jpg" alt="Marketing 2">
                        </div>
                        <div class="team-role">Marketing</div>
                        <div class="team-name">Adzka Aulia Putra</div>
                    </div>
                </div>

                <!-- Barista + Head Barista (3 sejajar) -->
                <div class="team-row triple">
                    <div class="team-card">
                        <div class="team-photo">
                            <img src="images/barista1.jpg" alt="Barista 1">
                        </div>
                        <div class="team-role">Barista</div>
                        <div class="team-name">Ariananda Pandu</div>
                    </div>

                    <div class="team-card">
                        <div class="team-photo">
                            <img src="images/head-barista.jpg" alt="Head Barista">
                        </div>
                        <div class="team-role">Head Barista</div>
                        <div class="team-name">Farhan Maulana</div>
                    </div>

                    <div class="team-card">
                        <div class="team-photo">
                            <img src="images/barista2.jpg" alt="Barista 2">
                        </div>
                        <div class="team-role">Barista</div>
                        <div class="team-name">Ahmad Rai</div>
                    </div>
                </div>

                <!-- Developer sendirian di bawah -->
                <div class="team-row single">
                    <div class="team-card">
                        <div class="team-photo">
                            <img src="images/developer.jpg" alt="Developer">
                        </div>
                        <div class="team-role">Developer</div>
                        <div class="team-name">Hamdan Sadad</div>
                    </div>
                </div>

            </div>
        </section>


        <!-- KRITIK & SARAN (ganti kontak) -->
        <section id="kritik-saran" class="contact-section">
            <h2>Kritik &amp; Saran</h2>
            <div class="contact-container">

                <div class="contact-info">
                    <p>
                        Kami sangat terbuka dengan kritik dan saran dari Anda untuk membuat Rice Field Coffee
                        menjadi lebih baik lagi. Silakan sampaikan pengalaman Anda selama berkunjung.
                    </p>
                    <ul>
                        <li>✔ Pelayanan</li>
                        <li>✔ Rasa menu</li>
                        <li>✔ Kenyamanan tempat</li>
                        <li>✔ Harga</li>
                    </ul>
                </div>

                <div class="contact-form">
                    <?php if ($feedback_success): ?>
                        <div class="alert alert-success">
                            Terima kasih, kritik &amp; saran Anda sudah terkirim.
                        </div>
                    <?php endif; ?>

                    <?php if ($feedback_error !== ''): ?>
                        <div class="alert alert-error">
                            <?php echo htmlspecialchars($feedback_error); ?>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="#kritik-saran">
                        <div class="form-group">
                            <label for="name">Nama *</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email (opsional)</label>
                            <input type="email" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="rating">Rating (1-5, opsional)</label>
                            <input type="number" id="rating" name="rating" min="1" max="5">
                        </div>

                        <div class="form-group">
                            <label for="message">Pesan *</label>
                            <textarea id="message" name="message" rows="4" required></textarea>
                        </div>

                        <button type="submit" name="submit_feedback" class="cta-button">
                            Kirim Kritik &amp; Saran
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- REVIEW (otomatis dari kritik & saran) -->
        <section id="review" class="review-section">
            <h2>Review Pengunjung</h2>
            <p class="review-subtitle">
                Semua kritik dan saran yang masuk akan tampil di sini sebagai bahan evaluasi kami.
            </p>

            <div class="review-grid">
                <?php if (empty($feedbacks)): ?>
                    <p class="no-review">Belum ada review. Jadilah yang pertama memberikan kritik &amp; saran!</p>
                <?php else: ?>
                    <?php foreach ($feedbacks as $fb): ?>
                        <div class="review-card">
                            <div class="review-header">
                                <div class="review-name">
                                    <?php echo htmlspecialchars($fb['name']); ?>
                                </div>
                                <?php if (!empty($fb['rating'])): ?>
                                    <div class="review-rating">
                                        <?php echo str_repeat('★', (int)$fb['rating']); ?>
                                        <?php echo str_repeat('☆', 5 - (int)$fb['rating']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <p class="review-message">
                                "<?php echo nl2br(htmlspecialchars($fb['message'])); ?>"
                            </p>
                            <div class="review-date">
                                <?php echo date('d M Y H:i', strtotime($fb['created_at'])); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- KERANJANG PESANAN -->
        <section id="pesanan" class="cart-section">
            <h2>Keranjang Pesanan</h2>
            <div class="cart">
                <div id="empty-cart-message">Keranjang masih kosong.</div>
                <div id="cart-items"></div>
                <div id="cart-total" class="cart-total">Total: Rp 0</div>
                <button id="checkout-btn" class="checkout-btn" disabled>Checkout</button>
            </div>
        </section>

    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>