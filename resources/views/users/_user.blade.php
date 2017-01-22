<li>
    <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar"/>
    <a href="{{ route('users.show', $user->id )}}" class="username">{{ $user->name }}</a>
    @can('destory',$user)
        <form method="post" action="{{route('users.destroy',$user->id)}}">
            {{csrf_field()}}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger delete-btn">删除</button>
        </form>
    @endcan
</li>