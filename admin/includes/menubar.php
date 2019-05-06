<aside class="main-sidebar">
  <section class="sidebar">
    
    <div class="user-panel">
      
      <div class="pull-left image">
        <img src="../img/Profile.png" class="img-circle" alt="User Image">
      </div>
      
      <div class="pull-left info">
        <?php echo $_SESSION['Username'];?>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    
    </div>

    <ul class="sidebar-menu" data-widget="tree">
      
      <li class="header">MAIN NAVIGATION</li>

      <!-- Optionally, you can add icons to the links -->

      <li><a href="AdminHome.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li><a href="info.php"><i class="fa fa-address-book"></i> <span>Business List</span></a></li>
      <li><a href="User.php"><i class="fa fa-users"></i> <span>Users</span></a></li>
      <li><a href="Archive.php"><i class="fa fa-trash"></i> <span>Archive</span></a></li>
      
      <?php

            $isread = 0;
            $eid = $_SESSION["Email"];
            $managerID = $_SESSION['User_ID'];
            $sql = "SELECT hd_ID FROM hd_table WHERE _read='$isread' AND _to = '$eid'";
            $query = $conn->query($sql);
            $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
            $unreadcount = $query->num_rows;

      ?>
      
      <li class="treeview">
        <a href="#">
          <i class="fa fa-envelope-o"></i>
          <span>Helpdesk</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-down pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="inbox.php"> Inbox<span class="pull-right-container">
                <span class="label label-primary pull-right"><?php echo $unreadcount; ?></span>
              </span></a></li>
          <li><a href="compose.php"> Compose</a></li>    
        </ul>
      </li>
      <li class="header">SUB FUNCTIONS</li>
      <?php

        if($_SESSION['Username'] != 'DTI')
        {
          echo'';
        
        }else{

          echo'<li><a href="catadd.php"><i class="fa fa-plus"></i> <span>Business Category Section</span></a></li>';
        
        }

      ?>

    </ul>
  </section>
</aside>