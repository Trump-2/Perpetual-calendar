<?php
	
  if(isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
  }else {
    // 這裡的 else 是為了處理如果進到網頁中網址沒有 month 參數時發生的錯誤訊息
    $month = date("m");
    $year = date('Y');
  
  }
  
	// 根據今天是星期幾決定要使用哪個背景圖片
	switch ($month) {
		case '0':
			$Bg = "./images/bg0.gif";
			break;
		case '1':
			$Bg = "./images/bg1.gif";
			break;
		case "2":
			$Bg = "./images/bg2.gif";
			break;
		case "3":
			$Bg = "./images/bg3.gif";
			break;
		case "4":
			$Bg = "./images/bg4.gif";
			break;
		case "5":
			$Bg = "./images/bg5.gif";
			break;
		case "6":
			$Bg = "./images/bg6.gif";
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="#">
  <title>萬年曆作業</title>
  <style>
  /*請在這裹撰寫你的CSS*/
  table {
    border-collapse: collapse;
    border: 3px double #999;

  }

  td {
    border: 1px solid #999;
    padding: 5px 10px;
    text-align: center;
  }
  </style>
</head>

<body style="background-image:url('<?php echo $Bg ?>')">

  <h1>萬年曆</h1>

  <?php
/*請在這裹撰寫你的萬年曆程式碼*/  
if(isset($_GET['month']) && isset($_GET['year'])) {
  $month = $_GET['month'];
  $year = $_GET['year'];
}else {
  // 這裡的 else 是為了處理如果進到網頁中網址沒有 month 參數時發生的錯誤訊息
  $month = date("m");
  $year = date('Y');

}

  echo "<h3 style='text-align:center'>";
  echo date("西元{$year}年{$month}月");
  echo "</h3>";

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
  <div style='width:264px;display:flex;margin:auto;justify-content:space-between'>
    <?php
if($month  > 11 ) {
  $next = 1;
  $nextYear = $year + 1;
}
else {
  $next = $month + 1;
  $nextYear = $year;

}

if ($month  < 2) {
 $prev = 12;
  $prevYear = $year - 1;
}
else {
  $prev = $month - 1;
  $prevYear = $year;
}

  ?>
    <a href='?year=<?=$prevYear?>&month=<?=$prev?>'>上一個月</a>
    <a href='?year=<?=$nextYear?>&month=<?=$next?>'>下一個月</a>
  </div>
  <table style='margin:auto'>
    <tr>
      <td>日</td>
      <td>一</td>
      <td>二</td>
      <td>三</td>
      <td>四</td>
      <td>五</td>
      <td>六</td>
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

  
?>

</body>

</html>