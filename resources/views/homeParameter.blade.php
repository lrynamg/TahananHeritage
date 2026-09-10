<x-app-layout>
    <div class="card border-0 shadow-sm" style="width: 300px;">
    <img src="{{ asset('images/' . $home['image']) }}"
         class="card-img-top rounded-4"
         alt="{{ $home['home_name'] }}"
         style="height: 250px; object-fit: cover;">
    <div class="card-body px-3">
        <h5 class="fw-bold mb-1">{{ $home['home_name'] }}</h5>
        <p class="text-muted mb-0">{{ $home['location'] }}</p>
    </div>
</div>
</x-app-layout>
