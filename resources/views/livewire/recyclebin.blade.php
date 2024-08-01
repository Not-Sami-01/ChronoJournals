<div>
  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
      <strong>Success!</strong> {{ session()->get('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @if (session()->has('error'))
    <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
      <strong>Error!</strong> {{ session()->get('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <div wire:loading class="container">Loading</div>
  @livewire('journals', ['Recyclebin' => true])
  <script src="{{ asset('/js/activityDetector.js') }}" ></script>

</div>
