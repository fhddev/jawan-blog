const element = document.querySelector('[data-choices="post-tags"]');
if (element) {
    const choices = new Choices(element, {
        removeItemButton: true
    });
}

$('.summernote').summernote({
    tabsize: 2,
    height: 200
});

new DataTable('#mytable');