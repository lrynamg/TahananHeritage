<x-app-layout>
  

{{-- banner --}}

<div class="row block">
    <div class="col h-50">
        <div class="card bg-dark text-white border-0 card-banner">
            <img class="card-img" src="/images/marcela.jpg" alt="Card image" style="height: 100%; object-fit: cover;">
            <div class="card-img-overlay d-flex justify-content-center align-items-center  gradient-banner">
                <h1 class="card-title text-center">Ancestral Homes</h1>
            </div>
        </div>
    </div>
</div>

{{--  Most Popular  --}}
<div class="row mt-5">
    <div class="col text-center">
        <h1>Most Popular</h1>
    </div>
</div>

{{-- 2nd wor  --}}
<div class="container-fluid py-5">


    <div class="card-slider-wrapper position-relative px-4">
        <button class="slider-arrow position-absolute top-50 translate-middle-y start-0 ms-4"
                onclick="scrollSlider('popularSlider', -1)">
            <i class="fas fa-chevron-left"></i>
        </button>

      <div id="popularSlider" class="d-flex flex-nowrap gap-4 px-2 card-scroll" style="overflow-x: auto; scroll-behavior: smooth;">
    @foreach ($heritageHomes as $home)
        <div class="card border-0 shadow-sm flex-shrink-0" style="width: 300px;">
            <img src="{{ asset('images/' . $home['image']) }}"
                 class="card-img-top rounded-4"
                 alt="{{ $home['home_name'] }}"
                 style="height: 250px; object-fit: cover;">
            <div class="card-body px-3">
                <h5 class="fw-bold mb-1">{{ $home['home_name'] }}</h5>
                <p class="text-muted mb-0">{{ $home['location'] }}</p>
            </div>
        </div>
    @endforeach
</div>


        <button class="slider-arrow position-absolute top-50 translate-middle-y end-0 me-4"
                onclick="scrollSlider('popularSlider', 1)">
            <i class="fas fa-chevron-right"></i>
        </button>

        <div class="d-flex justify-content-center gap-2 mt-3">
            <span class="page-dot active"></span>
            <span class="page-dot"></span>
        </div>
    </div>
</div>

{{--  UNDERRATED GEMS  --}}
<div class="row my-2">
    <div class="col text-center">
        <h1>Underrated Gems</h1>
    </div>
</div>

<div class="card-slider-wrapper position-relative px-4">
    <button class="slider-arrow position-absolute top-50 translate-middle-y start-0 ms-4"
            onclick="scrollSlider('underratedSlider', -1)">
        <i class="fas fa-chevron-left"></i>
    </button>

    {{-- <div id="underratedSlider" class="d-flex flex-nowrap gap-4 px-2 card-scroll" style="overflow-x: auto; scroll-behavior: smooth;">

        <div class="col-auto">
            <div class="card border-0 shadow-sm" style="width: 300px;">
                <img src=""
                     class="card-img-top rounded-4"
                     alt="house name"
                     style="height: 250px; object-fit: cover;">
                <div class="card-body px-0">
                    <h5 class="fw-bold mb-1">house name</h5>
                    <p class="text-muted mb-0">house location</p>
                </div>
            </div>
        </div>

    </div> --}}

    <div id="popularSlider" class="d-flex flex-nowrap gap-4 px-2 card-scroll" style="overflow-x: auto; scroll-behavior: smooth;">
    @foreach ($heritageHomes as $home)
        <div class="card border-0 shadow-sm flex-shrink-0" style="width: 300px;">
            <img src="{{ asset('images/' . $home['image']) }}"
                 class="card-img-top rounded-4"
                 alt="{{ $home['home_name'] }}"
                 style="height: 250px; object-fit: cover;">
            <div class="card-body px-3">
                <h5 class="fw-bold mb-1">{{ $home['home_name'] }}</h5>
                <p class="text-muted mb-0">{{ $home['location'] }}</p>
            </div>
        </div>
    @endforeach
</div>


    <button class="slider-arrow position-absolute top-50 translate-middle-y end-0 me-4"
            onclick="scrollSlider('underratedSlider', 1)">
        <i class="fas fa-chevron-right"></i>
    </button>

    <div class="d-flex justify-content-center gap-2 mt-3">
        <span class="page-dot active"></span>
        <span class="page-dot"></span>
    </div>
</div>

<div class="text-end container my-4">
    <button class="btn text-white rounded-pill px-4 py-2" style="background-color: #c05a18;">Explore More</button>
</div>
</x-app-layout>
