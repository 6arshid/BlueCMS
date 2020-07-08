@include('admin.includes.header')

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach($menus as $row)

        <tr>
            <th scope="row">{{$row->id}}</th>
            <td>{{$row->title}}</td>
            <td>{{$row->content}}</td>
            <td><a href="/admin/menus/edit_menu/{{$row->id}}" class="btn btn-success">Edit</a>
            <a href="/admin/menus/delete_menus/{{$row->id}}" class="btn btn-danger">Delete</a></td>
        </tr>
        @endforeach()





    </tbody>
</table>

{{ $menus->links() }}

@include('admin.includes.footer')