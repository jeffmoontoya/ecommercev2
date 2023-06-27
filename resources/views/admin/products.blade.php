<x-app>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="admin-sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users') }}">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products') }}">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.categories') }}">Categorías</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <product-list/>
            </div>
        </div>
    </div>
</x-app>
