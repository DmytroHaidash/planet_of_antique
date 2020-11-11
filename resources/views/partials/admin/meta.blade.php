<h2 class="mt-2">Meta</h2>

<div class="form-group">
    <label for="meta[title]">Title</label>
    <input type="text" name="meta[title]" class="form-control"
           value="{!! $meta ? $meta->title : '' !!}">
</div>

<div class="form-group">
        <label for="meta[description]">Description</label>
        <textarea cols="4" name="meta[description]" class="form-control">{!! $meta ? $meta->description : '' !!}</textarea>
</div>

<div class="form-group">
    <label for="meta[keywords]">Key words</label>
    <input type="text" name="meta[keywords]" class="form-control"
           value="{!! $meta ? $meta->keywords : '' !!}">
</div>
