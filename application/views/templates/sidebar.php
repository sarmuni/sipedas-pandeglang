<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-car"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIPEDAS <sup>v3</sup></div>
    </a>

    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`, `menu`,icon
                                FROM `user_menu` JOIN `user_access_menu`
                                ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                            WHERE `user_access_menu`.`role_id` = $role_id
                            ORDER BY `user_access_menu`.`menu_id` ASC
                            ";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>
    <?php foreach ($menu as $m) : ?>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <?php $url = $this->uri->segment(1);
        if (strtolower($m['menu']) == strtolower($url)) {
            $a = 'show';
            $ac = 'active';
        } else {
            $a = '';
            $ac = '';
        }
        ?>
        <!-- Nav Item - Pages Collapse Menu -->

        <li class="nav-item <?php echo $ac; ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#<?= $m['menu']; ?>" aria-expanded="false" aria-controls="<?= $m['menu']; ?>">
                <i class="<?= $m['icon']; ?>"></i>
                <span> <?= $m['menu']; ?></span>
            </a>
            <div id="<?= $m['menu']; ?>" class="collapse <?php echo $a; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php
                    $menuId = $m['id'];
                    $querySubMenu = "SELECT *
                               FROM `user_sub_menu` JOIN `user_menu` 
                                 ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                              WHERE `user_sub_menu`.`menu_id` = $menuId
                                AND `user_sub_menu`.`is_active` = 1
                        ";
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                    ?>
                    <?php foreach ($subMenu as $sm) : ?>
                        <a class="collapse-item" href="<?= base_url($sm['url']); ?>"><?= $sm['title']; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </li>

    <?php endforeach; ?>

    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>