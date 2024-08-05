<div class="container">
  <input type="hidden" id="hidden" value="{{ $journal->content }}" />
  <h1 class="text-center">Journal</h1>
  <form wire:submit.prevent='editEntry(@json($journal->_id))'>
    <div wire:ignore>
      <div class="d-inline">
        Tag <input type="text" wire:model='tag' id="tag"> <input type="datetime-local"
          wire:model='datetime'>
          <button x-data="" type="submit" class="" wire:loading.class='loading-save' wire:target='editEntry(@json($journal->_id))'  id="save">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
              <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z"/>
              <path d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z"/>
            </svg>
          </button>
        </div>
      <div wire:loading wire:target='editEntry(@json($journal->_id))' class="mx-2" style="float: right">
        <div class="spinner-border  spinner-border-sm text-warning mx-auto m-0 p-0" role="status"></div>
      </div>
      <textarea x-data="ckeditor()" id="content" class="ckeditor form-control" wire:model="content" required autofocus>{{ $journal->content }}</textarea>
      {{-- <button type="submit"  wire:loading.attr="disabled" class="btn btn-primary container-fluid">Submit</button> --}}
    </div>
    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}" id="script"></script>
    <script src="{{ asset('/js/activityDetector.js') }}" ></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
      crossorigin="anonymous"></script>
    <script type="text/javascript">
      var content = document.getElementById('hidden').value;
      var editor = CKEDITOR.replace('content');
      var val = 0;
      var save = document.getElementById('save');
      editor.setData(content);
      // Listens when textarea is changing.
      editor.on('change', function(event) {
        
        // Update wire:model value.
        @this.set('content', event.editor.getData());
      });
      editor.on('change', function(event) {
        val++;
        if(val == 10){
          save.click();
          val = 0;
        }
      })

      function ckeditor() {
        return {
          /**
           * The function creates the editor and returns its instance
           * @param $dispatch Alpine's magic property
           */
          create: function($dispatch) {
            // Create the editor with the x-ref
            var editor = CKEDITOR.replace('content');
            editor.setData(content);
          }
        }
      }
    </script>
  </form>
  {{-- </div> --}}
</div>
