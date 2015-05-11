    <div  id="nav" class="clearfix">
      <div id="hamburger"></div>
      <ul id="menu">
        <li><a href="<?php echo($base_url); ?>">Home</a></li>
        <li class="dropdown"><span onClick="return true">Locations</span>
          <ul>
            <li><a href="<?php echo($base_url); ?>/locations/vancouver">Vancouver</a></li>
            <li><a href="<?php echo($base_url); ?>/locations/north_shore">North Shore</a></li>
            <li><a href="<?php echo($base_url); ?>/locations/tri-cities">Tri-Cities</a></li>
          </ul>
        </li>
        <li><a href="<?php echo($base_url); ?>/about">About</a></li>
        <li><a href="<?php echo($base_url); ?>/give">Give</a></li>
        <li><a href="<?php echo($base_url); ?>/contact">Contact</a></li>
      </ul>
      <span id="countdown" title="<?= $next_chapel ?>">00:00:00</span>
    </div><!-- end of navigation-->
