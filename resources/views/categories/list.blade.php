@extends('layouts.main')

@section('title', $title)

@section('content')
    <div class="content-wrapper">
        <h1 class="page-title">Category List</h1>
        
        @can('create', \App\Models\category::class)
        <a href="{{ route('categories.create-form') }}" class="new-product-button">New Category</a>
        @endcan
        @if (isset($categories) && count($categories) > 0)
            <table class="category-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>No. Of Products</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                <a href="{{ route('categories.view', $category->code) }}">{{ $category->code }}</a>
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->products_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-container">
                {{ $categories->links() }}
            </div>
        @else
            <p class="no-results">No categories found.</p>
        @endif
    </div>
@endsection
