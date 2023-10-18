@if ($errors->any())
  <div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            @foreach (array_unique($errors->all()) as $error)
               <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        </div>
    </div>
  </div>
@endif