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

        @foreach($pages as $row)

        <tr>
            <th scope="row">{{$row->id}}</th>
            <td><a href="/pages/{{$row->id}}" target="_blank">{{$row->title}}</a></td>
            <td>{{$row->content}}</td>
            <td><a href="/admin/pages/edit_page/{{$row->id}}" class="btn btn-success">Edit</a>
            <a href="/admin/pages/delete_page/{{$row->id}}" class="btn btn-danger">Delete</a></td>
        </tr>
        @endforeach()





    </tbody>
</table>

{{ $pages->links() }}

@include('admin.includes.footer')