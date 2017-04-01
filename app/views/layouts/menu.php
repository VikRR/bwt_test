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
                    <li><a href="weather">Weather</a></li>
                    <li><a href="feedback">Feedback</a></li>
                <?php endif ?>
                <li><a href="comment">Add Comment</a></li>
            </ul>
        </nav>
    </div>
</div>