<div>
    <label style="display:block;font-size:12px;color:rgba(240,255,255,0.5);margin-bottom:6px">Judul Film</label>
    <input type="text" name="title" value="{{ old('title', isset($movie) ? $movie->title : '') }}"
           placeholder="Masukkan judul film"
           style="width:100%;background:rgba(240,255,255,0.07);border:0.5px solid rgba(135,206,235,0.25);border-radius:12px;padding:12px;font-size:14px;color:#F0FFFF;outline:none"
           onfocus="this.style.borderColor='rgba(135,206,235,0.6)'"
           onblur="this.style.borderColor='rgba(135,206,235,0.25)'">
    @error('title')<p style="font-size:11px;color:#F09595;margin-top:4px">{{ $message }}</p>@enderror
</div>

<div>
    <label style="display:block;font-size:12px;color:rgba(240,255,255,0.5);margin-bottom:6px">Genre</label>
    <input type="text" name="genre" value="{{ old('genre', isset($movie) ? $movie->genre : '') }}"
           placeholder="Action, Drama, Sci-Fi..."
           style="width:100%;background:rgba(240,255,255,0.07);border:0.5px solid rgba(135,206,235,0.25);border-radius:12px;padding:12px;font-size:14px;color:#F0FFFF;outline:none"
           onfocus="this.style.borderColor='rgba(135,206,235,0.6)'"
           onblur="this.style.borderColor='rgba(135,206,235,0.25)'">
    @error('genre')<p style="font-size:11px;color:#F09595;margin-top:4px">{{ $message }}</p>@enderror
</div>

<div>
    <label style="display:block;font-size:12px;color:rgba(240,255,255,0.5);margin-bottom:6px">Status</label>
    <select name="status"
            style="width:100%;background:rgba(10,0,50,0.8);border:0.5px solid rgba(135,206,235,0.25);border-radius:12px;padding:12px;font-size:14px;color:#F0FFFF;outline:none">
        @foreach(['want to watch','watching','completed'] as $s)
        <option value="{{ $s }}" {{ old('status', isset($movie) ? $movie->status : '')===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
</div>

<div>
    <label style="display:block;font-size:12px;color:rgba(240,255,255,0.5);margin-bottom:6px">Rating (0–10, opsional)</label>
    <input type="number" name="rating" step="0.1" min="0" max="10"
           value="{{ old('rating', isset($movie) ? $movie->rating : '') }}"
           placeholder="8.5"
           style="width:100%;background:rgba(240,255,255,0.07);border:0.5px solid rgba(135,206,235,0.25);border-radius:12px;padding:12px;font-size:14px;color:#F0FFFF;outline:none"
           onfocus="this.style.borderColor='rgba(135,206,235,0.6)'"
           onblur="this.style.borderColor='rgba(135,206,235,0.25)'">
</div>

<div>
    <label style="display:block;font-size:12px;color:rgba(240,255,255,0.5);margin-bottom:6px">Deskripsi (opsional)</label>
    <textarea name="description" rows="4" placeholder="Tulis deskripsi singkat..."
              style="width:100%;background:rgba(240,255,255,0.07);border:0.5px solid rgba(135,206,235,0.25);border-radius:12px;padding:12px;font-size:14px;color:#F0FFFF;outline:none;resize:none"
              onfocus="this.style.borderColor='rgba(135,206,235,0.6)'"
              onblur="this.style.borderColor='rgba(135,206,235,0.25)'">{{ old('description', isset($movie) ? $movie->description : '') }}</textarea>
</div>