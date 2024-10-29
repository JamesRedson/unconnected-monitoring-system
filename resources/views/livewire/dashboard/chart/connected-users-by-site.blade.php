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
          <canvas id="usersBySiteChart"></canvas>
        </div>

      </section>

    </div>
  </div>
</div>

@push('scripts')
  <script>
    const usersBySiteChart = document.getElementById('usersBySiteChart');

    // Prepare datasets
    const dataSets = [];
    const siteNames = @json($siteNames);
    const data = @json($data);

    siteNames.forEach(site => {
      color = getRandomColor();
      dataSets.push({
        label: site,
        data: data[site], // Ensure data exists and is properly encoded
        backgroundColor: color, // Function to get a random color for each site_name
        borderColor: color,
        tension: 0.4,
        fill: true
      });
    });

    function getRandomColor() {
      // Define base color components (R, G, B)
      const r = Math.floor(Math.random() * 256);
      const g = Math.floor(Math.random() * 256);
      const b = Math.floor(Math.random() * 256);

      // Define a fixed alpha transparency
      const alpha = 0.31;

      return `rgba(${r}, ${g}, ${b}, ${alpha})`;
    }

    new Chart(usersBySiteChart, {
      type: 'line',
      plugins: [ChartDataLabels],
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: @json($title)
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
        labels: @json($labels),
        datasets: dataSets
      },
    });
  </script>
@endpush
