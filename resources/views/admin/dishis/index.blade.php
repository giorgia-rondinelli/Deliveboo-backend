@extends('layouts.admin')

@section('content')
    <div>
        <div>
            <h1 class="mb-4">Dishis</h1>
        </div>

        <div>
            <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>
                            <a href="#" class="btn btn-primary">show</a>
                            <a href="#" class="btn btn-success">create</a>
                            <a href="#" class="btn btn-warning">edit</a>
                            <a href="#" class="btn btn-danger">delete</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
        </div>
    </div>
@endsection
