/*
* 立即顯示圖片
* _this = this = input type=files
* img_ids
* */
function showPreview(_this,img_ids) {
    //取得檔案來源
    var file = _this.files[0];
    if(window.FileReader) {
        img_ids.forEach(function(element) {
            var img_target = document.getElementById(element);
            var fr = new FileReader();
            fr.onloadend = function(e) {
                img_target.src = e.target.result;
            };
            fr.readAsDataURL(file);
        });
    }
}