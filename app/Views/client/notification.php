<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Notifications</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --sidebar-width: 250px;
            --header-height: 70px;
            --content-padding: 20px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-container {
            display: flex;
            flex: 1;
            padding-top: var(--header-height);
        }

        .sidebar-col {
            width: var(--sidebar-width);
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            position: fixed;
            left: 0;
            top: var(--header-height);
            height: calc(100vh - var(--header-height));
            overflow-y: auto;
            z-index: 100;
            transition: all 0.3s;
        }

        .content-col {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: var(--content-padding);
            background-color: #fff;
            min-height: calc(100vh - var(--header-height));
        }

        .notification-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .notification-header {
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .notification-list {
            list-style: none;
            padding: 0;
        }

        .notification-item {
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-item.unread {
            border-left-color: var(--primary-color);
            background-color: #e9f0ff;
            font-weight: 600;
        }

        .notification-date {
            color: #6c757d;
            font-size: 0.85rem;
            margin-left: 15px;
            white-space: nowrap;
        }

        @media (max-width: 992px) {
            .sidebar-col {
                transform: translateX(-100%);
            }

            .sidebar-col.active {
                transform: translateX(0);
            }

            .content-col {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <?= $this->include('layout/HeaderClient') ?>

    <div class="main-container">
        <div class="sidebar-col">
            <?= $this->include('layout/SidebarClient') ?>
        </div>

        <div class="content-col">
            <div class="notification-container">
                <div class="notification-header">
                    <h3><i class="fas fa-bell me-2"></i>Mes Notifications</h3>
                </div>

                <ul class="notification-list">
                    <?php if (count($notifications) > 0): ?>
                        <?php foreach ($notifications as $notif): ?>
                            <?php
                                $isUnread = $notif['statut'] == 'non_lu';
                                $classe = $isUnread ? 'unread' : '';
                                $service = isset($notif['nom_service']) ? $notif['nom_service'] : 'Service';
                                $date = date('d/m/Y', strtotime($notif['date_notification']));
                                // $heure = date('H:i', strtotime($notif['heure_debut']));
                                $msg = "";

                                if ($notif['message']) {
                                    $msg = $notif['message'];
                                }
                            ?>
                            <li class="notification-item <?= $classe ?>">
                                <div><?= $msg ?></div>
                                <span class="notification-date">
                                    <?= date('d/m/Y H:i', strtotime($notif['date_notification'])) ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-muted">Aucune notification pour le moment.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script sr
