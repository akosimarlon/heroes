// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

$(document).ready(function() {  
  fetchchartdata2();
  setInterval(fetchchartdata2 , 10000);
  //fetchchartdata();
});

/* #### Bar Chart Example ##### */
function fetchchartdata2() {
  
$.ajax({      
  url: 'dataTeacherGender.php',
  type: 'POST',
  dataType: 'JSON',
  success: function (data) {
    var gend = [];    
    var data_array2 = [];
    var p;    
    //date = JSON.parse(data);
    
    for(var count=0; count<data.length; count++){
      if(data[count].sex == "male" ) {p = "male";}else{p = "female";}            
      gend.push(p);
      data_array2.push(data[count].vals);   
         
    }
    
    data_array2.max = function() { return  Math.max.apply(Math, this); };


    // Pie Chart Example
    var ctx1 = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx1, {
      type: 'doughnut',
      data: {
        labels: gend,
        datasets: [{
          data: data_array2,
          backgroundColor: ['#00CED1', '#FF69B4'], //, '#36b9cc'
          hoverBackgroundColor: ['#40E0D0', '#FF1493'], //, '#2c9faf'
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: true,
          caretPadding: 10,
        },
        legend: {
          display: true
        },
        cutoutPercentage: 80,
      },
    });

  }
});

}
