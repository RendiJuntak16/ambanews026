<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin Baru - PortalKini</title>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4F46E5;         /* Warna Utama Indigo */
            --primary-hover: #4338CA;
            --primary-light: #EEF2FF;
            --bg-body: #F8FAFC;         
            --surface: #FFFFFF;         
            --text-dark: #0F172A;       
            --text-muted: #64748B;      
            --border: #E2E8F0;          
            --input-bg: #F8FAFC;
            --success: #10B981;
            --radius-md: 8px;
            --radius-lg: 16px;
            --shadow-card: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            --shadow-input: 0 0 0 3px rgba(79, 70, 229, 0.15);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            /* Latar belakang yang sama dengan halaman login */
            background-image: radial-gradient(circle at top right, #e2e8f0 0%, transparent 40%),
                              radial-gradient(circle at bottom left, #eef2ff 0%, transparent 40%);
        }

        .register-wrapper {
            width: 100%;
            max-width: 450px; /* Sedikit lebih lebar dari login untuk kenyamanan */
            background: var(--surface);
            padding: 2.5rem 2.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            background-color: var(--primary-light);
            color: var(--primary);
            border-radius: 14px;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .register-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .register-header p {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .input-icon-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon-wrapper i {
            position: absolute;
            left: 1rem;
            color: #94A3B8;
            font-size: 1rem;
            transition: var(--transition);
        }

        /* Input Field Styling */
        .form-control {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.75rem;
            font-size: 0.95rem;
            background-color: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            color: var(--text-dark);
            outline: none;
            transition: var(--transition);
        }

        .form-control::placeholder {
            color: #94A3B8;
        }

        /* Efek saat input diklik (Focus) */
        .form-control:focus {
            background-color: var(--surface);
            border-color: var(--primary);
            box-shadow: var(--shadow-input);
        }

        .form-control:focus + i, 
        .form-control:not(:placeholder-shown) + i {
            color: var(--primary);
        }

        .btn-submit {
            width: 100%;
            padding: 0.875rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
            transition: var(--transition);
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-link:hover {
            color: var(--primary);
        }

        /* Responsivitas untuk layar HP */
        @media (max-width: 480px) {
            .register-wrapper {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="register-wrapper">
        
        <!-- Bagian Header -->
        <div class="register-header">
            <div class="brand-logo">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <h1>Tambah Admin Baru</h1>
            <p>Buat akun akses untuk staf pengelola portal.</p>
        </div>

        <!-- Tampilkan Error Jika Ada -->
        @if($errors->any())
            <div style="background-color: #FEF2F2; color: #EF4444; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulir Registrasi -->
        <form action="{{ route('registrasi.post') }}" method="POST">
            @csrf
            <!-- Input Nama -->
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <div class="input-icon-wrapper">
                    <input type="text" id="name" name="name" class="form-control" placeholder="ikaa" value="{{ old('name') }}" required>
                    <i class="fa-regular fa-user"></i>
                </div>
            </div>

            <!-- Input Email -->
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-icon-wrapper">
                    <input type="email" id="email" name="email" class="form-control" placeholder="ika@ambanews.com" value="{{ old('email') }}" required>
                    <i class="fa-regular fa-envelope"></i>
                </div>
            </div>

            <!-- Input Password -->
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div class="input-icon-wrapper">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
            </div>

            <!-- Input Konfirmasi Password -->
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div class="input-icon-wrapper">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ketik ulang kata sandi" required>
                    <i class="fa-solid fa-shield-check"></i>
                </div>
            </div>

            <!-- Tombol Daftar -->
            <button type="submit" class="btn-submit">
                Daftarkan Akun <i class="fa-solid fa-check"></i>
            </button>
            
            <!-- Link Kembali (Opsional) -->
            <a href="{{ route('article.dashboard') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
            
        </form>

    </div>

    

</body>
</html>