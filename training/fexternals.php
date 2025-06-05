<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
 <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
  <script src="assets/js/plugins/jQuery-3/jquery-3.0.0.js"></script>
  <script src="assets/js/plugins/jquery-ui-1.13.1/jquery-ui.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script>
    // Set the timeout duration in milliseconds (e.g., 5000 milliseconds = 5 seconds)
// const timeoutDuration = 50000;

// Function to refresh the page
// function refreshPage() {
//   alert("You Have More Time To Use This Page So We Want To Refresh This Site Are You Sure To Refresh This Browser ?");
//   location.reload(); // Reload the current page
// }

// Set the timeout to call the refreshPage function after the specified duration
// setTimeout(refreshPage, timeoutDuration);
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#fff",
          data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 15,
              font: {
                size: 14,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false
            },
            ticks: {
              display: false
            },
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

          },
          {
            label: "Websites",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#212529",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            fill: true,
            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            maxBarThickness: 6
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>  
<script src="vendor/select2/js/select2.min.js"></script>
<script src="vendor/select3/js/select3.min.js"></script>
<script src="vendor/select4/js/select4.min.js"></script>
<script src="vendor/select5/js/select5.min.js"></script>
<script src="vendor/select6/js/select6.min.js"></script>
<script>$(document).ready(function(){	if($("#myToast"))	{    $("#myToast").toast("show");	}});</script>
  <script>
	  // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
	<?php
	if(isset($_SESSION['franchisesession']))
	{
		?>
		$(".franchise-session").val("<?=$_SESSION['franchisesession']?>");
		<?php
	}
	?>
	
function template(data) {
  return data.html;
}
    $('.franchise-session').select3();
    $('.select4').select4();
    $('.select5').select5();
$(function(){
$("#enquiryterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#quotationterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#estimateterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#proformaterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#jobterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#salesorderterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#deliverychallanterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#invoiceterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#paymentmode").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#salesreturnterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#purchaseorderterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#purchasereceiveterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#billterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#purchasereturnterm").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#duedates").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#saleperson").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#defaultunit").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
$("#category").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
$(function(){
  // for select search problem solving
$(".select2-field").select2({
matcher: matchCustom
});
$("#subcategory").select2({
matcher: matchCustom
});
$("#custcategory").select2({
matcher: matchCustom
});
$("#custsubcategory").select2({
matcher: matchCustom
});
$("#prodefaultunit").select2({
matcher: matchCustom
});
$("#procategory").select2({
matcher: matchCustom
});
$("#prosubcategory").select2({
matcher: matchCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
    $('.reportcatsearch').select4({
                width: '100%',
                ajax: {
                    url: "reportcatsearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });
                  $('.reportpreparedsearch').select4({
                width: '100%',
                ajax: {
                    url: "reportpreparedsearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });
            $('.reportcheckedsearch').select4({
                width: '100%',
                ajax: {
                    url: "reportcheckedsearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });
    $('.reportpaytermsearch').select4({
                width: '100%',
                ajax: {
                    url: "reportpaytermsearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });
    $('.reportcustsearch').select4({
                width: '100%',
                ajax: {
                    url: "reportcustsearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });
    $('.reportvensearch').select4({
                width: '100%',
                ajax: {
                    url: "reportvensearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });
    $('.customerinlist').select4({
                width: '100%',
                ajax: {
                    url: "inlistcustsearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });
    $('#customer').select2({
                width: '100%',
                ajax: {
                    url: "inlistcustsearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });
    $('#vendor').select2({
                width: '100%',
                ajax: {
                    url: "inlistvensearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });
            
function template(data) {
  return data.html;
}

$(".adjustingproduct1").select2({
                width: '100%',
                ajax: {
                    url: "inlistadjustprosearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });

$(".reportproducts").select4({
                width: '100%',
                ajax: {
                    url: "inlistrepprosearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });

$(".product1").select2({
                width: '100%',
                ajax: {
                    url: "inlistprosearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });
    $('.select2-field').select2({
		tags: "true"
	});
});
</script>
<script>
	$("#iconNavbarSidenav").click(function(){
	if ($("body").hasClass("g-sidenav-hidden")) {
		$("body").removeClass("g-sidenav-hidden");
	}
	else
	{
		$("body").addClass("g-sidenav-hidden");
	}
});

</script>
<!-- <script type="text/javascript">
$("#state").autocomplete({
    source: ["JAMMU AND KASHMIR (1)", "ANDAMAN AND NICOBAR ISLANDS (35)", "ANDHRA PRADESH (NEWLY ADDED) (37)","ANDHRA PRADESH(BEFORE DIVISION) (28)","ARUNACHAL PRADESH (12)","ASSAM (18)","BIHAR (10)","CENTRE JURISDICTION (99)","CHANDIGARH (4)","CHATTISGARH (22)","DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)","DELHI (7)","GOA (30)","GUJARAT (24)","HARYANA (6)","HIMACHAL PRADESH (2)","JAMMU AND KASHMIR (1)","JHARKHAND (20)","KARNATAKA (29)","KERALA (32)","LADAKH (NEWLY ADDED) (38)","LAKSHADWEEP (31)","MADHYA PRADESH (23)","MAHARASHTRA (27)","MANIPUR (14)","MEGHALAYA (17)","MIZORAM (15)","NAGALAND (13)","ODISHA (21)","OTHER TERRITORY (97)","PUDUCHERRY (34)","PUNJAB (3)","RAJASTHAN (8)","SIKKIM (11)","TAMIL NADU (33)","TELANGANA (36)","TRIPURA (16)","UTTAR PRADESH (9)","UTTARAKHAND (5)","WEST BENGAL (19)"],
    minLength: 1,
}).focus(function () {
    $(this).autocomplete("search");
});
</script> -->
<script type="text/javascript">
 $("#salute").autocomplete({
    source: ["Mr.", "Mrs.", "Dr.","Ms.","Miss."],
    minLength: 0,
}).focus(function () {
    $(this).autocomplete("search");
});
function companynames(){
   var pcontact=document.getElementById("pcontact").value;
   var companyname=document.getElementById("companyname").value;
   // if (pcontact!="") {
    // document.getElementById('customerdname').value=companyname;
    $("#customerdname").autocomplete({
    source: [companyname,pcontact],
    minLength: 0,
}).focus(function () {
    $("#customerdname").autocomplete("search");
});          
    //}
   }
</script>
                                                           <script type="text/javascript">
                                                                        const wrapper = document.querySelector(".wrapper"),
        selectBtn = wrapper.querySelector(".select-btn"),
        options = wrapper.querySelector(".options"),
        searchInp = wrapper.querySelector("input");
        let values = ["jsfd","jhfdsgydsf","bcsgfdy","dshgjbd","adjy","dsfhdjjh"];
        function addValues(selectedValue) {
            options.innerHTML = "";
            values.forEach(value => {
                let isSelected = value == selectedValue ? "selected" : "";
                let li = `<li onclick="updateName(this)" class="${isSelected}">${value}</li>`;
                options.insertAdjacentHTML("beforeend", li);
            });
        }
        addValues();
        function updateName(selectedLi){
            searchInp.value = "";
            addValues(selectedLi.innerText);
            wrapper.classList.remove("active");
            selectBtn.firstElementChild.innerText = selectedLi.innerText;
        }
        searchInp.addEventListener("keyup", () => {
            let arr = [];
            let searchedVal = searchInp.value;
            arr = values.filter(data => {
                return data.toLowerCase().startsWith(searchedVal);
            }).map(data => `<li onclick="updateName(this)">${data}</li>`).join("");
            options.innerHTML = arr ? arr : `<p>No Results Found</p>`;
        });
        selectBtn.addEventListener("click", () => {
            wrapper.classList.toggle("active");
        });
        
</script>
<script type="text/javascript">
 <?php
if ($current_file_name=='products.php'||$current_file_name=='services.php') {
?>
           $(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
// ajax for get
$.ajax({
type: "GET",
url: 'listallsearch.php?term=products&searchTerm='+ value +'',
success: function (result) {
$("#myTable").html(result);
if (result == ''){
<?php
if ($access['propageload']=='pagenum') {
?>
$('#page-link0').click();
<?php
}
?>
}
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
  });
  $("#servsearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
// ajax for get
$.ajax({
type: "GET",
url: 'listallsearch.php?term=services&searchTerm='+ value +'',
success: function (result) {
$("#myTable").html(result);
if (result == ''){
<?php
if ($access['servpageload']=='pagenum') {
?>
$('#page-link0').click();
<?php
}
?>
}
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
  });
});    
    window.setMobileTable = function(selector) {
        // if (window.innerWidth > 600) return false;
        const tableEl = document.querySelector(selector);
        const thEls = tableEl.querySelectorAll('thead th');
        const tdLabels = Array.from(thEls).map(el => el.innerText);
        tableEl.querySelectorAll('tbody tr').forEach(tr => {
            Array.from(tr.children).forEach(
                (td, ndx) => td.setAttribute('label', tdLabels[ndx])
            );
        });
    }
    function tableEditorremove() {
        $('#tableEditor').remove();
        return false;
    }
    $(".checkbox-dropdown").click(function() {
        $(this).toggleClass("is-active");
    });

    $(".checkbox-dropdown ul").click(function(e) {
        e.stopPropagation();
    });








    $("#name").click(function(e) {
        var checkbox = $(this);
        if (checkbox.is(":checked")) {
            //check it 
        } else {
            // prevent from being unchecked
            this.checked = !this.checked;
        }
    });



    $("#rate").click(function(e) {
        var checkbox = $(this);
        if (checkbox.is(":checked")) {
            //check it 
        } else {
            // prevent from being unchecked
            this.checked = !this.checked;
        }
    });


    if ($('#name').is(":checked")) {
        // it is checked  
        //alert("Name column is checked")
    }
    if ($('#rate').is(":checked")) {
        // it is checked  
        //alert("rate column is checked")
    }
    $(function() {
        var $chk = $(".grpChkBox input:checkbox");
        var $tbl = $("#someTable");
        var $tblhead = $("#someTable th");

        $chk.prop('checked', true);

        $chk.click(function() {
            var colToHide = $tblhead.filter("." + $(this).attr("name"));
            var index = $(colToHide).index();
            $tbl.find('tr :nth-child(' + (index + 1) + ')').toggle();
        });
    });


    function funaddcolumn() {
        
       // $('#grpChkBox').css("display" , "none");
    }
    var buttons = document.querySelectorAll('.arlina-button');

    Array.prototype.slice.call(buttons).forEach(function(button) {

        var resetTimeout;

        button.addEventListener('click', function() {

            if (typeof button.getAttribute('data-loading') === 'string') {
                button.removeAttribute('data-loading');
            } else {
                button.setAttribute('data-loading', '');
            }

            clearTimeout(resetTimeout);
            resetTimeout = setTimeout(function() {
                button.removeAttribute('data-loading');
            }, 1000);

        }, false);

    });                 
<?php
}
?>
 <?php
if ($current_file_name=='productadd.php'||$current_file_name=='productedit.php'||$current_file_name=='serviceadd.php'||$current_file_name=='serviceedit.php') {
?>
$(document).ready(function() {

        $("#defaultunit").change(function(event) {

            $('.unitchange span').html($(this).val());
        });
    });
    $('#purchaseunit').on('change', function() {
        var defaultunitval = $('#defaultunit').find(":selected").val();
        var purchaseunitval = $('#purchaseunit').find(":selected").val();
        if (defaultunitval === purchaseunitval) {
            $('#purchaseindunit1').attr('disabled', true);
        } else {
            $('#purchaseindunit1').attr('disabled', false);
        }
    });

    $('#salesunit').on('change', function() {
        var defaultunitval = $('#defaultunit').find(":selected").val();
        var salesunittval = $('#salesunit').find(":selected").val();
        if (defaultunitval === salesunittval) {
            $('#saleindunit').attr('disabled', true);
        } else {
            $('#saleindunit').attr('disabled', false);
        }
    });
    var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        },
        updateIndex = function(e, ui) {
            $('td.index', ui.item.parent()).each(function(i) {
                $(this).html(i + 1);
            });
            $('input[type=text]', ui.item.parent()).each(function(i) {
                $(this).val(i + 1);
            });
        };
    $("#purchasetable tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();
    $("tbody").sortable({
        distance: 5,
        delay: 100,
        opacity: 0.6,
        cursor: 'move',
        update: function() {}
    });
    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();
        $('#reportrange1').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            },
            "alwaysShowCalendars": true,
            "applyClass": "btn-custom",
            "cancelClass": "btn-custom-grey"
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                .format('YYYY-MM-DD'));
        });
    });
    $("#subcategory").select2({
        placeholder: "Select Country",
        allowClear: true
    });
    function taxable() {
       document.getElementById('taxablediv').style.display = "block";
       document.getElementById('nontaxablediv').style.display = "none";
    }
    function nontaxable() {
       document.getElementById('taxablediv').style.display = "none";
       document.getElementById('nontaxablediv').style.display = "block";
    }
    $(function() {
        $("#invoicesuffix").autocomplete({
            source: 'invoicesuffixsearch.php',
            select: function(event, ui) {
                $("#invoicesuffix").val(ui.item.invoicesuffix);
                $("#city").val(ui.item.city);
                $("#district").val(ui.item.district);
                $("#state").val(ui.item.state);
                $("#pincode").val(ui.item.pincode);
            },
            minLength: 2
        });
        $("#email").autocomplete({
            source: 'franchisesearch.php?type=email',
        });
    });
    $("#defaultunit").on("change", function() {
        var sOptionVal = $(this).val();
        if (sOptionVal == '#AddNewDefaultUnit') {
            $('#AddNewDefaultUnit').modal('show');
        }
    });
    $(function() {
        $("#productname").autocomplete({
            source: 'productsearch.php?type=productname',
        });
        $("#category").autocomplete({
            source: 'productsearch.php?type=category',
        });
    });
    let lineNo = 2;
    $(document).ready(function() {
        $(".purchaseadd-row").click(function() {
            markup =
                '<tr><td style="width:3%;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td style="width:18%;"><input type="hidden" name="productid[]" id="productid1"><input type="text" name="productname[]" id="productname1' +
                lineNo +
                '" required class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title=""></td><td style="width:11%;"><div class="input-group mb-3 input-group-sm"><div class="input-group-prepend"><span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $res[0]; ?></span></div><input type="age" min="0" name="quantity[]" required id="quantity1' +
                lineNo +
                '" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)"></div><td style="width: 6%;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $res[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1' +
                lineNo +
                '" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td><td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1' +
                lineNo +
                '" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td><td style="width:3%;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>';
            tableBody = $("#purchasetable");
            tableBody.append(markup);
            renumber_table('#purchasetable');
            lineNo++;
        });
    });
    let linesNo = 2;
    $(document).ready(function() {
        $(".saleadd-row").click(function() {
            markup =
                '<tr><td data-label="" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td data-label="PRICE NAME" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><input type="hidden" name="productid[]" id="productid1"><input type="text" name="productname[]" id="productname1" required class="form-control form-control-sm bordernoneinput bor"  style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title="" placeholder="Sale Price or Trade Price or Wholesale Price"></td><td data-label="MRP" style="padding-bottom:0px !important;margin-bottom: -18px !important;padding-top: 13.2px !important;"><div class="input-group mb-3 input-group-sm"><div class="input-group-prepend"><span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $res[0]; ?></span></div><input type="age" min="0" name="quantity[]" required id="quantity1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)"></div></td><td data-label="SELLING PRICE" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $res[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td><td data-label="DESCRIPTION" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td><td data-label="" style="padding-bottom: 9px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-deletes" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td></tr>';
            tableBody = $("#saletable");
            tableBody.append(markup);
            var start = moment().subtract(29, 'days');
            var end = moment();
            $('#reportrange' + linesNo).daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
                        .subtract(1, 'month').endOf('month')
                    ]
                },
                "alwaysShowCalendars": true,
                "applyClass": "btn-custom",
                "cancelClass": "btn-custom-grey"
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') +
                    ' to ' + end.format('YYYY-MM-DD'));
            });
            renumber_table('#saletable');
            linesNo++;
        });
    });
    let linesNo = 2;
    $(document).ready(function() {
        $(".inventoryadd-row").click(function() {
            markup =
                '<tr><td style="width:3%;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td style="width:18%;"><input type="hidden" name="productid[]" id="productid1' +
                linesNo +
                '"><input type="text" name="productname[]" id="productname1" required class="form-control form-control-sm bordernoneinput bor"  style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title=""></td><td style="width:11%;"> <div class="input-group mb-3 input-group-sm"> <div class="input-group-prepend"><span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $res[0]; ?></span></div><input type="age" min="0" name="quantity[]" required id="quantity1' +
                linesNo +
                '" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)"></div></td><td style="width: 6%;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $res[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td><td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1' +
                linesNo +
                '" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td><td style="width:3%;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete' +
                linesNo +
                '" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>';
            tableBody = $("#inventorytable");
            tableBody.append(markup);
            var start = moment().subtract(29, 'days');
            var end = moment();
            $('#reportrange' + linesNo).daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
                        .subtract(1, 'month').endOf('month')
                    ]
                },
                "alwaysShowCalendars": true,
                "applyClass": "btn-custom",
                "cancelClass": "btn-custom-grey"
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') +
                    ' to ' + end.format('YYYY-MM-DD'));
            });
            renumber_table('#inventorytable');
            linesNo++;
        });
    });
    function title(x){
     var Characters = x.value;
    }
                     
                    $(document).ready(function() {
                        window.onresize = function (event) {
  applyOrientation();
}

            
function applyOrientation() {
                        if (window.innerHeight >= window.innerWidth) {
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                     }

                        if (window.innerHeight <= window.innerWidth) {
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                     }
}
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
});
var x = window.matchMedia("(max-width: 1344px)");
myFunction(x);
x.addListener(myFunction);
<?php
}
?>
 <?php
if ($current_file_name=='productadd.php'||$current_file_name=='serviceadd.php') {
?>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $("#submit").click(function() {



        $(".Spinnn").css("display", "block");
        $(".Spinnn").fadeOut(200);

    });




    checkBox = document.getElementById('trackinventory').addEventListener('click', event => {
        if (event.target.checked) {
            document.getElementById('table').style.display='none';
        } else {
            document.getElementById('table').style.display='block';
        }
    });


    $('#ImgPreview').click(function() {
        $('#imag').click();
    });


    $('#ImgPreview2').click(function() {
        $('#imag2').click();
    });

    $('#ImgPreview3').click(function() {
        $('#imag3').click();
    });

    $('#ImgPreview4').click(function() {
        $('#imag4').click();
    });
    $('#ImgPreview5').click(function() {
        $('#imag5').click();
    });
   var buttons = document.querySelectorAll( '.arlina-button' );

Array.prototype.slice.call( buttons ).forEach( function( button ) {

    var resetTimeout;

    button.addEventListener( 'click', function() {

        if( typeof button.getAttribute( 'data-loading' ) === 'string' ) {
            button.removeAttribute( 'data-loading' );
        }
        else {
            button.setAttribute( 'data-loading', '' );
        }

        clearTimeout( resetTimeout );
        resetTimeout = setTimeout( function() {
            button.removeAttribute( 'data-loading' );
        }, 1000 );

    }, false );

} );
    function readURL(input, imgControlName) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(imgControlName).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imag").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview";
        readURL(this, imgControlName);
        $('.preview1').addClass('it');
        $('#removeImage1').css("color", "black");
    });
    $("#imag2").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview2";
        readURL(this, imgControlName);
        $('.preview2').addClass('it');
        $('.btn-rmv2').addClass('rmv');
    });
    $("#imag3").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview3";
        readURL(this, imgControlName);
        $('.preview3').addClass('it');
        $('.btn-rmv3').addClass('rmv');
    });
    $("#imag4").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview4";
        readURL(this, imgControlName);
        $('.preview4').addClass('it');
        $('.btn-rmv4').addClass('rmv');
    });
    $("#imag5").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview5";
        readURL(this, imgControlName);
        $('.preview5').addClass('it');
    });
    $("#removeImage1").click(function(e) {
        e.preventDefault();
        $("#imag").val("");
        $("#ImgPreview").attr("src",
            "assets/img/productimage1.png"
        );
        $('.preview1').removeClass('it');
        $('#removeImage1').css("color", "#6c757d");
    });
    $("#removeImage2").click(function(e) {
        e.preventDefault();
        $("#imag2").val("");
        $("#ImgPreview2").attr("src",
            "assets/img/productimage1.png"
        );
        $('.preview2').removeClass('it');
        $('#removeImage2').css("color", "#6c757d");
    });
    $("#removeImage3").click(function(e) {
        e.preventDefault();
        $("#imag3").val("");
        $("#ImgPreview3").attr("src",
            "assets/img/productimage1.png"
        );
        $('.preview3').removeClass('it');
        $('#removeImage3').css("color", "#6c757d");
    });
    $("#removeImage4").click(function(e) {
        e.preventDefault();
        $("#imag4").val("");
        $("#ImgPreview4").attr("src",
            "assets/img/productimage1.png"
        );
        $('.preview4').removeClass('it');
        $('#removeImage4').css("color", "#6c757d");
    });
    $("#removeImage5").click(function(e) {
        e.preventDefault();
        $("#imag5").val("");
        $("#ImgPreview5").attr("src",
            "assets/img/productimage1.png"
        );
        $('.preview5').removeClass('it');
        $('#removeImage5').css("color", "#6c757d");
    });
    $(document).ready(function() {
$('table').on('click','.btn-deletes',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("saletable").rows.length;
if(x!=2)
{
r = confirm('Delete this item?');
if(r) {
$(this).closest('tr').remove();
renumber_table(tableID);
}
}
else
{
    alert('Unable to Delete First row');
}
});
 });
    $(document).ready(function() {
        //Helper function to keep table row from collapsing when being sorted
        var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        };
        //Make diagnosis table sortable
        $("#purchasetable tbody").sortable({
            helper: fixHelperModified,
            stop: function(event, ui) {
                renumber_table('#purchasetable')
            }
        }).disableSelection();
        //Make diagnosis table sortable
        $("#saletable tbody").sortable({
            helper: fixHelperModified,
            stop: function(event, ui) {
                renumber_table('#saletable')
            }
        }).disableSelection();
        $("#inventorytable tbody").sortable({
            helper: fixHelperModified,
            stop: function(event, ui) {
                renumber_table('#inventorytable')
            }
        }).disableSelection();
        //Delete button in table rows
    //     $('table').on('click', '.btn-delete', function() {
    //         tableID = '#' + $(this).closest('table').attr('id');
    //         r = confirm('Delete this item?');
    //         if (r) {
    //             $(this).closest('tr').remove();
    //             renumber_table(tableID);
    //         }
    //     });
    // });
    $('table').on('click','.btn-delete',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("purchasetable").rows.length;
if(x!=2)
{
r = confirm('Delete this item?');
if(r) {
$(this).closest('tr').remove();
renumber_table(tableID);
}
}
else
{
    alert('Unable to Delete First row');
}
});
});
    //Renumber  table rows
    function renumber_table(tableID) {
        $(tableID + " tr").each(function() {
            count = $(this).parent().children().index($(this)) + 1;
            $(this).find('.priority').html(count);
        });
    }
<?php
}
?>
 <?php
if ($current_file_name=='productview.php'||$current_file_name=='serviceview.php') {
?>
window.setMobileTable = function(selector) {
  // if (window.innerWidth > 600) return false;
  const tableEl = document.querySelector(selector);
  const thEls = tableEl.querySelectorAll('thead th');
  const tdLabels = Array.from(thEls).map(el => el.innerText);
  tableEl.querySelectorAll('tbody tr').forEach( tr => {
    Array.from(tr.children).forEach( 
      (td, ndx) =>  td.setAttribute('label', tdLabels[ndx])
    );
  });
}
  $(function() {
      $( "#area" ).autocomplete({
       source: 'areasearch.php', select: function (event, ui) { $("#area").val(ui.item.area); $("#city").val(ui.item.city); $("#district").val(ui.item.district); $("#state").val(ui.item.state); $("#pincode").val(ui.item.pincode);}, minLength: 2
     });
     $( "#email" ).autocomplete({
       source: 'franchisesearch.php?type=email',
     });
  });
          function checkscrolltouch() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrow').style.visibility = 'hidden';
            document.getElementById('leftarrow').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrow').style.visibility = 'visible';
            document.getElementById('rightarrow').style.visibility = 'visible';
          }
            }
          }
          function leftarrow() {
            document.getElementById('nav-tab').scrollLeft += -90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
          }
          function rightarrow() {
            document.getElementById('nav-tab').scrollLeft += 90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrow').style.visibility = 'hidden';
            }
            document.getElementById('leftarrow').style.visibility = 'visible';
          }
<?php
}
?>
<?php
if ($current_file_name=='productedit.php'||$current_file_name=='serviceedit.php') {
    ?>
    function gettaxable() {
        var taxpreftaxable = document.getElementById('taxpreftaxable');
        var taxprefnontaxable = document.getElementById('taxprefnontaxable');
        if (taxpreftaxable.checked == true) {
            document.getElementById('taxablediv').style.display = "block";
            document.getElementById('nontaxablediv').style.display = "none";
        } else {
            document.getElementById('taxablediv').style.display = "none";
            document.getElementById('nontaxablediv').style.display = "block";
        }
    }
    function readURL(input, imgControlName) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(imgControlName).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imag").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview";
        readURL(this, imgControlName);
        $('.preview1').addClass('it');
        $('.btn-rmv1').addClass('rmv');
    });
    $("#imag2").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview2";
        readURL(this, imgControlName);
        $('.preview2').addClass('it');
        $('.btn-rmv2').addClass('rmv');
    });
    $("#imag3").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview3";
        readURL(this, imgControlName);
        $('.preview3').addClass('it');
        $('.btn-rmv3').addClass('rmv');
    });
    $("#imag4").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview4";
        readURL(this, imgControlName);
        $('.preview4').addClass('it');
        $('.btn-rmv4').addClass('rmv');
    });
    $("#imag5").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview5";
        readURL(this, imgControlName);
        $('.preview5').addClass('it');
    });
    $("#removeImage1").click(function(e) {
        e.preventDefault();
        $("#imag").val("");
        $("#ImgPreview").attr("src",
            "assets/img/Pencil-Icons.png"
        );
        $('.preview1').removeClass('it');
    });
    $("#removeImage2").click(function(e) {
        e.preventDefault();
        $("#imag2").val("");
        $("#ImgPreview2").attr("src",
            "assets/img/Pencil-Icons.png"
        );
        $('.preview2').removeClass('it');
    });
    $("#removeImage3").click(function(e) {
        e.preventDefault();
        $("#imag3").val("");
        $("#ImgPreview3").attr("src",
            "assets/img/Pencil-Icons.png"
        );
        $('.preview3').removeClass('it');
    });
    $("#removeImage4").click(function(e) {
        e.preventDefault();
        $("#imag4").val("");
        $("#ImgPreview4").attr("src",
            "assets/img/Pencil-Icons.png"
        );
        $('.preview4').removeClass('it');
    });
    $("#removeImage5").click(function(e) {
        e.preventDefault();
        $("#imag5").val("");
        $("#ImgPreview5").attr("src",
            "assets/img/Pencil-Icons.png"
        );
        $('.preview5').removeClass('it');
    });
    $(document).ready(function() {
        //Helper function to keep table row from collapsing when being sorted
        var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        };
        //Make diagnosis table sortable
        $("#purchasetable tbody").sortable({
            helper: fixHelperModified,
            stop: function(event, ui) {
                renumber_table('#purchasetable')
            }
        }).disableSelection();
        //Make diagnosis table sortable
        $("#saletable tbody").sortable({
            helper: fixHelperModified,
            stop: function(event, ui) {
                renumber_table('#saletable')
            }
        }).disableSelection();
        //Delete button in table rows
        $('table').on('click', '.btn-delete', function() {
            tableID = '#' + $(this).closest('table').attr('id');
            r = confirm('Delete this item?');
            if (r) {
                $(this).closest('tr').remove();
                renumber_table(tableID);
            }
        });
    });
    //Renumber  table rows
    function renumber_table(tableID) {
        $(tableID + " tr").each(function() {
            count = $(this).parent().children().index($(this)) + 1;
            $(this).find('.priority').html(count);
        });
    }
<?php
}
?>
<?php
if ($current_file_name=='productview.php'||$current_file_name=='productedit.php'||$current_file_name=='serviceview.php'||$current_file_name=='serviceedit.php') {
    ?>
$(document).ready(function() {
  let noaccess = document.getElementById('taxprefnontaxable');
  let access = document.getElementById('taxpreftaxable');
  let taxablediv = document.getElementById('taxablediv');
  let nontaxablediv = document.getElementById('nontaxablediv');
  if (noaccess.checked == true) {
    document.getElementById('taxablediv').style.display='none';
  }
  if (access.checked == true) {
    document.getElementById('taxablediv').style.display='block';
  }
});
<?php
}
?>
$(document).ready(function () {

window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove();
    });
}, 4000);

});
</script>
<script type="text/javascript">
<?php
if ($current_file_name=='franchises.php'||$current_file_name=='users.php') {
    ?>
    window.setMobileTable = function(selector) {
  // if (window.innerWidth > 600) return false;
  const tableEl = document.querySelector(selector);
  const thEls = tableEl.querySelectorAll('thead th');
  const tdLabels = Array.from(thEls).map(el => el.innerText);
  tableEl.querySelectorAll('tbody tr').forEach( tr => {
    Array.from(tr.children).forEach( 
      (td, ndx) =>  td.setAttribute('label', tdLabels[ndx])
    );
  });
}
<?php
}
?>
</script>
<script type="text/javascript">
  <?php
if ($current_file_name=='franchiseadd.php'||$current_file_name=='franchiseedit.php') {
    ?>
  $(function() {
    $( "#invoicesuffix" ).autocomplete({
       source: 'invoicesuffixsearch.php', select: function (event, ui) { $("#invoicesuffix").val(ui.item.invoicesuffix); $("#city").val(ui.item.city); $("#district").val(ui.item.district); $("#state").val(ui.item.state); $("#pincode").val(ui.item.pincode);}, minLength: 2
     });
     $( "#email" ).autocomplete({
       source: 'franchisesearch.php?type=email',
     });
  });
<?php
}
?>
  <?php
if ($current_file_name=='franchiseadd.php'||$current_file_name=='useradd.php'||$current_file_name=='franchiseedit.php'||$current_file_name=='useredit.php') {
    ?>
    var buttons = document.querySelectorAll('.arlina-button');

    Array.prototype.slice.call(buttons).forEach(function(button) {

        var resetTimeout;

        button.addEventListener('click', function() {

            if (typeof button.getAttribute('data-loading') === 'string') {
                button.removeAttribute('data-loading');
            } else {
                button.setAttribute('data-loading', '');
            }

            clearTimeout(resetTimeout);
            resetTimeout = setTimeout(function() {
                button.removeAttribute('data-loading');
            }, 1000);

        }, false);

    });
<?php
}
?>
  <?php
if ($current_file_name=='franchiseview.php'||$current_file_name=='userview.php') {
    ?>
window.setMobileTable = function(selector) {
  // if (window.innerWidth > 600) return false;
  const tableEl = document.querySelector(selector);
  const thEls = tableEl.querySelectorAll('thead th');
  const tdLabels = Array.from(thEls).map(el => el.innerText);
  tableEl.querySelectorAll('tbody tr').forEach( tr => {
    Array.from(tr.children).forEach( 
      (td, ndx) =>  td.setAttribute('label', tdLabels[ndx])
    );
  });
}
<?php
}
?>
</script>
<script type="text/javascript">
  <?php
if ($current_file_name=='preference_franchisee_roles.php'||$current_file_name=='preference_users_roles.php'||$current_file_name=='preference_billing.php') {
    ?>
    $(function() {
        $("#invoicesuffix").autocomplete({
            source: 'invoicesuffixsearch.php',
            select: function(event, ui) {
                $("#invoicesuffix").val(ui.item.invoicesuffix);
                $("#city").val(ui.item.city);
                $("#district").val(ui.item.district);
                $("#state").val(ui.item.state);
                $("#pincode").val(ui.item.pincode);
            },
            minLength: 2
        });
        $("#email").autocomplete({
            source: 'franchisesearch.php?type=email',
        });
    });
<?php
}
?>
  <?php
if ($current_file_name=='preference_franchises_roles_label.php'||$current_file_name=='preference_users_roles_label.php'||$current_file_name=='preference_billing_label.php') {
    ?>
    $(function() {
        $("#invoicesuffix").autocomplete({
            source: 'invoicesuffixsearch.php',
            select: function(event, ui) {
                $("#invoicesuffix").val(ui.item.invoicesuffix);
                $("#city").val(ui.item.city);
                $("#district").val(ui.item.district);
                $("#state").val(ui.item.state);
                $("#pincode").val(ui.item.pincode);
            },
            minLength: 2
        });
        $("#email").autocomplete({
            source: 'franchisesearch.php?type=email',
        });
    });
    var buttons = document.querySelectorAll( '.arlina-button' );

Array.prototype.slice.call( buttons ).forEach( function( button ) {

    var resetTimeout;

    button.addEventListener( 'click', function() {
        
        if( typeof button.getAttribute( 'data-loading' ) === 'string' ) {
            button.removeAttribute( 'data-loading' );
        }
        else {
            button.setAttribute( 'data-loading', '' );
        }

        clearTimeout( resetTimeout );
        resetTimeout = setTimeout( function() {
            button.removeAttribute( 'data-loading' );           
        }, 1000 );

    }, false );

} );
<?php
}
?>
</script>
<script>
  <?php
if ($current_file_name=='enquiryadd.php'||$current_file_name=='quotationadd.php'||$current_file_name=='estimateadd.php'||$current_file_name=='proformaadd.php'||$current_file_name=='jobadd.php'||$current_file_name=='salesorderadd.php'||$current_file_name=='deliverychallanadd.php'||$current_file_name=='purchaseorderadd.php'||$current_file_name=='purchasereceiveadd.php'||$current_file_name=='enquiryedit.php'||$current_file_name=='quotationedit.php'||$current_file_name=='estimateedit.php'||$current_file_name=='proformaedit.php'||$current_file_name=='jobedit.php'||$current_file_name=='salesorderedit.php'||$current_file_name=='deliverychallanedit.php'||$current_file_name=='creditnoteedit.php'||$current_file_name=='salesreturnedit.php'||$current_file_name=='purchaseorderedit.php'||$current_file_name=='purchasereceiveedit.php'||$current_file_name=='debitnoteedit.php'||$current_file_name=='purchasereturnedit.php') {
    ?>
                    $(document).ready(function() {
                        window.onresize = function (event) {
  applyOrientation();
}
function applyOrientation() {
                        if (window.innerHeight >= window.innerWidth) {
                             var proitemselect = document.getElementsByClassName('proitemselect'); 
                        proitemselectlen = proitemselect.length;
                        for (i=0;i<proitemselectlen;i++) {
                            if (x.matches) { 
                             proitemselect[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             proitemselect[i].classList.add('form-control','form-control-sm');
                             }
                         }
                        var taxabledesign = document.getElementsByClassName('taxabledesign'); 
                        taxabledesignlen = taxabledesign.length;
                        for (i=0;i<taxabledesignlen;i++) {
                            if (x.matches) { 
                             taxabledesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             taxabledesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var amountdesign = document.getElementsByClassName('amountdesign');
                        amountdesignlen = amountdesign.length;
                        for (i=0;i<amountdesignlen;i++) {
                            if (x.matches) { 
                             amountdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             amountdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                     }

                        if (window.innerHeight <= window.innerWidth) {
                             var proitemselect = document.getElementsByClassName('proitemselect'); 
                        proitemselectlen = proitemselect.length;
                        for (i=0;i<proitemselectlen;i++) {
                            if (x.matches) { 
                             proitemselect[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             proitemselect[i].classList.add('form-control','form-control-sm');
                             }
                         }
                        var taxabledesign = document.getElementsByClassName('taxabledesign');
                        taxabledesignlen = taxabledesign.length;
                        for (i=0;i<taxabledesignlen;i++) {
                            if (x.matches) { 
                             taxabledesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             taxabledesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var amountdesign = document.getElementsByClassName('amountdesign');
                        amountdesignlen = amountdesign.length;
                        for (i=0;i<amountdesignlen;i++) {
                            if (x.matches) { 
                             amountdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             amountdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                     }
}
                             var proitemselect = document.getElementsByClassName('proitemselect'); 
                        proitemselectlen = proitemselect.length;
                        for (i=0;i<proitemselectlen;i++) {
                            if (x.matches) { 
                             proitemselect[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             proitemselect[i].classList.add('form-control','form-control-sm');
                             }
                         }
var taxabledesign = document.getElementsByClassName('taxabledesign');
                        taxabledesignlen = taxabledesign.length;
                        for (i=0;i<taxabledesignlen;i++) {
                            if (x.matches) { 
                             taxabledesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             taxabledesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var amountdesign = document.getElementsByClassName('amountdesign');
                        amountdesignlen = amountdesign.length;
                        for (i=0;i<amountdesignlen;i++) {
                            if (x.matches) { 
                             amountdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             amountdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (y.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
});
var y = window.matchMedia("(max-width: 991px)");
myFunction(y);
y.addListener(myFunction);
<?php
}
?>
  <?php
if ($current_file_name=='invoiceedit.php'||$current_file_name=='billedit.php'||$current_file_name=='invoiceadd.php'||$current_file_name=='converttoinvoice.php'||$current_file_name=='salesreturnadd.php'||$current_file_name=='creditnoteadd.php'||$current_file_name=='billadd.php'||$current_file_name=='purchasereturnadd.php'||$current_file_name=='salesorderadd.php'||$current_file_name=='salesorderedit.php'||$current_file_name=='debitnoteadd.php') {
    ?>
                    $(document).ready(function() {
                        window.onresize = function (event) {
  applyOrientation();
}
let modaltriggercheck = document.getElementById("triggerconfirm-adddelete");
if (modaltriggercheck.classList.contains('show')) {
    $(".finalsubmitrequired").attr("required","required");
                }
                else{
                    $(".finalsubmitrequired").removeAttr("required");
                }
function applyOrientation() {
                        if (window.innerHeight >= window.innerWidth) {
                             var proitemselect = document.getElementsByClassName('proitemselect'); 
                        proitemselectlen = proitemselect.length;
                        for (i=0;i<proitemselectlen;i++) {
                            if (x.matches) { 
                             proitemselect[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             proitemselect[i].classList.add('form-control','form-control-sm');
                             }
                         }
                        var taxabledesign = document.getElementsByClassName('taxabledesign'); 
                        taxabledesignlen = taxabledesign.length;
                        for (i=0;i<taxabledesignlen;i++) {
                            if (x.matches) { 
                             taxabledesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             taxabledesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var amountdesign = document.getElementsByClassName('amountdesign');
                        amountdesignlen = amountdesign.length;
                        for (i=0;i<amountdesignlen;i++) {
                            if (x.matches) { 
                             amountdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             amountdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                     }

                        if (window.innerHeight <= window.innerWidth) {
                             var proitemselect = document.getElementsByClassName('proitemselect'); 
                        proitemselectlen = proitemselect.length;
                        for (i=0;i<proitemselectlen;i++) {
                            if (x.matches) { 
                             proitemselect[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             proitemselect[i].classList.add('form-control','form-control-sm');
                             }
                         }
                        var taxabledesign = document.getElementsByClassName('taxabledesign');
                        taxabledesignlen = taxabledesign.length;
                        for (i=0;i<taxabledesignlen;i++) {
                            if (x.matches) { 
                             taxabledesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             taxabledesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var amountdesign = document.getElementsByClassName('amountdesign');
                        amountdesignlen = amountdesign.length;
                        for (i=0;i<amountdesignlen;i++) {
                            if (x.matches) { 
                             amountdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             amountdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (x.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                     }
}
                             var proitemselect = document.getElementsByClassName('proitemselect'); 
                        proitemselectlen = proitemselect.length;
                        for (i=0;i<proitemselectlen;i++) {
                            if (x.matches) { 
                             proitemselect[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             proitemselect[i].classList.add('form-control','form-control-sm');
                             }
                         }
var taxabledesign = document.getElementsByClassName('taxabledesign');
                        taxabledesignlen = taxabledesign.length;
                        for (i=0;i<taxabledesignlen;i++) {
                            if (x.matches) { 
                             taxabledesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             taxabledesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var amountdesign = document.getElementsByClassName('amountdesign');
                        amountdesignlen = amountdesign.length;
                        for (i=0;i<amountdesignlen;i++) {
                            if (x.matches) { 
                             amountdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             amountdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
                         var totaltaxdesign = document.getElementsByClassName('totaldesign');
                        totaltaxdesignlen = totaltaxdesign.length;
                        for (i=0;i<totaltaxdesignlen;i++) {
                            if (z.matches) { 
                             totaltaxdesign[i].classList.remove('form-control','form-control-sm');
                           }
                           else {
                             totaltaxdesign[i].classList.add('form-control','form-control-sm');
                             }
                         }
});
var z = window.matchMedia("(max-width: 991px)");
myFunction(z);
z.addListener(myFunction);
<?php
}
?>
  <?php
if ($current_file_name=='enquiryadd.php'||$current_file_name=='quotationadd.php'||$current_file_name=='estimateadd.php'||$current_file_name=='proformaadd.php'||$current_file_name=='jobadd.php'||$current_file_name=='salesorderadd.php'||$current_file_name=='deliverychallanadd.php'||$current_file_name=='converttoinvoice.php'||$current_file_name=='invoiceadd.php'||$current_file_name=='salesreturnadd.php'||$current_file_name=='creditnoteadd.php'||$current_file_name=='purchaseorderadd.php'||$current_file_name=='purchasereceiveadd.php'||$current_file_name=='billadd.php'||$current_file_name=='purchasereturnadd.php'||$current_file_name=='enquiryedit.php'||$current_file_name=='quotationedit.php'||$current_file_name=='estimateedit.php'||$current_file_name=='proformaedit.php'||$current_file_name=='jobedit.php'||$current_file_name=='salesorderedit.php'||$current_file_name=='deliverychallanedit.php'||$current_file_name=='invoiceedit.php'||$current_file_name=='creditnoteedit.php'||$current_file_name=='salesreturnedit.php'||$current_file_name=='purchaseorderedit.php'||$current_file_name=='purchasereceiveedit.php'||$current_file_name=='billedit.php'||$current_file_name=='debitnoteedit.php'||$current_file_name=='purchasereturnedit.php'||$current_file_name=='debitnoteadd.php') {
    ?>
function funesmargindetails() {
$('#ViewMarginDetails').modal('hide');
}
function funesfrequentproduct() {
      $('#Viewfrequentproduct').modal('hide');
    }
$(function(){
$(".select2").select2({
matcher: matchCustom,
templateResult: formatCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
function formatCustom(state) {
return $(
'<div><div>' + state.text + '</div><div class="foo">'
+ $(state.element).attr('data-foo')
+ '</div></div>'
);
}
<?php
}
?>
  <?php
if ($current_file_name=='purchaseorderadd.php'||$current_file_name=='purchasereceiveadd.php'||$current_file_name=='billadd.php'||$current_file_name=='purchasereturnadd.php'||$current_file_name=='purchaseorderedit.php'||$current_file_name=='purchasereceiveedit.php'||$current_file_name=='billedit.php'||$current_file_name=='debitnoteedit.php'||$current_file_name=='purchasereturnedit.php'||$current_file_name=='debitnoteadd.php') {
    ?>
    function funesvendorview() {
      $('#Viewcustdetails').modal('hide');
    }
$(function(){
$("#vendor").select2({
matcher: matchCustom,
templateResult: formatCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
function formatCustom(state) {
if($(state.element).attr('data-receivable')=="")
{
return $(
'<div><div>' + state.text + '</div></div>'
);
}
else
{
if($(state.element).attr('data-receivable')=="0")
{
return $(
'<div><div style="margin-top:-6px !important;">' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Work Phone: '+ $(state.element).attr('data-foo') + '</td><td align="right">Amount Receivable: <span style="color:green">'+ $(state.element).attr('data-receivable') + '</span></td></tr></table></div></div>'
);
}
else
{
return $(
'<div><div style="margin-top:-6px !important;">' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Work Phone: '+ $(state.element).attr('data-foo') + '</td><td align="right">Amount Receivable: <span style="color:red">'+ $(state.element).attr('data-receivable') + '</span></td></tr></table></div></div>'
);
}
}
}
<?php
}
?>
  <?php
if ($current_file_name=='enquiryadd.php'||$current_file_name=='quotationadd.php'||$current_file_name=='estimateadd.php'||$current_file_name=='proformaadd.php'||$current_file_name=='jobadd.php'||$current_file_name=='salesorderadd.php'||$current_file_name=='deliverychallanadd.php'||$current_file_name=='converttoinvoice.php'||$current_file_name=='invoiceadd.php'||$current_file_name=='salesreturnadd.php'||$current_file_name=='creditnoteadd.php'||$current_file_name=='enquiryedit.php'||$current_file_name=='quotationedit.php'||$current_file_name=='estimateedit.php'||$current_file_name=='proformaedit.php'||$current_file_name=='jobedit.php'||$current_file_name=='salesorderedit.php'||$current_file_name=='deliverychallanedit.php'||$current_file_name=='invoiceedit.php'||$current_file_name=='creditnoteedit.php'||$current_file_name=='salesreturnedit.php') {
    ?>
    function funescustomerview() {
      $('#Viewcustdetails').modal('hide');
    }
$(function(){
$("#customer").select2({
matcher: matchCustom,
templateResult: formatCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
function formatCustom(state) {
if($(state.element).attr('data-receivable')=="")
{
return $(
'<div><div>' + state.text + '</div></div>'
);
}
else
{
if($(state.element).attr('data-receivable')=="0")
{
return $(
'<div><div style="margin-top:-6px !important;">' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Work Phone: '+ $(state.element).attr('data-foo') + '</td><td align="right">Amount Receivable: <span style="color:green">'+ $(state.element).attr('data-receivable') + '</span></td></tr></table></div></div>'
);
}
else
{
return $(
'<div><div style="margin-top:-6px !important;">' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Work Phone: '+ $(state.element).attr('data-foo') + '</td><td align="right">Amount Receivable: <span style="color:red">'+ $(state.element).attr('data-receivable') + '</span></td></tr></table></div></div>'
);
}
}
}
<?php
}
?>
</script>
<script>
  <?php
if ($current_file_name=='enquirys.php'||$current_file_name=='quotations.php'||$current_file_name=='estimates.php'||$current_file_name=='proformas.php'||$current_file_name=='jobs.php'||$current_file_name=='salesorders.php'||$current_file_name=='deliverychallans.php'||$current_file_name=='invoices.php'||$current_file_name=='salesreturns.php'||$current_file_name=='creditnotes.php'||$current_file_name=='purchaseorders.php'||$current_file_name=='purchasereceives.php'||$current_file_name=='bills.php'||$current_file_name=='purchasereturns.php'||$current_file_name=='debitnotes.php') {
    ?>
$(document).ready(function(){
$("#invsearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
// ajax for get
$.ajax({
type: "GET",
url: 'listallsearch.php?term=invoices&searchTerm='+ value +'',
success: function (result) {
$("#someTableTr").html(result);
if (result == ''){
<?php
if ($access['invpageload']=='pagenum') {
?>
$('#page-link0').click();
<?php
}
?>
}
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
});
$("#billsearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
// ajax for get
$.ajax({
type: "GET",
url: 'listallsearch.php?term=bills&searchTerm='+ value +'',
success: function (result) {
$("#myTable").html(result);
if (result == ''){
<?php
if ($access['billpageload']=='pagenum') {
?>
$('#page-link0').click();
<?php
}
?>
}
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
});
});
window.setMobileTable = function(selector) {
  // if (window.innerWidth > 600) return false;
  const tableEl = document.querySelector(selector);
  const thEls = tableEl.querySelectorAll('thead th');
  const tdLabels = Array.from(thEls).map(el => el.innerText);
  tableEl.querySelectorAll('tbody tr').forEach( tr => {
    Array.from(tr.children).forEach( 
      (td, ndx) =>  td.setAttribute('label', tdLabels[ndx])
    );
  });
}
<?php
}
?>
</script>
<script type="text/javascript">
  <?php
if ($current_file_name=='invoiceview.php') {
?>
let modaltriggercheck = document.getElementById("triggerconfirm-adddelete");
if (modaltriggercheck.classList.contains('show')) {
    $(".finalsubmitrequired").attr("required","required");
                }
                else{
                    $(".finalsubmitrequired").removeAttr("required");
                }
$(function(){
$(".select2").select2({
matcher: matchCustom,
templateResult: formatCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
function formatCustom(state) {
return $(
'<div><div>' + state.text + '</div><div class="foo">'
+ $(state.element).attr('data-foo')
+ '</div></div>'
);
}
<?php
}
if ($current_file_name=='enquiryview.php'||$current_file_name=='quotationview.php'||$current_file_name=='estimateview.php'||$current_file_name=='proformaview.php'||$current_file_name=='jobview.php'||$current_file_name=='salesorderview.php'||$current_file_name=='deliverychallanview.php'||$current_file_name=='invoiceview.php'||$current_file_name=='salesreturnview.php'||$current_file_name=='creditnoteview.php'||$current_file_name=='purchaseorderview.php'||$current_file_name=='purchasereceiveview.php'||$current_file_name=='billview.php'||$current_file_name=='purchasereturnview.php'||$current_file_name=='debitnoteview.php') {
    ?>
    var buttons = document.querySelectorAll('.arlina-button');

    Array.prototype.slice.call(buttons).forEach(function(button) {

        var resetTimeout;

        button.addEventListener('click', function() {

            if (typeof button.getAttribute('data-loading') === 'string') {
                button.removeAttribute('data-loading');
            } else {
                button.setAttribute('data-loading', '');
            }

            clearTimeout(resetTimeout);
            resetTimeout = setTimeout(function() {
                button.removeAttribute('data-loading');
            }, 1000);

        }, false);

    });
<?php
}
?>
</script>
<script>
  <?php
if ($current_file_name=='salespaymentedit.php'||$current_file_name=='customerrefundedit.php'||$current_file_name=='purchasepaymentedit.php'||$current_file_name=='vendorrefundedit.php'||$current_file_name=='salespaymentadd.php'||$current_file_name=='customerrefundadd.php'||$current_file_name=='purchasepaymentadd.php'||$current_file_name=='vendorrefundadd.php') {
    ?>
          function checkscrolltouch() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrow').style.visibility = 'hidden';
            document.getElementById('leftarrow').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrow').style.visibility = 'visible';
            document.getElementById('rightarrow').style.visibility = 'visible';
          }
            }
          }
          function leftarrow() {
            document.getElementById('nav-tab').scrollLeft += -90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
          }
          function rightarrow() {
            document.getElementById('nav-tab').scrollLeft += 90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrow').style.visibility = 'hidden';
            }
            document.getElementById('leftarrow').style.visibility = 'visible';
          }
  <?php
}
if ($current_file_name=='salespayments.php'||$current_file_name=='customerrefunds.php'||$current_file_name=='purchasepayments.php'||$current_file_name=='vendorrefunds.php') {
    ?>
$(document).ready(function(){
$("#salepaysearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
// ajax for get
$.ajax({
type: "GET",
url: 'listallsearch.php?term=salespay&searchTerm='+ value +'',
success: function (result) {
$("#myTable").html(result);
if (result == ''){
<?php
if ($access['salepaypageload']=='pagenum') {
?>
$('#page-link0').click();
<?php
}
?>
}
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
});
$("#purpaysearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
// ajax for get
$.ajax({
type: "GET",
url: 'listallsearch.php?term=purpay&searchTerm='+ value +'',
success: function (result) {
$("#myTable").html(result);
if (result == ''){
<?php
if ($access['purpaypageload']=='pagenum') {
?>
$('#page-link0').click();
<?php
}
?>
}
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
});
$("#cusrefsearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
// ajax for get
$.ajax({
type: "GET",
url: 'listallsearch.php?term=customerrefund&searchTerm='+ value +'',
success: function (result) {
$("#myTable").html(result);
if (result == ''){
<?php
if ($access['salereturnpaypageload']=='pagenum') {
?>
$('#page-link0').click();
<?php
}
?>
}
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
});
$("#venrefsearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
// ajax for get
$.ajax({
type: "GET",
url: 'listallsearch.php?term=vendorrefund&searchTerm='+ value +'',
success: function (result) {
$("#myTable").html(result);
if (result == ''){
<?php
if ($access['purreturnpaypageload']=='pagenum') {
?>
$('#page-link0').click();
<?php
}
?>
}
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
});
$("#creditnotesearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
// ajax for get
$.ajax({
type: "GET",
url: 'listallsearch.php?term=creditnote&searchTerm='+ value +'',
success: function (result) {
$("#someTableTr").html(result);
if (result == ''){
<?php
if ($access['creditnotepageload']=='pagenum') {
?>
$('#page-link0').click();
<?php
}
?>
}
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
});
$("#debitnotesearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
// ajax for get
$.ajax({
type: "GET",
url: 'listallsearch.php?term=debitnote&searchTerm='+ value +'',
success: function (result) {
$("#myTable").html(result);
if (result == ''){
<?php
if ($access['debitnotepaypageload']=='pagenum') {
?>
$('#page-link0').click();
<?php
}
?>
}
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
});
});
window.setMobileTable = function(selector) {
  // if (window.innerWidth > 600) return false;
  const tableEl = document.querySelector(selector);
  const thEls = tableEl.querySelectorAll('thead th');
  const tdLabels = Array.from(thEls).map(el => el.innerText);
  tableEl.querySelectorAll('tbody tr').forEach( tr => {
    Array.from(tr.children).forEach( 
      (td, ndx) =>  td.setAttribute('label', tdLabels[ndx])
    );
  });
}
<?php
}
?>
</script>
<script>
  <?php
if ($current_file_name=='customers.php'||$current_file_name=='vendors.php') {
    ?>
           $(document).ready(function(){
  $("#cussearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
// ajax for get
$.ajax({
type: "GET",
url: 'listallsearch.php?term=customers&searchTerm='+ value +'',
success: function (result) {
$("#myTable").html(result);
if (result == ''){
<?php
if ($access['custpageload']=='pagenum') {
?>
$('#page-link0').click();
<?php
}
?>
}
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
  });
  $("#vensearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
// ajax for get
$.ajax({
type: "GET",
url: 'listallsearch.php?term=vendors&searchTerm='+ value +'',
success: function (result) {
$("#myTable").html(result);
if (result == ''){
<?php
if ($access['venpageload']=='pagenum') {
?>
$('#page-link0').click();
<?php
}
?>
}
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
  });
});    
 function deleteitem(quotationno,quotationdate,cancelstatus)
{
  $('#deleteconfirm-adddelete').modal('show');
  $("#deleteconfirm-adddelete #deleteitem").attr("href","quotationcancel.php?quotationno="+quotationno+"&quotationdate="+quotationdate+"&cancelstatus="+cancelstatus);
}
 function deleteitem1(quotationno,quotationdate,cancelstatus)
{
  $('#deleteconfirm1-adddelete').modal('show');
  $("#deleteconfirm1-adddelete #deleteitem1").attr("href","estimatecancel.php?quotationno="+quotationno+"&quotationdate="+quotationdate+"&estimatestatus="+cancelstatus);
}
window.setMobileTable = function(selector) {
  // if (window.innerWidth > 600) return false;
  const tableEl = document.querySelector(selector);
  const thEls = tableEl.querySelectorAll('thead th');
  const tdLabels = Array.from(thEls).map(el => el.innerText);
  tableEl.querySelectorAll('tbody tr').forEach( tr => {
    Array.from(tr.children).forEach( 
      (td, ndx) =>  td.setAttribute('label', tdLabels[ndx])
    );
  });
}
<?php
}
?>
  <?php
if ($current_file_name=='customerview.php'||$current_file_name=='vendorview.php'||$current_file_name=='enquiryadd.php') {
    ?>
          function checkscrolltouch() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrow').style.visibility = 'hidden';
            document.getElementById('leftarrow').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrow').style.visibility = 'visible';
            document.getElementById('rightarrow').style.visibility = 'visible';
          }
            }
          }
          function leftarrow() {
            document.getElementById('nav-tab').scrollLeft += -90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
          }
          function rightarrow() {
            document.getElementById('nav-tab').scrollLeft += 90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrow').style.visibility = 'hidden';
            }
            document.getElementById('leftarrow').style.visibility = 'visible';
          }
window.setMobileTable = function(selector) {
  // if (window.innerWidth > 600) return false;
  const tableEl = document.querySelector(selector);
  const thEls = tableEl.querySelectorAll('thead th');
  const tdLabels = Array.from(thEls).map(el => el.innerText);
  tableEl.querySelectorAll('tbody tr').forEach( tr => {
    Array.from(tr.children).forEach( 
      (td, ndx) =>  td.setAttribute('label', tdLabels[ndx])
    );
  });
}
<?php
}
?>
</script>
<script>
  <?php
if ($current_file_name=='expenseadd.php'||$current_file_name=='expenseedit.php') {
    ?>
var buttons = document.querySelectorAll('.arlina-button');

Array.prototype.slice.call(buttons).forEach(function(button) {

var resetTimeout;

button.addEventListener('click', function() {

if (typeof button.getAttribute('data-loading') === 'string') {
button.removeAttribute('data-loading');
} else {
button.setAttribute('data-loading', '');
}

clearTimeout(resetTimeout);
resetTimeout = setTimeout(function() {
button.removeAttribute('data-loading');
}, 1000);

}, false);

});
<?php
}
?>
</script>
<script>
  <?php
if ($current_file_name=='manualjournals.php'||$current_file_name=='chartaccounts.php'||$current_file_name=='projects.php'||$current_file_name=='timesheet.php') {
    ?>
window.setMobileTable = function(selector) {
  // if (window.innerWidth > 600) return false;
  const tableEl = document.querySelector(selector);
  const thEls = tableEl.querySelectorAll('thead th');
  const tdLabels = Array.from(thEls).map(el => el.innerText);
  tableEl.querySelectorAll('tbody tr').forEach( tr => {
    Array.from(tr.children).forEach( 
      (td, ndx) =>  td.setAttribute('label', tdLabels[ndx])
    );
  });
}
<?php
}
?>
</script>
<script>
  <?php
if ($current_file_name=='manualjournaladd.php'||$current_file_name=='manualjournaledit.php'||$current_file_name=='manualjournalview.php'||$current_file_name=='chartaccountadd.php'||$current_file_name=='chartaccountedit.php'||$current_file_name=='projectadd.php'||$current_file_name=='projectedit.php'||$current_file_name=='projectview.php') {
    ?>
    var buttons = document.querySelectorAll('.arlina-button');

    Array.prototype.slice.call(buttons).forEach(function(button) {

        var resetTimeout;

        button.addEventListener('click', function() {

            if (typeof button.getAttribute('data-loading') === 'string') {
                button.removeAttribute('data-loading');
            } else {
                button.setAttribute('data-loading', '');
            }

            clearTimeout(resetTimeout);
            resetTimeout = setTimeout(function() {
                button.removeAttribute('data-loading');
            }, 1000);

        }, false);

    });
<?php
}
?>
</script>
<script>
        $(document).ready(function() {
            // Add a mouseover event listener to all input elements
            $('input').on('mouseover', function() {
                // Set the tooltip text to the current value of the input element
                $(this).attr('title', $(this).val());
            });
            $('textarea').on('mouseover', function() {
                // Set the tooltip text to the current value of the input element
                $(this).attr('title', $(this).val());
            });
$(".product1").on("select2:open", function() {
document.getElementById("ppp").value = this.id.split('product')[1];
});
        });
function countRowsInTableBody(tableId) {
    var table = document.getElementById(tableId);
    var tbody = table.getElementsByTagName('tbody')[0];
    var rows = tbody.getElementsByTagName('tr');
    return rows.length;
  }
    </script>
<!--      <script>
        $(document).ready(function() {
            $("*").each(function() {
                var element = $(this);
                var text = element.text();
                element.attr("title", text);
            });
        });
    </script> 
<script>
var countering = Math.ceil(countRowsInTableBody('purchasetable') / 10);
var intervaling = setInterval(function() {
  $("body").on("click",function() {
    if ($("#exampleModal").hasClass("show")) {
      console.log("yes");
    }
    else{
        clearInterval(intervaling);
        clearInterval(intervalings);
        clearTimeout(finaltimer);
    }
  });
    if (countering <= 0) {
        clearInterval(intervaling);
        var counterings = 9;
        var percent = 10;
        var intervalings = setInterval(function() {
    counterings--;
    if (counterings <= 0) {
        clearInterval(intervalings);
    $('#timer').html('<div class="progress" style="height:30px !important;text-align:center !important;"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="96" aria-valuemin="0" aria-valuemax="96" style="height:30px !important;width:96%;background-color:#5cb85c !important;">96% completed. Please wait just a few seconds.</div></div>');
  }
  else{
    $('#timer').html('<div class="progress" style="height:30px !important;text-align:center !important;"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="'+percent+'" aria-valuemin="0" aria-valuemax="100" style="height:30px !important;width:'+percent+'%;background-color:#5cb85c !important;">'+percent+'% Completed</div></div>');
    percent+=10;
  }
}, 1000);
  // var finaltimer = setTimeout(function() 
  // {
  // }, ((Math.ceil(countRowsInTableBody('purchasetable') / 10)*1000)+1000));
        return;
    }
    else{
      $('#time').text(countering);
    }
}, 1000);
</script>

    -->