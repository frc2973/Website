<?php
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {

        header('location: http://rockers.enrog.com/mobile/mobile.php');
}


   include "pageParts/topPart.php";
?>

<script src="js/primScript.js"></script>
<link rel="stylesheet" type="text/css" href="css/index.css" />
<div style='position:relative;width:100vw;height:calc(100vh - 80px);overflow:hidden; '>
    <!-- Background -->
    <div class='mpBkg' style='position:absolute;left:0px;top:0px;width:100%;height: 100%;'>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
        <defs>
            <filter id="blur">
                <feGaussianBlur stdDeviation="5" />
            </filter>
        </defs>
    </svg>
        <!-- Activity Pane --->
        <div id='activityContainer'>
            <div id='activityImageLanding'>
                <div id='activityLogo'></div>
            </div>
            <div id='activityCalendar'>
                <a href='http://rockers.enrog.com/testPage.php'><div class='activityHeader'>
                    <h2 style='font-weight: lighter;'>Calendar</h2>
                </div></a>
                <div id='CalendarText' style='background-color: rgba(0,0,0,0.25); color: white;'>
                    <table style="width:100%">
                    <?php
										//Redo this to only capture upcoming dates, and only get the most recent ones. Calender date comparison should include today's calender events, but it might not.
                        $result = $GLOBALS['mrdb']->query("SELECT name, calenderDate, hoursText FROM calender WHERE calenderDate >= CURTIME() ORDER BY calenderDate LIMIT 5");
												if ($result->num_rows>0)
                        {
												echo " <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Event</th>
                        </tr>";
                             while($row = $result->fetch_assoc()) {
                               if (date("Y-m-d", strtotime($row['calenderDate'])) == date("Y-m-d")) {
                                 echo "
                                     <tr>
                                     <td>Today</td>
                                     <td>".date("h:i A", strtotime($row['calenderDate']))."</td>
                                     <td>".$row['name']."</td>
                                     </tr>
                                     ";
                               }
                               else {
                                echo "
                                    <tr>
                                    <td>".date("l, M d", strtotime($row['calenderDate']))."</td>
                                    <td>".date("h:i A", strtotime($row['calenderDate']))."</td>
                                    <td>".$row['name']."</td>
                                    </tr>
                                    ";
                                  }
															}
                        }
                        else {
                            echo "
                              <tr>
                                <th>Day</th>
                                <th>Time</th>
                              </tr>
                              <tr>
                                <td>Monday</td>
                                <td>4:00-8:30pm</td>
                              </tr>
                              <tr>
                                <td>Monday</td>
                                <td>6:00-8:30pm</td>
                              </tr>
                              <tr>
                                <td>Thursday</td>
                                <td>6:00-8:30pm</td>
                              </tr>
                              <tr>
                                <td>Saturday</td>
                                <td>9:00-4:00pm</td>
                              </tr>
                            ";

                        }
                    ?>
                    </table>
                </div>
            </div>
            <div id='activityBlog' class='collapseOnClick'>
                <div class='activityHeader'>
                    <a style='text-decoration: none; color: white; cursor: pointer;' href='http://rockers.enrog.com/blog.php'><h2 style='font-weight: lighter'>Latest Blog</h2></a>
                </div>
                <div id='BlogContent'>
                <?php
                $sql = "SELECT * FROM blogs ORDER BY time DESC LIMIT 1";
                $result = $GLOBALS['mrdb']->query($sql);
                if ($result->num_rows > 0)
                {
                  while ($row = $result->fetch_assoc()) {
                    $info = retrieveData($row['id']);
                    $strucd = blogRawToStructured(retrieveSource($info),$info);
                    $gimg2 = getImage($strucd['blog icon']);
                  echo
                  "
                  <div id='hoverContainer'>
                      <div id='nextBlogContainer'>
                          <span class='font' onclick='location.replace(\"blog.php?viewBlog=".$row['id']."\");' style='transform: translate(-50%,-50%); left: 50%; top: 50%; position:absolute;font-size: 20px; color: white; font-weight: bold;'>".$row['title']."</span>
                      </div>
    									<div class='ContentContainer'>
                          <div id='contentImg' style='height: 100%; background-color:rgba(0,0,0,0.25); background-image:url(".$gimg2['imageAddress']."); background-position: center; background-size: cover;' onclick='location.replace(\"blog.php?viewBlog=".$row['id']."\");'></div>
    									</div>
                  </div>
									";
                  }
                }
                ?>

                </div>
            </div>
        </div>
</div>

<link rel="stylesheet" type="text/css" href="css/about.css" />
<div style='display:none;'>
<?php include "pageParts/bottomPart.php"; ?>
