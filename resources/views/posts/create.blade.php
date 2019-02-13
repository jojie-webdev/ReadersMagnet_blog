@extends('layouts.admin')

@section('content')
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
                                <input class="form-control file" name="title" type="text" required>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-lg-12 control-label">Post Content</label>
                            <div class="col-lg-12">
                                <textarea class="form-control description" name="body" type="text" required>
                                </textarea>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-lg-12 control-label">Upload author or book cover photo</label>
                            <div class="col-lg-12">
                                <input class="form-control file" type="file" name="filename" required>   
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-lg-12 control-label">Category</label>
                            <div class="col-lg-12">
                                <select class="form-control" name="category" required>
                                    <option value="Uncategorized" >Uncategorized</option>
                                    <option value="Children's book">Children's book</option>
                                    <option value="Literature & Fiction & Non-Fiction">Literature & Fiction & Non-Fiction</option>
                                    <option value="Christian and Inpirational">Christian and Inpirational</option>
                                    <option value="History">History</option>
                                    <option value="Health & Fitness">Health & Fitness</option>
                                    <option value="Computers & Technology">Computers & Technology</option>
                                    <option value="Sports & Travel1">Sports & Travel</option>
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
<script>tinymce.init({ selector:'textarea.description' });</script>
@endsection
