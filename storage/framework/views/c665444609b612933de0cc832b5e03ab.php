<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications | UPSKILL</title>
    <style>
        :root {
            --navy: #13176b;
            --navy-deep: #0c0f4d;
            --gold: #dba617;
            --cyan: #7fe9e3;
            --line: #e5e7eb;
            --muted: #6b7280;
            --bg: #f7f8fc;
            --white: #ffffff;
            --red: #ef4444;
            --shadow: 0 12px 30px rgba(19, 23, 107, 0.08);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
            color: var(--navy);
            background: linear-gradient(135deg, #f8faff 0%, var(--bg) 100%);
        }
        a { text-decoration: none; color: inherit; }
        button { font: inherit; cursor: pointer; }

        .topbar {
            background: var(--navy);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 28px;
            gap: 20px;
        }
        .brand { display: flex; align-items: center; gap: 14px; }
        .brand .logo {
            width: 46px; height: 46px; border-radius: 50%; background: #fff;
            display: flex; align-items: center; justify-content: center; overflow: hidden;
        }
        .brand .logo img { width: 100%; height: 100%; object-fit: contain; padding: 4px; }
        .brand h1 { margin: 0; font-size: 24px; letter-spacing: 1px; }
        .nav-pills { display: flex; gap: 8px; flex-wrap: wrap; margin-left: auto; }
        .nav-pills a {
            color: #fff; font-weight: 700; padding: 10px 16px; border-radius: 10px;
            transition: background-color .2s ease, color .2s ease;
        }
        .nav-pills a:hover, .nav-pills a.is-active {
            background: rgba(255,255,255,0.13); color: var(--gold);
        }

        .page {
            max-width: 1500px;
            margin: 0 auto;
            padding: 40px 36px 64px;
        }
        .hero {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: var(--shadow);
            padding: 24px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        .hero h2 { margin: 0 0 6px; font-size: 28px; }
        .hero p { margin: 0; color: var(--muted); }
        .hero-badges { display: flex; gap: 10px; flex-wrap: wrap; }
        .pill {
            background: #f3f6ff; color: var(--navy); border: 1px solid #dfe8ff;
            padding: 8px 14px; border-radius: 999px; font-size: 13px; font-weight: 700;
        }
        .pill strong { margin-right: 4px; }

        .content-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 32px;
            align-items: start;
        }
        .sidebar-card, .list-card {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 22px;
            box-shadow: var(--shadow);
        }
        .sidebar-card { padding: 24px; }
        .sidebar-card h3 { margin: 0 0 14px; font-size: 18px; }
        .filter-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 0; border-bottom: 1px solid var(--line); color: var(--muted);
            font-size: 14px; font-weight: 600;
        }
        .filter-item:last-child { border-bottom: none; }
        .filter-item.active { color: var(--navy); }
        .filter-item .count {
            background: #eef2ff; color: var(--navy); padding: 4px 8px; border-radius: 999px; font-size: 12px;
        }

        .list-card { padding: 28px; }
        .list-card-head {
            display: flex; justify-content: space-between; align-items: center; gap: 10px;
            margin-bottom: 16px;
        }
        .list-card-head h3 { margin: 0; font-size: 18px; }
        .list-card-head button {
            border: 1px solid var(--line); background: #fff; color: var(--navy); padding: 8px 14px; border-radius: 999px; font-weight: 700;
        }
        .notif-item {
            display: flex; gap: 14px; align-items: flex-start; padding: 16px 0; border-bottom: 1px solid var(--line);
        }
        .notif-item:last-child { border-bottom: none; }
        .notif-icon {
            width: 44px; height: 44px; border-radius: 14px; background: linear-gradient(135deg, #eef4ff 0%, #dbeafe 100%);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .notif-icon svg { width: 22px; height: 22px; color: var(--navy); }
        .notif-item.unread { background: #f9fbff; border-radius: 16px; padding-left: 8px; padding-right: 8px; }
        .notif-title { display: flex; align-items: center; gap: 8px; margin-bottom: 4px; }
        .notif-title strong { font-size: 15px; }
        .unread-dot {
            width: 8px; height: 8px; border-radius: 50%; background: var(--red);
            display: inline-block;
        }
        .notif-meta { font-size: 13px; color: var(--muted); margin-top: 4px; }
        .notif-action {
            margin-left: auto; color: var(--navy); font-size: 13px; font-weight: 700; white-space: nowrap;
        }

        @media (max-width: 900px) {
            .content-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<header class="topbar">
    <div class="brand">
        <span class="logo">
            <img src="<?php echo e(asset('Images/PSU-Logo.png')); ?>" alt="PSU Logo">
        </span>
        <h1>UPSKILL</h1>
    </div>
    <nav class="nav-pills">
        <a href="<?php echo e(route('courses.browse')); ?>">Courses</a>
        <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
    </nav>
</header>

<main class="page">
    <section class="hero">
        <div>
            <h2>Notifications</h2>
            <p>Stay up to date with course updates, deadlines, and announcements.</p>
        </div>
        <div class="hero-badges">
            <span class="pill"><strong>3</strong>Unread</span>
            <span class="pill"><strong>12</strong>Today</span>
            <span class="pill"><strong>24</strong>Total</span>
        </div>
    </section>

    <div class="content-grid">
        <aside class="sidebar-card">
            <h3>Filter</h3>
            <div class="filter-item active">All notifications <span class="count">24</span></div>
            <div class="filter-item">Unread <span class="count">3</span></div>
            <div class="filter-item">Courses <span class="count">9</span></div>
            <div class="filter-item">Announcements <span class="count">6</span></div>
            <div class="filter-item">System <span class="count">6</span></div>
        </aside>

        <section class="list-card">
            <div class="list-card-head">
                <h3>Recent updates</h3>
                <button type="button">Mark all as read</button>
            </div>

            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="notif-item <?php echo e($notification->unread ? 'unread' : ''); ?>">
                    <div class="notif-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <?php if($notification->type === 'course'): ?>
                                <path d="M5 4h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1z"/>
                                <path d="M8 8h8"/><path d="M8 12h5"/>
                            <?php elseif($notification->type === 'announcement'): ?>
                                <path d="M5 5h14v10H8l-3 3V5z"/>
                            <?php else: ?>
                                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.7 21a2 2 0 0 1-3.4 0"/>
                            <?php endif; ?>
                        </svg>
                    </div>
                    <div style="flex:1; min-width:0;">
                        <div class="notif-title">
                            <strong><?php echo e($notification->title); ?></strong>
                            <?php if($notification->unread): ?>
                                <span class="unread-dot" aria-hidden="true"></span>
                            <?php endif; ?>
                        </div>
                        <div style="color:#4b5563; font-size:14px; line-height:1.5;"><?php echo e($notification->message); ?></div>
                        <div class="notif-meta"><?php echo e($notification->time); ?> · <?php echo e(ucfirst($notification->type)); ?></div>
                    </div>
                    <a href="#" class="notif-action">View</a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </section>
    </div>
</main>
</body>
</html>
<?php /**PATH C:\Users\Admin\Herd\Micro-credentials\resources\views/notifications.blade.php ENDPATH**/ ?>