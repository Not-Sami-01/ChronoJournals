<div class="container">
  <link rel="stylesheet" href="{{ url('/css/style.css') }}">
  @php
  $tracker = new helpers();
@endphp

  @if ($asc)
    <button wire:loading.attr='disabled' class="my-2 btn border btn-sm" wire:click='toggleAsc'>
      Descending
    </button>
  @else
    <button wire:loading.attr='disabled' class="my-2 btn btn-outline-secondary btn-sm" wire:click='toggleAsc'>
      Ascending
    </button>
  @endif

  @if (!$all)
    <button class="btn btn-outline-secondary btn-sm" wire:loading.attr='disabled' wire:click='setPagination({{ $pagination === 10 ? 30 : 10 }})'>
      Set pagination to {{ $pagination === 10 ? '30' : '10' }} | (Current: {{ $pagination }})
    </button>
  @endif

  @if (!request()->is('recyclebin'))
    <label>Search</label>
    <input type="text" wire:model.live='search' class="border border-dark">
  @endif

  <div wire:loading class="my-2" style="float: right;">
    <div class="spinner-border text-warning mx-auto p-0" style="margin-bottom: -1px;" role="status"></div>
  </div>

  <h4>Total results: {{ count($journals) }}</h4>

  <div class="container-fluid">
    @foreach ($journals as $journal)
      @php
        $update = $tracker->compareValue((int) getMonth($journal->journal_date_time));
      @endphp
      @if ($loop->index !== 0 && !$update)
        <div class="container d-flex">
          <p class="month-name">{{ getMonthAndYear($journal->journal_date_time) }}</p>
          <span class="month-flex">
            <span class="month-line"></span>
          </span>
        </div>
      @endif

      <div class="card my-1">
        <div class="card-header d-flex justify-content-between">
          <div class="d-inline">
            <div class="journal-index">#{{ count($journals) - $loop->index }} - {{ formatDate($journal->journal_date_time) }}</div>
          </div>

          @if (request()->is('recyclebin'))
            <div class="d-inline">
              <div class="d-inline mx-2 cursor-pointer" wire:click='restoreDelete(@json($journal->_id))'>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-recycle" viewBox="0 0 16 16">
                  <path d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.5.5 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244z"/>
                </svg>
              </div>
              <div class="d-inline mx-2 cursor-pointer" wire:click='forceDelete(@json($journal->_id))'>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                </svg>
              </div>
            </div>
          @else
            <div class="d-inline cursor-pointer" wire:click='deleteEntry(@json($journal->_id))'>
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
              </svg>
            </div>
          @endif
        </div>

        @if (request()->is('recyclebin'))
          <div class="card-body cursor-pointer">
            <p class="card-text fs-6">{!! filterString(substr($journal->content, 0, 300)) !!}...</p>
          </div>
        @else
          <div class="card-body cursor-pointer" wire:click='editJournal(@json($journal->_id))'>
            <p class="card-text fs-6">{!! filterString(substr($journal->content, 0, 300)) !!}...</p>
          </div>
        @endif
      </div>
    @endforeach
  </div>

  <div>
    @if ($search === '' && !$all)
      @if ($journals->hasPages())
      <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        <!-- Previous Page Link -->
        @if ($journals->onFirstPage())
          <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
            {!! __('pagination.previous') !!}
          </span>
        @else
          <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            {!! __('pagination.previous') !!}
          </button>
        @endif
  
        <!-- Pagination Links -->
        <span class="container">
          @for ($i = 1; $i <= $journals->lastPage(); $i++)
            <a class="mx-1" href="{{ url("/?page=$i") }}">{{ $i }}</a>
          @endfor
        </span>
  
        <!-- Next Page Link -->
        @if ($journals->hasMorePages())
          <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            {!! __('pagination.next') !!}
          </button>
        @else
          <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
            {!! __('pagination.next') !!}
          </span>
        @endif
      </nav>
      @endif
    @endif
  </div>

  <script src="{{ asset('/js/activityDetector.js') }}"></script>
  <script>
  $(document).ready(function() {
    $('.card-body img').each(function() {
        $(this).replaceWith('<div>***Image</div>'); // Replace the image with the div
    });
});
</script>
</div>
