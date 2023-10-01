// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

$(document).ready(function() {  
  fetchchartdata5();
  setInterval(fetchchartdata5 , 10000);
  //fetchchartdata();
});

/* #### Bar Chart Example ##### */
function fetchchartdata5() {
  
$.ajax({      
  url: 'dataTeachingRelatedGender.php',
  type: 'POST',
  dataType: 'JSON',
  success: function (data) {
    var gend = [];    
    var data_array5 = [];
    var p;    
    //date = JSON.parse(data);
    
    for(var count=0; count<data.length; count++){
      if(data[count].sex == "male" ) {p = "male";}else{p = "female";}            
      gend.push(p);
      data_array5.push(data[count].vals);   
         
    }
    
    data_array5.max = function() { return  Math.max.apply(Math, this); };


    // Pie Chart Example
    var ctx = document.getElementById("myPieChart3");
    var myPieChart3 = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: gend,
        datasets: [{
          data: data_array5,
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
