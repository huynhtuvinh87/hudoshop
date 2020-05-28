<tr role="row" class="odd">

    <td width=50>
        @if($data['image'])
        <img width="50" src="{{ $data['image'] }}">
        @else
        <img width="50" src="{{ asset('images/image_default.png') }}">
        @endif
    </td>
    <td>{{ $prefix.' '.$data['title'] }}</td>
    <td>{{ $data['description'] }}</td>
    <td width=200>
        <a class="btn btn-sm btn-success" href="{{ route('admin.categories.edit',$data['id'])}}">Update</a>
        <a class="btn btn-sm btn-danger" href="{{ route('admin.categories.trash.delete',$data['id']) }}">Trash</a>
    </td>
</tr>
