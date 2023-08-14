<script src="https://cdn.tiny.cloud/1/{{ env('TINY_CLOUD_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea.wysiwyg',
    plugins: 'code table lists',
    toolbar: 'undo redo | blocks | bold italic underline strikethrough | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    /*'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat'*/
  });
</script>