@extends('admin.admin_layout')
@section('title', 'Pages')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pages</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.pages') }}" class="btn btn-primary btn-sm float-right">List Pages</a>
                </div>
                <div class="card-body table-responsive">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('pages.update', $page->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $page->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $page->title }}" id="title" required>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ $page->slug }}" id="slug" required>
                        </div>
                        <div class="form-group">
                            <label for="text">Text</label>
                            <textarea name="text" id="summernote" class="form-control" required>{{ $page->text }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="show_nav">Show in Navigation</label>
                            <select name="show_nav" class="form-control" required>
                                <option value="1" {{ $page->show_nav == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ $page->show_nav == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="show_tips">Show Tips</label>
                            <select name="show_tips" class="form-control" required>
                                <option value="1" {{ $page->show_tips == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ $page->show_tips == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="published">Published</label>
                            <select name="published" class="form-control" required>
                                <option value="Published" {{ $page->published == 'Published' ? 'selected' : '' }}>Published</option>
                                <option value="Unpublished" {{ $page->published == 'Unpublished' ? 'selected' : '' }}>Unpublished</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.pages') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('#summernote').summernote({
            height: 200
        });

        // Auto-generate slug from title
        $('#title').on('input', function() {
            var title = $(this).val();
            var slug = title.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')  // Replace non-alphanumeric characters with hyphens
                .replace(/^-+/, '')           // Remove leading hyphens
                .replace(/-+$/, '');          // Remove trailing hyphens
            $('#slug').val(slug);  // Set the slug field value
        });
    });
</script>
@endsection
