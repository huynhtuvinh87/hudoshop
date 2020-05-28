<tr role="row" class="odd">
    <td>{{ $prefix.' '.$data['title'] }}</td>
    <td>{{ $data['description'] }}</td>
    <td width=200>
        <a class="btn btn-sm btn-success" href="{{ route('admin.categories.edit',$data['id'])}}">Update</a>
        <a class="btn btn-sm btn-danger" href="{{ route('admin.categories.trash.delete',$data['id']) }}">Trash</a>
    </td>
</tr>
