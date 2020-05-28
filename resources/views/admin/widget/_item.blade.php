<tr role="row" class="odd">

    <td>{{ $data['title'] }}</td>
    <td>{{ $data['type'] }}</td>
    <td width=200>

        <form onsubmit="return confirm('Please confirm you want to delete!');" action="{{ route('admin.widgets.destroy',$data['id']) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            @if($data['type']=='page')
            <a class="btn btn-sm btn-success" href="{{ route('admin.pages.edit',$data['post_id'])}}">Update</a>
            @elseif($data['type']=="article")
            <a class="btn btn-sm btn-success" href="{{ route('admin.articles.edit',$data['post_id'])}}">Update</a>
            @else
            <a class="btn btn-sm btn-success" href="{{ route('admin.widgets.edit',$data['id'])}}">Update</a>
            @endif

            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
