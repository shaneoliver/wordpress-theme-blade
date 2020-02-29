<header class="headroom">
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ home_url() }}">{{ get_bloginfo('name') }}</a>
            <button class="hamburger hamburger--collapse d-xl-none" type="button" data-toggle="collapse" data-target="#primaryNavigation" aria-controls="primaryNavigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
            <div class="navbar-collapse collapse" id="primaryNavigation">
                {{ wp_nav_menu([
                    'theme_location' => 'primary',
                    'depth' => 4,
                    'walker' => new \ShaneOliver\NavWalker,
                    'menu_class' => 'navbar-nav mr-auto',
                    'container' => false,
                ]) }}
                {{ get_search_form() }}
            </div>
        </div>
    </nav>
</header>
