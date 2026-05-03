```php id="jlwm5n"
<div class="sidebar">

    <!-- LOGO -->
    <div class="logo-area text-center">
        <h3>☕ Black Coffee</h3>
        <p>Owner Panel</p>
    </div>

    <!-- MENU -->
    <div class="menu-list">

        <a href="index.php?page=home" class="menu-link">
            <span>🏠</span> Dashboard
        </a>

        <a href="index.php?page=laporan" class="menu-link">
            <span>📊</span> Laporan
        </a>

        <a href="index.php?page=grafik" class="menu-link">
            <span>📈</span> Grafik
        </a>

        <a href="index.php?page=profile" class="menu-link">
            <span>👤</span> Profile
        </a>

        <a href="index.php?page=settings" class="menu-link">
            <span>⚙️</span> Settings
        </a>

    </div>

    <!-- BOTTOM -->
    <div class="sidebar-bottom">

        <a href="../logout.php" class="logout-btn">
            🚪 Logout
        </a>

    </div>

</div>

<style>

.sidebar{
    width: 260px;
    height: 100vh;
    background: linear-gradient(to bottom, #3E2723, #6D4C41);
    position: fixed;
    left: 0;
    top: 0;
    padding: 25px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 4px 0 20px rgba(0,0,0,0.15);
}

/* LOGO */
.logo-area h3{
    color: white;
    font-weight: 700;
    margin-bottom: 5px;
}

.logo-area p{
    color: rgba(255,255,255,0.7);
    font-size: 14px;
}

/* MENU */
.menu-list{
    margin-top: 30px;
}

.menu-link{
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: white;
    padding: 14px 16px;
    border-radius: 12px;
    margin-bottom: 12px;
    transition: 0.3s;
    font-weight: 500;
}

.menu-link:hover{
    background: rgba(255,255,255,0.15);
    transform: translateX(5px);
    color: white;
}

.menu-link span{
    font-size: 18px;
}

/* LOGOUT */
.logout-btn{
    display: block;
    text-align: center;
    text-decoration: none;
    background: #dc3545;
    color: white;
    padding: 12px;
    border-radius: 12px;
    transition: 0.3s;
    font-weight: 600;
}

.logout-btn:hover{
    background: #bb2d3b;
    color: white;
}

</style>

```
