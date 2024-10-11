<script>
    function imagePreview() {
      return {
          images: [],
          handleFileChange(event) {
              const files = event.target.files;
              this.images = [...files].map(file => URL.createObjectURL(file));
          }
      };
  }

  function videoPreview() {
      return {
          videos: [],
          handleFileChange(event) {
              const files = event.target.files;
              this.videos = [...files].map(file => URL.createObjectURL(file));
          }
      };
  }
</script>