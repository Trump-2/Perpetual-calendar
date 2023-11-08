<?php
// echo date("Y-m-d");
if (isset($_GET['month']) && isset($_GET['year'])) {
  $month = $_GET['month'];
  $year = $_GET['year'];
} else {
  // 這裡的 else 是為了處理如果進到網頁中網址沒有 month 參數時發生的錯誤訊息
  $month = date("n");
  $year = date('Y');
}

// 根據今天是星期幾決定要使用哪個背景圖片
switch ($month) {
  case '1':
    $Bg = "./images/bg0.gif";
    break;
  case '2':
    $Bg = "./images/bg1.gif";
    break;
  case "3":
    $Bg = "./images/bg2.gif";
    break;
  case "4":
    $Bg = "./images/bg3.gif";
    break;
  case "5":
    $Bg = "./images/bg4.gif";
    break;
  case "6":
    $Bg = "./images/bg5.gif";
    break;
  case "7":
    $Bg = "./images/bg6.gif";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>萬年曆作業</title>

</head>

<body style="background-image:url('<?php echo $Bg ?>')">

  <h1>萬年曆</h1>
  <?php
  /*請在這裹撰寫你的萬年曆程式碼*/
  // if(isset($_GET['month']) && isset($_GET['year'])) {
  //   $month = $_GET['month'];
  //   $year = $_GET['year'];
  // }else {
  //   // 這裡的 else 是為了處理如果進到網頁中網址沒有 month 參數時發生的錯誤訊息
  //   $month = date("m");
  //   $year = date('Y');

  // }

  // 名言的array
  $sayingArr = ['From error to error one discovers the entire truth.', 'The only impossible journey is the one you never begin.', 'Strength and growth come only through continuous effort and struggle.', 'However difficult life may seem, there is always something you can do and succeed at.', 'The beautiful thing about learning is nobody can take it away from you.', 'I am always doing that which I cannot do, in order that I may learn how to do it.', 'There is no such thing as a great talent without great will - power.', 'I don\'t wait for moods. You accomplish nothing if you do that. Your mind must know it has got down to work.', 'You can overcome anything, if and only if you love something enough.', 'Talent without working hard is nothing.', 'Find a group of people who challenge and inspire you; spend a lot of time with them, and it will change your life.', 'Life is like a game of cards. The hand you are dealt is determinism; the way you play it is free will.'];


  // 顯示每個月 1 號的日期格式
  $thisFirstDay = date("{$year}-{$month}-1");
  // 算出每個月 1 號是星期幾，w 代表 0 是星期日依此類推
  $thisFirstDay_Dayoftheweek = date('w', strtotime($thisFirstDay));
  // 算出每個月個別有幾天，也就是總天數
  $thisMonthDays = date("t");
  // 算出每個月最後一天的日期格式，又因為每個月的天數可以推算出每個月最後一天是幾號 ( 例如：28天，代表該月最後一天為 28 號 )，所以利用 $thisMonthDays
  $thisLastDay = date("{$year}-{$month}-$thisMonthDays");
  // 算出每個月有幾周； 利用每個月的總天數 + 每個月第一周 1 號前面的空白天數 ( 剛好等於 1 號是星期幾的值 )，然後再除以 7，最後取無條件進位得出
  $weeks = ceil(($thisMonthDays + $thisFirstDay_Dayoftheweek) / 7);
  // 算出第一周第一天的日期；利用每個月一號 ( 轉成秒數 ) - 每個月第一周 1 號前面的空白天數 ( 剛好等於 1 號是星期幾的值 )，最後再轉換成日期格式
  $firstCellDate = date("Y-m-d", strtotime("-$thisFirstDay_Dayoftheweek days", strtotime($thisFirstDay)));
  // echo $firstCellDate;


  ?>
  <!-- style='width:500px;display:flex;margin:auto;justify-content:space-between' -->
  <div>
    <?php
    if ($month  > 11) {
      $next = 1;
      $nextYear = $year + 1;
    } else {
      $next = $month + 1;
      $nextYear = $year;
    }

    if ($month  < 2) {
      $prev = 12;
      $prevYear = $year - 1;
    } else {
      $prev = $month - 1;
      $prevYear = $year;
    }


    // echo "<h3 style='text-align:center'>";
    // echo date("西元{$year}年{$month}月");
    // echo "</h3>";


    ?>
    <a href='?year=<?= $prevYear ?>&month=<?= $prev ?>'>Prev</a>
    <a href='?year=<?= date('Y') ?>&month=<?= date('n') ?>'>Now</a>
    <a href='?year=<?= $nextYear ?>&month=<?= $next ?>'>Next</a>

    <div class="month">
      <?php
      echo date('M', strtotime(date("Y-$month-1")));
      ?>
    </div>
    <div class="year">
      <?php
      echo $year;
      ?>
    </div>

  </div>
  <div class="circle"></div>
  <div class="container">
    <div class='aside-div'>
      <aside>
        123
      </aside>
    </div>
    <div class="main-div">

      <main>

        <table>
          <tr>
            <td>Sun</td>
            <td>Mon</td>
            <td>Tue</td>
            <td>Wed</td>
            <td>Thu</td>
            <td>Fri</td>
            <td>Sat</td>
          </tr>
          <?php
          // $i 影響週數
          for ($i = 0; $i < $weeks; $i++) {
            echo "<tr>";
            // $j 影響一週有幾天
            for ($j = 0; $j < 7; $j++) {
              // 從每月第一周的第一天開始每天遞增 1，從加 0 開始
              $addDays = 7 * $i + $j;
              // 從每月第一周的第一天的那格開始，算出每格的秒數
              $thisCellDate = strtotime("+$addDays days", strtotime($firstCellDate));
              // 判斷格子中的日期是星期幾，0代表星期日(依此類推)，因為這裡要讓假日的 background-color 改變，也就是星期為 0 或 6 的，所以將其作為判斷條件
              if (date('w', $thisCellDate) == 0 || date('w', $thisCellDate) == 6) {
                echo "<td style='background-color:lightgreen'>";
              } else if (date('Y-m-j') == date('Y-m-j', $thisCellDate)) {
                echo "<td style='color:red'>";
              } else {
                echo "<td>";
              }
              // 判斷格子中的日期的月份是否為每月 1 號代表的日期格式裡的月份相等，因為這裡要將不是該月份的日期不顯示出來
              if (date("m", $thisCellDate) == date('m', strtotime($thisFirstDay))) {
                echo date("j", $thisCellDate);
              }
              echo "</td>";
            }
            echo "</tr>";
          }
          echo "<tr >";
          echo "<td colspan='7'>";

          // 根據月份印出不同的名言
          for ($i = 0; $i <= 11; $i++) {
            if ($month == $i + 1) {
              echo $sayingArr[$i];
            }
          }

          echo "</td>";

          echo "</tr>";
          echo "</table>";
          ?>
      </main>

    </div>
  </div>

  <div id="current-time"></div>

  <script>
    function updateTime() {
      var currentTime = new Date();
      var hours = currentTime.getHours();
      var minutes = currentTime.getMinutes();
      var seconds = currentTime.getSeconds();
      var formattedTime = hours + ':' + minutes + ':' + seconds;
      document.getElementById('current-time').innerHTML = formattedTime;
    }

    setInterval(updateTime, 1000); // 每秒更新一次時間
  </script>

  <!-- <script language="JavaScript">
    function ShowTime() {
      var now = new Date();
      hr = ('0' + now.getHours()).substr(-2);
      min = ('0' + now.getMinutes()).substr(-2);
      sec = ('0' + now.getSeconds()).substr(-2);
      document.getElementById('Time').innerHTML = hr + ' : ' + min + ' : ' + sec;
      setTimeout('ShowTime()', 1000);
    }
  </script> -->
</body>

</html>