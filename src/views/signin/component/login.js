const login = {
  data() {
    return {
      password: "",
      email: "",
      rememberCheck: true,
      passwordValidate: {
        passLength: true,
        passLower: true,
        passUpper: true,
        passNumber: true,
      },
      allValidationPassword: true,
      allValidationEmail: true,
    };
  },
  methods: {
    validateLogin() {
      console.log("validate");
      axios
        .post("/api/internal-apis/login.php", {
          email: this.email,
          password: this.password,
        })
        .then((res) => {
          if (res.data.logged_status) {
            location.href = res.data.redirrect;
          }
          console.log(res);
        })
        .catch((err) => {
          console.error(err);
        });
      // this.passwordValidate.passLength=this.password.length>8?true:false;
      // this.passwordValidate.passUpper = /[A-Z]/.test(this.password)?true:false;
      // this.passwordValidate.passLower=/[a-z]/.test(this.password)?true:false;
      // this.passwordValidate.passNumber=/[0-9]/.test(this.password)?true:false;
      // if(this.passwordValidate.passLength&&
      //     this.passwordValidate.passUpper&&
      //     this.passwordValidate.passLower&&
      //     this.passwordValidate.passNumber) this.allValidationPassword=true
    },
  },
  template: `
    <div class="login-screen img-fluid">
        <div class="main-div">

            <div class="ad-logo">
                    <img src="./assets/ad-logo.svg">
            </div>
            <div class="bg-img-1">
                <img src="./assets/bg-logo1.svg">
            </div>
            <div class="bg-img-2">
                <img src="./assets/bg-logo2.svg">
            </div>
            <div class="bg-img-3">
                <img src="./assets/bg-logo3.svg">
            </div>
            <div class="login-text">
                <h3>Login to your account</h3>
                <p :style="allValidationEmail&&allValidationPassword?'display:none':''">Welcome back! Please enter your details.</p>
                <p :style="allValidationEmail&&allValidationPassword?'color:#FBC9CB':'display:none'"> Ensure your email and password are correct then try again</p>
            </div>
            <form  @submit.prevent="validateLogin"  >
                <div class="input-field">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                        class="form-control" 
                        id="email" 
                        placeholder="Enter your email" 
                        name="email" 
                        v-model="email"
                        required>
                </div>

                <div class="input-field">
                    <label for="user-password" class="form-label">Password</label>
                    <input type="password" 
                        class="form-control" 
                        id="user-password" 
                        placeholder="Enter password" 
                        name="user-password" 
                        v-model="password"
                        required>
                </div>

                <div class="checkbox-field">
                    <div class="remember-field">
                        <input v-model="rememberCheck" class="form-check-input" type="checkbox" id="myCheck"  name="remember" required>
                        <label class="form-check-label" for="myCheck">Remember me</label>
                    </div>
                    <div class="forget-password">
                        <span >Forgot password?</span>
                    </div>
                </div>
                <button type="submit"  class="login-btn">Log In</button>
            </form>
            <div class="contact-line pt-4" >
                <span >Don’t have an account? </span>
                <span >Contact us</span>
            </div>
        </div>  
        <loginfooter>
        </loginfooter>
    </div>
    
	
	
	`,
};
