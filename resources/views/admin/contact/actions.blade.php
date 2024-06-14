@canany(['contacts-view', 'contacts-edit', 'contacts-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('contacts-view')
                    <a href="{{ route('contacts.show',$contact->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('contacts-edit')
                    <a href="{{ route('contacts.edit',$contact->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('contacts-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany
