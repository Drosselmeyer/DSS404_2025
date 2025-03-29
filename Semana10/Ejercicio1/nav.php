 <!-- Barra de navegación -->
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">Panel de Administrador</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="inicio.php">Inicio</a></li> <!-- Enlace para ir a la página de inicio -->
                <?php
                  if ($tipo_usuario == 'administrador') { // Verificar si el usuario no ha iniciado sesión
                    // Redirigir al usuario al formulario de creacion de usuarios
                    echo '<li><a href="pagina_administrador.php">Pagina Administrador</a></li>';
                  }
              
                  if (isset($tipo_usuario)){
                    echo '<li><a href="cerrar_sesion.php">Cerrar sesión</a></li>'; //Enlace para cerrar sesión
                  }

                  if (!isset($tipo_usuario)){
                    echo '<li><a href="registrarse.php">Registrarse</a></li>'; //Enlace para registrarse
                  }
              ?>  
            </ul>
        </div>
    </nav>
