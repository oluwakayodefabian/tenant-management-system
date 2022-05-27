<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav" style=<?= $title == 'login' ? 'background-color:#212529;' : '' ?>>
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">TMS</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href='<?= base_url() ?>'>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  js-scroll-trigger" href='<?= base_url("login") ?>'>Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  js-scroll-trigger" href="<?= base_url("register") ?>">Register</a>
                </li>

            </ul>
        </div>
    </div>
</nav>