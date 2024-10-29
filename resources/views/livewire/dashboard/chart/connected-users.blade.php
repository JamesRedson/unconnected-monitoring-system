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

          <div>
            <canvas id="usersChart"></canvas>
          </div>

        </section>

      </div>
    </div>
  </div>

  @push('scripts')
    <script>
      const usersChart = document.getElementById('usersChart');
      const usersChartLabels = @json($labels);
      const usersChartData = @json($data);
      const usersChartTitle = @json($title);

      new Chart(usersChart, {
        type: 'line',
        plugins: [ChartDataLabels],
        options: {
          responsive: true,
          plugins: {
            title: {
              display: true,
              text: usersChartTitle
            },
            datalabels: {
              anchor: 'end',
              align: 'end',
              color: '#555',
              font: {
                weight: 'bold'
              },
              formatter: function(value, context) {
                return value; // Display the count on top of the line
              }
            }
          },
          interaction: {
            intersect: false,
          },
          scales: {
            x: {
              display: true,
              title: {
                display: true,
                text: 'Days'
              }
            },
            y: {
              display: true,
              ticks: {
                precision: 0
              },
              title: {
                display: true,
                text: 'Total Users'
              },
              suggestedMin: 0,
              // suggestedMax: 1
            }
          }
        },
        data: {
          labels: usersChartLabels,
          datasets: [{
            label: 'Users',
            data: usersChartData,
            fill: true,
            backgroundColor: 'rgba(74, 222, 128, 0.5)',
            borderColor: 'rgb(74, 222, 128)',
            tension: 0.4,
          }]
        },
      });
    </script>
  @endpush
