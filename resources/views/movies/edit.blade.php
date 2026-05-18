<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="topbar-title">Edit Film</div>
            <div class="topbar-sub">{{ $movie->title }}</div>
        </div>
    </x-slot>

    <div style="max-width:520px">
        <form action="{{ route('movies.update',$movie) }}" method="POST"
              style="background:rgba(240,255,255,0.05);border:0.5px solid rgba(135,206,235,0.15);border-radius:14px;padding:24px;display:grid;gap:16px">
            @csrf @method('PUT')
            @include('movies._form')
            <div style="display:flex;gap:10px;padding-top:4px">
                <button type="submit" class="btn-primary">Update Film</button>
                <a href="{{ route('movies.show',$movie) }}" class="btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>