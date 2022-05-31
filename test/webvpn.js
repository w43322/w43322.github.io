document.getElementById("convert").onclick = () =>
{
    const url = document.getElementById("url-input").value;
    const key_iv = CryptoJS.enc.Utf8.parse("wrdvpnisthebest!");
    const res = "https://webvpn.neu.edu.cn/http/77726476706e69737468656265737421"
    + CryptoJS.AES.encrypt(
        url, 
        key_iv, {
            iv: key_iv,
            mode: CryptoJS.mode.CFB,
            padding: CryptoJS.pad.ZeroPadding
        }).ciphertext.toString().substr(0, url.length<<1);
    document.getElementById("converted-link").setAttribute("href", res);
    document.getElementById("converted-link").innerHTML = "用东北大学WebVPN打开'" + url + "'";
}