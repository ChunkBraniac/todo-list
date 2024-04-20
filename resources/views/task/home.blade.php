<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-12">
                    <div class="card rounded-3">
                        <div class="card-body p-4">

                            <h4 class="text-center my-3 pb-3">To Do App</h4>

                            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2"
                                action="" method="post">
                                @csrf
                                <div class="col-12 col-xl-12">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="text" id="form1" autocomplete="off" name="task"
                                            class="form-control" @required(true) />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-primary">Save</button>
                                </div>
                            </form>

                            <table class="table mb-4 text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Todo item</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @unless (count($showTasks) == 0)
                                        @foreach ($showTasks as $tasks)
                                            <tr>
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>{{ $tasks->task }}</td>
                                                <td>{{ $tasks->status }}</td>
                                                <td>

                                                    <div class="container col-xl-5">
                                                        <div class="row">
                                                            <div class="col-xl-3">
                                                                <form action="{{ route('task.destroy', $tasks->id) }} "
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger mt-2">Delete</button>
                                                                </form>
                                                            </div>

                                                            <div class="col-xl-8">
                                                                <form action="{{ route('task.finish', $tasks->id) }} "
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success mt-2">Finished</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endunless
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
