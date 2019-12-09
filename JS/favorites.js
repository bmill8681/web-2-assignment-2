document.addEventListener('DOMContentLoaded', function () {
    if(document.querySelector(".removeAll"))
        document.querySelector(".removeAll").addEventListener('click', () => removeAllPhotos());

    let buttonList = document.querySelectorAll(".removePhoto");
    buttonList.forEach(cur => {
        cur.addEventListener('click', e => removePhoto(e))
    });
});

removeAllPhotos = () => {
    fetch('./favoritesRemover.php?all=yeahbud')
    .then(data => data.json())
    .then(data => {
        if (data)
            location.reload();
    });
}

removePhoto = e => {
    fetch(`./favoritesRemover.php?imageid=${e.target.dataset.imageid}`)
        .then(data => data.json())
        .then(data => {
            location.reload();
        });
}