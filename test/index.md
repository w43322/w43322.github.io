# NEU WebVPN 工具

---

## 使用方法

1.  在下面文本框内填入要访问的域名（不带前后缀），如`neucsecg.neu.edu.cn`。
2.  点击`获取链接`按钮。
3.  打开下面的超链接，使用东北大学WebVPN进入网页。

---

<html>
    <head>
        <script src="https://cdn.staticfile.org/crypto-js/3.1.9-1/crypto-js.min.js"></script>
        <script src="webvpn.js"></script>
    </head>
    <body>
        <div style="display: table; margin-right: auto; margin-left: auto;">
            <input value="neu.edu.cn" type="text" id="url-input">
            <button id="convert" onclick="convertOnClick()">获取链接</button>
            <br>
            <a id="converted-link" href="https://neu.edu.cn/">用东北大学WebVPN打开'neu.edu.cn'</a>
        </div>
    </body>
</html>

---

## 免责声明

1.  本工具仅用于生成WebVPN链接，用于其他用途后果自负。

## 关于

[原理](https://github.com/w43322/neu-webvpn-anysite)

[帮助改进此页面](https://github.com/w43322/w43322.github.io/pulls)

[给我发邮件](mailto:raywang777@foxmail.com)

---

<div style="text-align:center">©️ 2022 Tang Kuku</div>
