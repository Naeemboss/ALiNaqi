<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="bg-dark py-3">
    <h4 class="text-white text-center">Simple Laravel CRUD Update Version</h4>
</div>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('products.create') }}" class="btn btn-dark">Create</a>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <!-- Corrected session check -->
        @if (session()->has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            </div>
        @endif
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h1 class="text-white">Products</h1>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Sku</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        @if ($products->isNotEmpty())
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->email }}</td>
                                    <td>{{ $product->password }}</td>
                                    <td>{{ $product->address }}</td>
                                    <td>{{ $product->city }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        @if($product->image)
                                            <img width="50" src="{{ asset('upload/products/'.$product->image) }}" alt="">
                                        @else
                                            <span>No image</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d, M, Y') }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark">Edit</a>
                                        <a href="#" onclick="deleteProduct({{ $product->id }});" class="btn btn-danger">Delete</a>

                                        <!-- Delete form (hidden by default) -->
                                        <form id="delete-product-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="post" style="display: none;">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12" class="text-center">No products available.</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script>
function deleteProduct(id) {
    if (confirm('Are you sure you want to delete this product?')) {
        document.getElementById('delete-product-form-' + id).submit();
    }
}
</script>



