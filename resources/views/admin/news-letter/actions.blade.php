@canany(['newsLetters-view', 'newsLetters-edit', 'newsLetters-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('news-letters.destroy',$newsLetter->id) }}" method="POST">
                @csrf
                @method('DELETE')
                {{-- @can('newsLetters-view')
                    <a href="{{ route('news-letters.show',$newsLetter->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('newsLetters-edit')
                    <a href="{{ route('news-letters.edit',$newsLetter->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan --}}
                @can('newsLetters-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany
