
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

        <h2>Upload Image</h2>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('images.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Choose Image</label>
                <input type="file" id="image" name="image" class="@error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
