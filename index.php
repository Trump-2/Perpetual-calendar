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
    $Bg = "./images/bookmarks/bm1.webp";
    break;
  case '2':
    $Bg = "./images/bookmarks/bm2.webp";
    break;
  case "3":
    $Bg = "./images/bookmarks/bm3.webp";
    break;
  case "4":
    $Bg = "./images/bookmarks/bm4.webp";
    break;
  case "5":
    $Bg = "./images/bookmarks/bm5.webp";
    break;
  case "6":
    $Bg = "./images/bookmarks/bm6.webp";
    break;
  case "7":
    $Bg = "./images/bookmarks/bm7.webp";
    break;
  case "8":
    $Bg = "./images/bookmarks/bm8.webp";
    break;
  case "9":
    $Bg = "./images/bookmarks/bm9.webp";
    break;
  case "10":
    $Bg = "./images/bookmarks/bm10.webp";
    break;
  case "11":
    $Bg = "./images/bookmarks/bm11.webp";
    break;
  case "12":
    $Bg = "./images/bookmarks/bm12.webp";
    break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="#">
  <link rel="stylesheet" href="style.css">
  <title>萬年曆作業</title>

</head>

<!-- <body style="background-image:url('<?php echo $Bg ?>')"> -->

<body>


  <?php
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
  


  if ($month > 11) {
    $next = 1;
    $nextYear = $year + 1;
  } else {
    $next = $month + 1;
    $nextYear = $year;
  }

  if ($month < 2) {
    $prev = 12;
    $prevYear = $year - 1;
  } else {
    $prev = $month - 1;
    $prevYear = $year;
  }

  ?>


  <div class="big-container">

    <div class="container">
      <div class=header>
        <div class="title"><span>P</span>erpetual<span> c</span>alendar</div>

        <div class="none"></div>
        <div class="return"> <a href='?year=<?= date('Y') ?>&month=<?= date('n') ?>'><i
              class="fa-solid fa-rotate-right"></i></a>
        </div>
        <div class="clock">
          <span id="hours"></span>
          <span>:</span>
          <span id="minutes"></span>
          <span>:</span>
          <span id="seconds"></span>
        </div>
      </div>
      <div class="box">
        <a class="prev" href='?year=<?= $prevYear ?>&month=<?= $prev ?>'><i class="fa-regular fa-circle-left"></i></a>
        <div class='aside-div'>
          <aside>
            <img src="<?php echo $Bg ?>" alt="">
          </aside>
        </div>
        <div class="main-div">
          <main>
            <div class=month-year>
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
            <table>
              <tr>
                <th>Sun.</th>
                <th>Mon.</th>
                <th>Tue.</th>
                <th>Wed.</th>
                <th>Thu.</th>
                <th>Fri.</th>
                <th>Sat.</th>
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
                  if ((date('w', $thisCellDate) == 0 || date('w', $thisCellDate) == 6) && date('Y-m-j') == date('Y-m-j', $thisCellDate)) {
                    echo "<td class='today-weekend'>";
                  } else if (date('w', $thisCellDate) == 0 || date('w', $thisCellDate) == 6) {
                    echo "<td class='weekend'>";
                  } else if (date('Y-m-j') == date('Y-m-j', $thisCellDate)) {
                    echo "<td class='today'>";
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
              echo "</table>";


              // 根據月份印出不同的名言
              echo "<div class='saying'>";
              echo "<div>";
              for ($i = 0; $i <= 11; $i++) {
                if ($month == $i + 1) {
                  echo $sayingArr[$i];
                }
              }
              echo "</div>";
              echo "</div>";
              ?>
          </main>

        </div>
        <a class="next" href='?year=<?= $nextYear ?>&month=<?= $next ?>'><i
            class="fa-regular fa-circle-left fa-flip-horizontal"></i></a>
      </div>
    </div>
    <div class="container2"></div>
    <div class="container3">
      <form action="index.php" method="get">
        <div>Search</div>
        <input type="text" name="year" placeholder="Year" required="">
        <select name="month">
          <option value="1">Jan.</option>
          <option value="2">Feb.</option>
          <option value="3">Mar.</option>
          <option value="4">Apr.</option>
          <option value="5">May.</option>
          <option value="6">Jun.</option>
          <option value="7">Jul.</option>
          <option value="8">Aug.</option>
          <option value="9">Sep.</option>
          <option value="10">Oct.</option>
          <option value="11">Nov.</option>
          <option value="12">Dec.</option>
        </select>
        <input type="submit" value="Go !">
      </form>
    </div>

  </div>

  <script>
    function updateClock() {
      var now = new Date();
      var hours = now.getHours().toString().padStart(2, '0');
      var minutes = now.getMinutes().toString().padStart(2, '0');
      var seconds = now.getSeconds().toString().padStart(2, '0');
      // var timeString = hours + ':' + minutes + ':' + seconds;

      // document.getElementById('clock').textContent = timeString;
      document.getElementById('hours').textContent = hours;
      document.getElementById('minutes').textContent = minutes;
      document.getElementById('seconds').textContent = seconds;

    }

    // 初次載入頁面時執行
    updateClock();

    // 每秒更新一次
    setInterval(updateClock, 1000);
  </script>


</body>

</html>