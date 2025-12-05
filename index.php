<?php
// Memanggil file konfigurasi dan fungsi
include 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rice Field Coffee - Pemesanan Online</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Nikmati Sensasi Kopi Anda di Rice Field Coffee</h1>
                <p>Rasakan keharuman dan cita rasa kopi terbaik yang diseduh khusus untuk Anda</p>
                <a href="#menu" class="cta-button">Lihat Menu</a>
            </div>
        </section>

        <!-- TENTANG KAMI -->
        <section id="about" class="about-section">
            <div class="about-container">
                <div class="about-text">
                    <h2>Tentang Kami</h2>
                    <p>
                        Rice Field Coffee lahir dari kecintaan kami terhadap kopi dan kebersamaan.
                        Kami menghadirkan suasana hangat di tengah alam terbuka dengan pilihan kopi
                        terbaik yang diseduh secara profesional. Setiap cangkir kopi kami diracik
                        dengan sepenuh hati agar menjadi teman terbaik di setiap obrolan Anda.
                    </p>
                    <p>
                        Selain kopi, kami juga menyediakan berbagai snack yang cocok dinikmati
                        bersama teman, keluarga, maupun saat Anda ingin menikmati waktu sendiri.
                    </p>
                </div>
                <div class="about-image-card">
                    <div class="about-image-wrapper">
                        <!-- Ganti dengan gambar kamu sendiri -->
                        <img src="images/about-coffee.jpg" alt="Suasana Rice Field Coffee">
                    </div>
                </div>
            </div>
        </section>

        <!-- TIM / OWNER -->
        <section class="team-section">
            <h2>Tim Rice Field Coffee</h2>
            <p class="team-subtitle">Orang-orang di balik setiap cangkir kopi dan suasana yang hangat.</p>

            <div class="team-grid">
                <!-- 1 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="images/team1.jpg" alt="Owner">
                    </div>
                    <div class="team-role">Owner RFC</div>
                    <div class="team-name">Diyatrie Muhammad Bilal</div>
                </div>

                <!-- 2 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="images/team2.jpg" alt="Co-Owner">
                    </div>
                    <div class="team-role">Co-Owner</div>
                    <div class="team-name">Gilang Atha</div>
                </div>

                <!-- 3 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="images/team3.jpg" alt="Barista">
                    </div>
                    <div class="team-role">Head Barista</div>
                    <div class="team-name">Farhan Maulana</div>
                </div>

                <!-- 4 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="images/team4.jpg" alt="Barista">
                    </div>
                    <div class="team-role">Barista</div>
                    <div class="team-name">Ariananda Pandu</div>
                </div>

                <!-- 5 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="images/team5.jpg" alt="Kitchen">
                    </div>
                    <div class="team-role">Barista</div>
                    <div class="team-name">Ahmad Rai</div>
                </div>

                <!-- 6 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="images/team6.jpg" alt="Service">
                    </div>
                    <div class="team-role">Marketing</div>
                    <div class="team-name">Banu Segara</div>
                </div>

                <!-- 7 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="images/team7.jpg" alt="Marketing">
                    </div>
                    <div class="team-role">Marketing</div>
                    <div class="team-name">Adzka</div>
                </div>

                <!-- 8 -->
                <div class="team-card">
                    <div class="team-photo">
                        <img src="images/team8.jpg" alt="Developer">
                    </div>
                    <div class="team-role">Developer</div>
                    <div class="team-name">Hamdan Sadad</div>
                </div>
            </div>
        </section>

        <!-- MENU -->
        <section id="menu" class="menu-section">
            <h2>Menu Kami</h2>
            <div class="menu-filters">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="hot">Hot Coffee</button>
                <button class="filter-btn" data-filter="cold">Cold Coffee</button>
                <button class="filter-btn" data-filter="snack">Snack</button>
            </div>

            <div class="menu-items">
                <?php
                // Menampilkan menu dari array
                foreach (getMenuItems() as $item) {
                    echo renderMenuItem($item);
                }
                ?>
            </div>
        </section>

        <section class="cart-section">
            <h2>Keranjang Pesanan</h2>
            <div id="cart" class="cart">
                <p id="empty-cart-message">Keranjang Anda masih kosong</p>
                <div id="cart-items"></div>
                <div id="cart-total" class="cart-total"></div>
                <button id="checkout-btn" class="checkout-btn" disabled>Checkout</button>
            </div>
        </section>
        <!-- KONTAK -->
        <section id="contact" class="contact-section">
            <h2>Kontak Kami</h2>
            <div class="contact-container">
                <div class="contact-info">
                    <p>
                        Punya pertanyaan, saran, atau ingin melakukan reservasi?
                        Silakan hubungi kami melalui kontak di bawah ini.
                    </p>
                    <ul>
                        <li><strong>WhatsApp:</strong> +62-895-3746-44233</li>
                        <li><strong>Email:</strong> info@ricefieldcoffee.com</li>
                        <li><strong>Instagram:</strong> @ricefieldcoffee</li>
                        <li><strong>Alamat:</strong> BTN CILIMUS SAWAH</li>
                    </ul>
                </div>
                <form class="contact-form">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" placeholder="Masukkan nama Anda">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Masukkan email Anda">
                    </div>
                    <div class="form-group">
                        <label for="pesan">Pesan</label>
                        <textarea id="pesan" rows="4" placeholder="Tulis pesan Anda di sini"></textarea>
                    </div>
                    <button type="submit" class="cta-button">Kirim Pesan</button>
                </form>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>