<x-admin-layout>
    <div>
        <div style="margin-bottom: 3rem;">
            <h1 style="font-size: 2.5rem; margin-bottom: 1rem; font-family: "Instrument Serif", serif;">Dashboard</h1>
            <p style="font-size: 1.1rem; color: #c55c2c;">Welcome to Tahanan Heritage Admin Panel</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
            <div class="admin-card" style="text-align: center; padding: 2rem;">
                <div style="font-size: 2.5rem; color: #c55c2c; margin-bottom: 0.5rem;">??</div>
                <h3 style="margin-bottom: 0.5rem; font-size: 1.8rem;">{{ $volunteersCount }}</h3>
                <p style="color: #999;">Total Volunteers</p>
            </div>
            
            <div class="admin-card" style="text-align: center; padding: 2rem;">
                <div style="font-size: 2.5rem; color: #c55c2c; margin-bottom: 0.5rem;">???</div>
                <h3 style="margin-bottom: 0.5rem; font-size: 1.8rem;">{{ $foundersCount }}</h3>
                <p style="color: #999;">Founders</p>
            </div>
            
            <div class="admin-card" style="text-align: center; padding: 2rem;">
                <div style="font-size: 2.5rem; color: #c55c2c; margin-bottom: 0.5rem;">??</div>
                <h3 style="margin-bottom: 0.5rem; font-size: 1.8rem;">{{ $homesCount }}</h3>
                <p style="color: #999;">Heritage Homes</p>
            </div>
        </div>
        
        <div class="admin-card">
            <h2 style="margin-bottom: 1.5rem;">Quick Actions</h2>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route("admin.volunteers.create") }}" class="btn-heritage">+ Add Volunteer</a>
                <a href="{{ route("admin.founders.create") }}" class="btn-heritage">+ Add Founder</a>
                <a href="{{ route("admin.homes.create") }}" class="btn-heritage">+ Add Home</a>
            </div>
        </div>
    </div>
</x-admin-layout>
