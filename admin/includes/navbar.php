<header class="main-header">
  
  <!-- Logo -->
  <a href="" class="logo">
    
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>MBP</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>MetroBusinessPortal</b></span>
  
  </a>
  
  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
    <!-- Navbar Right Menu -->
   
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">     
         <!-- Messages: style can be found in dropdown.less-->
          <?php
         
            $isread = 0;
            $eid = $_SESSION["Email"];
            $managerID = $_SESSION['User_ID'];
            $sql = "SELECT hd_ID FROM hd_table WHERE _read='$isread' AND _to = '$eid'";
            $query = $conn->query($sql);
            $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
            $unreadcount = $query->num_rows;
         
          ?>
          <li class="dropdown messages-menu" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-danger"><?php echo $unreadcount; ?></span>
            </a>
            <ul class="dropdown-menu" style="width:400px;">
              <li class="header">You have <?php echo $unreadcount; ?> message(s)</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <?php
                $isread = 0;
               
                $sql= "SELECT information_table.Firstname,user_table.User_ID,user_table.Username,user_table.Email,hd_table._subject,hd_table._message,hd_table._status,hd_table.hd_ID,hd_table.date_added FROM user_table INNER JOIN hd_table ON user_table.User_ID = hd_table.User_ID INNER JOIN information_table ON information_table.Information_ID=user_table.Information_ID WHERE hd_table._read = '$isread' AND hd_table._to='$eid'";

                $query = $conn->query($sql);
                $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                if (mysqli_num_rows($query) > 0) {
                  foreach ($results as $result) {
                ?>
                <ul class="menu">
                  <li><a href="read.php?id=<?php echo $result['hd_ID']; ?>">
                        <div class="pull-left">
                        <img src="../img/profile.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                      <?php echo $result['Username']; ?>
                      </h4>
                      <p><?php echo $result['_subject']; ?></p>
                    </a>
                  </li>
                  <!-- end message -->
                
                </ul>
                 <?php 
              }
            } ?>
              </li>
              <li class="footer"><a href="inbox.php">See All Messages</a></li>
            </ul>
          </li>
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->

        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <img src="../img/profile.png" class="user-image" alt="User Image">   
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs"><?php echo $_SESSION['Username'];?></span>
        </a>
        
        <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
            
              <img src="../img/profile.png" class="img-circle" alt="User Image">
              <p><?php echo $_SESSION['Username'];?>
                <small><?php echo $_SESSION['Email']?></small>
              </p> 
            </li>

            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="includes/logout.php" onclick="return confirm('Are you sure to logout?');" class="btn btn-default btn-flat">Log out</a>
              </div>
            </li>
          </ul> <!-- UL | dropdown-menu -->
        </li>
      </ul>
    </div> 
  </nav> <!-- Header Navbar-->
</header>
