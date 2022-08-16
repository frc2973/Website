<!-- Test PHP Handler --->

<!-- This file contains various functions for retrieving SQL information from MRDB. This will be referenced by webpages that need access to MRDB, reading and writing. --->

<?php
    
  function retrieveCalendar($db) {
    $calEvents = $db->query("SELECT id, name, calenderDate, hoursText FROM calender WHERE calenderDate >= CURTIME() ORDER BY calenderDate");
    if ($calEvents->num_rows==0) {
      echo "No upcoming events in calendar. Default schedule displayed";
    }
    else {
      echo "<tr>
             <th>ID</th>
             <th>Date</th>
             <th>Time</th>
             <th>Event</th>
             <th>Actions</th>
           </tr>";
      while($row = $calEvents->fetch_assoc())
      {
          echo "<tr>
                  <td>".$row['id']."</td>
                  <td>".date("l, M d", strtotime($row['calenderDate']))."</td>
                  <td>".$row['hoursText']."</td>
                  <td>".$row['name']."</td>
                  <td>Delete Button</td>
                </tr>";
      }
    }
  }
?>
