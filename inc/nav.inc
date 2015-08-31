    <div  id="nav" class="clearfix">
      <div id="hamburger"></div>
      <ul id="menu">
        <li><a href="/">Home</a></li>
        <li class="dropdown"><span onClick="return true">Locations</span>
          <ul>
            <li><a href="/locations/vancouver">Vancouver</a></li>
            <li><a href="/locations/north_shore">North Shore</a></li>
            <li><a href="/locations/tri-cities">Tri-Cities</a></li>
            <li><a href="/locations/richmond">Richmond</a></li>
          </ul>
        </li>
        <li><a href="/music">Music</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/give">Give</a></li>
        <li><a href="/contact">Contact</a></li>
      </ul>
      <span id="countdown" title="<?= date('F j, Y', $next_chapel); ?>">00:00:00</span>
    </div><!-- end of navigation-->
