<!DOCTYPE html>
<html>
<head>
    <title>Laravel 11 Generate PDF Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        width: 80%;
        margin: 0 auto;
    }
    .header, .footer {
        text-align: center;
    }
    .content {
        margin-top: 20px;
    }
    .details {
        width: 100%;
        border-collapse: collapse;
    }
    .details th, .details td {
        border: 1px solid #000;
        padding: 10px;
        text-align: left;
    }
</style>
<body>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua.</p>
  
    <table class="details">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>C.C.T</th>
            <th>Director</th>
            <th>Supervisor</th>
        </tr>
        @foreach($levels as $level)
        <tr>
            <td>{{ $level->order }}</td>
            <td>{{ $level->level }}</td>
            <td>{{ $level->cct }}</td>
            <td>
                @if($level->director)
                    {{ $level->director->nombre }} {{ $level->director->apellido_paterno }} {{ $level->director->apellido_materno }}
                @endif
        
            </td>
            <td>
                @if($level->supervisor)
                    {{ $level->supervisor->nombre }} {{ $level->supervisor->apellido_paterno }} {{ $level->supervisor->apellido_materno }}
                @endif
            </td>
        </tr>
        @endforeach
    </table>
  
    
</body>
</html>
