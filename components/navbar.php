<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/../config/constants.php');

$currentPage = basename($_SERVER['SCRIPT_NAME']);

// Define navigation items (excluding login which goes on the right)
$navItems = ['index', 'about', 'latest', 'contact'];
?>

<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <div class="container-fluid position-relative">
        <a id="brand" class="navbar-brand" href="<?php echo ROOT_DIR . PAGES['index']['URL']; ?>">
            <img alt="Innowind Icon" class="h-icon d-inline-block align-text-top" src="<?php echo ICON_PATH; ?>"> InnoWind
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul id="page_navigation" class="navbar-nav position-absolute top-50 start-50 translate-middle">
                <?php foreach ($navItems as $page):
                    $isActive = ($currentPage === PAGES[$page]['filename']) ? 'active' : '';
                    $url = ROOT_DIR . PAGES[$page]['URL'];
                    $label = PAGES[$page]['label'];
                    $hasDropdown = isset(PAGES[$page]['dropdown']);

                    if ($hasDropdown):
                        // Check if any dropdown item is active
                        $dropdownActive = '';
                        foreach (PAGES[$page]['dropdown'] as $dropdownPage) {
                            if ($currentPage === PAGES[$dropdownPage]['filename']) {
                                $dropdownActive = 'active';
                                break;
                            }
                        }
                        $isActive = ($currentPage === PAGES[$page]['filename'] || $dropdownActive) ? 'active' : '';
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo $isActive; ?>" href="#" id="dropdown<?php echo ucfirst($page); ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $label; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown<?php echo ucfirst($page); ?>">
                        <li><a class="dropdown-item" href="<?php echo $url; ?>"><?php echo $label; ?></a></li>
                        <li><hr></li>
                        <?php foreach (PAGES[$page]['dropdown'] as $dropdownPage):
                            $dropdownUrl = ROOT_DIR . PAGES[$dropdownPage]['URL'];
                            $dropdownLabel = PAGES[$dropdownPage]['label'];
                            $dropdownIsActive = ($currentPage === PAGES[$dropdownPage]['filename']) ? 'active' : '';
                        ?>
                        <li><a class="dropdown-item <?php echo $dropdownIsActive; ?>" href="<?php echo $dropdownUrl; ?>"><?php echo $dropdownLabel; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $isActive; ?>" href="<?php echo $url; ?>"><?php echo $label; ?></a>
                </li>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <ul id="login_navigation" class="navbar-nav ms-auto">
                <li class="nav-item">
                    <?php
                    if($_SESSION['is_logged_in'] ?? false) {
                        $loginActive = ($currentPage === PAGES['admin_main']['filename']) ? 'active' : '';
                        $loginUrl = ROOT_DIR . PAGES['logout']['URL'];
                    }
                    else{
                        $loginActive = ($currentPage === PAGES['login']['filename']) ? 'active' : '';
                        $loginUrl = ROOT_DIR . PAGES['login']['URL'];
                    }
                    ?>
                    <a class="nav-link <?php echo $loginActive; ?>" href="<?php echo $loginUrl; ?>"><?php echo PAGES['login']['label']; ?> <span class="d-lg-none"> Admin</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>