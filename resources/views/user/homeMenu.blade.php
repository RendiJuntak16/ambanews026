<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PortalKini - Baca Blog Kami</title>
    
    <!-- Menggunakan Inter untuk UI/Navigasi dan Merriweather untuk Heading & Teks Artikel (Klasik & Elegan) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #F97316; /* Oranye khas tema kita */
            --primary-hover: #EA580C;
            --text-dark: #111827;
            --text-gray: #4B5563;
            --text-light: #9CA3AF;
            --bg-white: #FFFFFF;
            --card-bg: #FFF7ED; /* Warna krem/hangat untuk box bawah kartu sesuai referensi */
            --radius-lg: 16px;
            --font-ui: 'Inter', sans-serif;
            --font-serif: 'Merriweather', serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: var(--font-ui);
            background-color: var(--bg-white);
            color: var(--text-dark);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        .hidden { display: none !important; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

        .navbar {
            position: absolute;
            top: 0; left: 0; width: 100%;
            padding: 1.5rem 0;
            z-index: 100;
        }
        .nav-content {
            display: flex; justify-content: space-between; align-items: center;
        }
        .logo {
            font-size: 1.5rem; font-weight: 700; color: #FFFFFF; 
            text-decoration: none; display: flex; align-items: center; gap: 0.5rem;
            cursor: pointer;
        }
        .nav-links {
            display: flex; align-items: center; gap: 2rem;
        }
        .nav-links a {
            color: #FFFFFF; text-decoration: none; font-size: 0.875rem; 
            font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;
            display: flex; align-items: center; gap: 0.25rem; transition: 0.3s;
        }
        .nav-links a:hover { color: var(--primary); }
        .btn-nav {
            background-color: var(--primary); color: #FFFFFF !important; 
            padding: 0.75rem 1.5rem; border-radius: 4px;
        }
        .btn-nav:hover { background-color: var(--primary-hover); transform: translateY(-2px); }

        .hero {
            position: relative;
            background: url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            min-height: 480px;
            display: flex; align-items: center;
            padding-top: 80px; /* Offset for navbar */
        }
        /* Overlay Gelap */
        .hero::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to bottom, rgba(17, 24, 39, 0.8), rgba(17, 24, 39, 0.9));
        }
        .hero-content {
            position: relative; z-index: 10;
            max-width: 800px; color: #FFFFFF;
        }
        .hero-content h1 {
            font-family: var(--font-serif); font-size: 3.5rem; 
            font-weight: 700; margin-bottom: 1rem; line-height: 1.2;
        }
        .hero-content p {
            font-size: 1.25rem; font-weight: 300; opacity: 0.9;
        }

        .content-section { padding: 5rem 0; }
        .section-header { max-width: 900px; margin-bottom: 3rem; }
        .section-header h2 {
            font-family: var(--font-serif); font-size: 2.5rem; 
            color: var(--text-dark); margin-bottom: 1rem;
        }
        .section-header p {
            color: var(--text-gray); font-size: 1rem; line-height: 1.7;
        }

        /* --- Desain Bar Pencarian --- */
        .search-container {
            position: relative;
            max-width: 600px;
            margin: 0 auto 3rem auto; /* Memposisikan di tengah dengan jarak ke bawah */
        }
        .search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 1.1rem;
        }
        .search-input {
            width: 100%;
            padding: 1rem 1.5rem 1rem 3.25rem;
            border: 1px solid #D1D5DB;
            border-radius: 50px; /* Bentuk membulat/pil yang elegan */
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
            font-family: var(--font-ui);
            color: var(--text-dark);
        }
        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
        }
        .search-input::placeholder {
            color: var(--text-light);
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }

        /* Desain Kartu Persis Referensi */
        .article-card {
            display: flex; flex-direction: column;
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            height: 100%;
        }
        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .card-img {
            width: 100%; height: 240px; object-fit: cover;
        }
        .card-body {
            background-color: var(--card-bg); /* Warna latar bawah yang khas */
            padding: 2rem;
            flex-grow: 1; display: flex; flex-direction: column;
        }
        .card-title {
            font-family: var(--font-serif); font-size: 1.35rem; 
            font-weight: 700; color: var(--text-dark); margin-bottom: 0.5rem;
            line-height: 1.4;
        }
        .card-date {
            font-size: 0.85rem; color: var(--text-light); 
            margin-bottom: 1.5rem; font-weight: 500;
        }
        .card-link {
            margin-top: auto; color: #10B981; /* Warna hijau teal sesuai referensi */
            font-size: 0.9rem; font-weight: 600; text-decoration: none;
            display: inline-block; transition: 0.3s;
        }
        .article-card:hover .card-link { color: var(--primary); }

        /* Menggunakan hero yang lebih kecil untuk detail agar senada */
        .hero-detail {
            position: relative;
            background: #111827; /* Solid dark color */
            padding: 120px 0 60px 0;
            text-align: center;
        }
        .hero-detail-content {
            position: relative; z-index: 10; max-width: 900px; margin: 0 auto; color: #FFFFFF;
        }
        .detail-meta {
            color: var(--primary); font-weight: 600; font-size: 0.875rem; 
            text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem;
        }
        .detail-title {
            font-family: var(--font-serif); font-size: 3rem; 
            font-weight: 700; line-height: 1.3; margin-bottom: 1.5rem;
        }
        .detail-author-date {
            font-size: 0.95rem; color: #9CA3AF;
        }

        .article-body-container {
            max-width: 800px; margin: -40px auto 4rem auto; 
            position: relative; z-index: 20;
            background: #FFFFFF; padding: 3rem; border-radius: var(--radius-lg);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }
        .article-main-image {
            width: 100%; height: auto; border-radius: 8px; margin-bottom: 3rem;
        }
        .article-text {
            font-family: var(--font-serif);
            font-size: 1.15rem; line-height: 1.9; color: #374151;
        }
        .article-text p { margin-bottom: 2rem; }
        
        /* Drop cap (Huruf pertama besar) bergaya majalah */
        .article-text p:first-of-type::first-letter {
            float: left; font-size: 4rem; line-height: 0.8; 
            padding-right: 0.5rem; color: var(--primary); font-weight: 900;
        }

        .back-btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            color: var(--text-gray); text-decoration: none; font-weight: 600;
            margin-bottom: 2rem; transition: 0.3s; cursor: pointer;
        }
        .back-btn:hover { color: var(--primary); }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 { font-size: 2.5rem; }
            .hero-detail { padding: 100px 20px 40px 20px; }
            .detail-title { font-size: 2rem; }
            .article-body-container { padding: 2rem 1.5rem; margin-top: 0; box-shadow: none; border-radius: 0; }
            .nav-links { display: none; } /* Simplified for mobile mockup */
        }
        
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container nav-content">
            <a href="#" class="logo" onclick="switchView('home')">
                <i class="fa-regular fa-newspaper"></i> AMBANEWS
            </a>
            <div class="nav-links">
                <a href="#">Berita <i class="fa-solid fa-angle-down" style="font-size: 10px;"></i></a>
                <a href="#">Topik <i class="fa-solid fa-angle-down" style="font-size: 10px;"></i></a>
                <a href="#">Tentang <i class="fa-solid fa-angle-down" style="font-size: 10px;"></i></a>
                <a href="{{ route('article.dashboard') }}" class="btn-nav">Masuk Admin</a>
            </div>
        </div>
    </nav>

    <!-- ================= HALAMAN HOME (DAFTAR BLOG) ================= -->
    <main id="view-home">
        
        <section class="hero">
            <div class="container hero-content">
                <h1>Baca Blog Kami</h1>
                <p>Blog kami mengambil pesan dari kejadian akhir pekan dan menyusun langkah tepat selanjutnya, sehingga Anda dapat memahami dan mengaplikasikannya secara praktis dalam kehidupan.</p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="section-header" style="text-align: center; margin-left: auto; margin-right: auto;">
                    <h2>Tentang Blog Kami</h2>
                    <p>Bacalah blog PortalKini untuk artikel inspiratif, wawasan praktis, dan pembaruan dari komunitas kami. Blog kami mencakup berbagai topik untuk mendorong pertumbuhan pengetahuan dan memperdalam koneksi Anda dengan isu terkini. Tetap terhubung dengan konten relevan yang memperkuat literasi Anda setiap harinya.</p>
                </div>

                <!-- Menambahkan Bar Pencarian -->
                <div class="search-container">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari judul atau topik artikel yang ingin Anda baca..." onkeyup="filterArticles()">
                </div>

                <div class="articles-grid" id="articlesGrid">
                    
                    @foreach ($articles as $item)
                    <!-- Kartu  -->
                        <a href="{{ route('article.detail', $item->id_article) }}" style="text-decoration: none;">
                            <div class="article-card">
                            <img src="{{ asset('storage/'. $item->thumbnail) }}" alt="{{ $item->title }}" class="card-img">
                            <div class="card-body">
                                <h3 class="card-title">{{ $item->title }}</h3>
                                <div class="card-date">{{ $item->created_at->format('d M Y') }}</div>
                                <span class="card-link">View Post</span>
                            </div>
                        </div>
                        </a>
                        
                     @endforeach
                    <!-- Jika database kosong, tampilkan pesan -->
                    @if($articles->isEmpty())
                        <p style="text-align: center; grid-column: 1 / -1;">Belum ada artikel yang dipublikasikan.</p>
                    @endif
                    

                </div>
            </div>
        </section>
    </main>

    <script>

        // Fungsi untuk menyaring (mencari) artikel secara real-time
        function filterArticles() {
            // Ambil teks yang diketik pengunjung lalu ubah ke huruf kecil
            let input = document.getElementById('searchInput').value.toLowerCase();
            
            // Ambil semua elemen kartu artikel
            let cards = document.getElementsByClassName('article-card');
            
            // Lakukan perulangan untuk mengecek setiap kartu
            for (let i = 0; i < cards.length; i++) {
                // Ambil teks judul dari dalam kartu
                let title = cards[i].querySelector('.card-title').innerText.toLowerCase();
                
                // Jika judul mengandung teks yang dicari, tampilkan. Jika tidak, sembunyikan.
                if (title.includes(input)) {
                    cards[i].style.display = ""; // Kembali ke setelan CSS bawaan (flex)
                } else {
                    cards[i].style.display = "none"; // Sembunyikan kartu
                }
            }
        }
    </script>
</body>
</html>