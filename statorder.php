<!DOCTYPE html>
    <head>
        <title>Statistics</title>
        <meta charset="UTF-8">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./style31.css">
        <style>
        
            .container{
                width : 50%;
                height : auto;
                padding-top : 50px;
                margin-left : auto;
                margin-right : auto;
                background-color : beige;
               margin-top: 50px;
               border-radius: 10px;
               box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
            }
            #btn{
                margin: 10px;
            }
        </style>
    </head>
    <body onload="start()">
        <div class="container">
            <select id="mySelect" onchange="send()">
            </select>
            <div>
                สถิติการขายสินค้าทั้งหมด
            </div>
            <canvas id="graph"></canvas><br>
            <a href="index.php"><button id="btn" class="btn btn-primary">กลับสู้หน้าหลัก</button></a>
        </div>
        <?php
            include ('db.php');
            $product = $pdo->prepare("SELECT DtoOrder FROM orderpd GROUP BY DtoOrder");
            $product->execute();
            $len = $product->fetchall();
        ?>
        <script>
        function start(){
            const len = <?php echo json_encode($len); ?>;
            for (var i = 0; i < len.length; i++) {
                var option = document.createElement("option");
                option.value = len[i]['DtoOrder'];
                option.text = len[i]['DtoOrder'];
                option.selected = true;
                mySelect.appendChild(option);
            }
            send();
        }
        function send() {
            date = document.getElementById("mySelect").value;
            httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = showResult;
            var url= "datagraph.php?date="+date;
            
            httpRequest.open("GET", url);
            httpRequest.send();
        }
        let bar;
        checkg = true;
        function showResult() {
          if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            result = httpRequest.responseText;
           var obj = jQuery.parseJSON(result);
            console.log(obj);
                    let pname = [];
                    let view = [];
                    for(let i=0;i<obj.length;i++){
                        pname.push(obj[i]["productname"]+" "+obj[i]["size"]);
                        view.push(obj[i]["NumofSell"]);
                    }
                    let chartdata = {
                        labels: pname,
                        datasets: [{
                            label : "ยอดการขายสินค้า",
                            backgroundColor : [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 165, 0,1)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 165, 0,1)',
                            ],
                            hoverBackgroundColor: 'green',
                            data : view
                        }]
                    };
                    if(!checkg){
                        bar.destroy();
                    }
                    let graphTarget = $('#graph');
                    let bargraph = new Chart(graphTarget,{
                        type: 'bar',
                        data: chartdata
                    })
                    bar = bargraph;
                    checkg = false;
            }
        }
        </script>

    </body>

</html>