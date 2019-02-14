@extends('layouts.admin')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Post Blog Here
            </div>
            <div class="panel-body">
                <!-- Add blog -->
                <form action="{{ url('posts') }}" method="POST" enctype="multipart/form-data" class="add-note">
                {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-lg-12 control-label">Post Title</label>
                            <div class="col-lg-12">
                                <input class="form-control file" name="post_title" type="text" required>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-lg-12 control-label">Post Content</label>
                            <div class="col-lg-12">
                                <textarea class="form-control description" name="post_content" type="text" required>
                                </textarea>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-lg-12 control-label">Post Excerpt</label>
                            <div class="col-lg-12">
                                <textarea class="form-control" name="excerpt" type="text" required>
                                </textarea>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-lg-12 control-label">Upload author or book cover photo</label>
                            <div class="col-lg-12">
                                <input class="form-control file" type="file" name="image" required>   
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-lg-12 control-label">Category</label>
                            <div class="col-lg-12">
                                <select class="form-control" name="category" required>
                                    <option value="1" >Uncategorized</option>
                                    <option value="2">Children's book</option>
                                    <option value="3">Literature & Fiction & Non-Fiction</option>
                                    <option value="4">Christian and Inpirational</option>
                                    <option value="5">History</option>
                                    <option value="6">Health & Fitness</option>
                                    <option value="7">Computers & Technology</option>
                                    <option value="8">Sports & Travel</option>
                                </select>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-success" value="Submit">
                            </div>
                        </div>
                </form><!-- Form END -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<!-- https://artisansweb.net/install-use-tinymce-wysiwyg-html-editor-laravel/ -->
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea.description', forced_root_block : 'p' });</script>
@endsection
