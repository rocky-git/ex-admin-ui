<template>
  <div class="container">
    <div class="login-layout">
      <div class="left">
        <div class="logo-container">
          <img :src="webLogo" class="logo" v-if="webLogo" />
        </div>
        <div class="left-container">
          <img src="https://guojixiangsu.togy.com.cn/eadmin/login-box-bg.9027741f.svg" class="ad">
          <div class="text-block">
            开箱即用的中后台管理系统
          </div>
        </div>
      </div>
      <div class="right">
        <div class="login-container">
          <a-form ref="loginForm" :model="loginForm" :rules="loginRules" @finish="handleLogin" class="login-form">
            <div class="title-container">
              <h3 class="title">
                <span>登录</span>
              </h3>
            </div>
            <a-form-item name="username">
              <a-input
                  size="large"
                  v-model:value="loginForm.username"
                  placeholder="请输入账号"
                  tabindex="1"
                  auto-complete="on"
              />
            </a-form-item>
            <a-form-item name="password">
              <a-input-password
                  size="large"
                  v-model:value="loginForm.password"
                  placeholder="请输入密码"
                  tabindex="2"
                  auto-complete="on"
                  @keyup.enter.native="handleLogin"
              />

            </a-form-item>
            <div v-if="verifyMode == 2" style="display: flex;justify-content: space-between;">
              <a-form-item name="verify">
            <span class="svg-container">
              <i class="el-icon-circle-check"/>
            </span>
                <a-input
                    ref="verify"
                    v-model="loginForm.verify"
                    placeholder="请输入验证码"
                    name="verify"
                    type="text"
                    tabindex="3"
                    auto-complete="on"
                    style="width: 150px"
                    maxlength="4"
                    @keyup.enter.native="handleLogin"
                />
              </a-form-item>
              <a-image :src="verifyImage" style="height: 52px;cursor: pointer;border-radius: 5px"
                        @click="getVerify"/>
            </div>
            <a-button :loading="loading" size="large" type="primary" htmlType="submit" block>{{loginBtnText}}</a-button>
          </a-form>
        </div>
        <div class="icp"><a href="http://beian.miit.gov.cn" target="_blank">{{webMiitbeian}}</a> | {{webCopyright}}</div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Login',
  props:{
    webLogo:String,
    webName:String,
    webCopyright:String,
    webMiitbeian:String,
    deBug: Boolean,
  },
  data() {
    const validatePassword = (rule, value, callback) => {
      if (value.length < 5) {
        callback(new Error('密码输入长度不能少于5位'))
      } else {
        callback()
      }
    }
    return {
      verifyMode: 1,
      buttonShow: false,
      loginForm: {
        debug: false,
        username: '',
        password: '',
        verify: '',
        hash: '',
      },
      loginRules: {
        username: [{required: true, trigger: 'change', message: '请输入账号'}],
        verify: [{required: true, message: '请输入验证码'}],
        password: [{required: true, trigger: 'change', validator: validatePassword}]
      },
      loading: false,
      verifyImage: '',
      loginBtnText: '登录',
      redirect: null,
    }
  },
  watch: {
    $route: {
      handler: function(route) {
        if(route.query && route.query.redirect){
          const index = route.fullPath.indexOf('?redirect=')
          this.redirect = route.fullPath.substr(index+10)
        }
      },
      immediate: true
    }
  },
  created(){
    if(this.deBug){
      this.loginForm.username = 'admin';
      this.loginForm.password = 'admin';
    }
    this.getVerify()
  },
  methods: {
    getVerify() {
      // this.$action.getVerify().then(res => {
      //   this.verifyImage = res.data.image
      //   this.loginForm.hash = res.data.hash
      //   this.verifyMode = res.data.mode
      // })
    },

    handleLogin(data) {
      this.loading = true
      this.$action.login(data).then(res => {
        this.$router.push(this.redirect || '/' )
      }).finally(() => {
        this.loading = false
      })
    }
  }
}
</script>
<style scoped>

.logo{

}

.login-layout .left{
  position:relative;
  width: 50%;
  height: 100%;
  margin-left: 150px;
}
.login-layout .left .ad{
  width: 45%;
}
.login-layout .right{
  position:relative;
  width: 50%;
  height: 100%;
}

.icp {
  position: absolute;
  bottom:10px;

  width: 100%;
  color: #000;
  opacity: .5;
  font-size: 12px;

}

.icp a {
  color: #000;
  text-decoration: none;
}
@keyframes bg-run {
  0% {
    background-position-x: 0;
  }

  to {
    background-position-x: -1920px;
  }
}
.container{
  position: relative;
  width: 100%;
  height: 100%;
  min-height: 100%;
  overflow: hidden;
  background-color: #FFFFFF;
}
.container:before {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  margin-left: -48%;
  background-image: url("https://guojixiangsu.togy.com.cn/eadmin/login-bg.b9f5c736.svg");
  background-position: 100%;
  background-repeat: no-repeat;
  background-size: auto 100%;
  content: "";
}
.text-block{
  margin-top: 30px;
  font-size: 32px;
  color:#FFFFFF;
}
.logo-container{
  font-size: 24px;
  color: #fff;
  font-weight: 700;
  position: relative;
  top: 50px;
  margin-left:20px;
}
.login-layout {
  height: 100%;
  display: flex;
  position: relative;
}
.left-container{
  position: absolute;
  top:calc(50% - 100px);
  left: 0;
  right: 0;
  bottom: 0;
}
.login-container {
  width: 400px;
  position: absolute;
  top:calc(50% - 250px);
  left:0;
  right: 0;
  bottom: 0;
}
.login-container .login-form {

}

.login-container .tips {
  font-size: 14px;
  color: #fff;
}

.login-container .svg-container {
  padding: 6px 5px 6px 15px;
  color: #889aa4;
  vertical-align: middle;
  display: inline-block;
}
.login-container .title-container .title {
  font-size: 26px;

  font-weight: bold;
}

.login-container .show-pwd {
  position: absolute;
  right: 10px;
  top: 7px;
  font-size: 16px;
  color: #889aa4;
  cursor: pointer;
  user-select: none;
}
</style>
