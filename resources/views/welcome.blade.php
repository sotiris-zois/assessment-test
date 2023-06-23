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
         @if (!$success)
                <div style="font-family: Figtree; color:red">
                    {{ $message }}
                </div>

        @else
            @if (!empty($new_product))
            <div>
                     Name: &nbsp;&nbsp;
                <strong>
                    {{ $new_product->name }}
                </strong>
                <BR>
                    Code: &nbsp;&nbsp;
                <strong>
                    {{ $new_product->code }}
                </strong>
                <BR>
                    Category: &nbsp;&nbsp;
                <strong>
                    {{ $new_product->category->title }}
                </strong>
                <BR>
                    Price: &nbsp;&nbsp;
                <strong>
                    {{ $new_product->price }}
                </strong>
                <BR>
                    Release Date: &nbsp;&nbsp;
                <strong>
                    {{ $new_product->release_date }}
                </strong>
                <BR>
                    Tags<BR>
                <strong>
                    @foreach ($new_product->tags as $tag )
                        <strong>{{ $tag->title }},</strong>
                    @endforeach
                </strong>
                <BR>
            </div>
            @endif


                @if(!empty($products))
                <div style="font-family: Figtree">
                <strong> PRODUCTS LIST </strong><BR><BR>
                    <table border="5">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Code</td>
                                <td>Category</td>
                                <td>Price</td>
                                <td>Release Date</td>
                                <td>Tags</td>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach ($products as $product)
                            <tr>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    {{ $product->code }}
                                </td>
                                <td>
                                    {{ $product->category->title }}
                                </td>
                                <td>
                                    {{ $product->price }}
                                </td>
                                <td>
                                    {{ $product->release_date }}
                                </td>
                                <td>
                                    @foreach ($product->tags as $tag )
                                        <strong>{{ $tag->title }},</strong>
                                    @endforeach
                                </td>
                            </tr>
                    @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            @endif
    </body>
</html>
