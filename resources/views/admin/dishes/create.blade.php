@extends('layouts.admin')

@section('content')
    <div>
        <div>
            <p>dish create</p>
        </div>

        <div>
            <form action="">
                {{-- dish name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                {{-- description --}}
                <div class="mb-3">
                    <label for="text" class="form-label">Description</label>
                    <textarea class="form-control me-2">Description</textarea>
                </div>

                {{-- price --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input name="price" type="text" class="form-control" id="price">
                </div>

                {{-- is visible --}}
                <div class="mb-3 checkbox">
                    <label class="form-label">Is visible</label>
                    <div class="btn-group btn-group-sm" role="group">
                        <input type="checkbox" class="btn-check" id="btncheck1">
                        <label class="btn btn-outline-primary">is visible</label>
                    </div>
                </div>

                {{-- img --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" id="" type="file" name="">
                    <img class="" id="" src="">
                </div>
            </form>
        </div>
    </div>
@endsection
