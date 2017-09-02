<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/vue"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
                crossorigin="anonymous"></script>
    </head>
    <body>

        <div class="container" id="app">
            <h2>Send message to your subscribers</h2>
            <form>
                <div class="form-group">
                    <label>Message:</label>
                    <textarea v-model="message" class="form-control"></textarea>
                </div>
                <button v-on:click="sendMessage" class="btn btn-default">Submit</button>
            </form>
        </div>

        <script src="{{asset('js/vue-app.js')}}"> </script>
    </body>
</html>
