<?= $this->include('layout/main') ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary: #6a4c93;
            --secondary: #f8f9fa;
            --unread: #fff3cd;
            --sidebar-width: 250px;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }
        
        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem 3rem;
            transition: all 0.3s ease;
        }
        
        .notification-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .notification-header {
            color: var(--primary);
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid rgba(106, 76, 147, 0.1);
            position: relative;
        }
        
        .notification-header h2 {
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .notification-list {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }
        
        .notification-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        
        .notification-card.unread {
            border-left-color: var(--primary);
            background-color: var(--unread);
        }
        
        .notification-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.1);
        }
        
        .notification-body {
            padding: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
            align-items: center;
        }
        
        .notification-item {
            display: flex;
            flex-direction: column;
        }
        
        .notification-label {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
            font-weight: 600;
        }
        
        .notification-value {
            font-weight: 500;
            color: #212529;
            word-break: break-word;
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            width: fit-content;
        }
        
        .status-unread {
            background-color: var(--primary);
            color: white;
        }
        
        .status-read {
            background-color: #e9ecef;
            color: #6c757d;
        }
        
        .btn-mark-read {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 0.6rem 1.25rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        
        .btn-mark-read:hover {
            background-color: #5a3d7d;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-top: 2rem;
        }
        
        .empty-state i {
            font-size: 3rem;
            color: #adb5bd;
            margin-bottom: 1.5rem;
        }
        
        .empty-state p {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 0;
        }
        
        .notification-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            justify-content: flex-end;
            grid-column: 1 / -1;
        }
        
        @media (min-width: 992px) {
            .notification-actions {
                grid-column: auto;
                justify-content: center;
            }
        }
        
        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
            
            .notification-body {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .notification-item {
                flex-direction: row;
                justify-content: space-between;
                padding-bottom: 1rem;
                border-bottom: 1px solid #eee;
            }
            
            .notification-item:last-child {
                padding-bottom: 0;
                border-bottom: none;
            }
        }
        
        @media (max-width: 576px) {
            .main-content {
                padding: 1rem;
            }
            
            .notification-header h2 {
                font-size: 1.5rem;
            }
            
            .btn-mark-read {
                width: 100%;
                justify-content: center;
            }
            
            .notification-actions {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <!-- Sidebar sera inclus via layout/main -->
        
        <main class="main-content">
            <div class="notification-container">
                <div class="notification-header">
                    <h2><i class="bi bi-bell-fill"></i> Mes Notifications</h2>
                </div>

                <?php if (!empty($notifications)) : ?>
                    <div class="notification-list">
                        <?php foreach ($notifications as $notif) : ?>
                            <div class="notification-card <?= $notif['statut'] == 'non lu' ? 'unread' : '' ?>">
                                <div class="notification-body">
                                    <div class="notification-item">
                                        <span class="notification-label">Client</span>
                                        <span class="notification-value"><?= esc($notif['nom']) ?></span>
                                    </div>
                                    
                                    <div class="notification-item">
                                        <span class="notification-label">Service</span>
                                        <span class="notification-value"><?= esc($notif['service']) ?></span>
                                    </div>
                                    
                                    <div class="notification-item">
                                        <span class="notification-label">Date</span>
                                        <span class="notification-value"><?= esc($notif['date_rdv']) ?></span>
                                    </div>
                                    
                                    <div class="notification-item">
                                        <span class="notification-label">Heure</span>
                                        <span class="notification-value"><?= esc($notif['heure_debut']) ?></span>
                                    </div>
                                    
                                    <div class="notification-actions">
                                        <span class="status-badge <?= $notif['statut'] == 'non lu' ? 'status-unread' : 'status-read' ?>">
                                            <i class="bi <?= $notif['statut'] == 'non lu' ? 'bi-envelope' : 'bi-envelope-open' ?>"></i>
                                            <?= esc($notif['statut']) ?>
                                        </span>
                                        
                                        <?php if ($notif['statut'] == 'non lu') : ?>
                                            <a href="<?= site_url('admin/marquer_lu/' . $notif['id_notification']) ?>" 
                                               class="btn-mark-read">
                                               <i class="bi bi-check-circle"></i> Marquer comme lu
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="empty-state">
                        <i class="bi bi-bell-slash"></i>
                        <p>Aucune notification pour le moment</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Animation des cartes au chargement
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.notification-card');
            
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = `all 0.4s ease ${index * 0.1}s`;
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            });
        });
    </script>
</body>
</html>