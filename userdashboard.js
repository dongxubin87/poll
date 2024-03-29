function changeAvatar() {
  var input = document.createElement('input');
  input.type = 'file';
  input.accept = 'image/*';
  input.onchange = function (event) {
    var file = event.target.files[0];
    if (!file) return;
    var reader = new FileReader();
    reader.onload = function (event) {
      var imageData = event.target.result;
      // 在此处将 imageData 发送到服务器以保存头像
      // 然后更新页面上的头像显示
      var avatarElement = document.getElementById('avatar');
      avatarElement.src = imageData;
    };
    reader.readAsDataURL(file);
  };
  input.click();
}

function saveSignature() {
  var signature = document.getElementById("signature").value;
  // 在此处将 signature 发送到服务器以保存个性签名
  // 例如使用 AJAX 请求将数据提交到服务器
  // 更新页面上的签名显示
  var signatureElement = document.getElementById('userSignature');
  signatureElement.textContent = signature;
}
