            <?php
                require "includes/connect.php";              

                            $sql =" SELECT User_ID.User_ID, business_table.business_Name as business_table FROM user_table, business_table LEFT JOIN user_table";

                                $result = $conn->query($sql);

                                if($results->num_rows)  {

                                    while($row = $results->fetch_object()) {
                                        echo"{$row->User_ID}({$row->business_Name})<br/>";
                                    }
                                }else {

                                    echo "no results";
                                }
                        
                        ?>