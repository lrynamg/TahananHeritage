
<x-app-layout> 
<div class="row block">
    <div class="col h-50">
        <div class="card bg-dark text-white border-0 card-banner">
            <img class="card-img" src="/images/home_banner.jpg" alt="Card image" style="height: 100%; object-fit: cover;">
            <div class="card-img-overlay d-flex align-items-end gradient-banner">
                <h1 class="card-title ms-3 mb-2">Preserving Our Past, Inspiring Our Future</h1>
            </div>
        </div>
    </div>
</div>


{{-- sit with us --}}
<div class="row m-lg-5 block">
    <div class="col-6 d-flex justify-content-end">
        <img src="/images/upuan.png" alt="upuan" />
    </div>

    <div class="col-6 d-flex align-items-center">
        <div>
            <h1>Sit with history for a moment</h1>
            <h3>-because preserving the past keeps us grounded in who we are.</h3>
        </div>

    </div>
</div>

{{--  bintana  --}}
<div class="row desc_design block">
    <div class="col text-center mt-5 mb-5 d-flex flex-column align-items-center">
        <img src=" /images/bintana.png" alt="bintana" class="mb-3 img-fluid img_customsize" />
        <p class="w-50 mx-auto p_desc_design">
            Ancestral Houses of the Philippines is a digital gateway to our nation’s living history. Here, we celebrate the beauty, craftsmanship, and stories behind heritage homes—reminders of our rich cultural identity. Through this platform, we aim to inspire appreciation, promote responsible tourism, and advocate for the preservation of these treasures for generations to come.
        </p>
        <button class="btn btn-dark rounded-pill orange_btn">Adopt a House</button>
    </div>
</div>

{{--  Homes of the Month  --}}
<div class="row mt-5 block">
    <div class="col text-center">
        <h1>Homes of the Month</h1>
    </div>
</div>

<div class="row p-5 pt-2" ng-init="showTblHome()">

    <div class="col" ng-repeat="home in tblHomeData | limitTo:4">
        <div class="card text-center card_custom card-animation">

            {{-- <img ng-src="{{ home.imagePath + home.imageName }}"
                 class="card-img img_fit"
                 alt="{{ home.house_name }}"
                 style="height: 250px; object-fit: cover;"> --}}

            <div class="card-img-overlay d-flex flex-column justify-content-end text-white">

                {{-- <h5 class="card-title">{{ home.house_name }}</h5> --}}

                <button class="btn peach_btn rounded-pill w-auto text-center"
                        >
                    View
                </button>
            </div>
        </div>
    </div>
</div>

{{--  our mission  --}}

<div class="row p-5 block">
    <div class="col-6">
        <img src=" /images/clarin.jpg" alt="Clarin House" class="rounded-5 w-100 h-100 shadow-sm" />
    </div>

    <div class="col-6 d-flex align-items-center">
        <div class="text-end ms-5">
            <h1>Our Mission</h1>
            <p>Our mission is to preserve and celebrate the ancestral houses of the Philippines by sharing their stories, promoting their historical and cultural value, and inspiring collective action for their protection. Through education, advocacy, and immersive experiences, we aim to connect communities to their heritage and ensure these timeless treasures endure for future generations.</p>
        </div>
    </div>
</div>

{{--  discover ancestral homes near you  --}}
<div class="row block">
    <div class="col text-center">
        <h1>Discover Ancestral Homes Near You</h1>

        <div class="row p-5 pt-2" ng-init="showTblLoc()">

            <div class="col">
                <select class="form-select rounded-pill text-center"
                        style="cursor: pointer;"
                        >
                    <option value="">Select Region</option>
                </select>
            </div>

            <div class="col">
                <select class="form-select rounded-pill text-center"
                        style="cursor: pointer;"
                        >
                    <option value="">Select Province</option>
                </select>
            </div>

            <div class="col">
                <select class="form-select rounded-pill text-center"
                        style="cursor: pointer;"
                        >
                    <option value="">Select City</option>
                  
                </select>
            </div>

            <div class="col">
                <button class="btn w-100 rounded-pill text-white"
                        style="background-color: #c05a18; border: none;"
                      >
                    Visit
                </button>
            </div>
        </div>

        <img src=" /images/homepage_footer2.png" alt="Alternate Text" class="w-100" />
    </div>
</div>

</x-app-layout>