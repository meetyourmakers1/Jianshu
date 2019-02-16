@if(\Auth::id() != $user->id)
    <div>
        @if(\Auth::user()->hasStar($user->id))
            <button class="btn btn-default like-button" like-value="1" like-user="{{$user->id}}" type="button">取消关注</button>
        @else
            <button class="btn btn-default like-button" like-value="0" like-user="{{$user->id}}" type="button">关注</button>
        @endif
    </div>
@endif