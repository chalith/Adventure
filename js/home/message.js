function countChar(val) {
    var len = val.value.length;
    if (len >= 320) {
      val.value = val.value.substring(0, 320);
    } else {
      $('#charNum').text(320 - len);
    }
  };