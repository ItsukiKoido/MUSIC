{{-- resources/views/partials/left-column.blade.php --}}
<div id="left-column">
    <div class="inside-line">
        <h2>Thread</h2>
    </div>
    <div class='likes'>
        @foreach($likes as $like)
        <div class='like'>
            <a href="/{{$like->id}}/post">
                {{$like->thread->live->artist->name}} / {{$like->thread->live->livename}} / {{$like->thread->threadname}}
            </a>
            <form id="form_{{$like->id}}" action="/{{$like->id}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="delete">
                    <p type="button" onclick="deleteLike({{ $like->id }})"><span></span></p> 
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
