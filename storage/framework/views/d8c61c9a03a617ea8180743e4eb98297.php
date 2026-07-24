<footer class="footer">
    <div class="container footer__grid">

        <div class="footer__brand-col">
            <a href="<?php echo e(url('/')); ?>" class="footer__brand">
                
                <span>UPSKILL</span>
            </a>
            <p class="footer__tagline">The Official Platform for PSU Microcredentials</p>
            <p class="footer__copy">&copy; <?php echo e(date('Y')); ?> Pangasinan State University. All rights reserved.</p>
        </div>

        <div class="footer__col">
            <h4 class="footer__heading">Platform</h4>
            <ul class="footer__list">
                <li><a href="<?php echo e(url('/explore')); ?>">Explore Courses</a></li>
                <li><a href="<?php echo e(url('/microcredentials')); ?>">Microcredentials</a></li>
                <li><a href="<?php echo e(url('/announcements')); ?>">Announcements</a></li>
            </ul>
        </div>

        <div class="footer__col">
            <h4 class="footer__heading">Account</h4>
            <ul class="footer__list">
                <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                <li><a href="<?php echo e(url('/register')); ?>">Enroll Now</a></li>
            </ul>
        </div>

        <div class="footer__col">
            <h4 class="footer__heading">Support</h4>
            <ul class="footer__list">
                <li><a href="<?php echo e(url('/help')); ?>">Help Center</a></li>
                <li><a href="<?php echo e(url('/privacy')); ?>">Privacy Policy</a></li>
                <li><a href="<?php echo e(url('/terms')); ?>">Terms of Use</a></li>
            </ul>
        </div>

    </div>
</footer>

<style>
.footer {
    background: var(--navy-dark);
    color: rgba(255,255,255,0.7);
    padding: 3.5rem 0 2.5rem;
    font-size: 0.88rem;
}
.footer__grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 2.5rem;
}
.footer__brand {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--white);
    font-family: var(--font-display);
    font-weight: 900;
    font-size: 1.1rem;
    letter-spacing: 0.04em;
    margin-bottom: 0.75rem;
}
.footer__tagline { color: rgba(255,255,255,0.55); line-height: 1.5; margin-bottom: 1rem; max-width: 260px; }
.footer__copy    { color: rgba(255,255,255,0.35); font-size: 0.78rem; }
.footer__heading { color: var(--gold); font-weight: 700; margin-bottom: 0.85rem; font-size: 0.82rem; text-transform: uppercase; letter-spacing: 0.08em; }
.footer__list    { list-style: none; display: flex; flex-direction: column; gap: 0.55rem; }
.footer__list a  { color: rgba(255,255,255,0.6); transition: color var(--transition); }
.footer__list a:hover { color: var(--gold); }

@media (max-width: 768px) {
    .footer__grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 480px) {
    .footer__grid { grid-template-columns: 1fr; }
}
</style><?php /**PATH C:\Users\Admin\Herd\Micro-credentials\resources\views/components/footer.blade.php ENDPATH**/ ?>