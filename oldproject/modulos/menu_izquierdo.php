            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas" ng-controller="menu">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                       <!-- <div class="pull-left image">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>--> <!--imagen de avagar, no se necesita -->
                        <div class="pull-left info">
                            <p>Hola, <span id="name_saludo"></span></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                    
                        <li id="m-usuarios">
                            <a href="#/Usuarios">
                                <i class="fa fa-user "></i> <span>Usuarios</span>
                            </a>
                        </li>
						
                        <li id="m-clientes">
                            <a href="#/Clientes">
                                <i class="fa fa-users"></i> <span>Clientes</span>
                            </a>
                        </li>
                       <li id="m-bioultra">
                            <a href="#/Biotestultra">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>BioTest Ultra</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                        </li>
                     
                        <li class="treeview" id="m-utilidades">
                            <a href="#">
                                <i class="fa fa-laptop" id="m-utlidades"></i>
                                <span>Utilidades</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#/Consejos"><i class="fa fa-angle-double-right"></i> Consejos</a></li>
                                <li><a href="#/Maquinas"><i class="fa fa-angle-double-right"></i> M&aacute;quinas</a></li>
                                <li><a href="#/CategoriaMaquinas"><i class="fa fa-angle-double-right"></i> Categorias M&aacute;quinas</a></li>
                             
                            </ul>
                        </li>
                       
                        <li class="treeview" id="m-rutinas">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Rutinas</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#/Rutinas"><i class="fa fa-angle-double-right"></i>Rutinas</a></li>
                                <li><a href="#/Ejercicios"><i class="fa fa-angle-double-right"></i> Ejercicios</a></li>
                                <li><a href="#/Musculos"><i class="fa fa-angle-double-right"></i> M&uacute;sculos</a></li>
                                <li><a href="#/TiposRutina"><i class="fa fa-angle-double-right"></i> Tipos de Rutina</a></li>
                            </ul>
                        </li>
                        
                        <li class="treeview" id="m-reportes">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Reportes</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu" >
                                <li><a href="#/ReportesClientes"><i class="fa fa-angle-double-right"></i> Formulario Clientes</a></li>
                                <li><a href="index.php?nav=Entrenadores"><i class="fa fa-angle-double-right"></i>Entrenadores</a></li>
                                <li><a href="index.php?nav=ClientesBio"><i class="fa fa-angle-double-right"></i>Biotest Clientes</a></li>
                            </ul>
                        </li>
                       
                        <!--<li>
                            <a href="calendar.html">
                                <i class="fa fa-calendar"></i> <span>Calendar</span>
                                <small class="badge pull-right bg-red">3</small>
                            </a>
                        </li>
                        <li>
                            <a href="mailbox.html">
                                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                <small class="badge pull-right bg-yellow">12</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Examples</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                <li><a href="examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
                                <li><a href="examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
                                <li><a href="examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
                                <li><a href="examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
                                <li><a href="examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
                                <li><a href="examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
                            </ul>
                        </li>-->
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>