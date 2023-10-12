<div class="card">
    <div class="card-body">
        <h5 class="card-head">Categories</h5>
        <ol class="list-group list-group-numbered">
            @foreach ($catWBlog as $category)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <a href="{{ Route('blogs_with_category', $category->id) }}" class="text-decoration-none">
                            <div class="fw-bold">{{ $category->name }}</div>
                        </a>
                    </div>
                    <span class="badge bg-primary rounded-pill">{{ count($category->blogs) }}</span>
                </li>
            @endforeach
        </ol>
    </div>
</div>
