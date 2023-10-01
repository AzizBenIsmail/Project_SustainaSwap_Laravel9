<!doctype html>
<html lang="en">

@include('basic component.head')

<body>

<main>

    @include('basic component.navbar')

    <div class="container mt-5 ">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 mt-3">
                <h1 class="text-center mt-5">Add New Item</h1>

                <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="title">Title :</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="description">Description :</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="category">Catégorie :</label>
                        <select name="category" class="form-control" required>
                            <option value="Bricolage">Bricolage</option>
                            <option value="Jardinage">Jardinage</option>
                            <option value="Peinture">Peinture</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="state">State :</label>
                        <select name="state" class="form-control" required>
                            <option value="Good">Good</option>
                            <option value="Bad">Bad</option>
                            <option value="Medium">Medium</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="picture">Picture :</label>
                        <input type="file" name="picture" class="form-control" required>
                    </div>
                    <div >
                        <button type="submit" class="btn btn-primary mt-5">Add New Item</button>
                    </div>
                </form>
            </div>
            <div class=" mt-3"></div>
            <div class=" mt-3"></div>
        </div>
    </div>
</main>

@include('basic component.footer')
@include('basic component.JAVASCRIPT_FILES')

</body>
</html>