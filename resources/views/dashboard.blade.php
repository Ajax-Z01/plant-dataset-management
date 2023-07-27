@extends('layouts.user_type.auth')

@section('content')
  <div class="container-xxl">
    <div class="row p-4 ms-3">
      <div class="col-md-6" data-aos="fade-right" data-aos-duration="2000">
        <div class="text-label" style="color: #263A29">
          <h2>Welcome to</h2>
          <h2>Plant Dataset Management</h2>
        </div>
        <div class="text-description">
          <p class="mb-0">This website will help you to manage your leaf dataset and find the right model using machine learning.</p>
        </div>
        <div class="button">
          <a href="#projects" class="btn bg-gradient-success btn-lg py-4 mt-2 rounded-pill">Get Started</a>
        </div>
      </div>
      <div class="col-md-6 d-none d-lg-block" data-aos="fade-left" data-aos-duration="2000">
        <img src="{{asset('assets/img/curved-images/farmer-1-copy.jpg')}}" alt="" class="w-100" style="border-radius: 38% 62% 31% 69% / 100% 0% 100% 0%;">
      </div>
    </div>

    <div class="container pt-3 pb-0">
      <div class="border border-2 border-bottom m-auto" style="width: 100%; opacity: 0.7"></div>
    </div>
    <div class="carousel-text-label mt-3" style="color: #263A29" data-aos="fade-down">
      <p>What is our goal ?</p>
    </div>

    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide m-5 mt-4" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
      </div>
      <div class="carousel-inner" style="border-radius: 4rem;">
        <div class="carousel-item active c-item" data-bs-interval="2000">
          <img src="{{asset('assets/img/slides - 1.jpg')}}" class="d-block w-100" alt="...">
          <div class="carousel-caption text-uppercase">
            <h5>your leaf dataset manager</h5>
          </div>
        </div>
        <div class="carousel-item c-item" data-bs-interval="2000">
          <img src="{{asset('assets/img/slides - 2.jpg')}}" class="d-block w-100" alt="...">
          <div class="carousel-caption text-uppercase">
            <h5>to help farmers in their work</h5>
          </div>
        </div>
        <div class="carousel-item c-item" data-bs-interval="2000">
          <img src="{{asset('assets/img/slides - 4.jpg')}}" class="d-block w-100" alt="...">
          <div class="carousel-caption text-uppercase">
            <h5>to assist experts in training data</h5>
          </div>
        </div>
        <div class="carousel-item c-item" data-bs-interval="2000">
          <img src="{{asset('assets/img/slides - 5.jpg')}}" class="d-block w-100" alt="...">
          <div class="carousel-caption text-uppercase">
            <h5>makes it easy to find machine learning models</h5>
          </div>
        </div>
        </div>
      </div>
    </div>
    <!-- End Carousel -->

    <div class="container pt-0 pb-5">
      <div class="border border-2 border-bottom m-auto" style="width: 100%; opacity: 0.7"></div>
    </div>
    
    <div class="card py-6 mt-0" id="projects" style="background-color: #285430; border-radius: 0">
      <div class="col-12" data-aos="zoom-in">
        <div class="card py-5 mx-5">
          <div class="card-header lh-lg py-0">
            <h6 class="text-center fw-bolder fs-3">PROJECTS</h6>
            <p class="text-center fs-6">Your recent projects</p>
          </div>
          <div class="card-body p-3">
            <div class="row">
              @foreach($projects as $project)
              <div class="col-xl-2 col-md-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card card-blog card-plain text-center">
                  <div class="position-relative">
                    <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-md">
                      <i class="ni ni-paper-diploma mt-2 text-center opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                  <div class="card-body px-1">
                    <a href="javascript:;">
                      <h5>
                        {{ $project->title }}
                      </h5>
                    </a>
                    <p class="my-2 text-sm">
                      {{ $fileCountsByProjectId[$project->id] }} File(s)
                    </p>
                    <p class="my-2 text-sm">
                        {{ $labelCountsByProjectId[$project->id] }} Label(s)
                    </p>
                    <div class="d-flex align-items-center justify-content-center">
                      <a href="{{ url('view-project/' . $project->id) }}" class="btn bg-gradient-success btn-sm my-2">View Project</a>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
              <div class="col-xl-4 col-md-12 mb-xl-0 mb-4">
                <div class="card h-100 card-plain border">
                  <div class="card-body d-flex flex-column justify-content-center text-center">
                    <a href="{{ url('create-project') }}">
                      <i class="fa fa-plus text-secondary mb-3"></i>
                      <h5 class=" text-secondary"> New project </h5>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('dashboard')
  <script>
    window.onload = function() {
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
              borderColor: "#3A416F",
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
    }
  </script>
@endpush

