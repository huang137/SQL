<html>
<head>
    <title>Assignment 4</title>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
		
    <?php 
        require_once 'loginb.php';
        function get_post($conn, $var) {
            return $conn->real_escape_string($_POST[$var]);
        }
        
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);
            
        $category_counts = $conn->query("SELECT COUNT(*) AS cnt, category FROM classics GROUP BY category;");
        
        if(!$category_counts) {
            die($conn->error);
        }
    ?>
    
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
              ['', '']
              <?php
                  echo " ,['Fiction', 3], ['Non-Fiction', 1], ['Play', 1]";
                  
              ?>
            ]);
            
          var options = {'width':550, 'height':400};
          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
          chart.draw(data, options);
        }
    </script>
</head>
<body>

<div id="piechart"></div>
    
</body>
</html>