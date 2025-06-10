@extends('layouts.app')

@section('title', 'Search Halal Restaurants')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Search Filters</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('search') }}" method="GET">
                    <div class="form-group mb-3">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ request('location') }}">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="cuisine">Cuisine Type</label>
                        <select name="cuisine" id="cuisine" class="form-control">
                            <option value="">All Cuisines</option>
                            @foreach($cuisineTypes as $type)
                                <option value="{{ $type }}" {{ request('cuisine') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="certification">Certification Body</label>
                        <select name="certification" id="certification" class="form-control">
                            <option value="">All Certifications</option>
                            @foreach($certificationBodies as $body)
                                <option value="{{ $body }}" {{ request('certification') == $body ? 'selected' : '' }}>{{ $body }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Search Results</h5>
            </div>
            <div class="card-body">
                @include('partials.map')
                
                <div class="list-group mt-4">
                    @foreach($restaurants as $restaurant)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>{{ $restaurant->name }}</h5>
                                    <p class="mb-1">{{ $restaurant->address }}, {{ $restaurant->city }}</p>
                                    <small class="text-muted">{{ $restaurant->cuisine_type }}</small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-success">Halal Certified</span>
                                    <div class="mt-2">
                                        <a href="{{ route('restaurant.show', $restaurant) }}" class="btn btn-sm btn-primary">View</a>
                                        @auth
                                            <button class="btn btn-sm btn-outline-primary toggle-favorite" data-id="{{ $restaurant->id }}">
                                                <i class="far fa-heart"></i> Save
                                            </button>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-4">
                    {{ $restaurants->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Initialize map here
    // Favorite toggle functionality
    $(document).ready(function() {
        $('.toggle-favorite').click(function() {
            const restaurantId = $(this).data('id');
            // AJAX call to toggle favorite
        });
    });
</script>
@endsection