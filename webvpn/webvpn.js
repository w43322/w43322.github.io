const raw_key = "b0A58a69394ce73@";
const key_iv = CryptoJS.enc.Utf8.parse(raw_key);
const hex_key = CryptoJS.enc.Hex.stringify(key_iv);

const url_input = document.getElementById("url-input");
const converted_link = document.getElementById("converted-link");

function getConvertedUrl(url) {
  return "https://webvpn.neu.edu.cn/http/" + hex_key + 
      CryptoJS.AES.encrypt(url, 
                           key_iv, {
                             iv: key_iv,
                             mode: CryptoJS.mode.CFB,
                             padding: CryptoJS.pad.ZeroPadding
                           }).ciphertext.toString().substr(0, url.length << 1);
}

function convertOnClick() {
  const url = url_input.value;
  converted_link.setAttribute("href", getConvertedUrl(url));
  converted_link.innerHTML = `用东北大学WebVPN打开'${url}'`;
}

convertOnClick();
