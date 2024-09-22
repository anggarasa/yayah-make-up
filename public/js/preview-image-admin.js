function imagePreview() {
    return {
        imageUrl: null,
        previewImage() {
            const reader = new FileReader();
            const imageFile = event.target.files[0];
            reader.onload = (e) => {
                this.imageUrl = e.target.result;
            };
            reader.readAsDataURL(imageFile);
        },
    };
}
