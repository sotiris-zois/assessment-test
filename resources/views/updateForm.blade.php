<html>

<head>
    <title> Update Product - {{ $product->code }} </title>
</head>

<body>
    <form id="updateForm">
        Name:
        <input type="text" id="name" value="{{ $product->name }}" />
        <BR>
        Code:
        <input type="text" id="code" value="{{ $product->code }}" />
        <BR>
        Category:
        <select id="category_id">
            @foreach ($categories as $category)
            @if($category->id == $product->category_id)
                <option value="{{ $category->id }}" selected>{{ $category->title }} </option>
            @else
            <option value="{{ $category->id }}">{{ $category->title }} </option>
            @endif
            @endforeach
        </select>
        <BR>
        Price: <input type="text" id="price" value="{{ $product->price }}">
        <BR>
        Release Date : <input type="text" id="release_date" value="{{ $product->release_date }}">
        <BR>
        Tags
        <BR>
        <select multiple=true id="tags">

        </select>
        <input id="productTags" type="hidden" value="{{ $productTags }}">
        <input type="submit" value="Update">
    </form>
</body>
<script src="{{ asset('js/jQuery.js') }}"></script>
<script>
    $(document).ready(function() {

        let productTags = JSON.parse($("#productTags").val());

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
                    if(productTags.includes(data[i].id)){
                        option.selected = true;
                    }
                    option.value = data[i].id;
                    option.textContent = data[i].title;
                    tagsContainer.append(option);
                }
            }
        });

        $('#updateForm').on('submit',function(e) {

            e.preventDefault();
            let endpoint = "{{ route('productUpdate') }}";

            let request = {
                id: {{ $product->id }},
                tags: $('#tags').val(),
                category_id: $('#category_id').val(),
                name: $('#name').val(),
                code: $('#code').val(),
                release_date: $('#release_date').val()

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
