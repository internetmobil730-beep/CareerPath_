<div class="offcanvas-header d-md-none">
    <h5 class="offcanvas-title" id="sidebarOffcanvasLabel">CareerPath</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>

<div class="sidebar">
    <div class="sidebar-header text-center py-3">
        <img width="200px" height="200px" src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid rounded-circle shadow-sm mb-2 mt-2">
        <p class="text-secondary small mt-2">{{ optional(Auth::user())->name }}</p>
    </div>
    
    <ul class="list-unstyled ps-0 mt-4">
        <li><a href="{{ route('dashboard.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">Ana Sayfa</a></li>
        <li><a href="{{ route('dashboard.majors.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.majors.index') ? 'active' : '' }}">Bölümler</a></li>
        <li><a href="{{ route('dashboard.universities.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.universities.index') ? 'active' : '' }}">Üniversiteler</a></li>
        <li><a href="{{ route('dashboard.skills.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.skills.index') ? 'active' : '' }}">Beceriler</a></li>
        <li><a href="{{ route('dashboard.skill_categories.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.skill_categories.index') ? 'active' : '' }}">Beceri Kategorileri</a></li>
        <li><a href="{{ route('dashboard.users.index') }}" class="sidebar-link {{ request()->routeIs('dashboard.users.index') ? 'active' : '' }}">Kullanıcılar</a></li>
       
    </ul>
</div>
