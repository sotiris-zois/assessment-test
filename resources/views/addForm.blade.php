<html>

<head>
    <title> Add Product  </title>
</head>

<body>
    <form id="addForm">
        Name:
        <input type="text" id="name"   />
        <BR>
        Code:
        <input type="text" id="code"   />
        <BR>
        Category:
        <select id="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }} </option>
            @endforeach
        </select>
        <BR>
        Price: <input type="text" id="price"  >
        <BR>
        Release Date : <input type="text" id="release_date"  >
        <BR>
        Tags
        <BR>
        <select multiple=true id="tags">

        </select>
        <input type="submit" value="Add product">
    </form>
</body>
<script src="{{ asset('js/jQuery.js') }}"></script>
<script>
    $(document).ready(function() {

        let endpoint = "{{ route('getTags') }}";

        $.ajax({
            type: 'get',
            url: endpoint,
            contentType: 'application/json',
            dataType: 'JSON'
        }).done(function(response) {
            console.log(response);
            if (response.success === true) {
                data = response.data;
                let i;
                let tagsContainer = $('#tags');
                for( i =0; i<data.length; i++ ){
                    let option = document.createElement('option');
                    option.value = data[i].id;
                    option.textContent = data[i].title;
                    tagsContainer.append(option);
                }
            }
        });

        $('#addForm').on('submit',function(e) {

            e.preventDefault();
            let endpoint = "{{ route('createProduct') }}";

            let request = {
                tags: $('#tags').val(),
                category_id: $('#category_id').val(),
                name: $('#name').val(),
                code: $('#code').val(),
                release_date: $('#release_date').val(),
                price: $("#price").val()
            };

            $.ajax({
                type: 'post',
                url: endpoint,
                data: request,
                dataType: 'JSON'
            }).done(function(response) {
                console.log(response);
                if (response.success === true) {

                }
            });
        });
    });
</script>

</html>
