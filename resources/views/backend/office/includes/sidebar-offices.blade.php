<li class="nav-item">
    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/offices*')) }}" href="{{ route('admin.offices.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_offices.sidebar.title')
    </a>
</li>