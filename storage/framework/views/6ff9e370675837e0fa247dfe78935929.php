
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Browse Courses | Upskill</title>
<style>
    :root{
        --navy:#13176b;
        --navy-deep:#0c0f4d;
        --gold:#dba617;
        --gold-dark:#c4930f;
        --cyan:#7fe9e3;
        --tag-cat:#38d6cf;
        --tag-level-bg:#f3e2a6;
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
    .nav-pills{display:flex;gap:14px;...}
    .brand h1{font-size:24px;letter-spacing:1px;margin:0;font-weight:800;}
    .brand .logo img{width:100%;height:100%;object-fit:contain;border-radius:50%;padding:3px;}
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
    .side-icon-box svg{width:26px;height:26px;color:#fff;transition:color .15s ease;}
    .side-link.active .side-icon-box svg{color:var(--navy);}

    /* Main */
    .main{padding:32px 36px 60px;}
    .page-head h2{font-size:30px;margin:0 0 6px;color:var(--navy);}
    .page-head p{margin:0 0 24px;color:var(--muted);font-size:15px;}

    /* Filters bar */
    .filters-bar{display:flex;align-items:center;gap:18px;flex-wrap:wrap;margin-bottom:32px;}
    .search-outline{display:flex;align-items:center;gap:10px;background:#fff;border:1.5px solid var(--line);border-radius:10px;padding:12px 16px;flex:1 1 220px;min-width:200px;}
    .search-outline svg{width:18px;height:18px;color:var(--muted);flex-shrink:0;}
    .search-outline input{border:none;outline:none;font-size:15px;width:100%;color:var(--ink);background:transparent;}
    .select-wrap{position:relative;flex:0 0 auto;}
    .select-wrap select{appearance:none;background:#fff;border:1.5px solid var(--line);border-radius:10px;padding:12px 42px 12px 18px;font-weight:700;color:#111;font-size:15px;min-width:170px;cursor:pointer;}
    .select-wrap svg{position:absolute;right:14px;top:50%;transform:translateY(-50%);width:18px;height:18px;color:#111;pointer-events:none;}
    .btn-filter{background:var(--navy);color:#fff;font-weight:800;border:none;border-radius:10px;padding:13px 30px;font-size:15px;flex-shrink:0;}

    /* Course grid */
    .courses-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(380px, 1fr));gap:28px;}
    .browse-card{border:1px solid var(--line);border-radius:20px;overflow:hidden;box-shadow:var(--shadow);background:#fff;display:flex;flex-direction:column;}
    .card-thumb{height:230px;background:var(--gold);background-size:cover;background-position:center;}
    .card-body{padding:20px 22px 24px;}
    .tags{display:flex;gap:10px;margin-bottom:14px;flex-wrap:wrap;}
    .tag{padding:8px 18px;border-radius:999px;font-weight:700;font-size:13px;}
    .tag-category{background:var(--tag-cat);color:#fff;}
    .tag-level{background:var(--tag-level-bg);color:var(--navy);}
    .browse-card h3{margin:0 0 10px;font-size:22px;color:var(--navy);line-height:1.25;}
    .browse-card .desc{margin:0 0 16px;color:var(--muted);font-size:14px;line-height:1.5;}
    .meta{display:flex;align-items:center;gap:18px;color:var(--muted);font-size:14px;flex-wrap:wrap;}
    .meta span{display:flex;align-items:center;gap:6px;}
    .meta svg{width:16px;height:16px;flex-shrink:0;}
    .empty-state{border:1px dashed var(--line);border-radius:16px;padding:40px;text-align:center;color:var(--muted);grid-column:1/-1;}

    @media (max-width:980px){
        .layout{grid-template-columns:1fr;}
        .sidebar{flex-direction:row;overflow-x:auto;position:static;margin:14px;border-radius:16px;}
        .courses-grid{grid-template-columns:1fr;}
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
            <h2>Browse All Courses</h2>
            <p><?php echo e(count($courses)); ?> <?php echo e(count($courses) === 1 ? 'course' : 'courses'); ?> available</p>
        </div>

        
        <form action="<?php echo e(route('courses.browse')); ?>" method="GET" class="filters-bar">
            <div class="search-outline">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
                <input type="text" name="q" placeholder="Search" value="<?php echo e($filters['q'] ?? ''); ?>">
            </div>

            <div class="select-wrap">
                <select name="category">
                    <option value="">All Categories</option>
                    <?php $__currentLoopData = $categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category); ?>" <?php if(($filters['category'] ?? '') === $category): echo 'selected'; endif; ?>><?php echo e($category); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
            </div>

            <div class="select-wrap">
                <select name="level">
                    <option value="">All Levels</option>
                    <?php $__currentLoopData = $levels ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($level); ?>" <?php if(($filters['level'] ?? '') === $level): echo 'selected'; endif; ?>><?php echo e($level); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
            </div>

            <button type="submit" class="btn-filter">Filter</button>
        </form>

        
        <div class="courses-grid">
            <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('courses.show', $course->id)); ?>" class="browse-card">
                    <div class="card-thumb" <?php if($course->thumbnail_url): ?> style="background-image:url('<?php echo e($course->thumbnail_url); ?>')" <?php endif; ?>></div>
                    <div class="card-body">
                        <div class="tags">
                            <?php if($course->category): ?>
                                <span class="tag tag-category"><?php echo e($course->category); ?></span>
                            <?php endif; ?>
                            <?php if($course->level): ?>
                                <span class="tag tag-level"><?php echo e($course->level); ?></span>
                            <?php endif; ?>
                        </div>
                        <h3><?php echo e($course->title); ?></h3>
                        <?php if($course->description): ?>
                            <p class="desc"><?php echo e($course->description); ?></p>
                        <?php endif; ?>
                        <div class="meta">
                            <?php if($course->instructor): ?>
                                <span><?php echo e($course->instructor); ?></span>
                            <?php endif; ?>
                            <?php if($course->duration): ?>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                                    <?php echo e($course->duration); ?>

                                </span>
                            <?php endif; ?>
                            <?php if($course->lessons_count): ?>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                    <?php echo e($course->lessons_count); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-state">
                    No courses match your search right now. Try adjusting your filters.
                </div>
            <?php endif; ?>
        </div>

    </main>
</div>

</body>
</html><?php /**PATH C:\Users\Admin\Herd\Micro-credentials\resources\views/Student_browse_Courses.blade.php ENDPATH**/ ?>