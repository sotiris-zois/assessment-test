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
    <a href="{{ route('addForm') }}">Add New Product</a>
    <BR><BR>
    <strong>Recent updates </strong><BR>
    <BR>
    <div id="recentChanges">
    </div>
    <BR><BR>
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
    <table id="results" border="5" cellpadding="10">
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
        </thead>
        <tbody>
        </tbody>
    </table>
    <BR>
    <div id="pagination-links" style="padding: 100px;margin: 100px;">

    </div>
    <BR>
    <div id="recent">

    </div>
</body>
<script src="{{ asset('js/jQuery.js') }}"></script>
<script>
    function getProducts(pageNum = 1) {
        let endpoint = "{{ route('productsList') }}";
        $.ajax({
            type: 'get',
            url: endpoint,
            contentType: 'application/json',
            data: {
                category_id: $('#category').val(),
                page: pageNum
            },
            dataType: 'JSON'
        }).done(function(response) {

            if (response.success && response.data.data) {
                let i;
                let data = response.data.data;
                let table = $('#results > tbody');
                table.empty();
                for (i = 0; i < data.length; i++) {

                    let row = document.createElement('tr');

                    let nameCol = document.createElement('td');
                    let codeCol = document.createElement('td');
                    let categoryCol = document.createElement('td');
                    let priceCol = document.createElement('td');
                    let releaseDateCol = document.createElement('td');
                    let tagsCol = document.createElement('td');
                    let actionsCol = document.createElement('td');

                    nameCol.textContent = data[i].name;
                    codeCol.textContent = data[i].code;
                    categoryCol.textContent = data[i].category.title;
                    priceCol.textContent = data[i].price;
                    releaseDateCol.textContent = data[i].release_date;
                    actionsCol.innerHTML = '<a target="_blank" href="products/update/' + data[i].id +
                        '">Edit</a>';
                    data[i].tags.forEach(function(tag) {
                        tagsCol.textContent += tag.title + ', ';
                    });
                    row.append(nameCol, codeCol, categoryCol, priceCol, releaseDateCol,
                        tagsCol, actionsCol);
                    table.append(row);
                }
                let links = $('#pagination-links');
                links.empty();
                let prev = document.createElement('a');
                prev.href = "#";
                prev.textContent = '<= Prev';
                prev.innerHTML += "&nbsp;&nbsp;&nbsp;";
                prev.onclick = function() {
                    getProducts(parseInt(response.data.current_page - 1));
                }
                let next = document.createElement('a');
                next.href = "#";
                next.textContent = 'Next =>';
                next.onclick = function() {
                    getProducts(parseInt(response.data.current_page + 1));
                }
                links.append(prev, next);
            }
        });
    }
    $(document).ready(function() {


        const socket = new WebSocket('ws://localhost:3000');

        socket.addEventListener('open', function(event) {
            console.log('Connected to the WebSocket server');
        });

        socket.addEventListener('message', function(event) {
            let recentChanges = $('#recentChanges');
            let data = JSON.parse(event.data);
            console.log(data);
            let type = data.type;

            data = data.data;
            let paragraph = document.createElement('p');

            paragraph.innerHTML = 'New product event: ' + type+'<BR>';
            paragraph.innerHTML += 'Name: ' + data.name + '<BR>';
            paragraph.innerHTML += 'Code: ' + data.code + '<BR>';
            paragraph.innerHTML += 'Category: ' + data.category.title + '<BR>';
            paragraph.innerHTML += 'Price: ' + data.price + '<BR>';
            paragraph.innerHTML += 'Release Date: ' + data.release_date + '<BR>';
            paragraph.innerHTML += 'Tags: ';

            data.tags.forEach(element => {
                paragraph.innerHTML += element.title + ',';
            });
            recentChanges.prepend(paragraph);
        });

        socket.addEventListener('close', function(event) {
            console.log('Connection closed');
        });

        $('#filter').on('submit', function(e) {

            e.preventDefault();

            getProducts();
        });

    });
</script>

</html>
