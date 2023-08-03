<header style="color: black;">
    <nav>
        <div class="logo">
            <img src="<?= base_url() ?>assets/images/logo.png" width="100%" height="100%" alt="">
        </div>
        <span class="menu_" id="menu_"><i class="ri-menu-3-fill"></i></span>
        <div class="mobile_nav" id="mobile_nav">
            <span class="close" id="close"><i class="ri-close-fill"></i></span>
            <ul class="navbar__list">
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li><a href="<?= base_url() ?>about-us">About-Us</a></li>
                <li><a href="<?= base_url() ?>priceing">Pricing</a></li>
                <?php if (isset($_SESSION['user'])) { ?>
                    <li class="user_">
                        <a href="<?= base_url() ?>account/profile" id="user_nav_name"><?= $_SESSION['user'] ?><i class="ri-arrow-down-s-fill"></i></a>
                        <ul class="user_ul">
                            <li><a href="<?= base_url() ?>account/profile">Dashboard</a></li>
                            <li><a href="<?= base_url() ?>logout">Logout</a></li>
                        </ul>
                    </li><?php } else { ?>
                    <li><a href="<?= base_url() ?>signin">SignIn</a></li>
                    <li><a href="<?= base_url() ?>signup">SignUp</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>