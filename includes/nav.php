<nav class="navbar is-info<?php if (isset($transparentNav)) { echo ' transparent'; }?>" role="navigation"
    aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="index.php">
            <img src="assets/vinyl.svg" width="40px">
            TuneUtils
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
            data-target="tune-nav">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="tune-nav" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item nav-translucent" href="index.php">
                Home
            </a>

            <div class="navbar-item nav-translucent has-dropdown is-hoverable">
                <a class="navbar-link">
                    Utils
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item" href="recent.php">
                        Recently played
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item" href="about.php">
                        About TuneUtils
                    </a>
                </div>
            </div>
        </div>


        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <?php if ($_SESSION['status'] !== 200) { ?>
                    <a class="button is-dark"
                        href="https://accounts.spotify.com/authorize?client_id=d7334867b2d94c2ca39d6462820cf8de&redirect_uri=http:%2F%2Flocalhost:8000%2Fauth%2Fauth.php&scope=user-read-private%20user-read-recently-played&response_type=token&state=123">
                        <strong>Login with Spotify</strong>
                    </a>
                    <?php } else { ?>

                    <div class="navbar-item nav-translucent has-dropdown is-hoverable">
                        <a class="navbar-link">
                            <img src="<?php echo $_SESSION['pfp']; ?>" />
                        </a>

                        <div class="navbar-dropdown is-right">
                            <div class="navbar-item" href="recent.php">
                                <small><strong>LOGGED IN AS <?php echo strtoupper($_SESSION['name']); ?></strong></small>
                            </div>
                            <hr class="navbar-divider">
                            <a class="navbar-item" href=https://accounts.spotify.com/authorize?client_id=d7334867b2d94c2ca39d6462820cf8de&redirect_uri=http:%2F%2Flocalhost:8000%2Fauth%2Fauth.php&scope=user-read-private%20user-read-recently-played&response_type=token&state=123">
                                Refresh access token
                            </a>
                            <a class="navbar-item" href="auth/clearToken.php">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // Get all "navbar-burger" elements
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

            // Add a click event on each of them
            $navbarBurgers.forEach(el => {
                el.addEventListener('click', () => {

                    // Get the target from the "data-target" attribute
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);

                    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                });
            });
        }

    });
</script>
