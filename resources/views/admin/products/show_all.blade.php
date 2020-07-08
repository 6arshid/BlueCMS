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

        @foreach($article as $row)

        <tr>
            <th scope="row">{{$row->id}}</th>
            <td>{{$row->title}}</td>
            <td>{{$row->content}}</td>
            <td><a href="/admin/posts/edit_post/{{$row->id}}" class="btn btn-success">Edit</a>
            <a href="/admin/posts/delete_post/{{$row->id}}" class="btn btn-danger">Delete</a></td>
        </tr>
        @endforeach()





    </tbody>
</table>

{{ $article->links() }}

@include('admin.includes.footer')