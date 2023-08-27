<div class="card-header">
    <h2>SEO</h2>
    <a  id="auto-fill-btn" data-title="name" data-description="description" class="btn mdi mdi-spin mdi-file-replace-outline" role="button">&nbsp;&nbsp;Auto Fill&nbsp;</a>
</div>
<div class="card-body pb-0">
    <div class="form-group">
        <label for="seo_title">SEO Title @include('cms._include.required')</label>
        <input class="form-control @error('seo_title') is-invalid @enderror" id="seo_title" name="seo_title" placeholder="SEO Title" value="{{ old('seo_title', $model->seo->title) }}">
        @error('seo_title')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="seo_description">SEO Description @include('cms._include.required')</label>
        <textarea id="seo_description" class="form-control @error('seo_description') is-invalid @enderror" name="seo_description">{{ old('seo_description', $model->seo->description) }}</textarea>
        @error('seo_description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="seo_robots">
            SEO Robots Meta Tag
            <i class="mdi mdi-tooltip-edit"  data-toggle="tooltip" data-placement="right" data-original-title="Comma separated HTML tag that goes the head tag of a page and provides instructions to Google bots"></i>
        </label>
        <input class="form-control @error('seo_robots') is-invalid @enderror" id="seo_robots" name="seo_robots" placeholder="SEO Robots Tag" value="{{ old('seo_robots', $model->seo->robots) }}">
        @error('seo_robots')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="seo_canonical_url">
            SEO Canonical URL
            <i class="mdi mdi-tooltip-edit"  data-toggle="tooltip" data-placement="right" data-original-title="Canonical URL is the URL of a page that Google chose as the most representative from a set of duplicate pages"></i>
        </label>
        <input class="form-control @error('seo_canonical_url') is-invalid @enderror" id="seo_canonical_url" name="seo_canonical_url" placeholder="SEO Canonical URL" value="{{ old('seo_canonical_url', $model->seo->canonical_url) }}">
        @error('seo_canonical_url')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="seo_image">SEO Image <p>{{ $model->seo->image ?: 'No Image Attached' }}</p> </label>
        <br>
        <small>It will be taken automatically from this data's image</small>
        <br>
        @if ($model->seo->image !== "")
        <img id="seo-image-preview" height="150px" src="{{ $model->seo->image }}" alt="Uploaded image" class="mt-3"/>
        @endif
    </div>
    <div class="form-group">
        <label for="seo_author">SEO Author  <p>{{ $model->seo->author ?: '-' }}</p></label>
        <br>
        <small>It will be filled automatically from authenticated user's name</small>
        <br><br> 
    </div>
</div>
