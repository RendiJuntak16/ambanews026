<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulis Artikel Baru - AmbaNews</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Quill Editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    
    <style>
        /* ================= VARIABLES & RESET ================= */
        :root {
            --surface: #FFFFFF;
            --background: #F3F4F6;
            --text-main: #0F172A;
            --text-muted: #475569;
            --border: #E2E8F0;
            --blogger: #4F46E5; 
            --radius-md: 8px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--background); 
            color: var(--text-main); 
            height: 100vh; 
            display: flex; 
            flex-direction: column; 
            overflow: hidden; /* Mencegah scroll ganda */
        }

        /* ================= HEADER ATAS ================= */
        .editor-header { 
            height: 64px; 
            background: var(--surface); 
            border-bottom: 1px solid var(--border); 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            padding: 0 24px; 
            flex-shrink: 0; 
        }
        
        .flex-center { display: flex; align-items: center; gap: 1rem; }
        
        .btn-icon { 
            padding: 0.5rem; border-radius: var(--radius-md); cursor: pointer; 
            border: none; background: transparent; font-size: 1.25rem; color: var(--text-muted);
        }
        .btn-icon:hover { background-color: var(--background); color: var(--text-main); }
        
        .blogger-logo { 
            background: var(--blogger); color: white; width: 36px; height: 36px; 
            border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; 
        }

        .btn { 
            padding: 0.6rem 1.2rem; border-radius: var(--radius-md); font-weight: 500; 
            border: none; cursor: pointer; font-size: 0.875rem; display: flex; align-items: center; gap: 0.5rem; 
        }
        .btn-outline { background-color: transparent; border: 1px solid var(--border); color: var(--text-main); }
        .btn-outline:hover { background-color: var(--background); }
        
        .btn-orange { background-color: var(--blogger); color: white; }
        .btn-orange:hover { background-color: #EA580C; }

        /* ================= AREA KERJA UTAMA ================= */
        .editor-workspace { 
            display: flex; 
            flex: 1; 
            overflow: hidden; 
        }
        
        /* Bagian Kertas Menulis (Kiri/Tengah) */
        .editor-main { 
            flex: 1; 
            padding: 24px 48px; 
            overflow-y: auto; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
        }
        
        .editor-paper { 
            width: 100%; 
            max-width: 900px; 
            display: flex; 
            flex-direction: column; 
            flex: 1; 
        }
        
        .blogspot-title { 
            width: 100%; font-size: 1.8rem; padding: 10px 0; border: none; 
            border-bottom: 1px solid #D1D5DB; background: transparent; outline: none; 
            margin-bottom: 15px; color: var(--text-main); font-weight: 600; 
            font-family: 'Inter', sans-serif; flex-shrink: 0; transition: border-color 0.3s;
        }
        .blogspot-title:focus { border-bottom: 2px solid var(--blogger); }

        /* Bagian Sidebar Setelan (Kanan) */
        .editor-sidebar { 
            width: 300px; 
            background: var(--surface); 
            border-left: 1px solid var(--border); 
            padding: 24px; 
            overflow-y: auto; 
            flex-shrink: 0; 
        }
        
        .form-group { margin-bottom: 1.5rem; display: flex; flex-direction: column; gap: 0.5rem; }
        .form-group label { font-size: 0.875rem; font-weight: 500; color: var(--text-main); }
        
        select { 
            width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--border); 
            border-radius: var(--radius-md); outline: none; font-size: 0.875rem; 
            background-color: var(--surface); cursor: pointer;
        }
        select:focus { border-color: var(--blogger); }
        
        .file-upload-wrapper { 
            border: 2px dashed var(--border); border-radius: var(--radius-md); 
            padding: 1.5rem 1rem; text-align: center; cursor: pointer; transition: 0.3s; 
        }
        .file-upload-wrapper:hover { border-color: var(--blogger); background-color: #FFF7ED; }
        .file-upload-wrapper p { color: var(--text-muted); font-size: 0.875rem; }

        /* ================= KUSTOMISASI QUILL CSS ================= */
        .ql-toolbar.ql-snow { 
            border: none !important; 
            border-bottom: 1px solid var(--border) !important; 
            background: transparent; 
            padding: 12px 0 !important; 
            margin-bottom: 10px; 
            flex-shrink: 0;
        }
        .ql-container.ql-snow { 
            border: none !important; 
            background: var(--surface); 
            border-radius: var(--radius-md); 
            box-shadow: var(--shadow-sm); 
            flex: 1; /* Biarkan memanjang secara otomatis */
            min-height: 400px; 
            font-family: 'Inter', sans-serif; 
            font-size: 1.1rem; 
        }
        .ql-editor { padding: 40px !important; }

        /* ================= RESPONSIVE (MOBILE) ================= */
        @media (max-width: 768px) {
            .editor-workspace { flex-direction: column; }
            .editor-main { padding: 16px; }
            .editor-sidebar { 
                width: 100%; border-left: none; border-top: 1px solid var(--border); 
                height: auto; max-height: 300px; 
            }
            .ql-editor { padding: 20px !important; }
        }
    </style>
</head>
<body>

    <!-- Header (Top Bar) -->
    <header class="editor-header">
        <div class="flex-center">
            <a href="/admin/dashboard" style="text-decoration: none;">
                <button class="btn-icon" title="Kembali"><i class="fa-solid fa-arrow-left"></i></button>
            </a>
            
            <div class="blogger-logo"><i class="fa-brands fa-blogger-b"></i></div>
        </div>
        <div class="flex-center" style="gap: 0.5rem;">
            <button class="btn btn-outline" style="display: none; /* Sembunyikan di layar sangat kecil */">Pratinjau</button>
            <button type="submit" form="form-artikel" class="btn btn-orange"><i class="fa-solid fa-paper-plane"></i> Perbarui</button>
        </div>
    </header>

    <!-- Ruang Kerja (Workspace) -->
   <!-- 1. Silakan tambahkan action, method, dan enctype di dalam tag form ini -->
<form action="{{ route('article.update', $data->id_article) }}" id="form-artikel" class="editor-workspace" method="POST" enctype="multipart/form-data">
    
    <!-- 2. Silakan ketik token CSRF Laravel di baris bawah ini -->
    @method('PUT')
    @csrf
        
    <!-- Bagian Tengah (Kertas Menulis) -->
    <main class="editor-main">
        <div class="editor-paper">
            
            <!-- 3. Silakan tambahkan atribut name="..." di input judul ini -->
            <input type="text" id="judul" name="title" class="blogspot-title" placeholder="Judul" required autocomplete="off" value="{{ $data->title }}">
            
            <!-- Elemen ini akan diubah menjadi Editor oleh Quill.js -->
            <<div id="editor-container" style="height: 300px; background: white;">
                {!! $data->content !!}
            </div>
            <!-- 4. Silakan tambahkan atribut name="..." di input hidden ini -->
            <input type="hidden" name="content" id="hidden-content">
            
        </div>
    </main>

    <!-- Bagian Kanan (Sidebar Setelan) -->
    <aside class="editor-sidebar">
        <div style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 0.5px;">
            Setelan Entri
        </div>
        
        <div class="form-group">
            <label>Label / Kategori</label>
            
            <!-- 5. Silakan tambahkan atribut name="..." di tag select ini -->
            <select id="kategori" name="category" required >
                <!-- Menyeleksi kategori yang sudah dipilih sebelumnya -->
                
                <option value="nasional" {{ $data->category == 'nasional' ? 'selected' : '' }}>Nasional</option>
                <option value="teknologi" {{ $data->category == 'teknologi' ? 'selected' : '' }}>Teknologi</option>
                <option value="olahraga" {{ $data->category == 'olahraga' ? 'selected' : '' }}>olahraga</option>
                <option value="Hiburan" {{ $data->category == 'hiburan' ? 'selected' : '' }}>hiburan</option>
                
            </select>
        </div>
        
        <div class="form-group mt-6">
            <label>Gambar Thumbnail</label>
            <div class="file-upload-wrapper">
                <i style="font-size: 1.5rem; margin-bottom: 0.5rem; color: #9CA3AF;"></i>
               <img src="{{ asset('storage/' . $data->thumbnail) }}" width="150" alt="Gambar Lama"><br><br>
                
                <!-- 6. Silakan tambahkan atribut name="..." di input file ini -->
                <input type="file" name="thumbnail"  accept="image/*" style=" margin-top: 10px; width: 100%;">
                
            </div>
        </div>
    </aside>
    
</form>
    
    

    <!-- Hanya panggil Script Quill JS di sini -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        // Inisialisasi Quill Editor
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Mulai menulis konten berita di sini...',
            modules: {
                toolbar: [
                    [{ 'font': [] }, { 'size': ['small', false, 'large', 'huge'] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    ['link', 'image', 'video'],
                    [{ 'align': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    ['blockquote'],
                    ['clean']
                ]
            }
        });

            // Inisialisasi Quill
            var quill = new Quill('#editor-container', {
            theme: 'snow'
            });

            // Menangkap event saat form disubmit
            var form = document.getElementById('form-artikel');

            form.onsubmit = function() {
                // Ambil isi HTML dari editor Quill (termasuk tag <p>, <b>, <img>, dll)
                var isiArtikel = quill.root.innerHTML;
                
                // Masukkan isi tersebut ke dalam input tipe hidden
                document.getElementById('hidden-content').value = isiArtikel;
                
                // Setelah dimasukkan, form akan otomatis melanjutkan proses submit ke Laravel
            };
    </script>

</body>
</html>