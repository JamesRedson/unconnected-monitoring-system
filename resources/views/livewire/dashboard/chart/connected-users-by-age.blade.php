 @push('styles')
   <style>
     .chart-legend-container {
       display: flex;
       /* Align items in one row */
       flex-wrap: wrap;
       /* Ensure responsiveness on smaller screens */
       justify-content: space-between;
       align-items: flex-start;
       /* Align items at the top */
     }

     .chart-container {
       height: 60vh;
       flex: 1;
       /* Take up remaining space */
     }

     .legend-container {
       flex: 0 0 300px;
       /* Fix the width of the legend */
       padding-left: 20px;
       /* Add space between the chart and the legend */
     }
   </style>
 @endpush

 <div class="mt-5">
   <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
     <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
       <div class="p-6 text-gray-900 dark:text-gray-100">

         <section class="container px-4 mx-auto">

           <div class="sm:flex sm:items-center sm:justify-between">
             <div>
               <div class="flex items-center gap-x-3">
                 <h2 class="text-lg font-medium text-gray-800 dark:text-white">Users</h2>
               </div>
               <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">These are all the connected users.</p>
             </div>
           </div>

           <div class="chart-legend-container">
             <div class="chart-container">
               <canvas id="usersByAgeChart"></canvas>
             </div>

             <div class="legend-container p-6">
               <h2 class="font-medium text-gray-800 dark:text-white">Age Group</h2>
               <div id="legend"></div>
             </div>
           </div>

         </section>

       </div>
     </div>
   </div>
 </div>

 @push('scripts')
   <script>
     const usersByAgeChart = document.getElementById('usersByAgeChart');
     const usersByAgeChartTitle = @json($title);
     const usersByAgeChartData = @json($data);
     const chartLegendContainer = document.getElementById('legend');

     // Prepare the data for the Pie Chart
     const ageGroups = Object.keys(usersByAgeChartData); // ['0-11', '12-29', '30-44', '45-59', '60+']
     const totalUsersByAgeGroup = Object.values(usersByAgeChartData); // Get the total counts directly

     // Calculate the total sum of counts
     const totalSum = totalUsersByAgeGroup.reduce((a, b) => a + b, 0);

     const centerText = {
       id: 'centerText',
       beforeDatasetsDraw(chart, args, pluginOptions) {
         const {
           ctx,
           data
         } = chart;

         ctx.save();
         const xCoor = chart.getDatasetMeta(0).data[0].x;
         const yCoor = chart.getDatasetMeta(0).data[0].y;
         ctx.font = 'bold 30px sans-serif';
         ctx.fillStyle = 'rgba(54, 162, 235, 1)';
         ctx.textAlign = 'center';
         ctx.textBaseline = 'middle';
         ctx.fillText(totalSum, xCoor, yCoor);
       }
     };

     // Generate the Pie Chart
     const ageChart = new Chart(usersByAgeChart, {
       type: 'doughnut',
       plugins: [ChartDataLabels, centerText],
       data: {
         labels: ageGroups, // The labels for each age group
         datasets: [{
           data: totalUsersByAgeGroup, // The total count of users for each age group
           backgroundColor: [
             'rgba(38, 185, 154, 0.6)',
             'rgba(38, 154, 185, 0.6)',
             'rgba(185, 38, 154, 0.6)',
             'rgba(154, 185, 38, 0.6)',
             'rgba(185, 154, 38, 0.6)'
           ],
           hoverOffset: 20,
           borderRadius: 5
         }]
       },
       options: {
         responsive: true,
         maintainAspectRatio: true,
         plugins: {
           legend: {
             position: 'top',
           },
           title: {
             display: true,
             text: usersByAgeChartTitle // Title for the chart
           },
           datalabels: {
             color: '#000', // Label color
             anchor: 'end', // Position labels outside the pie slices
             align: 'start',
             offset: 10, // Distance from the pie slices
             formatter: (value, ctx) => {
               const label = ctx.chart.data.labels[ctx.dataIndex];
               let sum = 0;
               const dataArr = ctx.chart.data.datasets[0].data;
               dataArr.forEach(data => {
                 sum += data;
               });
               const percentage = (value * 100 / sum).toFixed(2) + "%"; // Show percentage

               return `${label}: ${value} (${percentage})`; // Display age group, count, and percentage
             },
             backgroundColor: 'rgba(255, 255, 255, 0.8)', // Background color for better visibility
             borderColor: 'rgba(0, 0, 0, 0.1)', // Border color of the labels
             display: false,
           }
         }
       }
     });

     // Function to create the custom legend with percentages
     function createCustomLegend(chart) {
       const data = chart.data.datasets[0].data; // Access chart data
       const labels = chart.data.labels; // Access chart labels
       const backgroundColors = chart.data.datasets[0].backgroundColor; // Access background colors
       let sum = data.reduce((a, b) => a + b, 0); // Calculate the total sum of users

       // Generate the custom legend content
       const legendHTML = labels.map((label, index) => {
         const value = data[index];
         const percentage = ((value / sum) * 100).toFixed(2); // Calculate percentage for each age group
         const color = backgroundColors[index]; // Get the corresponding color

         return `
						<p class="mt-2 text-gray-500 dark:text-gray-400 flex items-center">
							<span class="inline-block w-4 h-4 rounded-full mr-2" style="background-color: ${color};"></span>
							<span>${label}: <b>${value}</b> <i>(${percentage}%)</i></span>
						</p>`; // Format: 0-11: 0 (0.00%)
       }).join(''); // Join all divs together

       // Inject the content into the legend container
       chartLegendContainer.innerHTML = legendHTML;
     }

     // Call the function to create the custom legend
     createCustomLegend(ageChart);
   </script>
 @endpush

 </div>
