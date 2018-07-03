<div class="sidebar" data-color="orange">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->



    <div class="sidebar-wrapper">

        <div class="user">
            <div class="photo">
                <img src="../assets/img/james.jpg">
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        {{ Auth::user()->name }}
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="#">
                                <span class="sidebar-mini-icon">MP</span>
                                <span class="sidebar-normal">Mi Perfil</span>
                            </a>
                        </li>
                        <li>
                         <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                              <span class="sidebar-mini-icon"><i class="fa fa-times"></i></span>
                              <span class="sidebar-normal">Cerrar sesion</span>
                          </a>


              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <ul class="nav">

              <li class="active">
                    <a href="{{ route('dashboard.index') }}">

                        <i class="fa fa-tachometer-alt"></i>

                      <p>Dashboard</p>
                    </a>
              </li>

              <li>
                    <a data-toggle="collapse" href="#platillos">

                        <i class="fa fa-utensils"></i>

                        <p>
                          Platillos <b class="caret"></b>
                        </p>
                    </a>

                    <div class="collapse " id="platillos">
                        <ul class="nav">
                          <li>
                              <a href="{{ route('dish.index') }}">
                                  <span class="sidebar-mini-icon">P</span>
                                  <span class="sidebar-normal"> Todos los Platillos </span>
                              </a>
                          </li>
                          <li>
                              <a href="{{ route('category.index') }}">
                                  <span class="sidebar-mini-icon">C</span>
                                  <span class="sidebar-normal">Categorías</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>
              <li>
                    <a data-toggle="collapse" href="#sucursales">

                        <i class="fa fa-store"></i>

                        <p>
                          Sucursales <b class="caret"></b>
                        </p>
                    </a>

                    <div class="collapse " id="sucursales">
                        <ul class="nav">

                          <li>
                              <a href="{{ route('store.index') }}">
                                  <span class="sidebar-mini-icon">S</span>
                                  <span class="sidebar-normal"> Todas las sucursales </span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              <li>
                    <a data-toggle="collapse" href="#users">

                        <i class="fa fa-users"></i>

                        <p>
                          Usuarios <b class="caret"></b>
                        </p>
                    </a>

                    <div class="collapse " id="users">
                        <ul class="nav">

                          <li>
                              <a href="{{ route('user.index') }}">
                                  <span class="sidebar-mini-icon">U</span>
                                  <span class="sidebar-normal"> Todos los usuarios </span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>
              <li>
                    <a data-toggle="collapse" href="#componentsExamples">

                        <i class="fa fa-book"></i>

                        <p>
                          Components <b class="caret"></b>
                        </p>
                    </a>

                    <div class="collapse " id="componentsExamples">
                        <ul class="nav">

                          <li>
                              <a href="../examples/components/buttons.html">
                                  <span class="sidebar-mini-icon">B</span>
                                  <span class="sidebar-normal"> Buttons </span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

        </ul>
    </div>
</div>
