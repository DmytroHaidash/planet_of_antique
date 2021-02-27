@extends('layouts.admin', ['title' => $user->name])

@section('content')
    <section>
        <form action="{{ route('admin.users.update', $user) }}" method="post">
            @csrf
            @method('patch')

            <div class="flex items-center">
                <h1 class="text-3xl font-bold font-slab">
                    Name: {{ $user->name }}
                </h1>
            </div>
            <div class="text-2xl">
                <p> Email:
                    <a href="mailto:{{ $user->email }}" class="border-b hover:text-orange-600 hover:border-orange-300">
                        {{ $user->email }}
                    </a>
                </p>
            </div>
            <div class="form-group">
                <select name="role" id="role" class="form-control">
                    @foreach(App\Models\User::$ROLES as $role)
                        <option value="{{ $role }}" {{ $role === $user->role ? 'selected' : '' }}>
                            {{ $role }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="premium">Premium</label>
                <input type="date" class="form-control" name="premium" id="premium"
                       value="{{ old('premium') ?? $user->premium }}">
            </div>
            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>

    </section>

@endsection
