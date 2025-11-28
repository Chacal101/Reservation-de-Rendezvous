<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Client</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            --sidebar-width: 280px;
            --text-light: rgba(255, 255, 255, 0.9);
            --text-hover: #ffffff;
            --accent-color: #4cc9f0;
            --header-height: 70px;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg);
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            z-index: 1020;
            overflow-y: auto;
            font-family: 'Poppins', sans-serif;
        }

        .sidebar-header {
            padding: 1rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-title {
            color: var(--text-light);
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            margin: 0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.8rem 1.2rem;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            color: var(--text-light) !important;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.15);
            color: var(--text-hover) !important;
            transform: translateX(5px);
        }

        .sidebar-menu a:hover i,
        .sidebar-menu a.active i {
            color: var(--accent-color);
        }

        .sidebar-menu i {
            width: 24px;
            text-align: center;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        /* Toggle Button */
        .toggle-btn {
            position: fixed;
            top: 1.5rem;
            left: 1.5rem;
            background: var(--accent-color);
            color: #1a2a3a;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            z-index: 1030;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .toggle-btn:hover {
            transform: scale(1.1);
        }

        .toggle-btn i {
            font-size: 1.2rem;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
                box-shadow: 5px 0 25px rgba(0, 0, 0, 0.2);
            }

            .toggle-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .sidebar-menu li {
            animation: fadeIn 0.4s ease forwards;
            opacity: 0;
        }

        .sidebar-menu li:nth-child(1) { animation-delay: 0.1s; }
        .sidebar-menu li:nth-child(2) { animation-delay: 0.2s; }
        .sidebar-menu li:nth-child(3) { animation-delay: 0.3s; }
        .sidebar-menu li:nth-child(4) { animation-delay: 0.4s; }
        .sidebar-menu li:nth-child(5) { animation-delay: 0.5s; }
    </style>
</head>
<body>

<!-- Toggle Button -->
<button class="toggle-btn" id="toggleSidebar">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3 class="sidebar-title">Menu Client</h3>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="<?= site_url('client/vitrine') ?>">
                <i class="fas fa-home"></i>
                <span>Accueil</span>
            </a>
        </li>
        <li>
            <a href="<?= site_url('client/profile') ?>">
                <i class="fas fa-user"></i>
                <span>Mon Profil</span>
            </a>
        </li>
        <li>
            <a href="<?= site_url('client/services') ?>">
                <i class="fas fa-list"></i>
                <span>Nos Services</span>
            </a>
        </li>
        <li>
            <a href="<?= site_url('client/mes_rendezvous') ?>">
                <i class="fas fa-calendar-alt"></i>
                <span>Mes Rendez-vous</span>
            </a>
        </li>
        <li>
            <a href="<?= site_url('client/notification') ?>">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>
    </ul>
</aside>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleBtn = document.getElementById("toggleSidebar");
        const sidebar = document.getElementById("sidebar");

        // Toggle sidebar
        toggleBtn.addEventListener("click", function() {
            sidebar.classList.toggle("show");
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', function(e) {
            if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                sidebar.classList.remove("show");
            }
        });

        // Highlight active menu item
        const currentPage = window.location.pathname.split('/').pop();
        const menuItems = document.querySelectorAll('.sidebar-menu a');
        
        menuItems.forEach(item => {
            if (item.getAttribute('href').includes(currentPage)) {
                item.classList.add('active');
            }
        });
    });
</script>

</body>
</html>