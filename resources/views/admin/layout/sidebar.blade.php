
<li class="nav-item-header pt-0">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : ''}}" href="{{ route('dashboard') }}">
        <i class="ph-house"></i>
        <span>Dashboard</span>
    </a>
</li>
@can('chillers-list')
<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/chillers*') ? 'active' : ''}}" href="{{ route('chillers.index') }}">
        <i class="ph-book"></i>
        <span>Chiller</span>
    </a>
</li>
@endcan
@can('customers-list')
<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/customers*') ? 'active' : ''}}" href="{{ route('customers.index') }}">
        <i class="ph-users-three"></i>
        <span>Customers</span>
    </a>
</li>
@endcan
@can('projects-list')
<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/projects*') ? 'active' : ''}}" href="{{ route('projects.index') }}">
        <i class="ph-users-three"></i>
        <span>Projects</span>
    </a>
</li>
@endcan
@can('blogs-list')
<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/blogs*') ? 'active' : ''}}" href="{{ route('blogs.index') }}">
        <i class="ph-book"></i>
        <span>Blogs</span>
    </a>
</li>
@endcan
@can('brands-list')
<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/brands*') ? 'active' : ''}}" href="{{ route('brands.index') }}">
        <i class="ph-book"></i>
        <span>Brands</span>
    </a>
</li>
@endcan
@can('models-list')
<li class="nav-item">
    <a class="nav-link {{ request()->is('admin/models*') ? 'active' : ''}}" href="{{ route('models.index') }}">
        <i class="ph-book"></i>
        <span>Models</span>
    </a>
</li>
@endcan
@canany(['roles-list', 'users-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Access Management</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('roles-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('roles*') ? 'active' : ''}}" href="{{ route('roles.index') }}">
        <i class="ph-atom"></i>
        <span>Roles</span>
    </a>
</li>
@endcan
@can('users-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('users*') ? 'active' : ''}}" href="{{ route('users.index') }}">
        <i class="ph-users"></i>
        <span>Users</span>
    </a>
</li>
@endcan
@canany(['notifications-list','audits-list', 'logs-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Configuration</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('audits-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('notifications*') ? 'active' : ''}}" href="{{ route('notifications.index') }}">
        <i class="ph-bell"></i>
        <span>Notifications</span>
    </a>
</li>
@endcan
@can('audits-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('audits*') ? 'active' : ''}}" href="{{ route('audits.index') }}">
        <i class="ph-diamonds-four"></i>
        <span>Audit</span>
    </a>
</li>
@endcan
@can('logs-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('logs*') ? 'active' : ''}}" href="{{ route('logs') }}" target="_blank">
        <i class="ph-bug"></i>
        <span>Errors</span>
    </a>
</li>
@endcan
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('settings*') ? 'active' : ''}}" href="{{ route('settings.index') }}">
        <i class="ph-gear"></i>
        <span>Settings</span>
    </a>
</li>
