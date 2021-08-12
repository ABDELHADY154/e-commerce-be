@extends('layouts.app')

@section('js')

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imageResult')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function() {
        $('#upload').on('change', function() {
            readURL(input);
        });
    });

    /*  ==========================================
        SHOW UPLOADED IMAGE NAME
    * ========================================== */
    var input = document.getElementById('upload');
    var infoArea = document.getElementById('upload-label');

    input.addEventListener('change', showFileName);

    function showFileName(event) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = 'File name: ' + fileName;
    }

</script>

@endsection
@section('css')
<style>
    #upload {
        opacity: 0;
    }

    #upload-label {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
    }

    .image-area {
        border: 2px dashed rgba(255, 255, 255, 0.7);
        padding: 1rem;
        position: relative;
    }

    .image-area::before {
        content: 'Uploaded image result';
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 0.8rem;
        z-index: 1;
    }

    .image-area img {
        z-index: 2;
        position: relative;
    }

    /*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/
    body {
        min-height: 100vh;
        background-color: #757f9a;
        background-image: linear-gradient(147deg, #757f9a 0%, #d7dde8 100%);
    }

</style>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Brand</h1>
</div>

{{-- <div class="container"> --}}
<div class="card p-3">
    <form class="" method="POST" action="{{route('brand.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="">Brand</label>
                <input type="text" name="brand" class="form-control form-control-user" id="exampleFirstName" placeholder="EX: Tommy">
                @error('brand')
                <p class="text-danger text-center mt-2">{{$message}}</p>
                @enderror
            </div>

        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="">Brand Description</label>

                <textarea name="brand_desc" id="" class="form-control" cols="30" rows="10"></textarea>
                @error('brand_desc')
                <p class="text-danger text-center mt-2">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="">Brand Gender</label>

                <select class="custom-select" name="gender_id">
                    <option selected>Choose Gender</option>
                    @foreach ($genders as $gender)
                    <option value="{{ $gender->id }}">{{ $gender->gender_name }}</option>
                    @endforeach
                </select>
                @error('gender_id')
                <p class="text-danger text-center mt-2">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-6 mb-sm-0">
                <label for="">Brand Logo</label>


                <!-- Upload image input-->
                <div class="input-group  px-2 py-2 rounded-pill bg-white shadow-sm">
                    <input id="upload" type="file" onchange="readURL(this);" name="brand_image" class="form-control border-0">
                    <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                    <div class="input-group-append">
                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                    </div>
                </div>

                <!-- Uploaded image area-->
                <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                @error('brand_image')
                <p class="text-danger text-center mt-2">{{$message}}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
{{-- </div> --}}


@endsection
