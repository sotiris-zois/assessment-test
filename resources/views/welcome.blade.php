<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>eSupplier - Assessment test for AmDocs</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="antialiased">
        <form id="filter" >
            Category:
            <select id="category">
                {{ print_r(request()->session()->all()); }}
                @foreach ($categories as $category )
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            <input type="submit" value="Filter Category" />
        </form>
    </body>
    <script src="{{ asset('js/jQuery.js') }}"></script>
<script>
    $(document).ready(function() {

        $('#filter').on('submit',function(e) {

            e.preventDefault();

            let endpoint = "{{ route('productsList') }}";
            $.ajax({
                type: 'get',
                url:endpoint,
                contentType: 'application/json',
                data: {
                    category_id: $('#category').val()
                },
                dataType: 'JSON'
            }).done(function(response) {
                console.log(response);
                if (response.success && response.data.data) {
                    let i;
                    for(i=0;i<response.data.data.length;i++){
                        let row = document.createElement('tr');
                        let nameColumn = document.createElement('td');
                        let nameColumn = document.createElement('td');
                        let nameColumn = document.createElement('td');
                        let nameColumn = document.createElement('td');
                        let nameColumn = document.createElement('td');
                        let nameColumn = document.createElement('td');
                    }
                }
            });
        });
    });
</script>
</html>
