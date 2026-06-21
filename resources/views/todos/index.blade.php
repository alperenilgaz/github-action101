<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DevOps101 - Todo</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: system-ui, sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .card {
            background: #1e293b;
            border-radius: 12px;
            padding: 2rem;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 8px 32px rgba(0,0,0,.4);
        }
        h1 { font-size: 1.5rem; margin-bottom: .25rem; }
        .subtitle { color: #94a3b8; font-size: .875rem; margin-bottom: 1.5rem; }
        form.add { display: flex; gap: .5rem; margin-bottom: 1.5rem; }
        input[type=text] {
            flex: 1;
            padding: .625rem .875rem;
            border: 1px solid #334155;
            border-radius: 8px;
            background: #0f172a;
            color: #e2e8f0;
            font-size: .9375rem;
        }
        input[type=text]:focus { outline: 2px solid #6366f1; border-color: transparent; }
        button, .btn {
            padding: .625rem 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: .875rem;
            font-weight: 500;
        }
        .btn-primary { background: #6366f1; color: #fff; }
        .btn-primary:hover { background: #4f46e5; }
        .btn-danger { background: transparent; color: #f87171; padding: .25rem .5rem; }
        .btn-danger:hover { color: #ef4444; }
        ul { list-style: none; }
        li {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .75rem 0;
            border-bottom: 1px solid #334155;
        }
        li:last-child { border-bottom: none; }
        li.done span { text-decoration: line-through; color: #64748b; }
        .empty { color: #64748b; text-align: center; padding: 1rem 0; font-size: .875rem; }
        .badge {
            display: inline-block;
            background: #312e81;
            color: #a5b4fc;
            font-size: .75rem;
            padding: .125rem .5rem;
            border-radius: 999px;
            margin-left: .5rem;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>DevOps101 <span class="badge">CI/CD Demo</span></h1>
        <p class="subtitle">GitHub Actions ile test edilecek basit todo uygulamasi</p>

        <form class="add" action="{{ route('todos.store') }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Yeni gorev ekle..." required maxlength="255">
            <button type="submit" class="btn btn-primary">Ekle</button>
        </form>

        @if ($errors->any())
            <p style="color:#f87171;font-size:.875rem;margin-bottom:1rem;">{{ $errors->first() }}</p>
        @endif

        <ul>
            @forelse ($todos as $todo)
                <li class="{{ $todo->completed ? 'done' : '' }}">
                    <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn" style="background:transparent;font-size:1.1rem;">
                            {{ $todo->completed ? '[x]' : '[ ]' }}
                        </button>
                    </form>
                    <span style="flex:1">{{ $todo->title }}</span>
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Sil</button>
                    </form>
                </li>
            @empty
                <li class="empty">Henuz gorev yok. Yukaridan ekleyebilirsin.</li>
            @endforelse
        </ul>
    </div>
</body>
</html>