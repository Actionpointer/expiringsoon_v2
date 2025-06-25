{{-- Blog Create --}}
<div class="container">
    <!-- Page header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-md-flex justify-content-between align-items-center">
                <div>
                    <h2>Create New Blog Post</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Blog</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('blog.list') }}" class="btn btn-light">Back to Blog List</a>
                </div>
            </div>
        </div>
    </div>
    <form action="#" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="card mb-4">
                    <div class="card-header">Blog Details</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="blogTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="blogTitle" name="title" placeholder="Enter blog title">
                        </div>
                        <div class="mb-3">
                            <label for="blogExcerpt" class="form-label">Excerpt</label>
                            <textarea class="form-control" id="blogExcerpt" name="excerpt" rows="2" placeholder="Short summary..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="blogContent" class="form-label">Content</label>
                            <textarea class="form-control" id="blogContent" name="content" rows="10" placeholder="Write your blog post..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="blogImage" class="form-label">Featured Image</label>
                            <input type="file" class="form-control" id="blogImage" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="blogTags" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="blogTags" name="tags" placeholder="e.g. ecommerce, marketing, sales">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-2">Publish</button>
                            <button type="button" class="btn btn-outline-secondary">Save as Draft</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card mb-4">
                    <div class="card-header">SEO Settings</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="metaTitle" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="metaTitle" name="meta_title" placeholder="Meta title for SEO">
                        </div>
                        <div class="mb-3">
                            <label for="metaDescription" class="form-label">Meta Description</label>
                            <textarea class="form-control" id="metaDescription" name="meta_description" rows="2" placeholder="Meta description for SEO..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="metaKeywords" class="form-label">Meta Keywords</label>
                            <input type="text" class="form-control" id="metaKeywords" name="meta_keywords" placeholder="e.g. blog, ecommerce, marketing">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> 