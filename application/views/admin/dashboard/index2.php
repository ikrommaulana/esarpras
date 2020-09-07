

<html>
<head>
  <title>Membuat Grafik Dengan Menggunakan Chart.js - www.malasngoding.com</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>
  <style type="text/css">
    body{
      font-family: roboto;
    }
  </style>
 
  <h2>Tutorial Membuat Grafik Dengan Chart.js - www.malasngoding.com</h2>
 
 
 
  <div style="width: 500px;height: 500px">
    <canvas id="myChart"></canvas>
  </div>
 
 
  <script>
   var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
    },

    // Configuration options go here
    options: {}
});
  </script>
</body>
</html>