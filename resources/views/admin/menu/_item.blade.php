<tr role="row" class="odd">
    <td><input type="number" value="{{$data['order']}}" class="menu_order" data-id="{{$data['id']}}" style="width: 50px; text-align: center"></td>
    <td>{{ $prefix.' '.$data['title'] }}</td>
    <td>{{ $data['link'] }}</td>

    <td width=200>

        <form onsubmit="return confirm('Please confirm you want to delete!');" action="{{ route('admin.menus.destroy',$data['id']) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <a class="btn btn-sm btn-success" href="{{ route('admin.menus.edit',$data['id'])}}">Update</a>
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>
