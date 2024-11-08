<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Sponsor - Sponsorify</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md m-4">
            <form method="POST" class="bg-white shadow-md rounded-xl px-8 pt-6 pb-8 mb-4 flex flex-col items-center"
                enctype="multipart/form-data">
                <div class="mb-8 text-center">
                    <p class="text-xl font-bold">Data Sponsor</p>
                    <p class="text-sm text-gray-400">Silahkan isi data sponsor dengan benar</p>
                </div>

                @error('message')
                    <div role="alert" class="alert alert-warning mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Warning: {{ $errors->first() }}</span>
                    </div>
                @enderror

                @csrf
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text font-bold">Nama sponsor</span>
                    </div>
                    <input type="text" placeholder="Type here" name="name"
                        class="input input-bordered w-full max-w-xs" required />
                </label>

                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text font-bold">Email</span>
                    </div>
                    <input type="email" name="email" placeholder="Type here"
                        class="input input-bordered w-full max-w-xs" required />
                </label>

                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text font-bold">Description</span>
                    </div>
                    <textarea type="text" name="description" placeholder="Type here" class="input input-bordered w-full max-w-xs"
                        required></textarea>
                </label>

                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text font-bold">Address</span>
                    </div>
                    <input type="text" placeholder="Type here" name="address"
                        class="input input-bordered w-full max-w-xs" required />
                </label>

                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text font-bold">Category</span>
                    </div>
                    <select class="select select-bordered w-full max-w-xs" name="category" required>
                        <option disabled selected>Category</option>
                        @foreach ($categories as $category)
                            <option value={{ $category->id }}>{{ $category->category }}</option>
                        @endforeach
                    </select>
                </label>


                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text font-bold">Batas pengumpulan proposal</span>
                    </div>
                    <input type="text" placeholder="Type here" name="maxSubmissionDate"
                        class="input input-bordered w-full max-w-xs" required />
                </label>

                <label class="form-control w-full max-w-xs mb-5">
                    <div class="label">
                        <span class="label-text font-bold">Image</span>
                    </div>
                    <input type="file" placeholder="Type here" name="image" class="file-input file-input-bordered"
                        required />
                </label>

                <input type="hidden" name="idUser" value={{ $authUser }}>

                <div class="form-control flex items-center justify-between">
                    <button class="btn bg-gray-600 text-white w-80">Submit</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>
