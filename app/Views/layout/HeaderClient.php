<?php $session = session(); ?>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --header-bg: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
        --text-light: #ffffff;
        --text-hover: #f8f9fa;
        --accent-color: #4cc9f0;
        --header-height: 70px;
    }
    
    .client-header {
        background: var(--header-bg);
        color: var(--text-light);
        height: var(--header-height);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
        padding: 0 1rem;
    }
    
    .header-container {
        max-width: 100%;
        height: 100%;
        margin: 0 auto;
    }
    
    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
    }
    
    .logo {
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: var(--text-light) !important;
        transition: all 0.3s ease;
    }
    
    .logo:hover {
        color: var(--accent-color) !important;
        transform: translateY(-2px);
    }
    
    .search-form {
        flex-grow: 1;
        max-width: 500px;
        margin: 0 2rem;
    }
    
    .search-input {
        border-radius: 50px !important;
        border: 2px solid rgba(255, 255, 255, 0.2);
        background-color: rgba(255, 255, 255, 0.1) !important;
        color: white !important;
        padding: 0.5rem 1.25rem;
        transition: all 0.3s ease;
    }
    
    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.7) !important;
    }
    
    .search-input:focus {
        background-color: rgba(255, 255, 255, 0.2) !important;
        border-color: var(--accent-color) !important;
        box-shadow: 0 0 0 0.25rem rgba(76, 201, 240, 0.25) !important;
    }
    
    .search-btn {
        border-radius: 50px !important;
        background-color: var(--accent-color) !important;
        color: #1a2a3a !important;
        font-weight: 500;
        border: none;
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
    }
    
    .search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .auth-btn {
        border-radius: 50px !important;
        font-weight: 500;
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .auth-btn i {
        font-size: 1.1rem;
    }
    
    .mobile-search-btn {
        display: none;
        background: none;
        border: none;
        color: var(--text-light);
        font-size: 1.25rem;
        padding: 0.5rem;
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    .mobile-search-btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .mobile-search-container {
        display: none;
        padding: 1rem;
        background-color: rgba(0, 0, 0, 0.1);
        border-radius: 0 0 10px 10px;
    }
    
    @media (max-width: 992px) {
        .search-form {
            display: none;
        }
        
        .mobile-search-btn {
            display: block;
        }
        
        .logo {
            font-size: 1.3rem;
        }
        
        .auth-btn {
            padding: 0.4rem 1rem;
            font-size: 0.9rem;
        }
    }
    
    @media (max-width: 576px) {
        .auth-btn span {
            display: none;
        }
        
        .auth-btn i {
            margin-right: 0;
        }
    }
    
    /* Correction pour le contenu sous le header */
    body {
        padding-top: var(--header-height);
    }
</style>

<header class="client-header">
    <div class="header-container">
        <div class="header-content">
            <!-- Logo -->
            <a href="<?= site_url('client') ?>" class="logo">
                RANDEVWEB
            </a>

            <!-- Formulaire de recherche desktop -->
            <form action="<?= site_url('client/recherche') ?>" method="GET" class="search-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control search-input" placeholder="Rechercher un service..." required>
                    <button type="submit" class="btn search-btn">
                        <i class="bi bi-search"></i> <span class="d-none d-sm-inline"></span>
                    </button>
                </div>
            </form>

            <!-- Boutons d'authentification -->
            <div class="d-flex align-items-center">
                <?php if ($session->has('client_nom')) : ?>
                    <a href="<?= site_url('client/logout') ?>" class="btn btn-danger auth-btn">
                        <i class="bi bi-box-arrow-right"></i> <span><?= esc($session->get('client_nom')) ?></span>
                    </a>
                <?php else : ?>
                    <a href="<?= site_url('client/login') ?>" class="btn btn-success auth-btn">
                        <i class="bi bi-person"></i> <span>Connexion</span>
                    </a>
                <?php endif; ?>

                <!-- Bouton recherche mobile -->
                <button class="mobile-search-btn ms-2" id="toggleSearch">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <!-- Formulaire de recherche mobile -->
        <div id="mobileSearch" class="mobile-search-container">
            <form action="<?= site_url('client/recherche') ?>" method="GET" class="d-flex">
                <input type="text" name="q" class="form-control search-input me-2" placeholder="Rechercher un service..." required>
                <button type="submit" class="btn search-btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>
</header>

<script>
    // Toggle mobile search
    document.getElementById("toggleSearch").addEventListener("click", function() {
        const searchBox = document.getElementById("mobileSearch");
        searchBox.style.display = searchBox.style.display === "block" ? "none" : "block";
        
        // Animation
        if (searchBox.style.display === "block") {
            searchBox.style.animation = "fadeInDown 0.3s ease-out";
        }
    });
    
    // Close mobile search when clicking outside
    document.addEventListener('click', function(e) {
        const searchBox = document.getElementById("mobileSearch");
        const toggleBtn = document.getElementById("toggleSearch");
        
        if (searchBox.style.display === "block" && 
            !e.target.closest('#mobileSearch') && 
            !e.target.closest('#toggleSearch')) {
            searchBox.style.display = "none";
        }
    });
    
    // Add animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);
</script>