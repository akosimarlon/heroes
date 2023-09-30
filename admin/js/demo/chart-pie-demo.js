// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

$(document).ready(function() {  
  fetchchartdata1();
  setInterval(fetchchartdata1 , 10000);
  //fetchchartdata();
});

/* #### Bar Chart Example ##### */
function fetchchartdata1() {
  
$.ajax({      
  url: 'dataTeacherGender.php',
  type: 'POST',
  dataType: 'JSON',
  success: function (data) {
    var gend = [];    
    var data_array = [];
    var p;    
    //date = JSON.parse(data);
    
    for(var count=0; count<data.length; count++){
      if(data[count].sex == "male" ) {p = "male";}else{p = "female";}            
      gend.push(p);
      data_array.push(data[count].vals);   
         
    }
    
    data_array.max = function() { return  Math.max.apply(Math, this); };


    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: gend,
        datasets: [{
          data: data_array,
          backgroundColor: ['#4e73df', '#1cc88a'], //, '#36b9cc'
          hoverBackgroundColor: ['#2e59d9', '#17a673'], //, '#2c9faf'
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
