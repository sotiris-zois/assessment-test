<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eSupplier - Assessment test for AmDocs</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body class="antialiased">
    <form id="filter">
        Category:
        <select id="category">
            {{ print_r(request()->session()->all()) }}
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
        <input type="submit" value="Filter Category" />
    </form>
    <BR><BR>
    <table id="results" border="5">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Category</th>
                <th>Price</th>
                <th>Release Date</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
    </table>
    <BR><BR>
    <div id="recent">

    </div>
</body>
<script src="{{ asset('js/jQuery.js') }}"></script>
<script>
    $(document).ready(function() {

        const socket = new WebSocket('ws://localhost:3000');

        socket.addEventListener('open', function(event) {
            console.log('Connected to the WebSocket server');
        });

        socket.addEventListener('message', function(event) {
            const message = event.data;
            console.log('Received message:', message);
        });

        socket.addEventListener('close', function(event) {
            console.log('Connection closed');
        });

        socket.addEventListener('product-updated', function(event) {
            console.log('Connection closed');
        });


        $('#filter').on('submit', function(e) {

            e.preventDefault();

            let endpoint = "{{ route('productsList') }}";
            $.ajax({
                type: 'get',
                url: endpoint,
                contentType: 'application/json',
                data: {
                    category_id: $('#category').val()
                },
                dataType: 'JSON'
            }).done(function(response) {
                console.log(response);
                // if (response.success && response.data.data) {
                //     let i;
                //     for(i=0;i<response.data.data.length;i++){
                //         let row = document.createElement('tr');
                //     }
                // }
            });
        });
    });
</script>

</html>
