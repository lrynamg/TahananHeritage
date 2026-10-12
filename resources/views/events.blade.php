<x-app-layout>

{{--  HERO BANNER  --}}
<div class="row block">
    <div class="col h-50">
        <div class="card bg-dark text-white border-0 card-banner">
            <img class="card-img" src="/images/marcela.jpg" alt="Card image" style="height: 100%; object-fit: cover;">
            <div class="card-img-overlay d-flex justify-content-center align-items-center  gradient-banner">
                <h1 class="card-title text-center">Events</h1>
            </div>
        </div>
    </div>
</div>


{{--  FEATURED EVENT INTRO  --}}
<div class="row p-5 m-5 pb-0 block">
    <div class="col text-center">
        <h1>Featured Event</h1>
        <p>Join us in celebrating and protecting the heritage homes of the Philippines.</p>
    </div>
</div>

{{--  FEATURED EVENT CARD  --}}
<div class="row p-5 m-3 pt-0 block">
    <div class="col">
        <div class="card involve_desc rounded-5 shadow-sm border-0 overflow-hidden">
            <div class="row g-0 align-items-center">
                <div class="col-md-5">
                    <img src="~/images/vigan-tour.jpg" class="img-fluid img_fit w-100 h-100" alt="Vigan heritage tour" style="object-fit: cover;">
                </div>
                <div class="col-md-7">
                    <div class="card-body p-4">
                        <span class="tag">Guided Tour</span>
                        <h1 class="fs-2">Walk Through History: Vigan Heritage Tour</h1>
                        <p class="fs-6">Explore centuries-old ancestral homes with local historians as your guide. Learn the stories behind the facades and the families who built them.</p>
                        <p class="fw-bold mb-4">October 18, 2026 &nbsp;&nbsp;|&nbsp;&nbsp; Vigan, Ilocos Sur</p>
                        <button type="button" class="btn orange_btn rounded-pill">Reserve a Slot</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--  UPCOMING EVENTS INTRO  --}}
<div class="row p-5 pb-0 block">
    <div class="col text-center">
        <h1>Upcoming Events</h1>
        <p>A few more ways to get involved this season.</p>
    </div>
</div>

{{--  UPCOMING EVENTS GRID  --}}
<div class="row p-5 m-3 pt-0 g-4 block">
    <div class="col-md-4">
        <div class="card volunteer_card rounded-5 shadow-sm border-0 h-100">
            <img src="~/images/restoration-workshop.jpg" class="card-img-top" alt="Restoration Basics Workshop" style="height: 200px; object-fit: cover; border-radius: 30px 30px 0 0;">
            <div class="card-body">
                <p class="fw-bold mb-1" style="color: #C75D2C;">November 5, 2026</p>
                <h1 class="fs-4">Restoration Basics Workshop</h1>
                <p class="fs-6">A hands-on session on traditional materials and simple upkeep for old wooden homes.</p>
                <a href="#" class="fw-bold text-decoration-none" style="color: #C75D2C;">Learn More &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card volunteer_card rounded-5 shadow-sm border-0 h-100">
            <img src="~/images/photography-walk.jpg" class="card-img-top" alt="Heritage Photography Walk" style="height: 200px; object-fit: cover; border-radius: 30px 30px 0 0;">
            <div class="card-body">
                <p class="fw-bold mb-1" style="color: #C75D2C;">November 20, 2026</p>
                <h1 class="fs-4">Heritage Photography Walk</h1>
                <p class="fs-6">Capture ancestral houses through your lens and help document them for our archive.</p>
                <a href="#" class="fw-bold text-decoration-none" style="color: #C75D2C;">Learn More &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card volunteer_card rounded-5 shadow-sm border-0 h-100">
            <img src="~/images/community-talk.jpg" class="card-img-top" alt="Community Talk: Why Heritage Matters" style="height: 200px; object-fit: cover; border-radius: 30px 30px 0 0;">
            <div class="card-body">
                <p class="fw-bold mb-1" style="color: #C75D2C;">December 3, 2026</p>
                <h1 class="fs-4">Community Talk: Why Heritage Matters</h1>
                <p class="fs-6">An open discussion with local historians on preserving our built heritage for the next generation.</p>
                <a href="#" class="fw-bold text-decoration-none" style="color: #C75D2C;">Learn More &rarr;</a>
            </div>
        </div>
    </div>
</div>

{{--  STATS STRIP  --}}
<div class="row p-5 m-3 pt-0 block">
    <div class="col">
        <div class="card involve_desc rounded-5 shadow-sm border-0">
            <div class="card-body row text-center py-4">
                <div class="col">
                    <h1 class="fs-2">12</h1>
                    <p class="fs-6">Events this year</p>
                </div>
                <div class="col">
                    <h1 class="fs-2">480+</h1>
                    <p class="fs-6">Participants</p>
                </div>
                <div class="col">
                    <h1 class="fs-2">9</h1>
                    <p class="fs-6">Provinces reached</p>
                </div>
                <div class="col">
                    <h1 class="fs-2">25</h1>
                    <p class="fs-6">Partner homes</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{--  NEWSLETTER SIGNUP  --}}
<div class="row p-5 m-3 pt-0 block">
    <div class="col">
        <div class="card form_volunteer rounded-5 border-0 text-center p-4">
            <h1 class="fs-2">Never Miss an Event</h1>
            <p class="fs-6">Sign up to get notified about our upcoming tours, workshops, and talks.</p>

            <form method="post" class="d-flex justify-content-center gap-2 flex-wrap mt-2">
                @csrf
                <input type="email" name="newsletter_email" class="form-control rounded-pill" style="max-width: 300px;" placeholder="your@email.com" required>
                <button type="submit" class="btn peach_btn rounded-pill">Notify Me</button>
            </form>
        </div>
    </div>
</div>

</x-app-layout>