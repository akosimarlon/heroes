// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

$(document).ready(function() {  
  fetchchartdata3();
  setInterval(fetchchartdata3 , 10000);
  //fetchchartdata();
});

/* #### Bar Chart Example ##### */
function fetchchartdata3() {
  
$.ajax({      
  url: 'dataNonTeacherGender.php',
  type: 'POST',
  dataType: 'JSON',
  success: function (data) {
    var gend = [];    
    var data_array3 = [];
    var p;    
    //date = JSON.parse(data);
    
    for(var count=0; count<data.length; count++){
      if(data[count].sex == "male" ) {p = "male";}else{p = "female";}            
      gend.push(p);
      data_array3.push(data[count].vals);   
         
    }
    
    data_array3.max = function() { return  Math.max.apply(Math, this); };


    // Pie Chart Example
    var ctx = document.getElementById("myPieChart2");
    var myPieChart2 = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: gend,
        datasets: [{
          data: data_array3,
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
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });

  }
});

}
