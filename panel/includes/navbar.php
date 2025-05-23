<nav class="admin-nav">
    <ul>
        <li><a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a></li>
        <li><a href="students.php" class="<?= basename($_SERVER['PHP_SELF']) == 'students.php' ? 'active' : '' ?>">
            <i class="fas fa-users"></i> Students
        </a></li>
        <li><a href="courses.php" class="<?= basename($_SERVER['PHP_SELF']) == 'courses.php' ? 'active' : '' ?>">
            <i class="fas fa-book"></i> Courses
        </a></li>
        <li><a href="settings.php" class="<?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">
            <i class="fas fa-cog"></i> Settings
        </a></li>
        <li><a href="../logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a></li>
    </ul>
</nav>