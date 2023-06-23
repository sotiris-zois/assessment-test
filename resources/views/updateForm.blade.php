<html>

<head>
    <title> Update Product - {{ $product->code }} </title>
</head>

<body>
    Category
    <form id="updateForm">
        Name:
        <input type="text" id="name" value="{{ $product->name }}" />
        <BR>
        Code:
        <input type="text" id="code" value="{{ $product->code }}" />
        <BR>
        Category:
        <select id="category_id">
            @foreach ($categories as $categoy)
                <option value="{{ $category->id }}">{{ $category->title }} </option>
            @endforeach
        </select>
        <BR>
        Tags
        <BR>
        <select multiple=true id="tags">
            @foreach ($product->tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->title }} </option>
            @endforeach
        </select>
        <input type="submit" value="Update">
    </form>
</body>
<script src="{{ asset('js/jQuery.js') }}"></script>
<script>
    $(document).ready(function() {

        $('#updateForm').onSubmit(function(e) {

            e.preventDefault();

            let request = {
                id: {{ $product->id }},
                tags: $('#tags').val(),
                category_id: $('#category_id').val()
            };

            $.ajax({
                type: 'post',
                url: "'" + {{ route('productUpdate') }} " + "'",
                contentType: 'application/json',
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
