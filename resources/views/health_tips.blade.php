@extends('layout.client')

@section('title', 'Health Tips')

@section('page_head')
<style>
    .health-tips-page { background: #f6f9fc; min-height: 60vh; }
    .health-tips-page__intro { max-width: 680px; margin: 0 auto 30px; }
    .health-tip-card { border: 1px solid #e1eaf3; border-radius: 14px; box-shadow: 0 4px 14px rgba(20, 49, 78, .05); }
    .health-tip-card h2 { color: #123b63; font-size: 21px; }
    .health-tip-card .btn { color: #075ca8; border-color: #b9d4ed; }
    .health-tip-card .btn:hover { background: #075ca8; border-color: #075ca8; }
</style>
@endsection

@section('content')
<main class="health-tips-page py-5">
    <div class="container">
        <div class="health-tips-page__intro text-center">
            <p class="text-uppercase small fw-semibold text-primary mb-2">Learn for your health</p>
            <h1 class="mb-3">Health tips you can use</h1>
            <p class="text-muted mb-0">Practical, easy-to-read guidance from the MediSync team.</p>
        </div>
        <div class="row g-4">
            @forelse($pages as $page)
                <div class="col-md-6 col-lg-4">
                    <article class="health-tip-card h-100 bg-white p-4 d-flex flex-column">
                        <h2 class="mb-3">{{ ucfirst(strtolower($page->title)) }}</h2>
                        <div class="text-muted mb-4 flex-grow-1">{{ \Illuminate\Support\Str::limit(strip_tags($page->text), 150) }}</div>
                        <a href="{{ route('pages.show', $page->slug) }}" class="btn btn-outline-primary align-self-start">Read article</a>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">Health tips will be available soon.</div>
            @endforelse
        </div>
    </div>
</main>
@endsection
