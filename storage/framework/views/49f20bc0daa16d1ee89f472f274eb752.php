
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard | Upskill</title>
<style>
    :root{
        --navy:#13176b;
        --navy-deep:#0c0f4d;
        --gold:#dba617;
        --gold-dark:#c4930f;
        --cyan:#7fe9e3;
        --thumb:#d8e3f8;
        --ink:#13176b;
        --muted:#6b7280;
        --line:#e5e7eb;
        --shadow: 0 10px 25px rgba(19,23,107,0.08);
    }
    *{box-sizing:border-box;}
    body{font-family:"Segoe UI", Roboto, Helvetica, Arial, sans-serif;color:var(--ink);margin:0;background:#fff;}
    a{text-decoration:none;color:inherit;}
    button{font-family:inherit;cursor:pointer;}

    /* Topbar */
    .topbar{background:var(--navy);display:flex;align-items:center;justify-content:space-between;padding:14px 28px;gap:20px;}
    .brand{display:flex;align-items:center;gap:14px;color:#fff;white-space:nowrap;}
    .brand .logo{width:46px;height:46px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
    .brand .logo svg{width:30px;height:30px;}
    .brand .logo img{width:100%;height:100%;object-fit:contain;border-radius:50%;padding:3px;}
    .brand h1{font-size:24px;letter-spacing:1px;margin:0;font-weight:800;}
    .nav-pills{display:flex;gap:8px;flex-wrap:wrap;margin-left:auto;align-items:center;}
    .nav-pills a{background:transparent;color:#fff;font-weight:700;padding:10px 18px;border-radius:10px;font-size:15px;transition:color .15s ease, background-color .15s ease;}
    .nav-pills a:hover{color:var(--gold);}
    .nav-pills a.is-active{color:var(--gold);background:rgba(255,255,255,0.08);}
    .search-box{display:flex;align-items:center;gap:10px;background:#fff;border-radius:999px;padding:10px 18px;min-width:240px;color:var(--muted);}
    .search-box input{border:none;outline:none;font-size:15px;width:100%;color:var(--ink);background:transparent;}
    .icon-cluster{display:flex;align-items:center;gap:14px;}
    .icon-circle{width:42px;height:42px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;overflow:hidden;}
    .icon-circle svg{width:22px;height:22px;color:var(--navy);}

    /* Layout */
    .layout{display:grid;grid-template-columns:264px 1fr;min-height:calc(100vh - 74px);align-items:start;}

    /* Sidebar */
    .sidebar{background:var(--navy);padding:26px 16px;display:flex;flex-direction:column;gap:6px;margin:24px 10px 24px 24px;border-radius:22px;box-shadow:0 16px 34px rgba(19,23,107,0.28);height:fit-content;position:sticky;top:20px;}
    .side-link{display:flex;align-items:center;gap:14px;padding:14px;border-radius:14px;font-weight:700;font-size:16px;color:#fff;transition:color .15s ease;}
    /* hover: text + icon turn gold (non-active links) */
    .side-link:not(.active):hover{color:var(--gold);}
    .side-link:not(.active):hover .side-icon-box svg{color:var(--gold);}
    .side-link svg{width:26px;height:26px;flex-shrink:0;}
    .side-link.active{background:var(--cyan);color:var(--navy);}
    .side-icon-box{width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
    .side-link.active .side-icon-box svg{color:var(--navy);width:26px;height:26px;}
    .side-link:not(.active) .side-icon-box svg{color:#fff;width:26px;height:26px;transition:color .15s ease;}

    /* Main */
    .main{padding:32px 36px 60px;}
    .page-head{display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:16px;margin-bottom:28px;}
    .page-head h2{font-size:30px;margin:0 0 6px;color:var(--navy);}
    .page-head p{margin:0;color:var(--muted);font-size:15px;}
    .btn-outline{background:#fff;border:1.5px solid #c9ccdb;color:#9aa0b4;font-weight:600;padding:12px 24px;border-radius:10px;font-size:15px;}

    /* Stats */
    .stats{display:grid;grid-template-columns:repeat(4,1fr);gap:22px;margin-bottom:36px;}
    .stat-card{border:1px solid var(--line);border-radius:18px;box-shadow:var(--shadow);padding:26px 20px;text-align:center;}
    .stat-top{display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:18px;}
    .stat-top svg{width:46px;height:46px;color:var(--navy);}
    .stat-top .num{font-size:44px;font-weight:800;color:var(--navy);}
    .stat-card .label{font-weight:800;font-size:19px;color:var(--navy);}

    /* Content grid */
    .content-grid{display:grid;grid-template-columns:1fr 360px;gap:28px;}
    .courses-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;}
    .courses-head h3{font-size:24px;margin:0;color:var(--navy);}
    .courses-head .enroll-more{font-weight:700;color:var(--navy);font-size:17px;}

    .course-card{border:1px solid var(--line);border-radius:16px;box-shadow:var(--shadow);padding:18px;display:flex;align-items:center;gap:18px;margin-bottom:20px;}
    .thumb{width:78px;height:78px;border-radius:12px;background:var(--thumb);flex-shrink:0;background-size:cover;background-position:center;}
    .course-info{flex:1;min-width:0;}
    .course-info h4{margin:0 0 4px;font-size:17px;color:var(--navy);}
    .course-info .cat{font-size:13px;color:var(--muted);margin-bottom:8px;}
    .progress-track{flex:1;height:7px;border-radius:999px;background:#e3e6f0;overflow:hidden;}
    .progress-fill{height:100%;background:var(--navy);border-radius:999px;}
    .pct{font-size:12px;color:var(--muted);margin-top:6px;}
    .btn-start{background:#fff;border:1.5px solid var(--navy);color:var(--navy);font-weight:700;padding:10px 22px;border-radius:10px;font-size:15px;flex-shrink:0;}
    .empty-state{border:1px dashed var(--line);border-radius:16px;padding:30px;text-align:center;color:var(--muted);}

    /* Side panels */
    .panel{border:1px solid var(--line);border-radius:18px;box-shadow:var(--shadow);overflow:hidden;margin-bottom:24px;min-height:230px;}
    .panel-head{background:var(--gold);color:var(--navy);font-weight:800;font-size:22px;padding:14px 22px;display:flex;align-items:center;justify-content:space-between;}
    .panel-body{padding:18px 22px;color:var(--muted);font-size:14px;}
    .panel-body ul{margin:0;padding-left:18px;}
    .panel-body li{margin-bottom:8px;}

    @media (max-width:980px){
        .layout{grid-template-columns:1fr;}
        .sidebar{flex-direction:row;overflow-x:auto;position:static;margin:14px;border-radius:16px;}
        .stats{grid-template-columns:repeat(2,1fr);}
        .content-grid{grid-template-columns:1fr;}
    }
</style>
</head>
<body>

<header class="topbar">
    <div class="brand">
        <span class="logo">
            <img src="<?php echo e(asset('images/PSU-Logo.png')); ?>" alt="PSU Logo">
        </span>
        <h1>UPSKILL</h1>
    </div>

    <nav class="nav-pills">
        <a href="<?php echo e(route('courses.index')); ?>" class="<?php echo e(request()->routeIs('courses.*') ? 'is-active' : ''); ?>">Courses</a>
        <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'is-active' : ''); ?>">Dashboard</a>
    </nav>

    <form action="<?php echo e(route('search')); ?>" method="GET" class="search-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
        <input type="text" name="q" placeholder="Search" value="<?php echo e(request('q')); ?>">
    </form>

    <div class="icon-cluster">
        <a href="<?php echo e(route('notifications.index')); ?>" class="icon-circle" title="Notifications">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.7 21a2 2 0 0 1-3.4 0"/></svg>
        </a>
        <a href="<?php echo e(route('profile.show')); ?>"
           class="icon-circle"
           title="<?php echo e($user->name ?? 'Profile'); ?>"
           <?php if($user->avatar_url ?? null): ?>
               style="background-image:url('<?php echo e($user->avatar_url); ?>');background-size:cover;background-position:center;overflow:hidden;"
           <?php endif; ?>>
            <?php if (! ($user->avatar_url ?? null)): ?>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/></svg>
            <?php endif; ?>
        </a>
        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline-flex;align-items:center;">
            <?php echo csrf_field(); ?>
            <button type="submit" style="background:#fff1f2;border:1px solid #fecdd3;color:#b91c1c;border-radius:999px;padding:8px 12px;font-weight:700;cursor:pointer;">Logout</button>
        </form>
    </div>
</header>

<div class="layout">

    
    <aside class="sidebar">
        <a href="<?php echo e(route('dashboard')); ?>" class="side-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
            </span>
            Dashboard
        </a>
        <a href="<?php echo e(route('courses.browse')); ?>" class="side-link <?php echo e(request()->routeIs('courses.browse') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
            </span>
            Browse Courses
        </a>
        <a href="<?php echo e(route('badges.index')); ?>" class="side-link <?php echo e(request()->routeIs('badges.*') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3 6 7 1-5 5 1.5 7L12 17l-6.5 4L7 14 2 9l7-1 3-6z"/></svg>
            </span>
            My Badges
        </a>
        <a href="<?php echo e(route('certificates.index')); ?>" class="side-link <?php echo e(request()->routeIs('certificates.*') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M8 13l-2 8 6-3 6 3-2-8"/></svg>
            </span>
            Certificates
        </a>
        <a href="<?php echo e(route('profile.show')); ?>" class="side-link <?php echo e(request()->routeIs('profile.*') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/></svg>
            </span>
            Profile
        </a>
        <a href="<?php echo e(route('pathways.index')); ?>" class="side-link <?php echo e(request()->routeIs('pathways.*') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="12" r="3"/><path d="M6 9v6"/><path d="M8.5 7.5L15.5 10.5"/><path d="M8.5 16.5L15.5 13.5"/></svg>
            </span>
            My Pathways
        </a>
        <a href="<?php echo e(route('analytics.index')); ?>" class="side-link <?php echo e(request()->routeIs('analytics.*') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><rect x="7" y="13" width="3" height="5"/><rect x="12" y="9" width="3" height="9"/><rect x="17" y="6" width="3" height="12"/></svg>
            </span>
            Analytics
        </a>
    </aside>

    
    <main class="main">

        <div class="page-head">
            <div>
                <h2>Welcome, <?php echo e($user->name ?? 'Student'); ?>!</h2>
                <p>Track your learning journey and continue where you left off.</p>
            </div>
            <a href="<?php echo e(route('courses.browse')); ?>">
                <button class="btn-outline" type="button">Explore Courses</button>
            </a>
        </div>

        
        <section class="stats">
            <div class="stat-card">
                <div class="stat-top">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M6 2h12v20l-6-4-6 4V2z"/></svg>
                    <span class="num"><?php echo e($stats['active_courses'] ?? 0); ?></span>
                </div>
                <div class="label">Active Courses</div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <svg viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="10" fill="var(--navy)"/><path d="M8 12.5l2.5 2.5L16 9.5" stroke="#fff" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="num"><?php echo e($stats['completed'] ?? 0); ?></span>
                </div>
                <div class="label">Completed</div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 3l9 5-9 5-9-5 9-5z"/><path d="M3 13l9 5 9-5" stroke="currentColor" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="num"><?php echo e($stats['badges_earned'] ?? 0); ?></span>
                </div>
                <div class="label">Badges Earned</div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M12 2l3 6 7 1-5 5 1.5 7L12 17l-6.5 4L7 14 2 9l7-1 3-6z" fill="var(--navy)"/><path d="M9 12l2 2 4-4" stroke="#fff" stroke-width="1.8" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="num"><?php echo e($stats['certificates'] ?? 0); ?></span>
                </div>
                <div class="label">Certificates</div>
            </div>
        </section>

        
        <div class="content-grid">

            <section class="courses-col">
                <div class="courses-head">
                    <h3>My Courses</h3>
                    <a href="<?php echo e(route('courses.browse')); ?>" class="enroll-more">+ Enroll More</a>
                </div>

                <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="course-card">
                        <div class="thumb" <?php if($course->thumbnail_url): ?> style="background-image:url('<?php echo e($course->thumbnail_url); ?>')" <?php endif; ?>></div>
                        <div class="course-info">
                            <h4><?php echo e($course->title); ?></h4>
                            <?php if($course->category): ?>
                                <div class="cat"><?php echo e($course->category); ?></div>
                            <?php endif; ?>
                            <div class="progress-track">
                                <div class="progress-fill" style="width:<?php echo e($course->progress_percent ?? 0); ?>%"></div>
                            </div>
                            <div class="pct"><?php echo e($course->progress_percent ?? 0); ?>% Complete</div>
                        </div>
                        <a href="<?php echo e(route('courses.show', $course->id)); ?>">
                            <button class="btn-start" type="button">
                                <?php echo e(($course->progress_percent ?? 0) > 0 ? 'Continue' : 'Start'); ?>

                            </button>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="empty-state">
                        You haven't enrolled in any courses yet.
                        <br>
                        <a href="<?php echo e(route('courses.browse')); ?>" class="enroll-more">Browse courses to get started</a>
                    </div>
                <?php endif; ?>
            </section>

            <aside class="side-col">
                <div class="panel">
                    <div class="panel-head">
                        <span>Progress</span>
                        <a href="<?php echo e(route('analytics.index')); ?>" style="color:inherit;">--&gt;</a>
                    </div>
                    <div class="panel-body">
                        <?php $__empty_1 = true; $__currentLoopData = $progress ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <p><?php echo e($item); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p>No progress activity yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-head">
                        <span>Badges</span>
                    </div>
                    <div class="panel-body">
                        <?php $__empty_1 = true; $__currentLoopData = $badges ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php /** @var object{name:string}|string $badge */ ?>
                            <p><?php echo e($badge->name ?? $badge); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p>No badges earned yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </aside>

        </div>

    </main>
</div>

</body>
</html><?php /**PATH C:\Users\Admin\Herd\Micro-credentials\resources\views/Student_dashboard.blade.php ENDPATH**/ ?>