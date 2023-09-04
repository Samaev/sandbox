<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="
                 https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js
                 "></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <title>Add Notes</title>
</head>
<body>

<div  class='d-flex flex-column align-items-center align-self-center' style="margin: 20px 20px;">

    <div class="container container-fluid">
        <h1 class="lead text-primary">reserved by my page </h1>
        <div class="d-flex flex-column">
            <a href="/extract-logos" class="route-button">Extract Logos</a>
            <a href="/my-page" class="route-button">My Page</a>
            <a href="/create-note" class="route-button">Create Note</a>
            <a href="/create-engagement" class="route-button">Create Engagement WORKS!!!!!!!!!!</a>
            <a href="/update-deal" class="route-button">Update Deal</a>
            <hr>
            <div id="editor"></div>

            <hr>
            <button class="btn btn-dark" onclick="updateNote();">Make a Note</button>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.0/axios.min.js" integrity="sha512-aoTNnqZcT8B4AmeCFmiSnDlc4Nj/KPaZyB5G7JnOnUEkdNpCZs1LCankiYi01sLTyWy+m2P+W4XM+BuQ3Q4/Dg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
</script>
<script>
    function updateNote() {

        var noteContent = quill.root.innerHTML;
        axios.post('/create-engagement', {
             note: noteContent
        })
            .then(response => {
                console.log('You got response ' + noteContent);
            })
            .catch(error => {
                console.log('// Handle errors here');
            });
    }
</script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


</body>
</html>
