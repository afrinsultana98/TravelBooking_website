@extends('admin.layouts.master')
@section('title', 'Product List')
@push('styles')
    <style>
        .desc-box {
            max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }
    </style>
@endpush
@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header mb-4">
                            <span class="h3">Feature create</span>
                            <a href="{{ route('feature.index') }}" class="btn btn-warning rounded float-end">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('feature.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name">Name<span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Feature name"
                                    />
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description">Description<sub class="opacity-50">(optional)</sub></label>
                                    <textarea name="description" placeholder="Description" class="form-control" rows="5">{{ old('description') }}</textarea>
                                </div>
                                <div class="mbl-3">
                                    <label for="image">Image<span class="text-danger">*</span></label>
                                    <input
                                        type="file"
                                        class="form-control-file"
                                        name="image"
                                        value="{{ old('image') }}"
                                    /><br>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary" type="submit">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
