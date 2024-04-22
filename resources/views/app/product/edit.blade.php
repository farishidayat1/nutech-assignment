@extends('app.layout')
<style>
    .inputfile {
        display: none;
    }
    ul {
        padding: 0;
        list-style: none;
    }
    li {
        display: inline-block;
    }
</style>
@section('content')  
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <ul>
                    <li><a href="{{ route('product') }}" style="color: darkgrey">Daftar Produk</a></li>
                    <li>></li>
                    <li style="font-weight: bolder;">Edit Produk</li>
                </ul>
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br/>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('product.update', [$product->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-control" name="category">
                                <option value="">Pilih kategori</option>
                                @foreach($product_categories as $product_category)
                                    <option value="{{ $product_category->name }}" @if($product->category == $product_category->name) selected @endif>{{ $product_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="name" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <label for="purchase_price" class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" name="purchase_price" id="purchase_price" value="{{ $product->purchase_price }}">
                        </div>
                        <div class="col-md-4">
                            <label for="selling_price" class="form-label">Harga Jual*</label>
                            <input type="number" class="form-control" name="selling_price" id="selling_price" value="{{ $product->selling_price }}">
                        </div>
                        <div class="col-md-4">
                            <label for="qty" class="form-label">Stok Barang</label>
                            <input type="number" class="form-control" name="qty" id="qty" value="{{ $product->qty }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="image" class="form-label">Upload Image</label>
                            <div class="custom-input-file py-4" style="width: 100%; border: 2px dashed #4e73df;">
                                <input type="file" id="file" class="inputfile" name="image" id="image" onchange="previewImage(this)">
                                <label for="file" style="display: block">
                                    <div class="col-md-12 d-flex justify-content-center text-center" style="flex-direction: column; cursor: pointer;">
                                        <img id="uploadPreview" src="{{ asset('storage/'.$product->image_url) }}" style="width: 100px; margin: auto; height: auto;">
                                        <span id="uploadPreviewName" class="file-button text-primary">
                                            upload gambar disini
                                        </span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <a href="{{ route('product') }}" class="mr-2 btn btn-outline-primary" style="width: 150px;">Batalkan</a>
                        <button type="submit" class="ml-2 btn btn-primary" style="width: 150px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function previewImage(input) {
            $('#uploadPreview')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
            $('#uploadPreviewName').text(input.files[0].name)
        };

        $('#purchase_price').on('change', function() {
            const val = $(this).val()
            const calculatePrice = parseFloat(val) + parseFloat(30 / 100 * val)
            $('#selling_price').val(calculatePrice)
        });
    </script>
@endsection