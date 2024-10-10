<?php $profile_fot = $_SESSION['foto_perfil']; ?>

<div class="header">
    <div class="headerMainmenu">
        <div>
            <ul>
                <li class="logo"><a href="home.php" title="Home">Fotaza</a></li>
                <li class="search" style="float: left;">
                    <form action="search.php" method="get">
                        <input type="text" id="search" name="keywords" placeholder="Buscar..." />
                        <select name="topic" class="search_topic">
                            <option value="Selec.">Selec.</option>
                            <option value="User">Usuario</option>
                            <option value="Post">Post</option>
                        </select>
                        <button type="submit" name="search"><img src="../img/search.png" style="margin: 0 0 -12px 12px; float: right; padding: 0;" height="33" width="33"></button>
                    </form>
                </li>
                <div class="leftHeaderMenu">
                    <li>
                        <form action="" method="POST">
                            <button type="submit" name="logout" style=" margin-top: 11px; border-radius: 10px; border:none;">
                                <a href="logout.php" title="Cerrar Login" style="font-weight: bold; margin: 8px 16px; font-size: 14px; color: #190b81;">Salir</a>
                            </button>
                        </form>
                    </li>

                    <li><a href="about.php?u=<?php echo $user ?>" title="Ir a mi perfil"><img src="<?php if(isset($profile_fot)){echo $profile_fot; }else{ echo '../img/logout.png'; } ?>" class="h_propic" height="30" width="30"></a></li>
                    <li><a href="home.php" style=" margin: 17px 0px 17px 17px;" title="Ir a Publicaciones"><img src="../img/home1.png" style="margin:-5px; padding: 0 5px;" height="22" width="22"></a></li>
                </div>


            </ul>
        </div>
    </div>
</div>
