<nav class="navbar navbar-default navbar-fixed-top">
		
        <div class="container-fluid" style="margin-right:5px;">
			<div class="navbar-header" style="float:top;position:absolute;margin-left:10px;">
				<a class="navbar-brand" href="PortalHome1.php">MBP</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
                <div class="usertab">
                    Welcome! <a href="CP.php">
                    <?php echo $_SESSION['Username']; ?></a><img src="IMG/Profile.png" alt="userpic" style="width:30px;height:30px;" />
                </div>
                
                <ul class="nav navbar-nav navbar-right">
                    <?php

                        $isread = 'send';
                        $managerID = $_SESSION['Username'];
                        $sql = "SELECT send_id FROM send_table WHERE _stat='$isread' AND _to = '$managerID'";
                        $query = $conn->query($sql);
                        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        $unreadcount = $query->num_rows;
                    ?>

                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            INBOX
                            <span class="label label-danger"><?php echo $unreadcount; ?></span>
                        </a>
                        <ul class="dropdown-menu" style="width:400px;">
                            <li class="thumbnail" style="padding-left:25px;">
                                <b>Go to: <a href="inbox1.php">INBOX</a></b>
                                <p>You have <?php echo $unreadcount; ?> message(s)</p>
                            </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <?php
                                    
                                    $isread = 'send';
                                    $sql = "SELECT information_table.Firstname,user_table.User_ID,user_table.Username,user_table.Email,send_table._sub,send_table._mes,send_table._stat,send_table.send_id,send_table.date_added FROM user_table INNER JOIN send_table ON user_table.User_ID = send_table.User_ID INNER JOIN information_table ON information_table.Information_ID=user_table.Information_ID WHERE send_table._stat = '$isread' AND user_table.User_ID = ".$_SESSION['User_ID'];

                                    $query = $conn->query($sql);
                                    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                
                                    if (mysqli_num_rows($query) > 0) {
                                        foreach ($results as $result) {
                                ?>

                                <ul class="menu">
                                    <li>
                                        <a href="read.php?id=<?php echo $result['send_id']; ?>" >
                                            <?php echo $result['Username']; ?>
                                            <p><?php echo $result['_sub']; ?> </p>
                                        </a>
                                    </li> <!-- End message -->     
                                </ul>

                                <?php 
                                        }
                                    } 
                                ?>
                            
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="CP.php">EDIT PROFILE</a></li>
                            <li><a href="editbusiness.php" data-toggle="modal" data-target="download/index.php">EDIT BUSINESS INFO</a></li>
                            <li><a href="download/index.php" data-toggle="modal" data-target="download/index.php">DOWNLOADABLE FORMS</a></li>
                            <li><a href="logout.php" onclick="return confirm('Are you sure to logout?');">LOGOUT</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
		</div>
	</nav>