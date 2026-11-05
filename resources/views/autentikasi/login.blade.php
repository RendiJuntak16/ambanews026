<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PortalKini</title>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4F46E5;         /* Warna Utama Indigo */
            --primary-hover: #4338CA;
            --primary-light: #EEF2FF;
            --bg-body: #F8FAFC;         /* Latar Belakang Abu-abu Terang */
            --surface: #FFFFFF;         /* Warna Kartu Putih */
            --text-dark: #0F172A;       /* Teks Utama Gelap */
            --text-muted: #64748B;      /* Teks Abu-abu */
            --border: #E2E8F0;          /* Garis Tepi */
            --input-bg: #F8FAFC;
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
            /* Latar belakang dengan pola dekoratif halus (opsional) */
            background-image: radial-gradient(circle at top right, #e2e8f0 0%, transparent 40%),
                              radial-gradient(circle at bottom left, #eef2ff 0%, transparent 40%);
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            background: var(--surface);
            padding: 3rem 2.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
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
            font-size: 1.75rem;
            margin-bottom: 1.25rem;
        }

        .login-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .login-header p {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .form-group {
            margin-bottom: 1.5rem;
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

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            font-size: 0.875rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            color: var(--text-muted);
            font-weight: 500;
        }

        .remember-me input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .forgot-password:hover {
            color: var(--primary-hover);
            text-decoration: underline;
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
            transition: var(--transition);
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        /* Responsivitas untuk layar HP */
        @media (max-width: 480px) {
            .login-wrapper {
                padding: 2.5rem 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        
        <!-- Bagian Header (Logo & Judul) -->
        <div class="login-header">
            <div class="brand-logo">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h1>AmbaNews Admin</h1>
            <p>Silakan masuk untuk mengelola sistem.</p>
        </div>

        <!-- Jika ada error dari Controller, tampilkan pesan warna merah di sini -->
        @if($errors->any())
            <div style="background-color: #FEF2F2; color: #EF4444; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 0.875rem; text-align: center;">
                {{ $errors->first() }}
            </div>
        @endif
        <!-- Formulir Login -->
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <!-- Input Email -->
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-icon-wrapper">
                    <!-- Perhatikan urutan: input diletakkan sebelum icon (untuk trik CSS focus icon) -->
                    <input type="email" id="email" name="email" class="form-control" placeholder="admin@wkwk.com" required>
                    <i class="fa-regular fa-envelope"></i>
                </div>
            </div>

            <!-- Input Password -->
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div class="input-icon-wrapper">
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
            </div>

            <!-- Tombol Masuk -->
            <button type="submit" class="btn-submit">
                Masuk Dashboard <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>
            
        </form>

    </div>

</body>
</html>