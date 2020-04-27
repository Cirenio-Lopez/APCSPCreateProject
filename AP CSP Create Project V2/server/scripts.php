<script src="styles/js/jquery.min.js"></script>
<script src="styles/js/jquery.validate.js"></script>
<!-- Preexisting Scripts (From a previous project) -->
<script src="styles/js/simpleParallax.js"></script>
<script src="styles/js/jarallax.js"></script>
<script src="styles/js/jarallax-video.js"></script>
<script src="styles/js/jarallax-element.js"></script>
<!-- Image Loader (Probably Not Needed) --><script src="styles/js/imagesloaded.pkgd.js"></script>
<!-- Image Sorter--><script src="styles/js/isotope.pkgd.js"></script>
<script src="styles/js/swiper.js"></script>
<script src="styles/js/grained.js"></script>
<script src="styles/js/scripts.js"></script>
<!-- My Scripts -->
<script>
    $(document).ready(function()
    {	// Main Content Edit
        $("#edit-toggle-main").click(function()
        {
            $("#ellipsis").toggle();
        });
        //Content Popup
        $("#edit-overlay-btn").click(function()
        {
            $("#edit-overlay").toggle();
        });
        $("#close-toggle-content").click(function()
        {
            $("#edit-overlay").toggle();
        });
        //Image Editing Tool
        $("#edit-img-btn").click(function()
        {
            $("#edit-overlay-image").toggle();
        });
        $("#close-toggle-image").click(function()
        {
            $("#edit-overlay-image").toggle();
        });
        //add
        $("#add-toggle").click(function()
        {
            $("#add").toggle();
        });
        $("#close-toggle-add").click(function()
        {
            $("#add").toggle();
        });
        // //delete
        // $("#delete-toggle").click(function()
        // {
        // 	$("#delete").toggle();
        // });
        // $("#close-toggle-delete").click(function()
        // {
        // 	$("#delete").toggle();
        // });
        // //edit
        // $("#edit-toggle").click(function()
        // {
        // 	$("#edit").toggle();
        // });
        // $("#close-toggle-edit").click(function()
        // {
        // 	$("#edit").toggle();
        // });
    });
</script>
<!-- Text Editor Scripts -->
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    var toolbarOptions = 
    [
        ['bold','italic','underline','strike'],
        ['blockquote','code-block'],
        [{'header': 1}, {'header': 2}],
        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'script': 'sub'}, {'script': 'super'}]
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        [{ 'direction': 'rtl' }],
        [{ 'size': ['small', false, 'large', 'huge'] }],
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'font': [] }],
        [{ 'align': [] }],
        ['clean']   
    ];
    var quill = new Quill('#editor',
    {
        modules:
        {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    $("#submit_edit").click(function ()
    {
        var id = $(this).parent().parent().parent().attr('id');
        var delta = quill.root.innerHTML;
        var curr_url = window.location.href;
        $.post("server/cms.php",{content: delta, id: id, curr_url: curr_url}, function(){});
        $("#edit-overlay").toggle();
        location.reload();
    });
</script>