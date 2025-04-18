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
            <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="card border-0 shadow-lg my-4">
                        <div class="card-header bg-dark">
                            <h1 class="text-white">Edit Product</h1>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                
                                <!-- Name Field -->
                                <div class="mb-3">
                                    <label for="name" class="form-label h5">Name</label>
                                    <input value="{{ old('name', $product->name) }}" type="text" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name" name="name" id="name" required>
                                    @error('name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email Field -->
                                <div class="mb-3">
                                    <label for="email" class="form-label h5">Email</label>
                                    <input value="{{ old('email', $product->email) }}" type="email" class="@error('email') is-invalid @enderror form-control form-control-lg" placeholder="Email" name="email" id="email" required>
                                    @error('email')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div class="mb-3">
                                    <label for="password" class="form-label h5">Password</label>
                                    <input value="{{ old('password', $product->password) }}" type="password" class="@error('password') is-invalid @enderror form-control form-control-lg" placeholder="Password" name="password" id="password">
                                    @error('password')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Address Field -->
                                <div class="mb-3">
                                    <label for="address" class="form-label h5">Address</label>
                                    <input value="{{ old('address', $product->address) }}" type="text" class="@error('address') is-invalid @enderror form-control form-control-lg" placeholder="Address" name="address" id="address" required>
                                    @error('address')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- City Field -->
                                <div class="mb-3">
                                    <label for="city" class="form-label h5">City</label>
                                    <input value="{{ old('city', $product->city) }}" type="text" class="@error('city') is-invalid @enderror form-control form-control-lg" placeholder="City" name="city" id="city" required>
                                    @error('city')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- SKU Field -->
                                <div class="mb-3">
                                    <label for="sku" class="form-label h5">SKU</label>
                                    <input value="{{ old('sku', $product->sku) }}" type="text" class="@error('sku') is-invalid @enderror form-control form-control-lg" placeholder="SKU" name="sku" id="sku" required>
                                    @error('sku')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description Field -->
                                <div class="mb-3">
                                    <label for="description" class="form-label h5">Description</label>
                                    <textarea placeholder="Description" class="@error('description') is-invalid @enderror form-control" name="description" cols="30" rows="5">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Price Field -->
                                <div class="mb-3">
                                    <label for="price" class="form-label h5">Price</label>
                                    <input value="{{ old('price', $product->price) }}" type="number" step="0.01" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Price" name="price" id="price" required>
                                    @error('price')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Image Field -->
                                <div class="mb-3">
                                    <label for="image" class="form-label h5">Image</label>
                                    <input type="file" class="@error('image') is-invalid @enderror form-control form-control-lg" name="image" id="image">
                                    @if($product->image) <!-- Check if the image exists -->
                                        <img class="w-50 my-2" src="{{ asset('upload/products/'.$product->image) }}" alt="Product Image">
                                    @endif
                                    @error('image')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

