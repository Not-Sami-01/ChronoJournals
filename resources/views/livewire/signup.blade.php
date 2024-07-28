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
      <h1 class="text-center my-3">Signup to continue</h1>
      <form class="border p-3 mb-3 rounded bg" wire:submit="save" >
        {{-- <input type="hidden" wire:model="_token" value="{{ csrf_token() }}"> --}}
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" wire:model="username" value="{{ old('username') }}" class="form-control" />
          @error('username')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input autocomplete="off" type="password" wire:model="password" class="form-control password" />
          @error('password')
            <span class="text-danger">{{ $message }} </span>
          @enderror
        </div>
        <div class="">
          <label class="form-label">Confirm password</label>
          <input autocomplete="off" type="password" wire:model="password_confirmation" class="form-control password" />
          @error('password_confirmation')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-3">
          <div class="form-check">
            <input class="form-check-input showPassword" type="checkbox" />
            <label class="form-check-label"> Show password</label>
          </div>
        </div>
        <div class="mb-3">
          <button wire:click.prevent='save' type="submit" class="btn btn-primary container-fluid rounded">
            Submit
          </button>
        </div>
        <p class="form-text py-0 my-0 text-dark">Already have an account? <a wire:navigate class=""
            href="{{ url('/login') }}">Login</a></p>

      </form>
    </div>

  </div>


{{-- resources/views/livewire/example-component.blade.php --}}

