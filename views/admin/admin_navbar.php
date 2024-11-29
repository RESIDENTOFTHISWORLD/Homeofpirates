<?php if ($controller->template !="Admin/admin_login.php"){ ?>
<a class="HomeButton"  href="http://<?=$config->domain;?>" >
        <img  class='homeButton' src='http://<?=$config->domain;?>/img/icons/home.svg'/>
</a>
<nav role='navigation' class='mainNav'>
    <a class="NavButton">
        <img class='menuButton' onclick='openNav()'  src='http://<?=$config->domain;?>/img/icons/menu.svg'/>
    </a>
    <div class='navbar' id='navbar'>

        <!--===== Admin Home =====-->
        <?php if ($controller->template=="admin/admin_home.php"){ ?>
            <span class='NavSpan' >HOME</span>
        <?php }else{ ?>
            <a class='NavLink' href="Admin_Home">HOME</a>
        <?php } ?>

        <!--===== AdminProjectsManager =====-->
        <?php if ($controller->template=="admin/admin_projects.php") { ?>
            <span class='NavSpan' >PROJEKTE MANAGER</span>
        <?php }else{ ?>
            <a class='NavLink' href="Admin_Projects">PROJEKTE MANAGER</a>
        <?php } ?>

        <!--===== The Crew =====-->
        <?php if ($controller->template=="admin/admin_users.php") { ?>
            <span class='NavSpan' >BENUTZER MANAGER</span>
        <?php }else{ ?>
            <a class='NavLink' href="Admin_Users">BENUTZER MANAGER</a>
        <?php } ?>


        <!------ END ------>
    </div>
    <div class='navbarSpace' onClick='closeNav()'>
    </div>
</nav>
<?php } ?>