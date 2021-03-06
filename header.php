<?php

require_once "lib/config.php";

is_Library_File();
require_once $_SERVER['SERVER_PATH'] . "lib/auth.php";

function generateAlert($status)
{
    printAlertFromStatus($status);

    unset($_SESSION["status_code"]);
}

function generateUserLoginDropdown()
{
    ?>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="userMenuDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php
    if(isset($_SESSION['login_user']))
    {
        ?>
                <?=$_SESSION['login_user']?>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                <?php if ($_SESSION['create'] == 1 || $_SESSION['update'] == 1 || $_SESSION['delete'] == 1) : ?>
                    <?php if ($_SESSION['admin'] == 1): ?>
                    <h6 class="dropdown-header">Interfaces</h6>
                    <a class="dropdown-item" href="<?=$_SERVER['CLIENT_PATH']?>/admin/admin.php">Website Management</a>
                    <div class="dropdown-divider"></div>
                    <?php endif?>
                    <h6 class="dropdown-header">Posts</h6>
                    <a class="dropdown-item" href="<?=$_SERVER['CLIENT_PATH']?>/user/user.php">Post Management</a>
                    <a class="dropdown-item" href="<?=$_SERVER['CLIENT_PATH']?>/post/post.php">Create New</a>
                    <div class="dropdown-divider"></div>
                <?php endif?>
                    <h6 class="dropdown-header">Meta</h6>
                    <a class="dropdown-item" href="<?=$_SERVER['CLIENT_PATH']?>/login.php?action=logout">Log Out</a>
                    </div>
        <?php
    }
    else
    {
        ?>
                <?="Guest"?>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item" data-toggle="modal" data-target="#loginModal">Login</button>
                    <a class="dropdown-item" href="<?=$_SERVER['CLIENT_PATH']?>/register.php">Register</a>
        <?php
    }
    ?>
                    </div>
            <?php
}

?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?=$_SERVER['CLIENT_PATH']?>" aria-label="Bits & Bytes Association">
            <img class="logo" src="<?=$_SERVER['CLIENT_PATH']?>/assets/img/banners/bba-banner-black.png" alt="Bits & Bytes Association">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            </span>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <form action="login.php?action=login" method="POST">
                <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend form-group">
                                <span class="input-group-text" id="login-username">Username:</span>
                            </div>
                            <input type="text" class="form-control" name="username" id="usr" placeholder="Username" aria-label="Username" aria-describedby="usr"> <!--Fix the formatting of this.-->
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend form-group">
                                <span class="input-group-text" id="login-password">Password:</span>
                            </div>
                            <input type="password" class="form-control" id="password" name="field" placeholder="Password" aria-label="Password" aria-describedby="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="offcanvas-collapse navbar-collapse hide navbar collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?=$_SERVER['CLIENT_PATH']?>">
                        Home 
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        About Us
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Our Story</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Current Board</a>
                        <a class="dropdown-item" href="#">Past Executives</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Projects
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Create Your Own</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="GET" action="<?=$_SERVER['CLIENT_PATH']?>/search.php">
                <input class="form-control mr-sm-2" name="query" type="text" placeholder="Search" aria-label="Search" data-cip-id="cIPJQ342845639">
                <button class="btn btn-outline-success my-2 my-sm-0 fas fa-search" type="submit"></button>
            </form>
        </div>
    </nav>
</header>
<div class="nav-scroller bg-white shadow-sm">
      <nav class="nav nav-underline">
      <?=generateUserLoginDropdown()?>
      </nav>
    </div>
<?php if (isset($_SESSION['status_code'])) : ?>
<?=generateAlert($_SESSION['status_code'])?>
<?php endif?>