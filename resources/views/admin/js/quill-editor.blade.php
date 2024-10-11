<script>
  var quill = new Quill("#description", {
    modules: {
        toolbar: [
            [{ header: [1, 2, 3, 4, 5, 6, false] }],
            ["bold", "italic", "underline"],
            [{ list: "ordered" }, { list: "bullet" }],
            [{ indent: "-1" }, { indent: "+1" }],
            [{ size: ["small", false, "large", "huge"] }],
            [{ font: [] }],
            [{ color: [] }, { background: [] }],
            [{ align: [] }],
        ],
    },
    placeholder: "Type something...",
    theme: "snow",
});

quill.on('text-change', function(delta, oldDelta, source) {
    @this.set('description', quill.root.innerHTML);
});

</script>