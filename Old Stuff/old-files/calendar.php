<link href="https://fonts.googleapis.com/css?family=Open+Sans:700|Roboto+Mono:300" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php

$GLOBALS['mrdb'] = new mysqli("localhost", "qmjezymy_rockers", "asdfghjkl12366", "qmjezymy_madrockers");
if ($GLOBALS['mrdb']->connect_error) {die("An error has occured.");}

date_default_timezone_set('America/Chicago');

/**
*@author  Xu Ding
*@email   thedilab@gmail.com
*@website http://www.StarTutorial.com
**/

class Calendar {

    /**
     * Constructor
     */
    public function __construct(){
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    /********************* PROPERTY ********************/
    private $dayLabels = array("S","M","T","W","R","F","S");

    private $currentYear=0;

    private $currentMonth=0;

    private $currentDay=0;

    private $currentDate=null;

    private $daysInMonth=0;

    private $naviHref= null;

    /********************* PUBLIC **********************/

    /**
    * print out the calendar
    */
    public function show() {
        $year  == null;
        $month == null;
        if(null==$year&&isset($_GET['year'])){
            $year = $_GET['year'];
        }else if(null==$year){
            $year = date("Y",time());
        }
        if(null==$month&&isset($_GET['month'])){
            $month = $_GET['month'];
        }else if(null==$month){
            $month = date("m",time());
        }
        $this->currentYear=$year;
        $this->currentMonth=$month;
        $this->daysInMonth=$this->_daysInMonth($month,$year);

        $content='<div id="calendarAndEventContainer">';
        $content.='<div id="calendar">'.
                        '<div class="box">'.
                        $this->_createNavi().
                        '</div>'.
                        '<div class="box-content">'.
                                '<ul class="label">'.$this->_createLabels().'</ul>';
                                $content.='<div class="clear"></div>';
                                $content.='<ul class="dates">';

                                $weeksInMonth = $this->_weeksInMonth($month,$year);
                                // Create weeks in a month
                                for( $i=0; $i<$weeksInMonth; $i++ ){

                                    //Create days in a week
                                    for($j=0;$j<=6;$j++){
                                        $content.=$this->_showDay($i*7+$j);
                                    }
                                }

                                $content.='</ul>';

                                $content.='<div class="clear"></div>';

                        $content.='</div>';

        $content.='</div>';

        //shows events on certain display
        $content.='<div id="events">
                      <div id="eventHeader"><h2>Upcoming Events</h2></div>
                      <div id="eventContainer">
                          <table style="width:100%">';

                          $result = $GLOBALS['mrdb']->query("SELECT name, calenderDate, hoursText FROM calender WHERE calenderDate >= CURTIME() ORDER BY calenderDate");
    											if ($result->num_rows>0)
                          {
        											$content.= " <tr>
                                      <th>Date</th>
                                      <th>Time</th>
                                      <th>Event</th>
                                      <th>Days Left</th>
                              </tr>";
                              while($row = $result->fetch_assoc()) {
                                $daysLeft=date("Y-m-d", strtotime($row['calenderDate'])) - date("Y-m-d");
                                if (date("Y-m-d", strtotime($row['calenderDate'])) == date("Y-m-d")) {
                                  $content.= "
                                      <tr>
                                      <td>Today</td>
                                      <td>".date("h:i A", strtotime($row['calenderDate']))."</td>
                                      <td>".$row['name']."</td>
                                      <td>".$daysLeft."</td>
                                      </tr>
                                      ";
                                }
                                else {
                                    $content.= " <tr>
                                          <td>".date("l, M d", strtotime($row['calenderDate']))."</td>
                                          <td>".date("h:i A", strtotime($row['calenderDate']))."</td>
                                          <td>".$row['name']."</td>
                                          <td>".$daysLeft."</td>
                                    </tr>";
                                }
    												  }
                          }
                          else {
                              $content.= "<center>No upcoming calendar events</center>";
                          }

        $content.='       </table>
                    </div>
                  </div>';
        $content.='</div>';

        return $content;
    }

    /********************* PRIVATE **********************/
    /**
    * create the li element for ul
    */
    private function _showDay($cellNumber){
        //Begin filling in first cell
        if($this->currentDay==0){

            $firstDayOfTheWeek = date('w',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));

            if(intval($cellNumber) == intval($firstDayOfTheWeek)){

                $this->currentDay=1;

            }
        }

        //2nd - Last Monthly Cells
        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){

            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));

            $cellContent = $this->currentDay;

            $this->currentDay++;

        }

        else{

            $this->currentDate =null;

            $cellContent=null;
        }

        //all calendar events that are upcoming
        $eventList = $GLOBALS['mrdb']->query("SELECT name, calenderDate, hoursText FROM calender WHERE calenderDate >= CURTIME() ORDER BY calenderDate");

        //previous days
        if (($this->currentDate) < date('Y-m-d') && ($this->currentDate-1) != null) {
            return '<li style="background-color: #171d22; opacity: 0.5;" id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                    ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
        }

        //current day AND/OR event today
        else if (($this->currentDate) == date('Y-m-d') && $eventList->num_rows>0) {
            while($row = $eventList->fetch_assoc()) {
              if (date('Y-m-d', strtotime($row['calenderDate'])) == ($this->currentDate)) {
                  return '<li style="background: linear-gradient(to top left, #1F47A9 50%, #CC483F 50%); " id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                          ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
              }
              else {
                  return '<li style="background-color: #1F47A9;" id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                        ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
              }
            }
        }

        //current day if no events in calendar
        else if (($this->currentDate) == date('Y-m-d')) {
            return '<li style="background-color: #1F47A9;" id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                  ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
        }

        //upcoming events
        else if ($eventList->num_rows>0)
        {
            while($row = $eventList->fetch_assoc()) {
              if (date('Y-m-d', strtotime($row['calenderDate'])) == $this->currentDate) {
                  return '<li style="background-color: #CC483F;" id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                          ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
              }
            }
        }

        //regular day
        else {
            return '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                    ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
        }

        return '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
    }

    /**
    * create navigation
    */
    private function _createNavi(){

        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;

        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;

        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;

        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;

        return
            '<div class="header">'.
                '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'"><i class="fa fa-chevron-left"></i></a>'.
                    '<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
                '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'"><i class="fa fa-chevron-right"></i></a>'.
            '</div>';
    }

    /**
    * create calendar week labels
    */
    private function _createLabels(){

        $content='';

        foreach($this->dayLabels as $index=>$label){

            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';

        }

        return $content;
    }



    /**
    * calculate number of weeks in a particular month
    */
    private function _weeksInMonth($month=null,$year=null){

        if( null==($year) ) {
            $year =  date("Y",time());
        }

        if(null==($month)) {
            $month = date("m",time());
        }

        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);

        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);

        //day of the week, not numerical day (e.g., Monday)
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));

        //Since 'N' returns 1-7, with Monday = 1, we need to set Sunday to 0 so that it comes before Monday
        if ($monthEndingDay == 7) {
          $monthStartDay = 0;
        }
        if ($monthStartDay == 7) {
          $monthStartDay = 0;
        }

        //Checks to see if the last day of the week is before the first
        if($monthEndingDay<$monthStartDay){

            $numOfweeks++;

        }

        return $numOfweeks;
    }

    /**
    * calculate number of days in a particular month
    */
    private function _daysInMonth($month=null,$year=null){

        if(null==($year))
            $year =  date("Y",time());

        if(null==($month))
            $month = date("m",time());

        //number of days in given month - that is what the 't' does
        return date('t',strtotime($year.'-'.$month.'-01'));
    }

}
