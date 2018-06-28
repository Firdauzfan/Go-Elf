<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="reservation.php">
          <i class="fa fa-calendar"></i> <span>Reservation</span>
        </a>
      </li>
      <?php
      include('config/connect.php');
      $role= $_SESSION['role'];
      if ($role=='supir') {
        echo '<li>
        <a href="bookelf.php">
          <i class="fa fa-calendar"></i> <span>Booking ELf</span>
        </a>
      </li>
      <li>';
      }
      ?>
      <li>
        <a href="list_booking_driver.php">
          <i class="fa fa-table"></i> <span>List Booking Driver</span>
        </a>
      </li>
      <li>
        <a href="list_booking.php">
          <i class="fa fa-table"></i> <span>List Booking Penumpang</span>
        </a>
      </li>
      <li>
        <a href="supir.php">
          <i class="fa fa-users"></i> <span>Data Supir</span>
        </a>
      </li>
      <li>
        <a href="penumpang.php">
          <i class="fa fa-address-card-o"></i> <span>Data Penumpang</span>
        </a>
      </li>
      <li>
        <a href="elf.php">
          <i class="fa fa-bus"></i> <span>Data Elf</span>
        </a>
      </li>
      <li>
        <a href="trackelf.php">
          <i class="fa fa-map-marker"></i> <span>Tracking Elf</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>