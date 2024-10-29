<div class="py-5">
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
            <canvas id="usersBySexChart"></canvas>
          </div>

        </section>

      </div>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    const usersBySexChart = document.getElementById('usersBySexChart');
    const usersBySexChartLabels = @json($labels);
    const usersBySexChartData = @json($data);
    const usersBySexChartTitle = @json($title);

    new Chart(usersBySexChart, {
      type: 'bar',
      plugins: [ChartDataLabels],
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: usersBySexChartTitle
          },
          datalabels: {
            anchor: 'end',
            align: 'end',
            color: '#555',
            font: {
              weight: 'bold'
            },
            formatter: function(value, context) {
              return value; // Display the count on top of the bars
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
        labels: usersBySexChartLabels,
        datasets: [{
            label: 'Male',
            data: usersBySexChartData['Male'],
            fill: true,
            backgroundColor: 'rgba(38, 185, 154, 0.31)',
            borderColor: 'rgb(75, 192, 192)',
          },
          {
            label: 'Female',
            data: usersBySexChartData['Female'],
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.4)',
            borderColor: 'rgb(75, 192, 192)',
          }
        ]
      },
    });
  </script>
@endpush
