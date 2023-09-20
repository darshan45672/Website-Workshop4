<header>
    <nav id="main-nav" class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="/index.php">
                    <img src="./images/logo.png" alt="UniCourt">
                </a>
                <div class="navbar-burger burger" id="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div id="navbar-example" class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item is-active" href="index.php">Blog</a>
                    <!-- paste the menu options below-->

                    <?php if(isset($_SESSION['userId'])) : ?>
                        <a class="navbar-item is-active" href="user-info.php"><?php echo $_SESSION['userName'] ?></a>
                        <a class="navbar-item is-active" href="logout.php">Logout</a>
                    <?php else : ?>
                        <a class="navbar-item is-active" href="login.php">Login</a>
                        <a class="navbar-item is-active" href="signup.php">Signup</a>
                    <?php endif ?>

                    
                </div>
            </div>
        </div>
    </nav>
</header>
