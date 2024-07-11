
<nav role='navigation' class='mainNav'>
    <a onclick='openNav()' >
        <img class='menuButton' src='img/icons/menu.svg'/>
    </a>


    <?php if ($controller->template!="home.php"){ ?>
        <a  onclick="submitMainForm('Home','render');" href="#" >
            <img  class='homeButton' src='img/icons/home.svg'/>
        </a>
    <?php } ?>

    <div class='navbar' id='navbar'>

        <!--===== Home =====-->
        <?php if ($controller->template=="home.php"){ ?>
            <span class='navlink'>HOME</span>
        <?php }else{ ?>
            <a href="Home" onclick="submitMainForm('Home','render');" class='navlink'>HOME</a>
        <?php } ?>

        <!--===== Portfolie =====-->
        <?php if ($controller->template=="portfolio.php") { ?>
            <span class='navlink'>PORTFOLIO</span>
        <?php }else{ ?>
            <a href="Portfolio" onclick="submitMainForm('Portfolio','render');" class='navlink'>PORTFOLIO</a>
        <?php } ?>

        <!--===== The Crew =====-->
        <?php if ($controller->template=="crew.php") { ?>
            <span class='navlink'>THE CREW</span>
        <?php }else{ ?>
            <a href="Crew" onclick="submitMainForm('Crew','render');" class='navlink'>THE CREW</a>
        <?php } ?>

        <!--===== Elektronische Requisiten =====-->
        <?php if ($controller->template=="elektronische_requisiten.php") { ?>
            <span class='navlink'>ELEKTRONISCHE REQUISITEN</span>
        <?php }else{ ?>
            <a href="Elektronische_requisiten" onclick="submitMainForm('Elektronische_requisiten','render');" class='navlink'>ELEKTRONISCHE REQUISITEN</a>
        <?php } ?>

        <!--===== Projekte =====-->
        <?php if ($controller->template=="projects.php") { ?>
            <span class='navlink'>PROJEKTE</span>
        <?php }else{ ?>
            <a href="Projects" onclick="submitMainForm('Projects','render');" href="#" class='navlink'>PROJEKTE</a>
        <?php } ?>

        <!--===== Artdepartmentstore =====-->
        <?php if ($controller->template=="furniture") { ?>
            <span class='navlink'>ARTDEPARTMENTSTORE ↗</span>
        <?php }else{ ?>
            <a href='https://www.artdepartmentstore.com/' target='_blank' rel='noopener' class='navlink'>ARTDEPARTMENTSTORE ↗</a>
        <?php } ?>

        <!--===== Filmtanken =====-->
        <?php if ($controller->template=="tanke") { ?>
            <span class='navlink'>FILMTANKE ↗</span>
        <?php }else{ ?>
            <a href='https://www.filmtanke.com/' target='_blank' rel='noopener' class='navlink'>FILMTANKE ↗</a>
        <?php } ?>

        <!--===== Impressum =====-->
        <?php if ($controller->template=="impressum.php") { ?>
            <span class='navlink'>IMPRESSUM</span>
        <?php }else{ ?>
            <a href="Impressum" onclick="submitMainForm('Impressum','render');" class='navlink'>IMPRESSUM</a>
        <?php } ?>

        <!--===== Datenschutz =====-->
        <?php if ($controller->template=="datenschutz.php") { ?>
            <span class='navlink'>DATENSCHUTZ</span>
        <?php }else{ ?>
            <a  href="Datenschutz" onclick="submitMainForm('Datenschutz','render');" class='navlink'>DATENSCHUTZ</a>
        <?php } ?>

        <!------ END ------>
    </div>
    <div class='navbarSpace' onClick='closeNav()'>
    </div>
</nav>

