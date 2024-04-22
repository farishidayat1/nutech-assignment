@extends('app.layout')
<style>
    .btn-primary {
        margin-bottom: 20px;
    }
    .btn-custom {
        height: 25px !important;
        font-size: 12px !important;
        line-height: 10px !important;
    }
    td {
        border-top: none !important;
    }

    nav svg {
        height: 10px;
    }

    nav .flex .relative {
        display: none;
    }

    .has-search .form-control {
        padding-left: 2.375rem;
    }

    .has-search .form-control-feedback {
        position: absolute;
        z-index: 2;
        display: block;
        width: 2.375rem;
        height: 2.375rem;
        line-height: 2.375rem;
        text-align: center;
        pointer-events: none;
        color: #aaa;
    }
</style>
@section('content')  
    <div class="container-fluid">
        <div class="card shadow mb-4">
            @if(session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif
            @if(session()->has('error_message'))
                <div class="alert alert-error">
                    {{ session()->get('error_message') }}
                </div>
            @endif
            <div class="card-body">
                <h6 class="m-0 font-weight-bold" style="font-size: 20px; color: black;">Daftar Produk</h6>
                <div class="d-flex col-md-12">
                    <div class="mt-2 col-md-6">
                        <form class="d-flex" action="{{ route('product') }}" id="form" method="GET" enctype="multipart/form-data">
                            <div class="form-group has-search col-6">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="Cari Barang" onchange="submitForm()">
                            </div>
                            <div class="form-group has-search col-4">
                                <img class="form-control-feedback" style="background: black;" src="{{ asset('cms-assets/Package.png')}}" />
                                <select class="form-control" name="category" onchange="submitForm()">
                                    <option value="">Semua</option>
                                    @foreach($product_categories as $product_category)
                                        <option value="{{ $product_category->name }}" @if($category == $product_category->name) selected @endif>{{ $product_category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="mt-2 d-flex justify-content-end col-md-6">
                        <a class="btn btn-icon-split btn-custom" href="{{ route('product.export', ['search' => $search, 'category' => $category]) }}" style="background: #197510; color: white !important;"> 
                            <img src="{{ asset('cms-assets/MicrosoftExcelLogo.png')}}" />
                            <span class="text">Export Excel</span>
                        </a> 
                        <a class="btn btn-icon-split ml-4 btn-custom" href="{{ route('product.create') }}" style="background: #F13B2F; color: white !important;"> 
                            <img src="{{ asset('cms-assets/PlusCircle.png')}}" />
                            <span class="text">Tambah Produk</span>
                        </a>    
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Nama Produk</th>
                                <th>Kategori Produk</th>
                                <th>Harga Beli(Rp)</th>
                                <th>Harga Jual(Rp)</th>
                                <th>Stok Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $index => $product)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>
                                        <img src="{{ asset('storage/'.$product->image_url) }}" style="width: 50px; height: 50px;" alt="{{ $product->name }}">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>{{ number_format($product->purchase_price, 0) }}</td>
                                    <td>{{ number_format($product->selling_price, 0) }}</td>
                                    <td>
                                        {{ $product->qty }}
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div>
                                                <a class="mr-2" href="{{ route('product.edit', [$product->id]) }}">
                                                    <img src="{{ asset('cms-assets/edit.png')}}" />
                                                </a>
                                            </div>
                                            <div>
                                                <form action="{{ route('product.delete', [$product->id])}}" id="form-delete-{{ $product->id }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $product->id }}"/>
                                                </form>
                                                <a onclick="confirmationDelete({{ $product->id }})">
                                                    <img src="{{ asset('cms-assets/delete.png')}}" />
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmationDelete(id) {
            const alert = confirm('Are you sure to delete this product ?')
            if(alert) {
                $("#form-delete-"+id).submit();
            }
        }

        function submitForm() {
            $('#form').submit()
        }
    </script>
@endsection