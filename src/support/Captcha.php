<?php

namespace ExAdmin\ui\support;

class Captcha
{
    // 验证码字符集合
    protected $codeSet = '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY';
    // 验证码字体大小(px)
    protected $fontSize = 20;
    // 是否画混淆曲线
    protected $useCurve = true;
    // 是否添加杂点
    protected $useNoise = true;
    // 验证码图片高度
    protected $imageH = 50;
    // 验证码图片宽度
    protected $imageW = 130;
    // 验证码位数
    protected $length = 4;

    // 背景颜色
    protected $bg = [255, 255, 255];

    /**
     * 配置验证码
     * @param string|null $config
     */
    protected function configure(array $config): void
    {
        foreach ($config as $key => $val) {
            if (property_exists($this, $key)) {
                $this->{$key} = $val;
            }
        }
    }

    /**
     * 验证验证码是否正确
     * @access public
     * @param string $code 用户验证码
     * @param string $hash 验证码hash
     * @return bool 用户验证码是否正确
     */
    public function check(string $code, $hash): bool
    {
        $code = strtolower($code);
        $res  = password_verify($code, $hash);
        return $res;
    }

    public function create(array $config = [])
    {
        $this->configure($config);


        // 图片宽(px)
        $this->imageW || $this->imageW = $this->length * $this->fontSize * 1.5 + $this->length * $this->fontSize / 2;
        // 图片高(px)
        $this->imageH || $this->imageH = $this->fontSize * 2.5;
        // 建立一幅 $this->imageW x $this->imageH 的图像
        $this->im = imagecreate($this->imageW, $this->imageH);
        // 设置背景
        imagecolorallocate($this->im, $this->bg[0], $this->bg[1], $this->bg[2]);

        // 验证码字体随机颜色
        $this->color = imagecolorallocate($this->im, mt_rand(1, 150), mt_rand(1, 150), mt_rand(1, 150));

        // 验证码使用随机字体
        $fontttf = __DIR__ . '/../../ttfs/1.ttf';

        if ($this->useNoise) {
            // 绘杂点
            $this->writeNoise();
        }
        if ($this->useCurve) {
            // 绘干扰线
            $this->writeCurve();
        }
        //生成验证码
        $characters = str_split($this->codeSet);
        for ($i = 0; $i < $this->length; $i++) {
            $text[] = $characters[rand(0, count($characters) - 1)];
        }
        $textStr = strtolower(implode('', $text));
        $hash    = password_hash($textStr, PASSWORD_BCRYPT, ['cost' => 10]);
        // 绘验证码
        $x = $this->imageW / $this->length;
        foreach ($text as $index => $char) {
            $_x    = $x * $index + mt_rand(3, 5);
            $y     = $this->fontSize + mt_rand(10, 20);
            $angle = mt_rand(-40, 40);
            $color = imagecolorallocate($this->im, mt_rand(1, 150), mt_rand(1, 150), mt_rand(1, 150));
            imagettftext($this->im, $this->fontSize, $angle, $_x, $y,$color, $fontttf, $char);
        }
        ob_start();
        // 输出图像
        imagepng($this->im);
        $content = ob_get_clean();
        imagedestroy($this->im);
        return [
            'image' => 'data:image/png;base64,' . base64_encode($content),
            'hash'  => $hash
        ];
    }

    /**
     * 画杂点
     * 往图片上写不同颜色的字母或数字
     */
    protected function writeNoise(): void
    {
        for ($i = 0; $i < 10; $i++) {
            //杂点颜色
            $noiseColor = imagecolorallocate($this->im, mt_rand(150, 225), mt_rand(150, 225), mt_rand(150, 225));
            for ($j = 0; $j < 5; $j++) {
                // 绘杂点
                imagestring($this->im, mt_rand(1, 5), mt_rand(0, $this->imageW), mt_rand(0, $this->imageH), '*', $noiseColor);
            }
        }
    }

    /**
     * 画一条由两条连在一起构成的随机正弦函数曲线作干扰线(你可以改成更帅的曲线函数)
     *
     *      高中的数学公式咋都忘了涅，写出来
     *        正弦型函数解析式：y=Asin(ωx+φ)+b
     *      各常数值对函数图像的影响：
     *        A：决定峰值（即纵向拉伸压缩的倍数）
     *        b：表示波形在Y轴的位置关系或纵向移动距离（上加下减）
     *        φ：决定波形与X轴位置关系或横向移动距离（左加右减）
     *        ω：决定周期（最小正周期T=2π/∣ω∣）
     *
     */
    protected function writeCurve(): void
    {
        $px = $py = 0;

        // 曲线前部分
        $A = mt_rand(1, $this->imageH / 2); // 振幅
        $b = mt_rand(-$this->imageH / 4, $this->imageH / 4); // Y轴方向偏移量
        $f = mt_rand(-$this->imageH / 4, $this->imageH / 4); // X轴方向偏移量
        $T = mt_rand($this->imageH, $this->imageW * 2); // 周期
        $w = (2 * M_PI) / $T;

        $px1 = 0; // 曲线横坐标起始位置
        $px2 = mt_rand($this->imageW / 2, $this->imageW * 0.8); // 曲线横坐标结束位置

        for ($px = $px1; $px <= $px2; $px = $px + 1) {
            if (0 != $w) {
                $py = $A * sin($w * $px + $f) + $b + $this->imageH / 2; // y = Asin(ωx+φ) + b
                $i  = (int)($this->fontSize / 5);
                while ($i > 0) {
                    imagesetpixel($this->im, $px + $i, $py + $i, $this->color); // 这里(while)循环画像素点比imagettftext和imagestring用字体大小一次画出（不用这while循环）性能要好很多
                    $i--;
                }
            }
        }

        // 曲线后部分
        $A   = mt_rand(1, $this->imageH / 2); // 振幅
        $f   = mt_rand(-$this->imageH / 4, $this->imageH / 4); // X轴方向偏移量
        $T   = mt_rand($this->imageH, $this->imageW * 2); // 周期
        $w   = (2 * M_PI) / $T;
        $b   = $py - $A * sin($w * $px + $f) - $this->imageH / 2;
        $px1 = $px2;
        $px2 = $this->imageW;

        for ($px = $px1; $px <= $px2; $px = $px + 1) {
            if (0 != $w) {
                $py = $A * sin($w * $px + $f) + $b + $this->imageH / 2; // y = Asin(ωx+φ) + b
                $i  = (int)($this->fontSize / 5);
                while ($i > 0) {
                    imagesetpixel($this->im, $px + $i, $py + $i, $this->color);
                    $i--;
                }
            }
        }
    }
}
