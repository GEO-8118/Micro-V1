
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Performance Analytics | Upskill</title>
<style>
    :root{
        --navy:#13176b;
        --navy-deep:#0c0f4d;
        --gold:#dba617;
        --gold-dark:#c4930f;
        --cyan:#7fe9e3;
        --green:#15803d;
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
    .side-link svg{width:26px;height:26px;flex-shrink:0;}
    .side-link.active{background:var(--cyan);color:var(--navy);}
    .side-icon-box{width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
    .side-icon-box svg{width:26px;height:26px;color:#fff;transition:color .15s ease;}
    .side-link.active .side-icon-box svg{color:var(--navy);}
    /* hover: text + icon turn gold (non-active links) */
    .side-link:not(.active):hover{color:var(--gold);}
    .side-link:not(.active):hover .side-icon-box svg{color:var(--gold);}

    /* Main */
    .main{padding:32px 36px 60px;}
    .page-head h2{font-size:30px;margin:0 0 6px;color:var(--navy);}
    .page-head p{margin:0 0 28px;color:var(--muted);font-size:15px;}

    /* Stats (shared pattern) */
    .stats{display:grid;grid-template-columns:repeat(4,1fr);gap:22px;margin-bottom:32px;}
    .stat-card{border:1px solid var(--line);border-radius:18px;box-shadow:var(--shadow);padding:26px 20px;text-align:center;}
    .stat-top{display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:18px;}
    .stat-top svg{width:42px;height:42px;color:var(--navy);}
    .stat-top .num{font-size:38px;font-weight:800;color:var(--navy);}
    .stat-card .label{font-weight:800;font-size:17px;color:var(--navy);}

    /* Panels */
    .panel{border:1px solid var(--line);border-radius:18px;box-shadow:var(--shadow);padding:22px 24px;}
    .panel-head-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;}
    .panel-head-row h3{margin:0;color:var(--navy);font-size:18px;}
    .panel-head-row a{color:var(--navy);font-weight:700;font-size:13px;}

    .top-row{display:grid;grid-template-columns:1fr 360px;gap:28px;margin-bottom:28px;align-items:start;}

    /* Active courses list */
    .course-line{display:flex;align-items:center;gap:16px;padding:14px 0;border-top:1px solid var(--line);}
    .course-line:first-of-type{border-top:none;}
    .course-thumb-sm{width:48px;height:48px;border-radius:10px;border:1.5px solid var(--line);background:#fff;flex-shrink:0;background-size:cover;background-position:center;}
    .course-line-info{flex:1;min-width:0;}
    .course-line-info .title{font-weight:700;color:var(--navy);font-size:14px;margin-bottom:2px;}
    .course-line-info .meta{font-size:12px;color:var(--muted);}
    .course-pct-badge{background:#eef1fb;color:var(--navy);font-weight:800;padding:7px 16px;border-radius:999px;font-size:13px;flex-shrink:0;}

    /* Recent badges mini grid */
    .badges-mini-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:8px;}
    .badge-mini-card{border:1px solid var(--line);border-radius:14px;padding:14px 16px;}
    .badge-mini-card .name{font-weight:800;color:var(--navy);font-size:14px;margin-bottom:4px;}
    .badge-mini-card .count{font-size:12px;color:var(--muted);}

    /* Metric panels (enrollment / completion) */
    .metric-row{padding:14px 0;border-top:1px solid var(--line);}
    .metric-row:first-of-type{border-top:none;padding-top:8px;}
    .metric-row .label{font-weight:700;color:var(--green);font-size:14px;margin-bottom:8px;}
    .metric-track{height:6px;border-radius:999px;background:#e3e6f0;overflow:hidden;}
    .metric-fill{height:100%;background:var(--green);border-radius:999px;}

    .bottom-row{display:grid;grid-template-columns:1fr 1fr;gap:28px;}

    .empty-state{color:var(--muted);font-size:14px;}

    @media (max-width:980px){
        .layout{grid-template-columns:1fr;}
        .sidebar{flex-direction:row;overflow-x:auto;position:static;margin:14px;border-radius:16px;}
        .stats{grid-template-columns:repeat(2,1fr);}
        .top-row{grid-template-columns:1fr;}
        .bottom-row{grid-template-columns:1fr;}
        .badges-mini-grid{grid-template-columns:1fr;}
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
        <a href="<?php echo e(route('courses.browse')); ?>" class="<?php echo e(request()->routeIs('courses.*') ? 'is-active' : ''); ?>">Courses</a>
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
            <h2>Performance Analytics</h2>
            <p>Take a look at your progress</p>
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
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6 7 1-5 5 1.5 7L12 17l-6.5 4L7 14 2 9l7-1 3-6z"/></svg>
                    <span class="num"><?php echo e($stats['badges_earned'] ?? 0); ?></span>
                </div>
                <div class="label">Badges earned</div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <svg viewBox="0 0 24 24" fill="none"><path d="M12 2l3 6 7 1-5 5 1.5 7L12 17l-6.5 4L7 14 2 9l7-1 3-6z" fill="var(--navy)"/><path d="M9 12l2 2 4-4" stroke="#fff" stroke-width="1.8" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span class="num"><?php echo e($stats['score_avg'] ?? 0); ?>%</span>
                </div>
                <div class="label">Course Score Avg</div>
            </div>
            <div class="stat-card">
                <div class="stat-top">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                    <span class="num"><?php echo e($stats['hours_enrolled'] ?? 0); ?></span>
                </div>
                <div class="label">Hours Enrolled</div>
            </div>
        </section>

        
        <div class="top-row">

            <div class="panel">
                <div class="panel-head-row">
                    <h3>Active Courses</h3>
                    <a href="<?php echo e(route('courses.browse')); ?>">View All</a>
                </div>
                <?php $__empty_1 = true; $__currentLoopData = ($activeCourses ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php /** @var object{title:string,meta:?string,thumbnail_url:?string,percent:int|float} $course */ ?>
                    <div class="course-line">
                        <div class="course-thumb-sm" <?php if($course->thumbnail_url ?? null): ?> style="background-image:url('<?php echo e($course->thumbnail_url); ?>')" <?php endif; ?>></div>
                        <div class="course-line-info">
                            <div class="title"><?php echo e($course->title); ?></div>
                            <?php if($course->meta ?? null): ?>
                                <div class="meta"><?php echo e($course->meta); ?></div>
                            <?php endif; ?>
                        </div>
                        <span class="course-pct-badge"><?php echo e($course->percent); ?>%</span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="empty-state">No active courses right now.</p>
                <?php endif; ?>
            </div>

            <div class="panel">
                <div class="panel-head-row">
                    <h3>Recent Badges</h3>
                </div>
                <div class="badges-mini-grid">
                    <?php $__empty_1 = true; $__currentLoopData = ($recentBadges ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php /** @var object{name:string,earned_count:int} $badge */ ?>
                        <div class="badge-mini-card">
                            <div class="name"><?php echo e($badge->name); ?></div>
                            <div class="count"><?php echo e($badge->earned_count); ?> Earned</div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="empty-state">No badges earned yet.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        
        <div class="bottom-row">

            <div class="panel">
                <div class="panel-head-row">
                    <h3>Enrollment by Courses</h3>
                </div>
                <?php $__empty_1 = true; $__currentLoopData = ($enrollmentByCourse ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php /** @var object{label:string,value:int|float,percent:int|float} $row */ ?>
                    <div class="metric-row">
                        <div class="label"><?php echo e($row->label); ?> -<?php echo e($row->value); ?></div>
                        <div class="metric-track"><div class="metric-fill" style="width:<?php echo e($row->percent); ?>%"></div></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="empty-state">No enrollment data yet.</p>
                <?php endif; ?>
            </div>

            <div class="panel">
                <div class="panel-head-row">
                    <h3>Completion Rate</h3>
                </div>
                <?php $__empty_1 = true; $__currentLoopData = ($completionRate ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php /** @var object{label:string,value:int|float,percent:int|float} $row */ ?>
                    <div class="metric-row">
                        <div class="label"><?php echo e($row->label); ?> - <?php echo e($row->value); ?>%</div>
                        <div class="metric-track"><div class="metric-fill" style="width:<?php echo e($row->percent); ?>%"></div></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="empty-state">No completion data yet.</p>
                <?php endif; ?>
            </div>

        </div>

    </main>
</div>

</body>
</html><?php /**PATH C:\Users\Admin\Herd\Micro-credentials\resources\views/Student_Analytics.blade.php ENDPATH**/ ?>