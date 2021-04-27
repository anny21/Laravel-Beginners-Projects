@extends('layouts.app')
@section('headerScript')
<style>
.pagination li {
  display: inline-block;
}
</style>

<!-- <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=60844da5cb8a6e001abbe269&product=inline-share-buttons" async="async"></script> -->
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Anonymous Messages') }}
                    <p>
  <button onclick="copyText('{{url('/'. auth()->user()->username)}}')" style="vertical-align:top;">Copy link to post message</button>
  <!-- <textarea class="js-copytextarea">Hello I'm some text</textarea> -->
</p>
                    @forelse(auth()->user()->messages()->paginate(5) as $message)
                    <div class="card mt-3">
  <div class="card-body">
    {{$message->message}}
    <!-- <div class="sharethis-inline-share-buttons"></div> -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message{{$message->id}}">
  View Message
</button>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="message{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      {{$message->message}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="copyText('{{$message->message}}')">Copy Mesage</button>
      </div>
    </div>
  </div>
</div>
@empty
<div class="card mt-3">
  <div class="card-body">
    No messages yet
  </div>
</div>
@endforelse

<div class="float-right">
{{auth()->user()->messages()->paginate(5)->links('pagination::bootstrap-4')}}
</div>


                </div>
            </div>
        </div>
    </div>
   
</div>

<script>

const copyText = str => {
let el = document.createElement("p");
el.innerHTML = str;
document.body.appendChild(el);
const range = document.createRange();
  range.selectNode(el);
  window.getSelection().addRange(range);
  document.execCommand('copy');
  window.getSelection().removeAllRanges();
  document.body.removeChild(el);
  alert('Text copied');
};

</script>
@endsection
