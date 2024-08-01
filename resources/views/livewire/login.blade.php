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
  <div class="container">
    <h1 class="text-center my-3">Login to continue</h1>
    <form class="border p-3 mb-3 rounded bg-secondary text-light" wire:submit='authenticate'>
      @csrf
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" autofocus wire:model="username" required value="{{ old('username') }}" class="form-control" />
        @error('username') <span>{{$message}}</span> @enderror
      </div>
      <div class="">
        <label class="form-label">Password</label>
        <input required autocomplete="off" type="password" wire:model="password" class="form-control password" />
        @error('password') <span>{{$message}}</span> @enderror
      </div>
      <div class="mb-3">
        <div class="form-check">
          <input class="form-check-input showPassword" type="checkbox" />
          <label class="form-check-label"> Show password</label>
        </div>
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary container-fluid rounded">
          Submit
        </button>
      </div>
      <p class="form-text py-0 my-0 text-light">Don't have an account? <a class="text-light" href="{{ url('/signup') }}"
          wire:navigate >Signup</a></p>
    </form>
  </div>
</div>
