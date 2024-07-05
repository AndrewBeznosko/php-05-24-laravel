<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false" v-pre>
        Products
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">
            Create Product
        </a>
        <a class="dropdown-item" href="#">
            All Products
        </a>

    </div>
</li>

<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
        Categories
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('admin.categories.create')  }}">
            Create Category
        </a>
        <a class="dropdown-item" href="{{ route('admin.categories.index')  }}">
            All Categories
        </a>

    </div>
</li>
