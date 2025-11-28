<!-- Bouton toggle pour mobile (à placer dans votre header) -->
<button class="sidebar-toggle d-lg-none btn btn-primary position-fixed" style="left: 10px; top: 10px; z-index: 1050;">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Logo et titre -->
    <div class="sidebar-header text-center py-3">
        <h4>Gestion <br><b style="color: #dc3545;">Rendez-vous</b></h4>
    </div>
    
    <!-- Menu principal -->
    <div class="sidebar-menu">
        <a href="<?= base_url('admin/dashboard') ?>" class="sidebar-link d-block py-2 px-3 my-1">
            <i class="fa-solid fa-gauge-high me-2"></i> Tableau de Bord
        </a>
        <a href="<?= base_url('admin/notifications') ?>" class="sidebar-link d-block py-2 px-3 my-1">
            <i class="fa-solid fa-bell me-2"></i> Notifications
        </a>    
        <a href="<?= base_url('calendar_view') ?>" class="sidebar-link d-block py-2 px-3 my-1">
            <i class="fa-solid fa-calendar-days me-2"></i> Calendrier Employer
        </a>
        <a href="<?= base_url('admin/tacheadmin') ?>" class="sidebar-link d-block py-2 px-3 my-1">
            <i class="fa-solid fa-clipboard-check me-2"></i> Tâches Admin
        </a>
        <a href="<?= base_url('employes') ?>" class="sidebar-link d-block py-2 px-3 my-1">
            <i class="fa-solid fa-users-gear me-2"></i> Employer
        </a>
        <a href="<?= base_url('services') ?>" class="sidebar-link d-block py-2 px-3 my-1">
            <i class="fa-solid fa-screwdriver-wrench me-2"></i> Service
        </a>
    </div>
    
    <!-- Bouton de déconnexion en bas -->
    <div class="sidebar-footer mt-auto">
        <form action="<?= base_url('admin/logout') ?>" method="POST" class="px-3 py-4">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-danger w-100">
                <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
            </button>
        </form>
    </div>
</div>

<style>
    .sidebar {
        display: flex;
        flex-direction: column;
        height: 100vh;
        background: linear-gradient(to bottom, #2c3e50, #1a2a3a);
        color: white;
        width: 250px;
        position: fixed;
        left: 0;
        top: 0;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        z-index: 1040;
    }
    
    /* Style pour mobile */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
        }
        
        .sidebar.show {
            transform: translateX(0);
        }
        
        /* Overlay lorsque la sidebar est ouverte */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1039;
            display: none;
        }
        
        .sidebar-overlay.show {
            display: block;
        }
    }
    
    .sidebar-header {
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    
    .sidebar-menu {
        flex-grow: 1;
        padding: 1rem 0;
    }
    
    .sidebar-link {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }
    
    .sidebar-link:hover {
        color: white;
        background: rgba(255,255,255,0.1);
        border-left: 3px solid #dc3545;
    }
    
    .sidebar-link i {
        width: 20px;
        text-align: center;
    }
    
    .sidebar-footer {
        border-top: 1px solid rgba(255,255,255,0.1);
    }
    
    .btn-logout {
        background: rgba(220, 53, 69, 0.2);
        border: none;
        color: rgba(255,255,255,0.8);
        transition: all 0.3s ease;
    }
    
    .btn-logout:hover {
        background: rgba(220, 53, 69, 0.4);
        color: white;
    }
</style>

<!-- Overlay pour fermer la sidebar (mobile) -->
<div class="sidebar-overlay"></div>

<!-- JavaScript pour le toggle -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');
    
    // Toggle sidebar
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('show');
        sidebarOverlay.classList.toggle('show');
    });
    
    // Fermer sidebar en cliquant sur l'overlay
    sidebarOverlay.addEventListener('click', function() {
        sidebar.classList.remove('show');
        sidebarOverlay.classList.remove('show');
    });
    
    // Fermer sidebar si on clique sur un lien (optionnel)
    document.querySelectorAll('.sidebar-link').forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth < 992) {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            }
        });
    });
});
</script>