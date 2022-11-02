---
github:
  is_project_page: true
  repository_url: https://github.com/w43322/c_osu_desu
  repository_name: c_osu_desu
---

# 用C语言实现Osu!音游

---

## Gameplay Demo

![](./osu_gameplay.gif)

## In-depth Gameplay Demo

<div style="position: relative; padding: 30% 45%;">
<iframe style="position: absolute; width: 100%; height: 100%; left: 0; top: 0;" src="https://player.bilibili.com/player.html?aid=555497526&bvid=BV15v4y1T7bN&cid=759844696&page=1&as_wide=1&high_quality=1&danmaku=0" frameborder="no" scrolling="no"></iframe></div>

## 实现细节总结与反思

### 谱面文件parser

* 使用了哈希来实现对字符串switch-case的支持

  ```c
  unsigned int hash_string(const char* String) {
      unsigned int hash = 0, i;
      assert_static(sizeof(unsigned int) == 4);
      assert_static(sizeof(unsigned char) == 1);
      for (i = 0; String[i]; ++i)
          hash = 65599 * hash + String[i];
      return hash ^ (hash >> 16);
  }
  ```

* 当时为了提高工作量用了sscanf、strchr等库函数手搓parser，现在看来用cjson等库实现更好

* 一个乐曲的信息parse后的信息直接保存在栈上，占的内存空间比较多(虽然还不到20MB)，可以优化一下，不一次读完

### 游戏渲染

* 手写了渲染队列，但实现的方式比较初级，不够高效，被遮挡的元素会先被渲染一次

* 手写了获取贝塞尔曲线上和圆弧上点位置的函数

  ```c
  POINT Bezier(const POINT* Points, int N, float T) {
    if (T < 0.0f) T = 0.0f;
    if (T > 1.0f) T = 1.0f;
    POINT res;
    float sum_x = 0.0f, sum_y = 0.0f;
    for (int i = 0; i <= N; ++i) {
      sum_x += pow(1 - T, N - i) * pow(T, i) * Combinition(N, i) * Points[i].x;
      sum_y += pow(1 - T, N - i) * pow(T, i) * Combinition(N, i) * Points[i].y;
    }
    res.x = (long)sum_x, res.y = (long)sum_y;
    return res;
  }
  POINT Circle(const POINT* Points, float T) {
    /* ...... */
  }
  ```

### 菜单设计

* 为满足学校课程要求，使用双向循环链表实现主菜单

* 参考了80年代红白机的风格，超长的字符串可以在屏幕上滚动显示

## 技术栈

* C
* EasyX
* Windows API

## 关于

&emsp;&emsp;本项目为东北大学计算机学院C语言课程设计，完成于2022年4月。
