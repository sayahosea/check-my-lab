<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dasbor Rekam Medis</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('/addon.css') }}">
</head>

<body class="bg-gray-100 font-sans overflow-hidden">

    <!-- Sidebar -->
    <x-sidebar.medis></x-sidebar.medis>

    <!-- Main content area -->
    <div class="ml-60 min-h-screen">

        <!-- Navbar -->
        <x-navbar></x-navbar>

        <div class="bg-white rounded shadow p-4 mb-6 ml-10 mr-10 mt-4">
            <h3 class="text-center font-semibold text-sm mb-4 pb-1 border-b-2  bg-[#a8dadc]">
                Statistik Hasil Uji Laboratorium
            </h3>

            <!-- Grafik Lebih Kecil -->
            <div class="max-w-4xl mx-auto p-4 bg-white rounded shadow">
                <canvas id="labChart" class="w-full h-[160px]"></canvas>
            </div>
        </div>

        <!-- Page Content -->
        <main class="ml-10 p-6">
            <div class="p-6 bg-gray-100 min-h-screen">
                <h1 class="text-2xl font-bold mb-4">Dasbor UPT Puskesmas Baloi Permai</h1>
                <!-- Statistik -->
                <x-statistics
                    total_patients="{{ $total_patients }}"
                    total_tests="{{ $total_tests }}"
                    total_staffs="{{ $total_staffs }}"
                ></x-statistics>
            </div>
        </main>
    </div>

    <script src="{{ asset('/js/chart.js') }}"></script>
    <script>
        const ctx = document.getElementById('labChart').getContext('2d');
        const labChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: ['Juli'],
            datasets: [{
              label: '',
              data: [{{ $total_tests }}],
              borderColor: 'green',
              backgroundColor: 'transparent',
              pointBackgroundColor: 'green',
              pointRadius: 3,
              pointHoverRadius: 4,
              borderWidth: 1.5,
              tension: 0.2,
              fill: false,
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                display: false
              }
            },
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  stepSize: 2,
                },
                grid: {
                  drawBorder: false
                }
              },
              x: {
                grid: {
                  drawBorder: false,
                  display: false
                }
              }
            }
          }
        });
    </script>
</body>
</html>
