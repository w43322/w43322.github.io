---
github:
  is_project_page: true
  repository_url: https://github.com/w43322/neu-webvpn-anysite
  repository_name: neu-webvpn-anysite
---

# NEU WebVPN 工具

---

## 使用方法

1.  在下面文本框内填入要访问的域名（不带前后缀），如`neucsecg.neu.edu.cn`。
2.  点击`获取链接`按钮。
3.  打开下面的超链接，使用东北大学WebVPN进入网页。
4.  若有更改端口号的需求，请复制下面的链接，并把`webvpn.neu.edu.cn/http/...`改为`.../http-"端口号"/...`，如`.../http-80/...`。

---

<html>
    <head>
        <script src="https://cdn.staticfile.org/crypto-js/3.1.9-1/crypto-js.min.js"></script>
    </head>
    <body>
        <div style="display: table; margin-right: auto; margin-left: auto;">
            <input value="neu.edu.cn" type="text" id="url-input">
            <button id="convert" onclick="convertOnClick()">获取链接</button>
            <br>
            <a id="converted-link"></a>
        </div>
        <script src="webvpn.js"></script>
    </body>
</html>

---

## 免责声明

1.  本工具仅用于生成WebVPN链接，用于其他用途后果自负。

## 关于

[原理](https://github.com/w43322/neu-webvpn-anysite)

[帮助改进此页面](https://github.com/w43322/w43322.github.io/pulls)

[给我发邮件](mailto:raywang777@foxmail.com)
