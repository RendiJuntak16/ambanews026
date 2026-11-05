<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Artikel Premium</title>
    
    <!-- Menggunakan font Merriweather (Klasik/Serif) dan Inter (Modern/Sans-Serif) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #F97316; /* Oranye khas portal Anda */
            --text-dark: #111827;
            --text-gray: #4B5563; /* Warna teks abu-abu yang nyaman di mata */
            --bg-white: #FFFFFF;
            --font-ui: 'Inter', sans-serif;
            --font-serif: 'Merriweather', serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: var(--font-ui);
            background-color: var(--bg-white);
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
        }

        .page-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 60px 24px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            transition: color 0.3s;
        }
        
        .back-btn:hover { color: var(--primary); }

        .article-meta {
            font-size: 0.875rem;
            color: #9CA3AF;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .article-meta span.category { color: var(--primary); }

        /* Bagian ini mengatur bagaimana tag HTML dari Quill ditampilkan */
        .article-content {
            width: 100%;
        }

        /* Heading 2 (H2): Digunakan sebagai teks raksasa pembuka ala referensi */
        .article-content h2 {
            font-family: var(--font-serif);
            font-size: 2.75rem;
            font-weight: 900;
            line-height: 1.25;
            color: var(--text-dark);
            margin-bottom: 3rem;
            letter-spacing: -0.02em; /* Jarak huruf dirapatkan agar tegas */
        }

        /* Heading 3 (H3): Digunakan sebagai Sub-judul di tengah artikel */
        .article-content h3 {
            font-family: var(--font-serif);
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-top: 3rem;
            margin-bottom: 1rem;
        }

        /* Paragraf (P): Menggunakan font tipis yang lega untuk membaca panjang */
        .article-content p {
            font-family: var(--font-ui);
            font-size: 1.125rem;
            font-weight: 300;
            line-height: 1.8;
            color: var(--text-gray);
            margin-bottom: 1.5rem;
        }

        /* Blockquote: Kutipan diubah menjadi modern dengan garis oranye */
        .article-content blockquote {
            border-left: 4px solid var(--primary);
            background: linear-gradient(to right, rgba(249,115,22,0.05), transparent);
            padding: 1.5rem 2rem;
            margin: 2.5rem 0;
            font-family: var(--font-ui);
            font-style: italic;
            font-size: 1.15rem;
            color: #374151;
            border-radius: 0 8px 8px 0;
        }

        /* Teks Hijau di dalam Kutipan (seperti "Ephesians 3:16") */
        .article-content blockquote span.highlight {
            color: #10B981; /* Warna hijau lembut */
            font-weight: 500;
        }

        /* Gambar di dalam artikel */
        .article-content img {
            width: 100%;
            max-height: 450px; /* Mencegah gambar potrait terlalu tinggi memakan layar */
            object-fit: cover; /* Memastikan gambar proporsional dan tidak gepeng */
            border-radius: 12px; /* Sudut membulat yang lebih premium */
            margin: 2.5rem 0; /* Jarak atas bawah yang lega dengan teks */
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05); /* Bayangan lembut */
            display: block;
        }

        @media (max-width: 768px) {
            .page-container { padding: 40px 20px; }
            .article-content h2 { font-size: 2rem; }
            .article-content h3 { font-size: 1.5rem; }
            .article-content p { font-size: 1rem; }
            .article-content blockquote { padding: 1.25rem; font-size: 1rem; }
        }
        
    </style>
</head>
<body>

    <main class="page-container">
        
        <!-- Tombol Navigasi -->
        <a href="{{ route('article.home') }}" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Blog
        </a>

        <!-- Meta Data (Kategori & Tanggal) -->
        <div class="article-meta">
            <span class="category">{{ $article->category }}</span> &nbsp;&bull;&nbsp; {{ $article->created_at->format('d F Y') }}
        </div>

        <!-- 
          AREA KONTEN ARTIKEL 
          {{-- Di Laravel, bagian dalam div ini akan diganti dengan: {!! $article->content !!} --}}
        -->
        <article class="article-content">
            
            <h2>{{ $article->title }}</h2>

            <!-- Menampilkan Gambar Utama -->
            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="" class="article-main-image">

            <!-- Menampilkan ISI KONTEN QUILL -->
            <div class="article-text">
                {{-- <!-- INGAT! Gunakan {!! !!} untuk mencetak HTML dari Quill --> --}}
                {!! $article->content !!}
            </div>

        </article>

    </main>

</body>
</html>