<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Artikel - AmbaNews</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
         /* Efek transisi saat baris dihapus */
        .fade-out-row {
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.4s ease-out;
        }
        /* ================= VARIABLES & BASE ================= */
        :root {
            --primary: #4F46E5; 
            --primary-hover: #4338CA;
            --secondary: #64748B;
            --background: #F1F5F9;
            --surface: #FFFFFF;
            --text-main: #0F172A;
            --text-muted: #475569;
            --border: #E2E8F0;
            --danger: #EF4444;
            --success: #10B981;
            --radius-md: 8px;
            --radius-lg: 12px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: var(--background); color: var(--text-main); line-height: 1.6; }
        
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .mb-6 { margin-bottom: 1.5rem; }
        
        h2 { color: var(--text-main); font-weight: 600; line-height: 1.2; }
        p { color: var(--text-muted); }
        .text-sm { font-size: 0.875rem; }

        /* ================= COMPONENTS ================= */
        /* Buttons */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.6rem 1.2rem; border-radius: var(--radius-md); font-weight: 500; border: none; cursor: pointer; transition: var(--transition); font-size: 0.875rem; gap: 0.5rem; outline: none; }
        .btn-primary { background-color: var(--primary); color: white; }
        .btn-primary:hover { background-color: var(--primary-hover); transform: translateY(-1px); }
        .btn-outline { background-color: transparent; border: 1px solid var(--border); color: var(--text-main); }
        .btn-outline:hover { background-color: #F8FAFC; }
        .btn-danger { background-color: #FEF2F2; color: var(--danger); border: 1px solid #FECACA; }
        .btn-icon { padding: 0.5rem; border-radius: var(--radius-md); cursor: pointer; border: none; background: transparent; transition: var(--transition); display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px;}
        .btn-icon:hover { background-color: var(--background); }

        /* Badges */
        .badge { padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 500; display: inline-block; }
        .badge-tech { background-color: #E0F2FE; color: #0284C7; }
        .badge-sport { background-color: #DCFCE7; color: #16A34A; }

        /* ================= LAYOUT ================= */
        .admin-layout { display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar { width: 260px; background: var(--surface); border-right: 1px solid var(--border); padding: 1.5rem 1rem; display: flex; flex-direction: column; gap: 0.5rem; flex-shrink: 0;}
        .sidebar-brand { font-size: 1.25rem; font-weight: 700; color: var(--primary); display: flex; align-items: center; gap: 0.5rem; padding: 0 1rem 1.5rem 1rem; border-bottom: 1px solid var(--border); margin-bottom: 1rem; }
        .sidebar-item { padding: 0.75rem 1rem; border-radius: var(--radius-md); color: var(--text-muted); text-decoration: none; display: flex; align-items: center; gap: 0.75rem; font-weight: 500; transition: var(--transition); cursor: pointer; white-space: nowrap; }
        .sidebar-item:hover, .sidebar-item.active { background-color: #EEF2FF; color: var(--primary); }
        
        /* Main Content */
        .admin-content { flex: 1; padding: 2rem; overflow-x: hidden; display: flex; flex-direction: column; }
        
        /* Table */
        .table-responsive { width: 100%; overflow-x: auto; background: var(--surface); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); border: 1px solid var(--border); }
        table { width: 100%; border-collapse: collapse; min-width: 600px; }
        th, td { padding: 1rem 1.5rem; text-align: left; border-bottom: 1px solid var(--border); }
        th { background-color: #F8FAFC; font-weight: 600; font-size: 0.875rem; color: var(--secondary); text-transform: uppercase; white-space: nowrap; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background-color: #F8FAFC; }

        /* ================= MODAL ================= */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center; z-index: 999; backdrop-filter: blur(4px); opacity: 0; pointer-events: none; transition: 0.3s; }
        .modal-overlay.active { opacity: 1; pointer-events: auto; }
        .modal-box { background: var(--surface); padding: 2rem; border-radius: var(--radius-lg); width: 90%; max-width: 400px; text-align: center; transform: scale(0.9); transition: 0.3s; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
        .modal-overlay.active .modal-box { transform: scale(1); }

       
        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            .admin-layout { flex-direction: column; }
            .sidebar { width: 100%; border-right: none; border-bottom: 1px solid var(--border); padding: 1rem; flex-direction: row; align-items: center; overflow-x: auto; -webkit-overflow-scrolling: touch; }
            .sidebar-brand { border-bottom: none; border-right: 1px solid var(--border); margin-bottom: 0; margin-right: 1rem; padding: 0 1rem 0 0; }
            .sidebar-item { padding: 0.5rem 0.75rem; font-size: 0.875rem; }
            .sidebar-spacer { display: none; }
            .admin-content { padding: 1rem; }
        }

       .admin-card {
        background-color: #FFFFFF;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        padding: 1.5rem 2rem;
        width: 100%; /* KUNCI: Biarkan melebar penuh mengisi sisa ruang di kanan sidebar */
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #E5E7EB;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }

    .admin-header h2 {
        font-size: 1.5rem;
        color: #111827;
        margin: 0;
    }

    .btn-tambah {
        background-color: #4F46E5;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
    }
    
    .btn-tambah:hover {
        background-color: #4338CA;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table th, .admin-table td {
        padding: 1rem 0.5rem;
        text-align: left;
        border-bottom: 1px solid #E5E7EB;
    }

    .admin-table th {
        font-size: 0.875rem;
        color: #6B7280;
        font-weight: 600;
        background-color: #F9FAFB;
    }

    .admin-table td {
        font-size: 0.95rem;
    }

    .admin-table tr:last-child td {
        border-bottom: none;
    }

    .role-badge {
        padding: 0.25rem 0.6rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: bold;
    }

    .role-super { background-color: #EEF2FF; color: #4F46E5; }
    .role-admin { background-color: #F3F4F6; color: #4B5563; }

    .action-link {
        text-decoration: none;
        font-size: 0.875rem;
        margin-right: 10px;
    }

    .text-blue { color: #2563EB; }
    .text-blue:hover { text-decoration: underline; }
    
    .text-red { color: #DC2626; }
    .text-red:hover { text-decoration: underline; }

    .text-muted { color: #6B7280; font-size: 0.875rem; }
        
    </style>
</head>
<body>

    <div class="admin-layout">
    
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <i class="fa-regular fa-newspaper"></i> AMBANEWS
            </div>
            
            <a href="{{ url('/admin/dashboard') }}" style="text-decoration: none;">
                <div class="sidebar-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-table-list"></i> Daftar Artikel
                </div>
            </a>
            
            <a href="{{ url('/admin/new-article') }}" style="text-decoration: none;">
                <div class="sidebar-item ">
                    <i class="fa-solid fa-pen-to-square"></i> Tulis Baru
                </div>
            </a>

            @if (Auth::user()->role === 'superadmin')
                
                <a href="{{ url('/daftar-admin') }}" style="text-decoration: none;">
                    <div class="sidebar-item {{ request()->is('/daftar-admin') ? 'active' : '' }}" >
                        <i class="fa-solid fa-users-gear"></i> Daftar Admin
                    </div>
                </a>
            @endif
            
            
            <div class="sidebar-spacer" style="margin-top: auto;"></div>
            
            <form action="/logout" method="POST">
                 @csrf
                 <div class="sidebar-item">
                 <button type="submit"  style=" color: var(--danger); border: none;" >
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar   
                 </button>
                 </div>
                
            </form>
            
        </aside>

        @yield('content')
        
    </div>

   
   
    
     <!-- Bootstrap 5 JS Bundle (Includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>