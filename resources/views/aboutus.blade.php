<x-app-layout>

<div class="row block">
    <div class="col">
        <div class="card bg-dark text-white border-0 card-banner">
            <img class="card-img" src="/images/clarin.jpg" alt="Card image">
            <div class="card-img-overlay d-flex justify-content-center align-items-center gradient-banner">
                <h1 class="card-title text-center">About Us</h1>
            </div>
        </div>
    </div>
</div>


{{--  DESCRIPTION  --}}
<div class="row p-5 m-5 block">
    <div class="col text-center">
        <div class="row">
            <p class="desc_aboutus">Ancestral Houses of the Philippines is a cultural heritage initiative dedicated to preserving the nation’s historic homes and the stories they hold. From the Spanish colonial bahay na bato to early 20th-century architectural gems, these houses stand as living witnesses to our shared history, artistry, and identity.</p>
        </div>

        <div class="row mt-1">
            <p>Founded in the Philippines through grassroots passion for heritage conservation, our project has grown into a platform that connects communities, historians, architects, and travelers. Thanks to the support of local advocates, cultural workers, and heritage enthusiasts, we work to document, promote, and protect ancestral homes across the archipelago. Our reach extends through educational resources, preservation campaigns, and collaborations with government agencies, NGOs, and private homeowners—ensuring these treasures remain standing for generations to come.</p>
        </div>
    </div>
</div>

{{--  MISSION & VISION  --}}
<div class="row p-5 m-3 mt-0 pt-0 block">
    <div class="col-6">
        <div class="card involve_desc rounded-5 shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-7">
                        <img src="/images/chest.png" alt="Alternate Text" class="img-fluid"/>
                    </div>

                    <div class="col-5">
                        <h1>
                            Our Vision
                        </h1>
                        <p class="fs-6">
                            A Philippines where every ancestral home is cherished, preserved, and celebrated as a vital link between our past, present, and future
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card form_volunteer">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <h1 class="">
                            Our Mission
                        </h1>
                        <p class="fs-6">
                            To preserve and promote the ancestral houses of the Philippines by telling their stories, showcasing their cultural and historical significance, and fostering partnerships for their protection. Through education, advocacy, and immersive experiences, we aim to inspire pride in our heritage and ensure these architectural treasures endure for generations to come.
                        </p>
                    </div>
                    <div class="col-5">
                        <img src="/images/kabinet.png" alt="Alternate Text" class="img-fluid"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--   MEET THE FOUNDERS   --}}
<div class="row block">
    <div class="col text-center">
        <h1>
            Meet the Founders
        </h1>
    </div>
</div>

<div class="row p-5 m-3 pt-0 block">

    <div class="card-slider-wrapper position-relative px-4 py-5 pt-3">
        <button class="slider-arrow position-absolute top-50 translate-middle-y z-1" style="left:1rem;">
            &lt;
        </button>

        <div id="cardSlider3" class="d-flex flex-nowrap gap-4 px-5 card-scroll">

            <div class="col">
                @foreach ($founders as $founder )
                 <div class="card volunteer_card flex-shrink-0" style="width: 300px;">
                    <img src={{ $founder['image'] }}
                         class="card-img-top img_volunteer rounded-5"
                         alt={{$founder["founder_name"]}}
                         style="height: 300px; object-fit: cover;">

                    <div class="card-body text-center">
                        <p class="card-title fw-bold">{{$founder["founder_name"]}}</p>
                        <p class="card-text">{{$founder["position"]}}</p>
                    </div>
                </div>
                @endforeach
               
            </div>
        </div>

        <div class="pagination-controls d-flex justify-content-center gap-2 mt-1 dot-group-1">
            <button class="page-dot active"  style="width:12px; height:12px;"></button>
            <button class="page-dot" style="width:12px; height:12px;"></button>
        </div>

        <button class="slider-arrow position-absolute top-50 translate-middle-y z-1" style="right: 1rem;">
            &gt;
        </button>
    </div>

</div>

{{--  FORM FOR SIGNUP  --}}
<div class="row m-2 p-5">
    <div class="col-4">
        <img src="/images/volunteer_form.jpg" alt="volunteer" class="img-fluid w-100" style="height:500px;"/>
    </div>
    <div class="col">
        <form method="post" class="border p-4 rounded-5 involve_desc" name="volunteerForm" >
            @csrf
            {{--  // Registration Form  --}}
            <div class="row">
                <div class="col">
                    <h1 class="text-center m-2 text-shadow"  style="color: #C75D2C;">Join Us in Preserving Heritage</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="form-label" style="color: #C75D2C;">First Name <span class="text-danger">*</span></label>
                    <input class="form-control rounded-pill" type="text" name="fname" value="" required/>
                    <div class="text-danger">
                        Input a valid first name.
                    </div>

                </div>
                <div class="col">
                    <label class="form-label" style="color: #C75D2C;">Last Name <span class="text-danger">*</span></label>
                    <input class="form-control rounded-pill" type="text" name="lname" value="" required/>
                    <div class="text-danger">
                        Input a valid last name.
                    </div>
                </div>
            </div>


            {{--  //email add  --}}

            <div class="row mt-3">
                <div class="col">
                    <label class="form-label" style="color: #C75D2C;">Email <span class="text-danger">*</span></label>
                    <input class="form-control rounded-pill" type="email" name="email" value="" required placeholder="youremail@gmail.com"/>
                    <div class="text-danger">
                        Input a valid email.
                    </div>
                </div>
            </div>

            {{--  //phone number  --}}

            <div class="row mt-3">
                <div class="col">
                    <label class="form-label" style="color: #C75D2C;">Phone Number <span class="text-danger">*</span></label>
                    <input class="form-control rounded-pill" type="text" name="pwd" value="" " required pattern="\d{11}" placeholder="09xxxxxxxxx"/>
                    <div class="text-danger">
                        Input a valid phone number. 
                    </div>
                </div>
            </div>

            <div class="mx-auto d-flex justify-content-center">
                <button type="button" class="btn orange_btn mt-3 rounded-pill text-center w-50">Volunteer</button>
            </div>

        </form>
    </div>
</div>
</x-app-layout>
