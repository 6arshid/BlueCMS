@include('admin.includes.header')

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach($attributes as $row)

        <tr>
            <th scope="row">{{$row->id}}</th>
            <td>{{$row->attribute_title}}</td>
            <td><a href="/admin/products/edit_attribute/{{$row->id}}" class="btn btn-success">Edit</a>
            <a href="/admin/products/delete_attribute/{{$row->id}}" class="btn btn-danger">Delete</a></td>
        </tr>
        @endforeach()





    </tbody>
</table>

{{ $attributes->links() }}

@include('admin.includes.footer')