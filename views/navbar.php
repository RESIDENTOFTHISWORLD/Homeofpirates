
<?php if ($controller->template!="home.php"){ ?>
    <a class="HomeButton"  href="Home" >
        <img  class='homeButton' src='img/icons/home.svg'/>
    </a>
<?php } ?>
<nav role='navigation' class='mainNav'>
    <a class="NavButton">
        <img class='menuButton' onclick='openNav()'  src='img/icons/menu.svg'/>
    </a>
    <div class='navbar' id='navbar'>

        <!--===== Home =====-->
        <?php if ($controller->template=="home.php"){ ?>
            <span class='NavSpan' >HOME</span>
        <?php }else{ ?>
            <a class='NavLink' href="Home">HOME</a>
        <?php } ?>

        <!--===== The Crew =====-->
        <?php if ($controller->template=="crew.php") { ?>
            <span class='NavSpan' >THE CREW</span>
        <?php }else{ ?>
            <a class='NavLink' href="Crew">THE CREW</a>
        <?php } ?>

        <!--===== Elektronische Requisiten =====-->
        <?php if ($controller->template=="elektronische_requisiten.php") { ?>
            <span class='NavSpan' >ELEKTRONISCHE REQUISITEN</span>
        <?php }else{ ?>
            <a class='NavLink' href="Elektronische_requisiten">ELEKTRONISCHE REQUISITEN</a>
        <?php } ?>

        <!--===== Projekte =====-->
        <?php if ($controller->template=="projects.php") { ?>
            <span class='NavSpan' >PROJEKTE</span>
        <?php }else{ ?>
            <a class='NavLink' href="Projects">PROJEKTE</a>
        <?php } ?>

        <!--===== Artdepartmentstore =====-->
        <?php if ($controller->template=="furniture") { ?>
            <span class='NavSpan' >ARTDEPARTMENTSTORE ↗</span>
        <?php }else{ ?>
            <a class='NavLink' href='https://www.artdepartmentstore.com/' target='_blank' rel='noopener'>ARTDEPARTMENTSTORE ↗</a>
        <?php } ?>

        <!--===== Filmtanken =====-->
        <?php if ($controller->template=="tanke") { ?>
            <span class='NavSpan' >FILMTANKE ↗</span>
        <?php }else{ ?>
            <a class='NavLink' href='https://www.filmtanke.com/' target='_blank' rel='noopener'>FILMTANKE ↗</a>
        <?php } ?>

        <!--===== Impressum =====-->
        <?php if ($controller->template=="impressum.php") { ?>
            <span class='NavSpan' >IMPRESSUM</span>
        <?php }else{ ?>
            <a class='NavLink' href="Impressum">IMPRESSUM</a>
        <?php } ?>

        <!--===== Datenschutz =====-->
        <?php if ($controller->template=="datenschutz.php") { ?>
            <span class='NavSpan' >DATENSCHUTZ</span>
        <?php }else{ ?>
            <a class='NavLink' href="Datenschutz">DATENSCHUTZ</a>
        <?php } ?>

        <!------ END ------>
    </div>
    <div class='navbarSpace' onClick='closeNav()'>
    </div>
</nav>

