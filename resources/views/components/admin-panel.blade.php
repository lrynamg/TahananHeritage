<div>
      <nav class="sidebar">
      <div class="sidebar-header">
          <h3><i class="fas fa-landmark"></i> Tahanan<br><small>Admin Panel</small></h3>
      </div>

      <ul class="components">
          <li>
              <a href="/dashboard">
                  <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
              </a>
          </li>
          {{-- <li>
              <a href="/Main/HeritageArticles">
                  <i class="fas fa-newspaper mr-2"></i> Articles
              </a>
          </li> --}}

          <li>
              <a href="/admin/users">
                  <i class="fas fa-user-tie mr-2"></i> Founders
              </a>
          </li>

          {{-- <li>
              <a href="/admin/">
                  <i class="fas fa-map-marker-alt mr-2"></i> Locations
              </a>
          </li> --}}

          <li>
              <a href="/admin/homes">
                  <i class="fas fa-home mr-2"></i> Heritage Houses
              </a>
          </li>

          <li>
              <a href="/admin/volunteers">
                  <i class="fas fa-hands-helping mr-2"></i> Volunteers
              </a>
          </li>
      </ul>

      <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn text-white">
                     <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>


      </div>
  </nav>
</div>