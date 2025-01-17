@extends('layouts._header')

@section('content')
<div class="container-fluid">
    <!-- Dynamic Cat Cards -->
    <div class="row" id="cat-container">
        <!-- Cat images will be dynamically added here -->
    </div>

    <script>
        fetch(`https://api.thecatapi.com/v1/images/search?limit=10`, {
            headers: {
                'x-api-key': '{{env("API_KEY")}}'
            }
        })
        .then(response => response.json())
        .then(cats => {
            cats.forEach(cat => {
                $('#cat-container').append(`
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4">
                        <div class="card shadow-sm">
                            <img src="${cat.url}" class="card-img-top" alt="Cat Image" style="height: 150px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title text-truncate">Gwapa Ko</h5>
                            </div>
                        </div>
                    </div>
                `);
            });
        })
        .catch(error => {
            $('#cat-container').html('<p class="text-center text-danger">Failed to load cat images. Try again later.</p>');
            console.error('Error fetching cat images:', error);
        });
    </script>
</div>
@endsection
