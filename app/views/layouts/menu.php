<div class="row">
    <?php if (!empty($_SESSION['username'])): ?>
        <div class="col-md-12 text-center hello">
            <h3><?= 'Hello, ' . $_SESSION['username']; ?></h3>
            <a href="logout"> Logout </a>
        </div>
    <?php endif ?>
    <div class="col-md-12 text-center">
        <nav>
            <ul class="nav navbar-nav menu">
                <?php if (!empty($_SESSION['username'])): ?>
                    <li><a href="weather" <?php if(trim($_SERVER['REQUEST_URI'], '/') == 'weather'){ echo 'class="active"';} ?>>Weather</a></li>
                    <li><a href="feedback" <?php if(trim($_SERVER['REQUEST_URI'], '/') == 'feedback'){ echo 'class="active"';} ?>>Feedback</a></li>
                <?php endif ?>
                <li><a href="comment" <?php if(trim($_SERVER['REQUEST_URI'], '/') == 'comment'){ echo 'class="active"';} ?>>Add Comment</a></li>
            </ul>
        </nav>
    </div>
</div>