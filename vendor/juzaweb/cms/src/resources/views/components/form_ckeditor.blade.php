<div class="form-group">
    <label class="col-form-label" for="ckeditor-{{ $name }}">{{ $label ?? $name }}</label>
    <textarea class="form-control" name="{{ $name }}" id="ckeditor-{{ $name }}" rows="5">{{ $value ?? '' }}</textarea>
</div>

<script type="text/javascript">
    CKEDITOR.replace("ckeditor-{{ $name }}", {
        filebrowserImageBrowseUrl: '/admin/file-manager?type=image',
        filebrowserBrowseUrl: '/admin/file-manager?type=file',
    });
</script>