{{-- resources/views/admin/products/create.blade.php --}}
@extends('layouts.app')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root{--cream:#FDF5F0;--blush:#F2C4CE;--rose:#E8A0B0;--deep-rose:#C4748A;--gold:#C9A96E;--gold-light:#E8D5B0;--gold-pale:#FAF3E8;--dark:#3A2028;--text:#4A2E34;--muted:#9C7A80;--white:#FFFAF8;--panel-bg:#FDF8F5;--border:rgba(196,116,138,0.13);}
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    .page{padding:36px 40px;background:var(--cream);min-height:100vh;font-family:'Raleway',sans-serif;}

    /* ── Breadcrumb nav ── */
    .nav-row{display:flex;align-items:center;gap:10px;margin-bottom:22px;opacity:0;animation:fadeUp .5s ease forwards .02s;}
    .btn-back{display:inline-flex;align-items:center;gap:7px;padding:8px 16px;background:transparent;border:1px solid rgba(201,169,110,.25);color:var(--muted);font-family:'Raleway',sans-serif;font-size:9px;font-weight:400;letter-spacing:2.5px;text-transform:uppercase;text-decoration:none;transition:all .22s ease;}
    .btn-back:hover{background:rgba(201,169,110,.07);border-color:var(--gold);color:var(--gold);transform:translateX(-2px);}
    .btn-back svg{transition:transform .22s;}.btn-back:hover svg{transform:translateX(-3px);}
    .nav-sep{color:rgba(201,169,110,.35);font-size:12px;}
    .btn-back-products{display:inline-flex;align-items:center;gap:7px;padding:8px 16px;background:transparent;border:1px solid rgba(201,169,110,.25);color:var(--muted);font-family:'Raleway',sans-serif;font-size:9px;letter-spacing:2.5px;text-transform:uppercase;text-decoration:none;transition:all .22s;}
    .btn-back-products:hover{background:rgba(201,169,110,.07);border-color:var(--gold);color:var(--gold);}

    /* ── Header ── */
    .page-eyebrow{font-size:9px;letter-spacing:4px;text-transform:uppercase;color:var(--gold);font-weight:400;margin-bottom:6px;opacity:0;animation:fadeUp .5s ease forwards .08s;}
    .page-title{font-family:'Cormorant Garamond',serif;font-weight:300;font-size:34px;color:var(--dark);line-height:1;opacity:0;animation:fadeUp .5s ease forwards .14s;}
    .page-title em{font-style:italic;color:var(--deep-rose);}

    /* ── Gold divider ── */
    .gold-divider{display:flex;align-items:center;gap:10px;margin:16px 0 30px;opacity:0;animation:fadeUp .5s ease forwards .2s;}
    .gold-divider span{flex:1;height:1px;}.gold-divider span:first-child{background:linear-gradient(to right,transparent,var(--gold));}.gold-divider span:last-child{background:linear-gradient(to left,transparent,var(--gold));}.gold-divider i{width:4px;height:4px;border-radius:50%;background:var(--gold);display:inline-block;}

    /* ── Form layout ── */
    .form-wrap{display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start;}
    @media(max-width:900px){.form-wrap{grid-template-columns:1fr;}}

    /* ── Card ── */
    .card{background:var(--panel-bg);border:1px solid rgba(201,169,110,.15);box-shadow:0 12px 40px rgba(58,32,40,.06);overflow:hidden;opacity:0;animation:fadeUp .5s ease forwards .26s;}
    .card::before{content:'';display:block;height:3px;background:linear-gradient(to right,var(--rose),var(--gold),var(--blush),var(--gold),var(--rose));background-size:200% 100%;animation:shimmerBar 3s linear infinite;}
    @keyframes shimmerBar{from{background-position:200% 0}to{background-position:-200% 0}}
    .card-head{padding:18px 24px;border-bottom:1px solid rgba(201,169,110,.12);background:rgba(201,169,110,.04);}
    .card-head h3{font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:400;color:var(--dark);}
    .card-head h3 em{color:var(--deep-rose);font-style:italic;}
    .card-body{padding:24px;}

    /* ── Fields (same as login page style) ── */
    .field{margin-bottom:20px;position:relative;}
    .field:last-child{margin-bottom:0;}
    .field label{display:block;font-size:9px;letter-spacing:3px;text-transform:uppercase;color:var(--gold);font-weight:500;margin-bottom:8px;}
    .field input,.field textarea,.field select{width:100%;background:#fff;border:1px solid rgba(201,169,110,.22);border-radius:0;padding:12px 16px;color:var(--dark);font-family:'Raleway',sans-serif;font-size:13px;font-weight:300;letter-spacing:.4px;outline:none;transition:border-color .3s,box-shadow .3s;box-shadow:0 1px 4px rgba(196,116,138,.05);}
    .field input::placeholder,.field textarea::placeholder{color:rgba(58,32,40,.25);font-size:12px;}
    .field input:focus,.field textarea:focus,.field select:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,169,110,.1),0 2px 8px rgba(196,116,138,.07);}
    .field-bar{display:block;height:2px;background:linear-gradient(to right,var(--rose),var(--gold));width:0;transition:width .4s ease;margin-top:-1px;}
    .field:focus-within .field-bar{width:100%;}
    .field textarea{resize:vertical;min-height:90px;}
    .field select{cursor:pointer;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' fill='none'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%23C9A96E' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;}

    /* ── Form grid ── */
    .form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;}

    /* ── File upload ── */
    .file-upload-wrap{position:relative;}
    .file-upload-label{display:flex;align-items:center;gap:12px;padding:14px 16px;background:#fff;border:1px dashed rgba(201,169,110,.4);cursor:pointer;transition:border-color .25s,background .25s;}
    .file-upload-label:hover{border-color:var(--gold);background:var(--gold-pale);}
    .file-upload-label .upload-ico{font-size:20px;opacity:.6;}
    .file-upload-label .upload-text{font-size:11px;color:var(--muted);letter-spacing:.5px;}
    .file-upload-label .upload-text strong{display:block;font-size:9px;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:2px;}
    .file-upload-wrap input[type="file"]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}

    /* ── Image preview ── */
    #imgPreview{width:100%;aspect-ratio:1;object-fit:cover;border:1px solid rgba(201,169,110,.2);display:none;margin-top:12px;}
    #imgPlaceholder{width:100%;aspect-ratio:1;background:rgba(201,169,110,.06);border:1px dashed rgba(201,169,110,.25);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;margin-top:12px;}
    #imgPlaceholder span{font-size:32px;opacity:.3;}
    #imgPlaceholder p{font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--muted);}

    /* ── Error messages ── */
    .field-error{font-size:10px;color:var(--deep-rose);margin-top:5px;letter-spacing:.3px;}

    /* ── Submit button ── */
    .btn-submit{width:100%;padding:14px;background:linear-gradient(135deg,var(--deep-rose),var(--gold));border:none;color:#fff;font-family:'Raleway',sans-serif;font-size:11px;font-weight:500;letter-spacing:4px;text-transform:uppercase;cursor:pointer;position:relative;overflow:hidden;transition:transform .2s,box-shadow .2s;box-shadow:0 6px 22px rgba(196,116,138,.25);margin-top:8px;}
    .btn-submit::before{content:'';position:absolute;top:0;left:-100%;width:60%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.25),transparent);transition:left .5s ease;}
    .btn-submit:hover::before{left:160%;}.btn-submit:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(196,116,138,.35);}

    @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
    ::-webkit-scrollbar{width:4px}::-webkit-scrollbar-thumb{background:var(--blush);border-radius:4px}
</style>

<div class="page">

    {{-- ── Navigation breadcrumb ── --}}
    <div class="nav-row">
        <a href="{{ route('admin.dashboard') }}" class="btn-back">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M9 2L4 7L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Tableau de bord
        </a>
        <span class="nav-sep">·</span>
        <a href="{{ route('admin.products.index') }}" class="btn-back-products">
            Produits
        </a>
    </div>

    {{-- ── Header ── --}}
    <p class="page-eyebrow">Administration</p>
    <h1 class="page-title">Nouveau <em>Produit</em></h1>

    <div class="gold-divider"><span></span><i></i><i></i><i></i><span></span></div>

    {{-- ── Form ── --}}
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-wrap">

            {{-- ── Main fields ── --}}
            <div>
                <div class="card">
                    <div class="card-head"><h3>Informations du <em>Produit</em></h3></div>
                    <div class="card-body">

                        <div class="field">
                            <label>Nom du produit</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="ex : Sérum Éclat Doré" required>
                            <span class="field-bar"></span>
                            @error('name')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div class="field">
                            <label>Description</label>
                            <textarea name="description" placeholder="Décrivez le produit…">{{ old('description') }}</textarea>
                            <span class="field-bar"></span>
                            @error('description')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        <div class="field">
                            <label>Catégorie</label>
                            <select name="category_id">
                                <option value="">— Choisir une catégorie —</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="field-bar"></span>
                        </div>

                        <div class="form-row">
                            <div class="field">
                                <label>Prix (DZD)</label>
                                <input type="number" name="price" value="{{ old('price') }}" placeholder="0" min="0" required>
                                <span class="field-bar"></span>
                                @error('price')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="field">
                                <label>Stock disponible</label>
                                <input type="number" name="stock" value="{{ old('stock') }}" placeholder="0" min="0" required>
                                <span class="field-bar"></span>
                                @error('stock')<p class="field-error">{{ $message }}</p>@enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ── Image & submit ── --}}
            <div style="display:flex;flex-direction:column;gap:20px">

                {{-- Image upload card ── --}}
                <div class="card" style="animation-delay:.32s">
                    <div class="card-head"><h3>Image <em>Produit</em></h3></div>
                    <div class="card-body">
                        <div class="field file-upload-wrap">
                            <label class="file-upload-label" for="imageInput">
                                <span class="upload-ico">🖼️</span>
                                <div class="upload-text">
                                    <strong>Choisir une image</strong>
                                    JPG, PNG, WEBP · Max 2 Mo
                                </div>
                            </label>
                            <input type="file" id="imageInput" name="image" accept="image/*"
                                   onchange="previewImg(this)">
                            @error('image')<p class="field-error">{{ $message }}</p>@enderror
                        </div>

                        {{-- Preview ── --}}
                        <img id="imgPreview" src="" alt="Aperçu">
                        <div id="imgPlaceholder">
                            <span>🧴</span>
                            <p>Aperçu de l'image</p>
                        </div>
                    </div>
                </div>

                {{-- Submit card ── --}}
                <div class="card" style="animation-delay:.38s">
                    <div class="card-body">
                        <button type="submit" class="btn-submit">
                            ✦ Ajouter le produit
                        </button>
                        <p style="font-size:10px;color:var(--muted);text-align:center;margin-top:12px;letter-spacing:.5px">
                            Le produit sera visible immédiatement
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </form>

</div>

<script>
function previewImg(input) {
    const preview = document.getElementById('imgPreview');
    const placeholder = document.getElementById('imgPlaceholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
