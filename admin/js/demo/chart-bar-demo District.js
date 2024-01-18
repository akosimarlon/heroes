// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


$(document).ready(function() {
  fetchchartdata();
  setInterval(fetchchartdata , 10000);  
});



/* #### Bar Chart Example ##### */
function fetchchartdata() { 

$.ajax({      
  url: 'databyDistrict.php',
  type: 'POST',
  dataType: 'JSON',
  success: function (data) {
    var district = [];
    
    var data_array = [];
    var p,p2;
    var totaldata = 0,max=0;
    //date = JSON.parse(data);
    for(var count=0; count<data.length; count++){
      
      //positionlabel.push(data[count].poss);
      district.push(data[count].dists);
      //position.push(data[count].poss);
      data_array.push(data[count].vals);
      totaldata = parseInt(data[count].vals);
      if(totaldata > max){
        max = totaldata;
      }
      
    }
    max += 5;
    data_array.max = function() { return  Math.max.apply(Math, this); };
    
    var ctx = document.getElementById("myBarChart");
    var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: district,
        datasets: [{
          label: "Total",
          backgroundColor: "#5376df",
          hoverBackgroundColor: "#2e59d9",
          borderColor: "#5376df",
          data: data_array, //[12, 17, 4, 2, 1, 4, 0],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 6
            },
            maxBarThickness: 25,
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: max,
              maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return number_format(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
            }
          }
        },
      }
    });

    }
  });

}