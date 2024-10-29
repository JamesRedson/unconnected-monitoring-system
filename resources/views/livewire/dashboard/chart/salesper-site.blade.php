<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
  <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
      <section class="container px-4 mx-auto">
        <div class="sm:flex sm:items-center sm:justify-between">
          <div>
            <div class="flex items-center gap-x-3">
              <h2 class="text-lg font-medium text-gray-800 dark:text-white">Sales</h2>
            </div>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">These are all the total sales per site.</p>
          </div>

          <div class="flex gap-x-4">
            <div class="flex items-center mt-4 gap-x-3">
              <div class="flex gap-x-4">
                <div class="flex items-center mt-4 gap-x-3">
                  <select wire:model.live="selectedSite"
                    class="text-gray-700 bg-white dark:bg-gray-800 dark:text-white border rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                    <option value="All Sites">All Sites</option>
                    @foreach ($siteNames as $siteName)
                      <option>{{ $siteName }}</option>
                    @endforeach
                  </select>

                </div>
              </div>

              <div class="flex items-center mt-4 gap-x-3">
                <input wire:model.live="selectedDate" type="month"
                  class="text-gray-700 bg-white dark:bg-gray-800 dark:text-white border rounded-md border-gray-300 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                  min="2020-01" max="{{ now()->format('Y-m') }}">
              </div>

            </div>
          </div>
        </div>

        <div class="relative"> <!-- Set a fixed height -->
          <div id="chartLoader"
            class="absolute inset-0 flex justify-center items-center bg-white dark:bg-gray-800 bg-opacity-75 dark:bg-opacity-75 z-10 transition-opacity duration-300 ease-in-out">
            <svg class="animate-spin h-8 w-8 text-gray-600 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg"
              fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
              </circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
          </div>

          <canvas id="salesPerSiteChart" wire:data="{{ json_encode($data) }}" wire:labels="{{ json_encode($labels) }}"
            wire:title="{{ json_encode($title) }}" wire:selected-site="{{ json_encode($selectedSite) }}"
            class="w-full h-full"></canvas>
        </div>

      </section>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    document.addEventListener('livewire:initialized', () => {
      let chartInstance = null;
      let isUpdating = false;

      const chartLoader = document.getElementById('chartLoader');

      function showLoader() {
        if (chartLoader) {
          chartLoader.style.opacity = '0';
          chartLoader.classList.remove('hidden');
          chartLoader.classList.add('flex');
          // Trigger reflow to ensure transition works
          chartLoader.offsetHeight;
          chartLoader.style.opacity = '1';
        }
      }

      function hideLoader() {
        if (chartLoader) {
          chartLoader.style.opacity = '0';
          setTimeout(() => {
            chartLoader.classList.remove('flex');
            chartLoader.classList.add('hidden');
          }, 300); // Match this with CSS transition duration
        }
      }

      function renderSalesPerSiteChart() {
        if (isUpdating) return;
        isUpdating = true;

        const ctx = document.getElementById('salesPerSiteChart');
        if (!ctx) {
          isUpdating = false;
          return;
        }

        try {
          // Get fresh data from wire:model bindings
          const data = JSON.parse(ctx.getAttribute('wire:data'));
          const labels = JSON.parse(ctx.getAttribute('wire:labels'));
          const title = JSON.parse(ctx.getAttribute('wire:title'));
          const selectedSite = JSON.parse(ctx.getAttribute('wire:selected-site'));

          // Destroy existing chart with fade out animation
          if (chartInstance) {
            chartInstance.destroy();
            chartInstance = null;
          }

          const dataSets = [];

          function getRandomColor() {
            const r = Math.floor(Math.random() * 256);
            const g = Math.floor(Math.random() * 256);
            const b = Math.floor(Math.random() * 256);
            const alpha = 0.31;
            return `rgba(${r}, ${g}, ${b}, ${alpha})`;
          }

          // Create datasets based on selected site
          if (selectedSite !== 'All Sites') {
            if (data[selectedSite]) {
              const color = getRandomColor();
              dataSets.push({
                label: selectedSite,
                data: data[selectedSite],
                backgroundColor: color,
                borderColor: color.replace('0.31', '1'),
                tension: 0.4,
                fill: true
              });
            }
          } else {
            Object.entries(data).forEach(([siteName, siteData]) => {
              const color = getRandomColor();
              dataSets.push({
                label: siteName,
                data: siteData,
                backgroundColor: color,
                borderColor: color.replace('0.31', '1'),
                tension: 0.2,
                fill: true
              });
            });
          }

          // Create new chart with animations
          chartInstance = new Chart(ctx, {
            type: 'line',
            plugins: [ChartDataLabels],
            data: {
              labels: labels,
              datasets: dataSets
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              animation: {
                duration: 800,
                easing: 'easeInOutQuart',
              },
              plugins: {
                title: {
                  display: true,
                  text: `${title} ${selectedSite !== 'All Sites' ? '- ' + selectedSite : ' '}`,
                  font: {
                    size: 16,
                    weight: 'bold'
                  }
                },
                datalabels: {
                  anchor: 'end',
                  align: 'end',
                  color: '#555',
                  font: {
                    weight: 'bold'
                  },
                  formatter: function(value) {
                    return value ? value.toLocaleString() : '0';
                  },
                  animation: {
                    duration: 800
                  }
                }
              },
              interaction: {
                intersect: false,
                mode: 'index'
              },
              scales: {
                x: {
                  display: true,
                  title: {
                    display: true,
                    text: 'Days',
                    font: {
                      weight: 'bold'
                    }
                  },
                  grid: {
                    display: true,
                    drawBorder: true,
                    drawOnChartArea: true,
                    drawTicks: true,
                  }
                },
                y: {
                  display: true,
                  title: {
                    display: true,
                    text: 'Total Sales Amount',
                    font: {
                      weight: 'bold'
                    }
                  },
                  ticks: {
                    precision: 0,
                    callback: function(value) {
                      return value.toLocaleString();
                    }
                  },
                  suggestedMin: 0,
                  grid: {
                    display: true,
                    drawBorder: true,
                    drawOnChartArea: true,
                    drawTicks: true,
                  }
                }
              },
              transitions: {
                show: {
                  animations: {
                    x: {
                      from: 0
                    },
                    y: {
                      from: 0
                    }
                  }
                },
                hide: {
                  animations: {
                    x: {
                      to: 0
                    },
                    y: {
                      to: 0
                    }
                  }
                }
              }
            }
          });

          // Hide loader after chart is fully rendered
          chartInstance.options.animation.onComplete = () => {
            hideLoader();
            isUpdating = false;
          };

        } catch (error) {
          console.error('Error rendering chart:', error);
          hideLoader();
          isUpdating = false;
        }
      }

      const style = document.createElement('style');
      style.textContent = `
        #chartLoader {
            transition: opacity 300ms ease-in-out;
        }
        canvas#salesPerSiteChart {
            transition: opacity 300ms ease-in-out;
        }
    `;
      document.head.appendChild(style);

      showLoader();
      setTimeout(renderSalesPerSiteChart, 300);

      let updateTimeout;
      Livewire.on('update-chart', () => {
        showLoader();
        clearTimeout(updateTimeout);
        updateTimeout = setTimeout(() => {
          renderSalesPerSiteChart();
        }, 300);
      });
    });
  </script>
@endpush
