
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo e($course->title ?? 'Course'); ?> | Upskill</title>
<style>
    :root{
        --navy:#13176b;
        --navy-deep:#0c0f4d;
        --gold:#dba617;
        --gold-dark:#c4930f;
        --gold-bg:#f5c518;
        --cyan:#7fe9e3;
        --tag-cat:#38d6cf;
        --tag-level-bg:#f3e2a6;
        --tag-feat-bg:#c8e6c9;
        --tag-feat:#2e7d32;
        --thumb:#d8e3f8;
        --ink:#13176b;
        --muted:#6b7280;
        --line:#e5e7eb;
        --shadow:0 10px 25px rgba(19,23,107,0.08);
        --card-shadow:0 4px 18px rgba(19,23,107,0.10);
    }
    *{box-sizing:border-box;}
    body{font-family:"Segoe UI",Roboto,Helvetica,Arial,sans-serif;color:var(--ink);margin:0;background:#f8f9fb;}
    a{text-decoration:none;color:inherit;}
    button{font-family:inherit;cursor:pointer;}

    /* ── Topbar ─────────────────────────────────────────── */
    .topbar{background:var(--navy);display:flex;align-items:center;justify-content:space-between;padding:14px 28px;gap:20px;}
    .brand{display:flex;align-items:center;gap:14px;color:#fff;white-space:nowrap;}
    .brand .logo{width:46px;height:46px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
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

    /* ── Page layout ─────────────────────────────────────── */
    .layout{display:grid;grid-template-columns:264px 1fr;min-height:calc(100vh - 74px);align-items:start;}

    /* ── Sidebar ─────────────────────────────────────────── */
    .sidebar{background:var(--navy);padding:26px 16px;display:flex;flex-direction:column;gap:6px;margin:24px 10px 24px 24px;border-radius:22px;box-shadow:0 16px 34px rgba(19,23,107,0.28);height:fit-content;position:sticky;top:20px;}
    .side-link{display:flex;align-items:center;gap:14px;padding:14px;border-radius:14px;font-weight:700;font-size:16px;color:#fff;transition:color .15s ease;}
    /* hover: text + icon turn gold (non-active links) */
    .side-link:not(.active):hover{color:var(--gold);}
    .side-link:not(.active):hover .side-icon-box svg{color:var(--gold);}
    .side-icon-box{width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
    .side-link.active{background:var(--cyan);color:var(--navy);}
    .side-link:not(.active) .side-icon-box svg{color:#fff;width:26px;height:26px;transition:color .15s ease;}
    .side-link.active .side-icon-box svg{color:var(--navy);width:26px;height:26px;}

    /* ── Main wrapper ────────────────────────────────────── */
    .main{padding:0 0 60px;}

    /* ── Back link ───────────────────────────────────────── */
    .breadcrumb{padding:22px 36px 0;display:flex;align-items:center;gap:8px;font-size:14px;font-weight:700;color:var(--navy);}
    .breadcrumb svg{width:16px;height:16px;}

    /* ── Hero banner (gold) ───────────────────────────────── */
    .hero{background:var(--gold);padding:32px 36px 36px;display:grid;grid-template-columns:1fr 340px;gap:36px;align-items:start;}
    .hero-left{}
    .hero-tags{display:flex;gap:10px;margin-bottom:18px;flex-wrap:wrap;}
    .tag{padding:7px 18px;border-radius:999px;font-weight:700;font-size:13px;}
    .tag-cat{background:var(--tag-cat);color:#fff;}
    .tag-level{background:var(--tag-level-bg);color:var(--navy);}
    .tag-feat{background:#fff;color:var(--navy);}
    .hero-title{font-size:30px;font-weight:800;color:var(--navy);margin:0 0 10px;line-height:1.25;}
    .hero-desc{font-size:14px;color:var(--navy-deep);margin:0 0 22px;line-height:1.5;opacity:.85;}
    .skills-label{font-size:13px;font-weight:800;color:var(--navy);text-transform:uppercase;letter-spacing:.08em;margin-bottom:10px;}
    .skill-tags{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:24px;}
    .skill-tag{background:var(--navy);color:#fff;padding:8px 20px;border-radius:8px;font-weight:700;font-size:14px;}
    .hero-meta{display:flex;align-items:center;gap:22px;font-size:14px;font-weight:600;color:var(--navy);flex-wrap:wrap;}
    .hero-meta span{display:flex;align-items:center;gap:6px;}
    .hero-meta svg{width:16px;height:16px;}

    /* ── Enroll card (right) ─────────────────────────────── */
    .enroll-card{background:#fff;border-radius:20px;box-shadow:var(--card-shadow);overflow:hidden;position:sticky;top:20px;}
    .enroll-thumb{height:200px;background:var(--thumb);background-size:cover;background-position:center;}
    .enroll-body{padding:22px 24px;}
    .progress-label{display:flex;justify-content:space-between;align-items:center;font-size:14px;font-weight:700;color:var(--navy);margin-bottom:8px;}
    .progress-track{width:100%;height:8px;background:#e3e6f0;border-radius:999px;overflow:hidden;margin-bottom:20px;}
    .progress-fill{height:100%;background:var(--navy);border-radius:999px;transition:width .3s;}
    .enroll-form{display:block;width:100%;margin:0 0 18px;}
    .btn-enroll{display:block;width:100%;background:var(--navy);color:#fff;font-weight:800;font-size:16px;padding:15px;border:none;border-radius:12px;text-align:center;cursor:pointer;letter-spacing:.3px;}
    .btn-enroll:hover{background:var(--navy-deep);}
    .btn-continue{display:block;width:100%;background:var(--gold);color:var(--navy);font-weight:800;font-size:16px;padding:15px;border:none;border-radius:12px;text-align:center;margin-bottom:18px;cursor:pointer;}
    .enroll-perks{display:flex;flex-direction:column;gap:10px;}
    .perk{display:flex;align-items:center;gap:10px;font-size:14px;font-weight:700;color:var(--navy);}
    .perk svg{width:18px;height:18px;color:var(--gold-dark);flex-shrink:0;}

    /* ── Body section ────────────────────────────────────── */
    .body-section{padding:32px 36px 0;}
    .panels-row{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:32px;}

    /* ── Info panels ─────────────────────────────────────── */
    .info-panel{background:#fff;border-radius:18px;box-shadow:var(--shadow);overflow:hidden;}
    .info-panel-head{background:var(--gold);padding:14px 22px;font-size:18px;font-weight:800;color:var(--navy);}
    .info-panel-body{padding:20px 24px;}
    .objectives-list{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:10px;}
    .objectives-list li{display:flex;align-items:flex-start;gap:10px;font-size:14px;color:var(--ink);line-height:1.4;}
    .objectives-list li svg{width:18px;height:18px;color:var(--navy);flex-shrink:0;margin-top:1px;}
    .instructor-wrap{display:flex;align-items:center;gap:14px;margin-bottom:14px;}
    .instructor-avatar{width:52px;height:52px;border-radius:50%;background:var(--thumb);flex-shrink:0;background-size:cover;background-position:center;}
    .instructor-name{font-weight:800;font-size:16px;color:var(--navy);margin:0 0 2px;}
    .instructor-dept{font-size:13px;color:var(--muted);}
    .instructor-bio{font-size:14px;color:var(--muted);line-height:1.5;margin:0;}

    /* ── Modules section ─────────────────────────────────── */
    .modules-section{background:#fff;border-radius:18px;box-shadow:var(--shadow);overflow:hidden;margin-bottom:32px;}
    .modules-head{padding:18px 24px;border-bottom:1px solid var(--line);}
    .modules-head h3{margin:0;font-size:20px;color:var(--navy);}
    .module-item{display:flex;align-items:center;gap:16px;padding:18px 24px;border-bottom:1px solid var(--line);transition:background .15s;}
    .module-item:last-child{border-bottom:none;}
    .module-item:hover{background:#f8f9fb;}
    .module-check{width:36px;height:36px;border-radius:8px;background:var(--thumb);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
    .module-check svg{width:20px;height:20px;color:var(--navy);}
    .module-info{flex:1;min-width:0;}
    .module-title{font-weight:700;font-size:15px;color:var(--navy);margin:0 0 3px;}
    .module-sub{font-size:13px;color:var(--muted);}
    .module-meta{display:flex;align-items:center;gap:14px;flex-shrink:0;}
    .module-type{font-size:13px;font-weight:600;color:var(--muted);}
    .module-duration{font-size:13px;font-weight:600;color:var(--muted);}
    .module-chevron{width:20px;height:20px;color:var(--muted);}

    /* ── Quiz section ────────────────────────────────────── */
    .quiz-section{background:#fff;border-radius:18px;box-shadow:var(--shadow);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;gap:16px;}
    .quiz-info{}
    .quiz-title{font-weight:800;font-size:16px;color:var(--navy);margin:0 0 4px;}
    .quiz-sub{font-size:13px;color:var(--muted);}
    .btn-quiz{background:var(--navy);color:#fff;font-weight:700;font-size:14px;padding:10px 24px;border:none;border-radius:10px;}
    .btn-quiz:hover{background:var(--navy-deep);}

    /* ── Responsive ──────────────────────────────────────── */
    @media (max-width:1100px){
        .hero{grid-template-columns:1fr;gap:24px;}
        .enroll-card{position:static;}
        .panels-row{grid-template-columns:1fr;}
    }
    @media (max-width:980px){
        .layout{grid-template-columns:1fr;}
        .sidebar{flex-direction:row;overflow-x:auto;position:static;margin:14px;border-radius:16px;}
    }
    @media (max-width:640px){
        .hero{padding:24px 18px;}
        .body-section{padding:20px 18px 0;}
        .breadcrumb{padding:16px 18px 0;}
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
        <a href="<?php echo e(route('dashboard')); ?>"      class="<?php echo e(request()->routeIs('dashboard') ? 'is-active' : ''); ?>">Dashboard</a>
    </nav>

    <form action="<?php echo e(route('search')); ?>" method="GET" class="search-box">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
            <circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>
        </svg>
        <input type="text" name="q" placeholder="Search" value="<?php echo e(request('q')); ?>">
    </form>

    <div class="icon-cluster">
        <a href="<?php echo e(route('notifications.index')); ?>" class="icon-circle" title="Notifications">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.7 21a2 2 0 0 1-3.4 0"/>
            </svg>
        </a>
        <a href="<?php echo e(route('profile.show')); ?>"
           class="icon-circle"
           title="<?php echo e($user->name ?? 'Profile'); ?>"
           <?php if($user->avatar_url ?? null): ?>
               style="background-image:url('<?php echo e($user->avatar_url); ?>');background-size:cover;background-position:center;overflow:hidden;"
           <?php endif; ?>>
            <?php if (! ($user->avatar_url ?? null)): ?>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/>
                </svg>
            <?php endif; ?>
        </a>
    </div>
</header>


<div class="layout">

    
    <aside class="sidebar">
        <a href="<?php echo e(route('dashboard')); ?>" class="side-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="9" rx="1"/>
                    <rect x="14" y="3" width="7" height="5" rx="1"/>
                    <rect x="14" y="12" width="7" height="9" rx="1"/>
                    <rect x="3" y="16" width="7" height="5" rx="1"/>
                </svg>
            </span>
            Dashboard
        </a>
        <a href="<?php echo e(route('courses.browse')); ?>" class="side-link <?php echo e(request()->routeIs('courses.*') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                </svg>
            </span>
            Browse Courses
        </a>
        <a href="<?php echo e(route('badges.index')); ?>" class="side-link <?php echo e(request()->routeIs('badges.*') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2l3 6 7 1-5 5 1.5 7L12 17l-6.5 4L7 14 2 9l7-1 3-6z"/>
                </svg>
            </span>
            My Badges
        </a>
        <a href="<?php echo e(route('certificates.index')); ?>" class="side-link <?php echo e(request()->routeIs('certificates.*') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="5"/>
                    <path d="M8 13l-2 8 6-3 6 3-2-8"/>
                </svg>
            </span>
            Certificates
        </a>
        <a href="<?php echo e(route('profile.show')); ?>" class="side-link <?php echo e(request()->routeIs('profile.*') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/>
                </svg>
            </span>
            Profile
        </a>
        <a href="<?php echo e(route('pathways.index')); ?>" class="side-link <?php echo e(request()->routeIs('pathways.*') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="6" cy="6" r="3"/>
                    <circle cx="6" cy="18" r="3"/>
                    <circle cx="18" cy="12" r="3"/>
                    <path d="M6 9v6"/>
                    <path d="M8.5 7.5L15.5 10.5"/>
                    <path d="M8.5 16.5L15.5 13.5"/>
                </svg>
            </span>
            My Pathways
        </a>
        <a href="<?php echo e(route('analytics.index')); ?>" class="side-link <?php echo e(request()->routeIs('analytics.*') ? 'active' : ''); ?>">
            <span class="side-icon-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 3v18h18"/>
                    <rect x="7"  y="13" width="3" height="5"/>
                    <rect x="12" y="9"  width="3" height="9"/>
                    <rect x="17" y="6"  width="3" height="12"/>
                </svg>
            </span>
            Analytics
        </a>
    </aside>

    
    <main class="main">

        
        <div class="breadcrumb">
            <a href="<?php echo e(route('courses.browse')); ?>" style="display:flex;align-items:center;gap:6px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
                Back to Browse
            </a>
        </div>

        
        <section class="hero">

            
            <div class="hero-left">
                
                <div class="hero-tags">
                    <?php if($course->category): ?>
                        <span class="tag tag-cat"><?php echo e($course->category); ?></span>
                    <?php endif; ?>
                    <?php if($course->level): ?>
                        <span class="tag tag-level"><?php echo e($course->level); ?></span>
                    <?php endif; ?>
                    <?php if($course->is_featured ?? false): ?>
                        <span class="tag tag-feat">Featured</span>
                    <?php endif; ?>
                </div>

                
                <h1 class="hero-title"><?php echo e($course->title); ?></h1>
                <?php if($course->description): ?>
                    <p class="hero-desc"><?php echo e($course->description); ?></p>
                <?php endif; ?>

                
                <?php if(!empty($course->skills)): ?>
                    <div class="skills-label">Skills You'll Gain</div>
                    <div class="skill-tags">
                        <?php $__currentLoopData = $course->skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="skill-tag"><?php echo e($skill); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                
                <div class="hero-meta">
                    <?php if($course->instructor): ?>
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/>
                            </svg>
                            <?php echo e($course->instructor); ?>

                        </span>
                    <?php endif; ?>
                    <?php if($course->duration): ?>
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 3"/>
                            </svg>
                            <?php echo e($course->duration); ?>

                        </span>
                    <?php endif; ?>
                    <?php if($course->lessons_count): ?>
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="3" width="20" height="14" rx="2"/>
                                <path d="M8 21h8M12 17v4"/>
                            </svg>
                            <?php echo e($course->lessons_count); ?> <?php echo e(Str::plural('Module', $course->lessons_count)); ?>

                        </span>
                    <?php endif; ?>
                    <?php if($course->enrolled_count ?? false): ?>
                        <span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            <?php echo e($course->enrolled_count); ?> Enrolled
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="enroll-card">
                <div class="enroll-thumb"
                     <?php if($course->thumbnail_url): ?>
                         style="background-image:url('<?php echo e($course->thumbnail_url); ?>')"
                     <?php endif; ?>>
                </div>
                <div class="enroll-body">
                    <div class="progress-label">
                        <span>Your Progress</span>
                        <span><?php echo e($progress_percent ?? 0); ?>%</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" style="width:<?php echo e($progress_percent ?? 0); ?>%"></div>
                    </div>

                    <?php if($is_enrolled ?? false): ?>
                        <a href="<?php echo e(route('courses.learn', $course->id)); ?>" class="btn-continue">
                            <?php echo e(($progress_percent ?? 0) > 0 ? 'Continue Learning' : 'Start Course'); ?>

                        </a>
                    <?php else: ?>
                        <form action="<?php echo e(route('courses.enroll', $course->id)); ?>" method="POST" class="enroll-form">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-enroll">Enroll Now</button>
                        </form>
                    <?php endif; ?>

                    <div class="enroll-perks">
                        <div class="perk">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="8" r="5"/>
                                <path d="M8 13l-2 8 6-3 6 3-2-8"/>
                            </svg>
                            Earn Digital Certificates!
                        </div>
                        <div class="perk">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2l3 6 7 1-5 5 1.5 7L12 17l-6.5 4L7 14 2 9l7-1 3-6z"/>
                            </svg>
                            Digital Badges
                        </div>
                        <?php if($course->passing_score ?? false): ?>
                            <div class="perk">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 12l2 2 4-4"/>
                                    <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2z"/>
                                </svg>
                                Passing Score: <?php echo e($course->passing_score); ?>%
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </section>

        
        <div class="body-section">

            
            <div class="panels-row">

                
                <div class="info-panel">
                    <div class="info-panel-head">Course Objectives</div>
                    <div class="info-panel-body">
                        <?php if(!empty($course->objectives)): ?>
                            <ul class="objectives-list">
                                <?php $__currentLoopData = $course->objectives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objective): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        <?php echo e($objective); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p style="color:var(--muted);font-size:14px;margin:0;">No objectives listed yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="info-panel">
                    <div class="info-panel-head">About the Instructor</div>
                    <div class="info-panel-body">
                        <?php if($instructor_detail ?? false): ?>
                            <div class="instructor-wrap">
                                <div class="instructor-avatar"
                                     <?php if($instructor_detail->avatar_url): ?>
                                         style="background-image:url('<?php echo e($instructor_detail->avatar_url); ?>')"
                                     <?php endif; ?>>
                                </div>
                                <div>
                                    <p class="instructor-name"><?php echo e($instructor_detail->name); ?></p>
                                    <p class="instructor-dept"><?php echo e($instructor_detail->department ?? ''); ?></p>
                                </div>
                            </div>
                            <?php if($instructor_detail->bio ?? false): ?>
                                <p class="instructor-bio"><?php echo e($instructor_detail->bio); ?></p>
                            <?php endif; ?>
                        <?php elseif($course->instructor): ?>
                            <div class="instructor-wrap">
                                <div class="instructor-avatar"></div>
                                <div>
                                    <p class="instructor-name"><?php echo e($course->instructor); ?></p>
                                    <p class="instructor-dept">Instructor</p>
                                </div>
                            </div>
                        <?php else: ?>
                            <p style="color:var(--muted);font-size:14px;margin:0;">No instructor information available.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            
            <?php if(($modules ?? collect())->count()): ?>
                <div class="modules-section">
                    <div class="modules-head">
                        <h3>Course Content</h3>
                    </div>

                    <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="module-item">
                            <div class="module-check">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="3"/>
                                </svg>
                            </div>
                            <div class="module-info">
                                <p class="module-title"><?php echo e($module->title); ?></p>
                                <?php if($module->description ?? false): ?>
                                    <p class="module-sub"><?php echo e($module->description); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="module-meta">
                                <?php if($module->type ?? false): ?>
                                    <span class="module-type"><?php echo e($module->type); ?></span>
                                <?php endif; ?>
                                <?php if($module->duration ?? false): ?>
                                    <span class="module-duration"><?php echo e($module->duration); ?></span>
                                <?php endif; ?>
                                <svg class="module-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6 9l6 6 6-6"/>
                                </svg>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php if($quiz ?? false): ?>
                        <div style="padding:16px 24px;background:#f8f9fb;border-top:1px solid var(--line);">
                            <div class="quiz-section" style="box-shadow:none;padding:0;background:transparent;">
                                <div class="quiz-info">
                                    <p class="quiz-title"><?php echo e($quiz->title); ?></p>
                                    <p class="quiz-sub">
                                        <?php echo e($quiz->questions_count); ?> <?php echo e(Str::plural('Question', $quiz->questions_count)); ?>

                                        <?php if($quiz->passing_score ?? false): ?>
                                            · Pass <?php echo e($quiz->passing_score); ?>%
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <?php if($is_enrolled ?? false): ?>
                                    <a href="<?php echo e(route('quiz.show', $quiz->id)); ?>">
                                        <button class="btn-quiz" type="button">Quiz</button>
                                    </a>
                                <?php else: ?>
                                    <button class="btn-quiz" type="button" disabled
                                            style="opacity:.5;cursor:not-allowed;">Quiz</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>

    </main>
</div>

</body>
</html><?php /**PATH C:\Users\Admin\Herd\Micro-credentials\resources\views/Student_Course_Description.blade.php ENDPATH**/ ?>