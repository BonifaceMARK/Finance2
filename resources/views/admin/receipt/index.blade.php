
@extends('layout.title')

@section('title', 'Employee Dashboard')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('admin.header')


  <!-- ======= Sidebar ======= -->
 @include('admin.sidebar')

  <main id="main" class="main">

    <section class="section dashboard">
      <div class="row">

        <h2>Uploaded Images</h2>

        @if ($images->isEmpty())
            <p>No images found.</p>
        @else
            <div class="row">
                @foreach ($images as $image)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="{{ asset($image->image_path) }}" class="card-img-top" alt="Image">
                            <div class="card-body">
                                <p class="card-text">Uploaded: {{ $image->created_at->diffForHumans() }}</p>
                                <!-- Add delete button here -->
                                <form action="{{ route('images.destroy', $image->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
