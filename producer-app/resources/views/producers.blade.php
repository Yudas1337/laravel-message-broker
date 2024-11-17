<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Producer App</title>
</head>
<body>

@if(session()->has('message'))
    <h1>{{ session('message') }}</h1>
@endif
<h1>Laravel Message Broker using RabbitMQ</h1>
<p>This is a simple Laravel application that demonstrates how to use RabbitMQ to send messages to a queue.</p>
<p>To send a message, click the button below:</p>
<form action="{{ route('send-queue') }}" method="post">
    @csrf
    <input type="text" name="message" placeholder="Enter a message">
    <button type="submit">Send Message</button>
</form>
</body>
</html>
