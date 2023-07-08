<x-app>
    <div class="container my-4">
        <div class="card mx-auto" style="max-width: 400px;">
            <h2 class="card-header">Crea una cuenta</h2>
            <div class="card-body">
                <form method="POST" action="{{ route('newUser') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lastname">Apellido</label>
                        <input id="lastname" type="text" name="lastname" value="{{ old('lastname') }}"
                            class="form-control @error('lastname') is-invalid @enderror">
                        @error('lastname')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input id="username" type="text" name="username" value="{{ old('username') }}"
                            class="form-control @error('username') is-invalid @enderror">
                        @error('username')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input id="password" type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="form-control">
                    </div>

                    <div class="form-group mx-3 my-3 text-center">
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app>
